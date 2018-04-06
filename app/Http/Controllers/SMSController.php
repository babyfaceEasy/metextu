<?php

namespace App\Http\Controllers;

use App\Sms;
use App\Message;
use App\TextMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midnite81\Plivo\Contracts\Services\Messaging;

class SMSController extends Controller
{
    //this controller works with the TextMessage Model

    //this is to return the sms page
    public function create()
    {
        return view ('clients.sms.create');
    }

    //this is the side that handles sending of the sms
    public function sendSMS(Request $request, Messaging $messaging)
    {
        //nb: for you to send to many numbers, pass it as an array.
        //hence if dere exist a, den just convert to array.
        //dst_nos would be sepreated by commas
        //validate the data
        $data = $this->validate($request, [
            'sender_name' => 'required|min:3',
            'message' => 'required',
            'dst_nos' => 'required',
        ]);

        //nb: when doing bulk, each messageUUID == to one phone number
        //so we would be saving each inside the database.
        //three things to be stored in our SMS table 1.sender_name 2.message 3. user_id 4. api_id
        //rest to be stored in the Message table 1. messageUUID, 2.dst_no(to) 3.status
        //others would be updated by the route(sms.status) action.

        //convering dst_nos to array.
        $data['dst_nos'] = explode(',', $request->get('dst_nos'));
        $dst_nos = $data['dst_nos'];
        
        //dd($data['dst_nos']);

        //add the current user to it
        $data['user_id'] = Auth::user()->id;

        //data is valid. send sms and then save to db

        $msg = $messaging->from($data['sender_name'])
            ->msg($data['message'])
            ->to($data['dst_nos'])
            ->sendMessage();
        
        
        //remove the element with key dst_nos
        unset($data['dst_nos']);
        

        // 0->error/ 1->success
        $status = 0;
        //$msg holds the resp
        if($msg['status'] == 202){
            //successful save into db
            $status = 1;
            //get message_id & api_id
            //nb: each element inside the message_ids is tagged directly to the dst_nos order.
            //$data['dst_nos'] = json_encode($data['dst_nos']);
            //$data['message_ids'] = json_encode($msg['response']['message_uuid']);
            $data['api_id'] = json_encode($msg['response']['api_id']);

            //dd($data);
            //save to db
            try{
                //put this whola action inside a transaction.
                $sms = Sms::create($data);
                //loop trhu the message_ids array and add each of thm to the messages table
                for($i = 0; $i < count($msg['response']['message_uuid']); $i++){
                    $msg_data = [
                        'sms_id' => $sms->id,
                        'messageUUID' => $msg['response']['message_uuid'][$i],
                        'to' => $dst_nos[$i],
                    ];

                    //save into messages table
                    Message::create($msg_data);
                }
            }catch(Exception $e){
                //log error
                Log::error('User with id: '. Auth::user()->id .', coul not send an sms.');
                //take them to an error page stating u r working on it.
                return redirect()->back()->with('err_msg', 'An error occured, please try again later1.');
            }
        }else{
            //error don't save
            return redirect()->back()->with('err_msg', 'An error occured, please try again later2.');
        }
        //success.
        return redirect()->back()->with('suc_msg', 'Message sent to phone number(s). Check dashbord for delivery status.');

    } //end of sendSMS()

    //this is to handle the sms_updates in our application
    public function delivery_report(Request $request)
    {
        $data = $this->validate($request, [
            'messageUUID' => 'required',
            'to' => 'required',
            'status' => 'required',
            'units' => '',
            'totalRate' => '',
            'totalAmount' => '',
            'MCC' =>'',
            'MNC' => '',
            'errorCode' => '',
            'parentMessageUUID' => '',
            'parentInfo' => ''

        ]);

        //valid data, update the messages table with the above info
        try{
            $msg = Message::where('messageUUID', $data['messageUUID'])->get();
            $msg->fill($data);
            $msg->save();
        }catch (\Exception $e){
            //log error
            Log::error('An error occured when updating the message with UUID: ', $data['messageUUID']);
            Log::eror('it was caused by ', $e->getMessage());

            return redirect('/home')->with('An error occured, please try contact the administrator.');
        }
        //process credit units here. i,e update the totla cost for sending the message as well as removing it from the persons cost.
        
    }//end of delivery_report
}
