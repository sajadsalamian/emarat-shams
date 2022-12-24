<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Timesheet;
use App\Models\User;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    public function GetAllTimesheet()
    {
        $emp = User::where('phone', auth()->user()->id)->first();
        $timesheets = Timesheet::where('employee_id', $emp->id)->get();
        return view('timesheet.timesheet', compact('timesheets'));
    }

    public function AddTimesheet()
    {
        return view('timesheet.timesheet-add');
    }

    public function StoreTimesheet(Request $request)
    {
        $emp = User::where('phone', auth()->user()->phone)->first();
        $date = $request->year . '-' . str_pad($request->month, 2, '0', STR_PAD_LEFT) .
        '-' . str_pad($request->day, 2, '0', STR_PAD_LEFT);
        $persian_date = $request->year . '/' . str_pad($request->month, 2, '0', STR_PAD_LEFT) .
        '/' . str_pad($request->day, 2, '0', STR_PAD_LEFT);
        $start_time = str_pad($request->starHour, 2, '0', STR_PAD_LEFT) . ":" .
            str_pad($request->startMinute, 2, '0', STR_PAD_LEFT);
        $end_time = str_pad($request->endHour, 2, '0', STR_PAD_LEFT) . ":" .
            str_pad($request->endMinute, 2, '0', STR_PAD_LEFT);
        Timesheet::create([
            'employee_id' => $emp->id,
            'date' =>$date,
            'persian_date' => $persian_date,
            'start_time' => $start_time,
            'end_time' => $end_time
        ]);
        return redirect()->back()->with('success', 'ساعت کاری با موفقیت ثبت گردید');
    }

    public function DeleteTimesheet($id)
    {
        Timesheet::destroy($id);
        return redirect('/timesheet');
    }
}
