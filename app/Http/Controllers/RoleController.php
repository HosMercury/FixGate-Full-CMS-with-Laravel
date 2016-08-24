<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

use App\Role;
use App\Http\Requests;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('users.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|min:2|max:220|unique:roles,name',
            'label'=>'max:1000',
        ]);

        $request['creator'] = 8888;

        $inserted = (new Role)->create($request->all());

        \Session::flash('message', 'Thanks , Your Role with Name (' . $inserted->name . ')
                                    has been Successfully added');

        return redirect('/roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('users.roles.show', compact('role','permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function assignPermission(Request $request, Role $role ,Permission $permission)
    {
        $this->validate($request, [
            'permission' => 'required|numeric|exists:permissions,id'
        ]);

        if ($role->hasPermission($request->permission)) {
            \Session::flash('alert', 'This Permission has been Assigned before to this user .');
            return back();
        }else{
            $role->permissions()->attach($request->permission);
            \Session::flash('message', 'Thanks , Permission has been added Successfully');
            return back();
        }
    }

    public function deletePermission(Request $request,Role $role,Permission $permission)
    {
        $role->permissions()->detach($permission);
        \Session::flash('message', 'Thanks , Permission has been deleted Successfully');
        return back();
    }
}
