<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Role;
use App\Permission;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.show', compact('user', 'roles','permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function assignRole(Request $request, User $user)
    {
        $this->validate($request, [
            'role' => 'required|numeric|exists:roles,id'
        ]);

        $role_name = Role::findOrFail($request->role)->name;
        if ($user->hasRole($role_name)) {
            \Session::flash('alert', 'This Role has been Assigned before to this user .');
            return back();
        }else{
            $user->assignRole($role_name);
            \Session::flash('message', 'Thanks , Role has been added Successfully');
            return back();
        }
    }

    public function deleteRole(Request $request,User $user,Role $role)
    {
        $user->roles()->detach($role);
        \Session::flash('message', 'Thanks , Role has been deleted Successfully');
        return back();
    }

}
