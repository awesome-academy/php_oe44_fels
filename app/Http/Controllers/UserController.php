<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->method() == 'GET') {
            $inforUser = Auth::user();
            return view('layouts.functions.profile', compact('inforUser'));
        } else {

            Session::flash('name', 'email');
            $dataUpdate = ['name'=>null, 'email'=>null, 'password'=>null, 'avatar'=> null];
            $name = trim($request->name);
            $dataUpdate['name'] = $name;
            $email = trim($request->email);
            $avatar = $request->hasFile('avatar');

            if ($request->has('isChangePassword')) {
                $passCurrent = $request->password_current;
                $passNew = $request->password;
                $passConfirm = $request->password_confirm;
                if (Auth::user()->password == null) {
                    if ($passNew != $passConfirm) {
                        Session::flash('FailConfirmPassword', 'Confirm password mismatched');

                        return redirect()->back()->withInput();
                    } else {
                        $dataUpdate['password'] = Hash::make($passNew);
                    }
                } else {
                    if (Hash::check($passCurrent, Auth::user()->password)) {
                        $dataUpdate['password'] = Hash::make($passNew);
                    } else {
                        Session::flash('FailPasswordCurrent', 'Current password mismatched');

                        return redirect()->back()->withInput();
                    }
                }
            }

            if (Auth::user()->provider_id == null && $email != Auth::user()->email) {
                $checkAlreadyExist = User::where('email', 'like', $email)->first();
                if ($checkAlreadyExist) {

                    return back()->withInput()->with('EmailAlreadyExist', 'This email already exists');
                }
                else{
                    $dataUpdate['email'] = $email;
                }
            }

            if($avatar){
                $typeAvatar = explode('/',$request->all()['avatar']->getMimeType());
                $request->all()['avatar']->move('images', $email. '.' .$typeAvatar[1]);
                $dataUpdate['avatar'] = 'images/'.$email. '.' .$typeAvatar[1];
            }

            $user = User::find(Auth::user()->id);

            foreach($dataUpdate as $key=>$value){
                if($value == null){
                    continue;
                }
                $user->$key = $value;
            }
            $user->save();

            return redirect()->route('user.profile')->withInput();
        }
    }
}