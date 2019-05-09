<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Country;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{

    public function userLoginRegister(){
        echo"test"; die;
    }

    public function logout(){
        Auth::logout();
        Session::forget('frontSession');
        Session::forget('session_id');
        return redirect('/');
    
    }

    public function updatePassword(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            $old_pwd = User::where('id',Auth::user()->id)->first();
            $current_pwd = $data['current_pwd'];
            if (Hash::check($current_pwd, $old_pwd->password)) {
                $new_pwd = bcrypt($data['new_pwd']);
                User::where('id',Auth::user()->id)->update(['password'=>$new_pwd]);
                return redirect()->back()->with('flash_message_success','Password Berhasil Diupdate');
            }else{
                return redirect()->back()->with('flash_message_error','Current Password Is Incorrect');
            }
        }
    }

    public function login(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();

            if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])) {
                $request->session()->put('frontSession', $data['email']);
                return redirect('/cart');
            }else{
                return redirect()->back()->with('flash_message_error','Invalid Username Or Password');
            }

        }
    }

    public function checkUserPassword(Request $request){
        $data = $request->all();
        // print_r($data);
        $current_pwd = $data["current_pwd"];
        $user_id = Auth::user()->id;
        $checkPassword = User::where('id',$user_id)->first();
        if (Hash::check($current_pwd,$checkPassword->password)) {
            echo "true"; die;
        }else {
            echo "false";die;
        }
    }

    public function account(Request $request){
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
        $countries = Country::get();

        if ($request->isMethod('post')) {
            $data = $request->all();
            $user = User::find($user_id);
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state = $data['state'];
            $user->country = $data['country'];
            $user->zipcode = $data['zipcode'];
            $user->mobile = $data['mobile'];
            $user->save();
            return redirect()->back()->with('flash_message_success','Akun anda berhasil diperbarui');
        }

        return view('users.account')->with(compact('countries','userDetails'));
    }

    public function register(Request $request){

        if ($request->isMethod('post')) {
            $data = $request->all();

            $usercount = User::where('email',$data['email'])->count();
            if ($usercount>0) {
                return redirect()->back()->with('flash_message_error','Email Sudah diGunakan');
            }else{
                $user = new User;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->save();
                if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])) {
                    $request->session()->put('frontSession', $data['email']);
                    return redirect('/cart');
                }

            }
        }

        return view('users.login_register');
    }
}
