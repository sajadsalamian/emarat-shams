<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function GetAllUser()
    {
        $users = User::all();
        foreach ($users as $user) {
            if ($user->wedding == 0) {
                $user->wedding = "مجرد";
            } else {
                $user->wedding = "متاهل";
            }
            switch ($user->role) {
                case 0:
                    $user->role_name = "ادمین";
                    break;
                case 1:
                    $user->role_name = "سرپرست کارگاه";
                    break;
                case 2:
                    $user->role_name = "پیمانکار";
                    break;
                case 3:
                    $user->role_name = "منشی";
                    break;
                case 4:
                    $user->role_name = "کارگر";
                    break;
                case 5:
                    $user->role_name = "مدیر مالی";
                    break;
                default:
                    break;
            }
        }
        return view('user.user', compact('users'));
    }

    public function GetUsersById($id)
    {
        $users = User::find($id);
        return view('user.user', compact('users'));
    }

    public function AddUser()
    {
        $projects = Project::all();
        $user = new User();
        $projects_map = array();
        return view('user.user-add', compact('projects', 'user', 'projects_map'));
    }

    public function StoreUser(Request $request)
    {
        try {
            $request->validate([
                'phone' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'role' => 'required',
                'salary' => 'required',
                'employment_type' => 'required',
                'wedding' => 'required',
            ]);
            $users = DB::table('users')->where('personal_code', 'like', $request->role . "%")
                ->latest('personal_code')->first();
            if (!is_null($users)) {
                $nextCode = $users->personal_code + 1;
            } else {
                $nextCode = $request->role . "0000";
            }
            // dd($nextCode);
            User::create([
                'personal_code' => $nextCode,
                'phone' => $request->phone,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'role' => $request->role,
                'salary' => $request->salary,
                'employment_type' => $request->employment_type,
                'wedding' => $request->wedding,
                'email' => $request->email,
                'password' => Hash::make('test')
            ]);
            return redirect()->back()->with('success', 'کارمند با موفقیت ثبت گردید');
        } catch (\Illuminate\Database\QueryException $exception) {
            $errorCode = $exception->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect()->back()->with('failed', "مقدار تلفن تکراری است");
            }
        }
    }

    public function EditUser($id)
    {
        $user = User::find($id);
        $projects = Project::all();
        $projects_map = DB::table('projects_user_map')->where('user_id', $user->id)->get();
        return view('user.user-add', compact('projects', 'user', 'projects_map'));
    }

    public function UpdateUser(Request $request)
    {
        $request->validate([
            'personal_code' => 'required',
            'phone' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'role' => 'required',
            'salary' => 'required',
            'employment_type' => 'required',
            'wedding' => 'required'
        ]);
        User::whereId($request->id)->update([
            'personal_code' => $request->personal_code,
            'phone' => $request->phone,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role' => $request->role,
            'salary' => $request->salary,
            'employment_type' => $request->employment_type,
            'wedding' => $request->wedding,
            'email' => $request->email
        ]);
        DB::table('projects_user_map')->where('user_id', $request->id)->delete();
        if (!is_null($request->projects)) {
            foreach ($request->projects as $key) {
                DB::table('projects_user_map')->insert([
                    'user_id' => $request->id,
                    'project_id' => $key
                ]);
            }
        }
        return redirect()->back()->with('success', 'کارمند با موفقیت بروزرسانی شد');
    }

    public function DeleteUser($id)
    {
        User::destroy($id);
        return redirect()->route('User.all');
    }

}
