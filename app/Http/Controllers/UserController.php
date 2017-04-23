<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
//        $this->middleware('superadmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('admins',User::class);
        return view('users.index');
    }

    /**
     * Display a listing of users.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        // same policy method like index.
        $this->authorize('admins',User::class);
        $users = User::with('roles')->get();

        return Datatables::of($users)
        ->addColumn('roles',function($user){
            return $user->roles->map(function($role) {
                return str_limit($role->name, 30, '...');
            })->implode(' - ');
        })
        ->editColumn('name', function($user) {
            return '<a href="/users/' . $user->employee_id .'"class="">' . str_limit($user->name, 50) . '</a>';
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
        //anyone can register
        return view('auth.register');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($employee_id)
    {
        $this->authorize('admins',User::class);
        $user =  $this->getUser($employee_id);
        $roles = $user->roles->map(function($role){
            return $role->id;
        })->toArray();
        return view('users.show', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $employee_id)
    {
        $this->authorize('admins',User::class);
        $this->validate($request, [
            'name' => 'required|max:255',
            'location_id' => 'required|exists:locations,store_code',
            ]);

        $user = $this->getUser($employee_id);
        $user->name = $request->name;
        $user->location_id = $request->location_id;
        $user->save();

        \Session::flash('success', 'Thanks , User with Name (' . $user->name . ')
            has been Successfully Updated');

        return redirect('/users/'.$user->employee_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($employee_id)
    {
        //Only superadmins allowed to delete users .
        //Change to admins if you want to be allowed from admins .
        $this->authorize('sAdmin',User::class);
        $this->getUser($employee_id)->delete();
        \Session::flash('success', 'Thanks , User has been Successfully Deleted');
        return redirect('users');
    }

    public function assignRole(Request $request,$user)
    {
        $this->authorize('admins',User::class);
        $user =  $this->getUser($user);
        $requested_roles=  $request->input('roles');

        $this->validate($request, [
            'roles.*' => 'required|numeric|min:1|max:6'
            ]);
                        
        if($user->roles()->sync($requested_roles))
            \Session::flash('success', 'Thanks , Role  has been added Successfully');
        else
            \Session::flash('danger', 'An error has been occured , please contact admins');

        return back();
    }


    public function deleteRole($user,$role)
    {
        $this->authorize('admins',User::class);
        $user =  $this->getUser($user);
        $user->roles()->detach($role);
        \Session::flash('success', 'Thanks , Role has been deleted Successfully');
        return back();
    }

    private function getUser($employee_id)
    {
        $this->authorize('admins',User::class);
        return User::where('employee_id',$employee_id)->first();
    }

}
