<?php

namespace App\Http\Controllers;

use App\Models\User_Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserTopicController extends Controller
{
    public function insert(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->all();
        if(count($data) == 1){
            $request->session()->flash('status', 'Please choose at least 1 topic');
        }
        $listTopicSelected = [];
        foreach($data as $key=>$value){
            if($key == '_token')
                continue;
            array_push($listTopicSelected, ['user_id'=>$user_id, 'topic_id'=>$value, 'created_at' => DB::raw('CURRENT_TIMESTAMP'),
'updated_at' => DB::raw('CURRENT_TIMESTAMP')]);
        }
        DB::beginTransaction();
        try {
            
            User_Topic::insert($listTopicSelected);
            DB::commit();

            return redirect()->route('home');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->route('home')->with('status', trans('select_again'));
        }
        
    }
}
