<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinancialController extends Controller
{
    public function FinancialRoot()
    {
        return view('financial.financial');
    }

    public function LoanRoot()
    {
        switch (auth()->user()->role) {
            case 0:
                $loans = DB::table('loan')->get();
                break;
            case 5:
                $loans = DB::table('loan')->where('type', 2)->get();
                break;
            default:
                $loans = DB::table('loan')->where('user_id', auth()->user()->id)->get();
                break;
        }
        foreach ($loans as $loan) {
            if ($loan->type == 1) {
                $loan->type_name = 'وام';
            } else {
                $loan->type_name = 'مساعده';
            }
            switch ($loan->status) {
                case 1:
                    $loan->status_name = 'در انتظار بررسی';
                    break;
                case 3:
                    $loan->status_name = 'ارسال شده به واحد مالی';
                    break;
                case 2:
                    $loan->status_name = 'موافقت شده';
                    break;
                default:
                    break;
            }
            $user = User::find($loan->user_id);
            $loan->user_name = $user->first_name . " " . $user->last_name;
        }
        return view('financial.loan.loan', compact('loans'));
    }

    public function GetLoanById($id)
    {
        $loan = DB::table('loan')->find($id);
        if ($loan->type == 1) {
            $loan->type_name = 'وام';
        } else {
            $loan->type_name = 'مساعده';
        }
        switch ($loan->status) {
            case 1:
                $loan->status_name = 'در انتظار بررسی';
                break;
            case 3:
                $loan->status_name = 'ارسال شده به واحد مالی';
                break;
            case 2:
                $loan->status_name = 'موافقت شده';
                break;
            default:
                break;
        }
        $loan->amount = number_format($loan->amount, 0, '.', ',');
        $loan->accepted_amount = number_format($loan->accepted_amount, 0, '.', ',');
        $loanPayment = array();
        if($loan->type == 1) {
            $loan->return_amount = number_format($loan->return_amount, 0, '.', ',');
            $loanPayment = DB::table('loan_repayment')->where('loan_id', $id)->get();
        }
        $user = User::find($loan->user_id);
        $loan->user_name = $user->first_name . " " . $user->last_name;

        $loan_docs = DB::table('loan_docs')->where('loan_id', $id)->get();
        for ($i = 0; $i < count($loan_docs); $i++) {
            $loan_docs[$i]->file = 'data:image/;base64,' . $loan_docs[$i]->file;
        }
        return view('financial.loan.loan-view', compact('loan', 'loan_docs', 'loanPayment'));
    }

    public function SetLoanConfirm(Request $request, $id)
    {
        $loan = DB::table('loan')->where('id', $id)->first();
        if ($loan->type == 1) {
            $request->validate([
                'accepted_amount' => 'required',
                'return_month' => 'required'
            ]);
            if (!isset($request->percentages) || trim($request->percentages) == '') {
                $request->percentages = 0;
            }
            $loan = DB::table('loan')->where('id', $id)->update([
                'accepted_amount' => Controller::convertToEnglishNumber($request->accepted_amount),
                'percentage' => Controller::convertToEnglishNumber($request->percentages),
                'return_amount' => str_replace(',', '', Controller::convertToEnglishNumber($request->return_amount)),
                'return_month' => Controller::convertToEnglishNumber($request->return_month),
                'start_date' => Controller::convertToEnglishNumber($request->year) . '/' . Controller::convertToEnglishNumber($request->month),
                'status' => '2'
            ]);
            $returndAmount = str_replace(',', '', Controller::convertToEnglishNumber($request->return_amount));
            $perReturndAmount = intdiv($returndAmount, $request->return_month);
            $extraYear = intdiv($request->month + $request->return_month , 12);
            for($i = 0; $i < $request->return_month + $extraYear; $i++){
                $additionMonth = 0;
                $month = ($request->month + $i + $additionMonth) % 13;
                $yearAdded = intdiv($request->month + $i , 13);
                if($month == 0){
                    continue;
                }
                $loan = DB::table('loan_repayment')->insert([
                    "loan_id" => $id,
                    "amount" => $perReturndAmount,
                    "date" => Controller::convertToEnglishNumber($request->year + $yearAdded) . '/' . Controller::convertToEnglishNumber($month),
                ]);
            }
        } else {
            $request->validate([
                'accepted_amount' => 'required'
            ]);
            $loan = DB::table('loan')->where('id', $id)->update([
                'accepted_amount' => Controller::convertToEnglishNumber($request->accepted_amount),
                'status' => '2'
            ]);
        }
        return redirect()->back()->with('success', 'ثبت گردید');
    }

    public function SaveLoanDoc(Request $request, $id)
    {
        $files = $request->file('loan_doc');
        if ($request->hasFile('loan_doc')) {
            foreach ($files as $file) {
                DB::table('loan_docs')->insert([
                    'loan_id' => $id,
                    'file' => base64_encode(file_get_contents($file)),
                    'type' => 0
                ]);
            }
        }
        return redirect()->back()->with('success', 'مستند با موفقیت ثبت گردید');
    }
}
