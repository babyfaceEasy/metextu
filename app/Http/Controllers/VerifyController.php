<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    /**
     * Verify the user with a single token
     * @param String $token
     * 
     * @return Response
     */
    
    public function verify($token)
    {
        //dd($token);
        User::where('verify_token', $token)->firstOrFail()
        ->update(['confirmed' => true, 'verify_token' => null]);

        return redirect()->route('login')
            ->with('suc_msg', 'Account verified! You can login in now.');

        
    }//end of verify()
}
