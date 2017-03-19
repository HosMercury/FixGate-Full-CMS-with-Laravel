<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.roles.index');
    }

    /**
     * Display a listing of roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $cols = ['id', 'name'];

        $roles = Role::select($cols);

        return Datatables::of($roles)
        ->editColumn('name', function($role) {
            return '<a href="/users/roles/' . $role->id .'"class="">' . str_limit($role->name, 50) . '</a>';
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
        return view('users.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4|max:220|unique:roles,name',
            'label' => 'max:500',
            ]);

        $request['creator'] = auth()->user()->employee_id;

        $inserted = (new Role)->create($request->all());

        \Session::flash('success', 'Thanks , Your Role with Name (' . $inserted->name . ') has been Successfully added');
        return redirect('/users/roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $permissions = $role->permissions->pluck('name');
        return view('users.roles.show', compact('role', 'permissions'));
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
            'name' => 'required|min:2|max:220',
            'label' => 'max:1000',
            ]);

        $role = Role::find($id) ;
        $role->name = $request->name;
        $role->label = $request->label;
        $role->save();

        \Session::flash('success', 'Thanks , Your Role with Name (' . $role->name . ')
            has been Successfully Updated');

        return redirect('/roles/'.$role->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::find($id)->delete();
        \Session::flash('success', 'Thanks , Your Role has been Successfully Deleted');
        return redirect('roles');
    }

    public function assignPermission(Request $request, Role $role, Permission $permission)
    {
        $this->validate($request, [
            'permission' => 'required|numeric|exists:permissions,id'
            ]);

        if ($role->hasPermission($request->permission)) {
            \Session::flash('alert', 'This Permission has been Assigned previously this user .');
            return back();
        } else {
            $role->permissions()->attach($request->permission);
            \Session::flash('success', 'Thanks , The Permission has been added Successfully');
            return back();
        }
    }

    public function deletePermission(Request $request, Role $role, Permission $permission)
    {
        $role->permissions()->detach($permission);
        \Session::flash('success', 'Thanks , Permission has been deleted Successfully');
        return back();
    }


}
