<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function GetAllNotification()
    {
        $notifications = array();
        $allNotifications = Notification::all();
        foreach ($allNotifications as $notif) {
            $users = explode(',', $notif->users);
            if (in_array(auth()->user()->id, $users)) {
                $notifications[] = $notif;
            }
        }
        foreach ($notifications as $notif) {
            $notif_read = DB::table('notification_read')->where([['notification_id', $notif->id], ['user_id', auth()->user()->id]])->first();
            if ($notif_read === null) {
                DB::table('notification_read')->insert([
                    'notification_id' => $notif->id,
                    'user_id' => auth()->user()->id,
                    'visit' => Carbon::now()->toDateTimeString(),
                    'see' => 1
                ]);
            } else {
                $notif->see = !($notif_read->see = 0);
            }
        }
        return view('notification.notification', compact('notifications'));
    }

    public function AddNotification()
    {
        return view('notification.notification-add');
    }

    public function StoreNotification(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        Notification::create([
            'title' => $request->title,
            'description' => $request->description
        ]);
        return redirect()->back()->with('success', 'اعلان با موفقیت ارسال شد');
    }

    public function DeleteNotification($id)
    {
        Notification::destroy($id);
        return redirect('/notification');
    }
}
