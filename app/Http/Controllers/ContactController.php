<?php

namespace App\Http\Controllers;

use App\Group;
//use Messaging;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Midnite81\Plivo\Contracts\Services\Messaging;
use Illuminate\Auth\Access\AuthorizationException;



class ContactController extends Controller
{
    /**
     * This returns a list of all contacts 
     * @return Collection 
     */
    public function allContacts()
    {
        //select all data where the id is equal to $user
        $user_id = Auth::user()->id;
        $contacts = Contact::all();
        $user_cnts = $contacts->filter(function ($value, $key) use($user_id){
            return $value->group->user_id == Auth::user()->id;
            //return $value->group->user_id == $user_id;
        });

        return view('clients.contacts.all_contacts', compact('user_cnts'));

        //dd($curr_user_cnts);
    }
    /**
     * Creates a new controller instance
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Group $group)
    {
        //dd($group);
        $contacts = Contact::where('group_id', '=', $group->id)->get();
        return view('clients.contacts.index', compact('contacts', 'group'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Group $group)
    {
        return view('clients.contacts.create', compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'cname' => 'required|min:3',
            'cphone_no' => 'required|min:10',
            'group_id' =>'required'
        ]);
        //get the group details
        $group = Group::findOrFail($request->get('group_id'));
        //validation successful. create new contact.
        try{
            Contact::create($data);
        }catch(Exception $e){
            //log the error
            Log::error('Could not create a contact for group id: ', $request->get('group_id'));
            Log::error('Due to the reason that', $e->getMesage());

            $request->session()->flash('err_msg', "An error occurred, please try again later.");
            return redirect()->route('groups.contacts.index', ['group' => $request->get('group_id')]);
        }

        //successful
        $request->session()->flash('suc_msg', "New contact added for group {{$group->gname}}");
        return redirect()->route('groups.contacts.index', ['group' => $request->get('group_id')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group, Contact $contact )
    {
        //check to see if the user is authorized
        try{
            $this->authorize('edit', $contact);
        }catch( AuthorizationException $e){
            //log error
            Log::error('A user with id: '. Auth::user()->id. ', tried to edit the contact not belonging to him / her.');

            return redirect()->route('groups.index')->with('err_msg', "You are not allowed to perform this action.");
        }
        return view('clients.contacts.edit', compact('contact', 'group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group, Contact $contact)
    {
        //check to see if the user is authorized
        try{
            $this->authorize('update', $contact);
        }catch( AuthorizationException $e){
            //log error
            Log::error('A user with id: '. Auth::user()->id. ', tried to update the contact not belonging to him / her.');

            return redirect()->route('groups.index')->with('err_msg', "You are not allowed to perform this action.");
        }
        
        //dd($request);
        $data = $this->validate($request, [
            'cname' => 'required|min:3',
            'cphone_no' => 'required|min:10',
            //'group_id' =>'required'
        ]);

        //valid data update contact instance
        try{
            $contact->update($data);
        }catch(Exception $e){
            //log error
            Log::error('Can not update the contact with id:', $contact->id);
            Log::error('Due to the reason that', $e->getMesage());

            $request->session()->flash('err_msg', "An error occurred, please try again later.");
            return redirect()->route('groups.contacts.index', ['group' => $request->get('group_id')]);
        }

        //successful!
        $request->session()->flash('suc_msg', "Contact update for group {$group->gname}, was successful!");
        return redirect()->route('groups.contacts.index', ['group' => $request->get('group_id')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group, Contact $contact)
    {
        //check to see if the user is authorized
        try{
            $this->authorize('edit', $contact);
        }catch( AuthorizationException $e){
            //log error
            Log::error('A user with id: '. Auth::user()->id. ', tried to delete a contact not belonging to him / her.');

            return redirect()->route('groups.index')->with('err_msg', "You are not allowed to perform this action.");
        }


        //search to see if the contact exist
        $contact = Contact::where([
            'id' => $contact->id,
            'group_id' => $group->id
        ])->firstOrFail();


        //delete the contact now
        try{
            $contact->delete();
        }catch (Exception $e){
            //log error
            Log::error('Error in deleting contact with id:', $contact->id);
            Log::error('Due to the fact that ', $e->getMessage());

            $request->session()->flash('err_msg', "An error occurreed, please try again later.");
        }
        //was successful
        return redirect()->back()->with('suc_msg', "Delete Operation for contact was successful!");
    }

    public function testSMSSender(Request $request, Messaging $messaging)
    {
        $msg = $messaging->from('MeTextU')->msg('Hello world from MetxtUC!')->to(['+2349097694139', '+2348060423371'])->sendMessage();
        //$msg = $messaging->getMessage('bda0cfac-37c7-11e8-bbfd-02af11be3b72');
        dd($msg);
        return 'gone';

        /*
         * send sms return / response
         array:2 [▼
            "status" => 202
            "response" => array:3 [▼
                "api_id" => "e9ecdf64-37c8-11e8-9746-060740e7e786"
                "message" => "message(s) queued"
                "message_uuid" => array:1 [▼
                0 => "e9ed3ea0-37c8-11e8-9746-060740e7e786"
                ]
            ]
            ]
         */

        /*
        get message return statement
        array:2 [▼
        "status" => 200
        "response" => array:13 [▼
            "api_id" => "da1fcda4-37c7-11e8-bbfd-02af11be3b72"
            "error_code" => "000"
            "from_number" => "16806666853"
            "message_direction" => "outbound"
            "message_state" => "delivered"
            "message_time" => "2018-04-04 01:19:25-04:00"
            "message_type" => "sms"
            "message_uuid" => "bda0cfac-37c7-11e8-bbfd-02af11be3b72"
            "resource_uri" => "/v1/Account/MAMGQZMZUYZDU5NDNHM2/Message/bda0cfac-37c7-11e8-bbfd-02af11be3b72/"
            "to_number" => "2349097694139"
            "total_amount" => "0.01300"
            "total_rate" => "0.01300"
            "units" => 1
        ]
        ]
        */
    }//end of test
}
