<?php

namespace App\Http\Controllers;

use App\Models\Payslip;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Reader\Exception\ReaderNotOpenedException;
use Rap2hpoutre\FastExcel\FastExcel;

class PayslipController extends Controller
{
    public function GetAllPayslipByUser()
    {
        if (auth()->user()->role == 0) {
            $payslips = Payslip::all();
        } else {
            $payslips = Payslip::where('personal_code', auth()->user()->personal_code)->get();
        }
        return view('financial.payslip.payslip', compact('payslips'));
    }

    public function GetPayslipByUser($id)
    {
        $payslip = Payslip::find($id);
        $user = User::where('personal_code', $payslip->personal_code)->first();
        $payslip_details = DB::table('payslips_details')->where('payslip_id', $id)->first();
        $payslip_details->employee_name = $user->first_name . ' ' . $user->last_name;
        $payslip_details->payslip_document = 'data:image/;base64,' . $payslip_details->payslip_document;
        return view('financial.payslip.payslip-view', compact('payslip_details', 'id'));
    }

    public function StorePayslipDetailsDoc(Request $request, $id)
    {
        $request->validate([
            'pay_det_file' => 'required',
        ]);
        DB::table('payslips_details')->where('id', $id)->update([
            'payslip_document' => base64_encode(file_get_contents($request->pay_det_file))
        ]);
        return redirect()->back()->with('success', 'مستند با موفقیت ثبت گردید');
    }

    public function ImportExcelPayslip()
    {
        $result = array();
        return view('financial.payslip.payslip-import', compact('result'));
    }

    public function ShowExcelPayslip(Request $request)
    {
        $result = array();
        if ($request->hasFile('ecxel_file')) {
            try {
                $result = (new FastExcel)->import($request->file('ecxel_file'), function ($line) {
                    return $line;
                });
            } catch (IOException|UnsupportedTypeException|ReaderNotOpenedException $e) {
            }
        }
        return view('financial.payslip.payslip-import', compact('result'));
    }

    public function SaveExcelPayslip(Request $request)
    {
        $list = json_decode($request->list);
        dd($list);
    }

    public function AddSinglePayslip()
    {
        $users = User::all();
        return view('financial.payslip.payslip-single-add', compact('users'));
    }

    public function SaveSinglePayslip(Request $request)
    {
        $request->validate([
            'personal_code' => 'required',
            'title' => 'required',
            'monthly_salary' => 'required',
            'ayelemandi' => 'required',
            'reward' => 'required',
            'insurance_earn' => 'required',
            'sum_of_earn' => 'required',
            'insurance_deduction' => 'required',
            'loan_deduction' => 'required',
            'mosaede_deduction' => 'required',
            'panelty' => 'required',
            'sum_of_deduction' => 'required',
            'total_earn' => 'required'
        ]);
        $payslipId = DB::table('payslips')->insertGetId([
            'personal_code' => $request->personal_code,
            'title' => $request->title
        ]);
        if ($request->hasFile('pay_det_file')) {
            $image = base64_encode(file_get_contents($request->pay_det_file));
        } else {
            $image = null;
        }
        DB::table('payslips_details')->insert([
            'payslip_id' => $payslipId,
            'monthly_salary' => $request->monthly_salary,
            'ayelemandi' => $request->ayelemandi,
            'reward' => $request->reward,
            'insurance_earn' => $request->insurance_earn,
            'sum_of_earn' => $request->sum_of_earn,
            'insurance_deduction' => $request->insurance_deduction,
            'loan_deduction' => $request->loan_deduction,
            'mosaede_deduction' => $request->mosaede_deduction,
            'panelty' => $request->panelty,
            'sum_of_deduction' => $request->sum_of_deduction,
            'total_earn' => $request->total_earn,
            'payslip_document' => $image
        ]);
        return redirect()->back()->with('success', 'فیش حقوقی با موفقیت ثبت گردید');
    }
}
