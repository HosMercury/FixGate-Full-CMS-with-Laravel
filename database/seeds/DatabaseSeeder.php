<?php

use Carbon\Carbon;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    protected $toTruncate = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        Model::unguard();

        foreach ($this->toTruncate as $table)
        {
            \DB::table($table)->truncate();
        }

        // Manual inserts ...

        // Users
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => 'member@fixgate.com',
            'password' => bcrypt('secret'),
        ]);
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => 'accountant@fixgate.com',
            'password' => bcrypt('secret'),
        ]);
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => 'admin@fixgate.com',
            'password' => bcrypt('secret'),
        ]);
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => 'superadmin@fixgate.com',
            'password' => bcrypt('secret'),
        ]);


        // Roles
        DB::table('roles')->insert([
            'name' => 'admin',
            'creator' => auth()->user()->id,
        ]);
        DB::table('roles')->insert([
            'name' => 'accountant',
            'creator' => auth()->user()->id,
        ]);
        DB::table('roles')->insert([
            'name' => 'superadmin',
            'creator' => auth()->user()->id,
        ]);

        App\User::whereEmail('accountant@fixgate.com')->assignRole( App\User::whereName('accountant'));
        App\User::whereEmail('admin@fixgate.com')->assignRole( App\User::whereName('admin'));
        App\User::whereEmail('superadmin@fixgate.com')->assignRole( App\User::whereName('superadmin'));

        // Permissions
        DB::table('permissions')->insert([
            'id' => 1,
            'name' => 'accountant_privileges',
            'creator' => auth()->user()->id,
        ]);
        DB::table('permissions')->insert([
            'id' => 2,
            'name' => 'admin_privileges',
            'creator' => auth()->user()->id,
        ]);
        DB::table('permissions')->insert([
            'id' => 3,
            'name' => 'superadmin_privileges',
            'creator' => auth()->user()->id,
        ]);

        App\Role::whereName('accountant')->givePermissionTo( App\Permission::whereName('accountant_privileges'));
        App\Role::whereName('admin')->givePermissionTo( App\Permission::whereName('admin_privileges'));
        App\Role::whereName('superadmin')->givePermissionTo( App\Permission::whereName('superadmin_privileges'));


        factory(App\Location::class,3)->create();

        factory(App\Order::class, 50)->create();

        Model::reguard();
    }
}
