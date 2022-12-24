<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function GetAllEmployee()
    {
        $employees = Employee::all();
        return view('employee.employee', compact('employees'));
    }

    public function GetEmployeeById($id)
    {
        $employees = Employee::all();
        return view('employee.employee', compact('employees'));
    }

    public function AddEmployee()
    {
        return view('employee.employee-add');
    }

    public function StoreEmployee(Request $request)
    {
        $date = $request->year . '-' . str_pad($request->month, 2, '0', STR_PAD_LEFT) .
            '-' . str_pad($request->day, 2, '0', STR_PAD_LEFT);
        $persian_date = $request->year . '/' . str_pad($request->month, 2, '0', STR_PAD_LEFT) .
            '/' . str_pad($request->day, 2, '0', STR_PAD_LEFT);
        $start_time = str_pad($request->starHour, 2, '0', STR_PAD_LEFT) . ":" .
            str_pad($request->startMinute, 2, '0', STR_PAD_LEFT);
        $end_time = str_pad($request->endHour, 2, '0', STR_PAD_LEFT) . ":" .
            str_pad($request->endMinute, 2, '0', STR_PAD_LEFT);
        Employee::create([
            'employee_id' => 12,
            'date' => $date,
            'persian_date' => $persian_date,
            'start_time' => $start_time,
            'end_time' => $end_time
        ]);
        return redirect()->back()->with('success', 'کارمند با موفقیت ثبت گردید');
    }

    public function DeleteEmployee($id)
    {
        Employee::destroy($id);
        return redirect('/employee');
    }
}
