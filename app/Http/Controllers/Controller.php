<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function convertToEnglishNumber($string)
    {
        $newNumbers = range(0, 9);
        $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
        $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

        $string =  str_replace($persianDecimal, $newNumbers, $string);
        $string =  str_replace($arabicDecimal, $newNumbers, $string);
        $string =  str_replace($arabic, $newNumbers, $string);
        return str_replace($persian, $newNumbers, $string);
    }

    public function Index(){
        $notifications = array();
        $allNotifications = Notification::all();
        foreach ($allNotifications as $notif) {
            $users = explode(',', $notif->users);
            if (in_array(auth()->user()->id, $users)) {
                $notifications[] = $notif;
            }
        }
        $unread = 0;
        foreach ($notifications as $notif) {
            $notif_read = DB::table('notification_read')->where([['notification_id', $notif->id], ['user_id', auth()->user()->id]])->first();
            if ($notif_read === null) {
                $unread++;
            }
        }
        return view('main', compact('unread'));
    }
}
