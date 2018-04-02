<?php

namespace App\Http\Controllers;

use App\Group;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
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
}
