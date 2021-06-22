<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class NotifyController extends Controller
{

    public function index()
    {
        $notifications = Notification::orderBy('created_at', 'desc')->get();

        foreach ($notifications as $notify) {
            $notify->time = Carbon::createFromFormat('Y-m-d H:i:s', $notify->created_at)->format('H:i:s Y-m-d');
        }

        return view('auth.admin.notifications', compact(['notifications']));
    }

    public function updateRead($id)
    {
        $notify = Notification::find($id);
        if ($notify) {
            $notify->is_read = Config::get('variable.readed');
            $notify->save();

            return $data = ['message' => "success"];
        }

        return $data = ['message' => "fail"];
    }

    public function markAllAsRead(){
        
        $notifications = Notification::where('is_read', Config::get('variable.unread'))->get();
        
        DB::beginTransaction();
        try {
            foreach ($notifications as $notify){
                $notify->is_read = Config::get('variable.readed');
                $notify->save();
            }
            DB::commit();

            return redirect()->route('notifications')->with('status', trans('mark_all_as_read_success'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('notifications')->with('status', trans('mark_all_as_read_success'));
        }
    }
}
