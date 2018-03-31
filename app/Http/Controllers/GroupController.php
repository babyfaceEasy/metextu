<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::where('user_id', Auth::user()->id)->get();
        return view('clients.groups.index')->with('groups', $groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.groups.create');
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
            'gname' => 'required|min:3',
        ]);
        //validation was successful 
        //validated data $data

        $data = array_merge($data, ['user_id' => Auth::user()->id]);

        try{
            //create new one and save to the db
            $group = Group::create($data);

        }catch(Exception $e){
            //log error
            Log::error('Error occured in creating a group for user with id: ', Auth::user()->id);
            Log::error('Caused by', $e-getMessage());

            $request->session()->flash('err_msg', "An error occured, please try again later.");
        }
        //everything went well
        return redirect()->route('groups.index')->with('suc_msg', "New Group added !");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        return view('clients.groups.edit')->with('group', $group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        //validate data
        $data = $this->validate($request, [
            'gname' => 'required|min:3',
        ]);
        //valid data and perform update

        try{

            $group->fill($data);
            $group->save();

        }catch(Exception $e){
            //log error
            Log::error('Error occured in updating the value of a group element belonging to user id: ', Auth::user()->id);
            Log::error('Caused by', $e-getMessage());

            $request->session()->flash('err_msg', "An error occured, please try again later.");   
            return redirect()->route('groups.index');         
        }

        //update was successful
        return redirect()->route('groups.index')->with('suc_msg', 'Group update action was successful !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //dd('we are in the destroy function');
        try{

            $group->delete();

        }catch(Exception $e){
            //log error
            Log::error('Error occured in deleting group with id: ', $group->id);
            Log::error('Caused by', $e-getMessage());

            $request->session()->flash('err_msg', "An error occured, please try again later.");   
            return redirect()->route('groups.index');             
        }

        //delete was successful
        return redirect()->route('groups.index')->with('suc_msg', "Delete action for group was successful.");
    }
}
