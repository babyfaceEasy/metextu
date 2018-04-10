<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Credit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreditController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    //this is to return the credit page
    public function getCreditPage()
    {
        $credits = 0.0;
        $user_dets = Credit::where('user_id', Auth::user()->id)->first();

        if($user_dets != null){
            $credits = $user_dets->units;
        }

        return view ('clients.credits.main')->with('credits', $credits);

    }
    //this is to purchase more units
    public function purchaseCredits(Request $request)
    {
        $data = $this->validate($request, [
            'units' => 'required|numeric',
        ]);
        

        //dd($data);
        //validated save into db / update
        $user_dets = Credit::where('user_id', Auth::user()->id)->first();
        if ($user_dets == null){
            //doesn't exist create new row
            $data['user_id'] = Auth::user()->id;
            Credit::create($data);
            $suc_msg = '';
        }else{
            //it exists just update
            $user_dets->fill($data);
            $user_dets->save();
        }

        //everything went well
        return redirect()->route('credit.page')->with('suc_msg', 'Purchase was successful');
    }

    //this is to retunr transfer credit page
    public function getTransferPage()
    {
        return view ('clients.credits.transfer');
    }

    //this is to handle the transfer of the credit
    public function transferCredits(Request $request)
    {
        //check if the current user has enough to send.
        //check if the other email given exists in the database
        //update the respective accounts using transactions.

        $data = $this->validate($request, [
            'units' => 'required|numeric',
            'email_to' => 'required|exists:users,email',
        ]);

        if (Auth::user()->credit->units <= $request->get('units')) {
            //then abort and return with error message
            return redirect()->route('transfer.page')->with('err_msg', "You have insufficient balance.")->withInput();
        }
        //everythin checks out nau do the updates in a transaction
        $curr_user = Auth::user()->credit;
        $to_user = User::where('email', $data['email_to'])->first()->credit;
        $units =  $data['units'];
        DB::transaction(function() use($curr_user, $to_user, $units){
            $curr_user->units -= $units;
            $curr_user->save();

            $to_user->units += $units;
            $to_user->save();
        });

        //all was done well
        return redirect()->route('transfer.page')->with('suc_msg', "Transfer action was successful.");
    }
}
