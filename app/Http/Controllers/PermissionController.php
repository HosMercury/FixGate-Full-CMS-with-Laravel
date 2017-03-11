<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $permissions = Permission::all();
        return view('users.permissions.index');
    }

    /**
     * Display a listing of permissions.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $cols = ['id', 'name'];

        $permissions = Permission::select($cols);

        return Datatables::of($permissions)
            ->editColumn('name', function ($permission) {
                return '<a href="/permissions/' . $permission->id . '"class="">' . str_limit($permission->name, 50) . '</a>';
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
        return view('users.permissions.create');
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
            'name' => 'required|min:2|max:220|unique:Permissions,name',
            'label' => 'max:1000',
        ]);

        $request['creator'] = 8888;

        $inserted = (new Permission)->create($request->all());

        \Session::flash('success', 'Thanks , Your Permission with Name (' . $inserted->name . ')
                                    has been Successfully added');

        return redirect('/permissions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);
        return view('users.permissions.show', compact('permission'));
    }


    /**
     * Show the form for store perms assigns.
     *
     */
    public function assign(Role $role)
    {
        $permissions = request('permissions');
        $permissions_ids = [];
        foreach($permissions as $permission){
            $permissions_ids[] = Permission::whereName($permission)->first()->id;
        }
        $role->permissions()->sync($permissions_ids);
        return redirect('/roles/'.$role->id);
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

        $permission = Permission::find($id);
        $permission->name = $request->name;
        $permission->label = $request->label;
        $permission->save();

        \Session::flash('success', 'Thanks , Your Permission with Name (' . $permission->name . ')
                                    has been Successfully Updated');

        return redirect('/permissions/' . $permission->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Permission::find($id)->delete();
        \Session::flash('success', 'Thanks , Your Permission has been Successfully Deleted');

        return redirect('permissions');
    }
}
