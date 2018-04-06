<?php

namespace App\Http\Controllers;

use App\Sms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_sms = Auth::user()->totalSMSSent();
        return view('home', compact('total_sms'));
        //return view('home');
    }

    public function showProfile()
    {
        return view ('auth.profile');
    }//end of showProfile()

    public function showEditProfile()
    {
        return view('auth.edit_profile');
    }//end of showEditProfile

    public function updateProfile(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        //dd($data);

        //successful update and save
        try{
            $current_user =  Auth::user();
            $update_resp = $current_user->fill($data);
            $current_user->save();

        }catch (Exception $e){
            //log error 
            Log::error('Error in updating user with id: ', ['id' => Auth::user()->id ]);
            Log::error('Caused by', $e->getMessage());
            $request->session()->flash('err_msg', 'An error occurred, please try again later.');
            return redirect()->route('home');
        }

        //it was suucessful
        $request->session()->flash('suc_msg', 'Account update was successful!');
        return redirect()->route('show.profile');

    }

    public function changePassword(Request $request)
    {
        //checks
        //1. if old passsword is correct
        //2. if the intended new password is not the same as currently been used pasword.
        if(!(Hash::check($request->get('old_password'), Auth::user()->password))){
            //password don't match
            return redirect()->back()->with('err_msg', "Your current password doesn't match with the password you provided. Please try again.");
        }
        if(strcmp($request->get('old_password'), $request->get('password')) == 0){
            //Current password and intended new password are the same
            return redirect()->back()->with('err_msg', "New password, cannot be the same as your current password. Please choose a different password.");
        }

        $validatedData = $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
        //dd($validatedData);

        //validation was successful, change password
        try{
            $current_user = Auth::user();
            $current_user->password = Hash::make($validatedData['password']);
            $current_user->save();
        } catch(Exception $e){
            //log error
            Log::error('Error in changing password of user with id:', ['id' => Auth::user()->id ]);
            Log::error('Caused by', $e->getMessage());
            $request->session()->flash('err_msg', 'An error occurred, please try again later.');
            return redirect()->back();
        }

        //it was successful
        return redirect()->back()->with('suc_msg', "Password changed sucessfully !");

    }//end of changePassword
}
