<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Role;
use App\Permission;
use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//          return User::with('roles')->get();
        return view('users.index');
    }

    /**
     * Display a listing of users.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
//        $cols = ['id', 'name','location_id','roles.name'];

        $users = User::with('roles')->get();

        return Datatables::of($users)
            ->addColumn('roles',function($user){
                return $user->roles->map(function($role) {
                    return str_limit($role->name, 30, '...');
                })->implode(' - ');
            })
            ->editColumn('name', function($user) {
                return '<a href="/users/' . $user->id .'"class="">' . str_limit($user->name, 50) . '</a>';
            })
            ->make(true);
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
        $this->validate($request, [
            'name' => 'required|max:255',
            'location_id' => 'required|exists:locations,id',
            'manager_id' => 'numeric',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->save();

        \Session::flash('success', 'Thanks , User with Name (' . $user->name . ')
                                    has been Successfully Updated');

        return redirect('/users/'.$user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        \Session::flash('success', 'Thanks , User has been Successfully Deleted');
        return redirect('users');
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
            \Session::flash('success', 'Thanks , Role has been added Successfully');
            return back();
        }
    }

    public function deleteRole(Request $request,User $user,Role $role)
    {
        $user->roles()->detach($role);
        \Session::flash('success', 'Thanks , Role has been deleted Successfully');
        return back();
    }

}
