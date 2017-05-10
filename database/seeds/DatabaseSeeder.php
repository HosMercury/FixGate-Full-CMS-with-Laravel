<?php

use App\Material;
use App\Order;
use App\Role;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    protected $toTruncate = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        foreach ($this->toTruncate as $table) DB::table($table)->truncate();

        // Locations ...
        DB::table('locations')->insert([
            ['store_code' => 8707, 'creator' => 6074, 'name' => 'paradise', 'city' => 'NY'],
            ['store_code' => 8000, 'creator' => 6074, 'name' => 'bahya', 'city' => 'DT'],
            ['store_code' => 7000, 'creator' => 6074, 'name' => 'sokaria', 'city' => 'IL']
            ]);

        // Users ...
        DB::table('users')->insert([
            //Labors ...
            ['employee_id' => 5555, 'name' => 'Labor', 'email' => 'labor@mail.com',
            'password' => bcrypt('secret'), 'location_id' => 8000],
            ['employee_id' => 8787, 'name' => 'Labor 2', 'email' => 'labor2@mail.com',
            'password' => bcrypt('secret'), 'location_id' => 8000],
            ['employee_id' => 9999, 'name' => 'Labor 3', 'email' => 'labor3@mail.com',
            'password' => bcrypt('secret'), 'location_id' => 8000],

            //Technicians ...
            ['employee_id' => 43434, 'name' => 'Technician', 'email' => 'technician@mail.com',
            'password' => bcrypt('secret'), 'location_id' => 8000],
                         ['employee_id' => 77277, 'name' => 'Technician 2', 'email' => 'technician2@mail.com',
            'password' => bcrypt('secret'), 'location_id' => 8000],
                         ['employee_id' => 77237, 'name' => 'Technician 3', 'email' => 'technician3@mail.com',
            'password' => bcrypt('secret'), 'location_id' => 8000],

            //Others ...
            ['employee_id' => 8888, 'name' => 'Mr Supervisor', 'email' => 'supervisor@mail.com',
            'password' => bcrypt('secret'), 'location_id' => 8000],
            ['employee_id' => 6074, 'name' => 'Mr Staff Member', 'email' => 'member@mail.com',
            'password' => bcrypt('secret'), 'location_id' => 8000],
            ['employee_id' => 11309, 'name' => 'Mr Accountant', 'email' => 'accountant@mail.com',
            'password' => bcrypt('secret'), 'location_id' => 8000],
            ['employee_id' => 12345, 'name' => 'Mr Admin', 'email' => 'admin@mail.com',
            'password' => bcrypt('secret'), 'location_id' => 8000],
            ['employee_id' => 999999, 'name' => 'Mr Super Admin', 'email' => 'superadmin@mail.com',
            'password' => bcrypt('secret'), 'location_id' => 8000]
            ]);

        // Roles ...
        DB::table('roles')->insert([
            ['name' => 'labor', 'creator' => 6074],
            ['name' => 'technician', 'creator' => 6074],
            ['name' => 'supervisor', 'creator' => 6074],
            ['name' => 'accountant', 'creator' => 6074],
            ['name' => 'admin', 'creator' => 6074],
            ['name' => 'superadmin', 'creator' => 6074]
            ]);

        User::whereEmail('labor@mail.com')->first()->assignRole('labor');
        User::whereEmail('labor2@mail.com')->first()->assignRole('labor');
        User::whereEmail('labor3@mail.com')->first()->assignRole('labor');

        User::whereEmail('technician@mail.com')->first()->assignRole('technician');
        User::whereEmail('technician2@mail.com')->first()->assignRole('technician');
        User::whereEmail('technician3@mail.com')->first()->assignRole('technician');

        User::whereEmail('supervisor@mail.com')->first()->assignRole('supervisor');
        User::whereEmail('accountant@mail.com')->first()->assignRole('accountant');
        User::whereEmail('admin@mail.com')->first()->assignRole('admin');
        User::whereEmail('superadmin@mail.com')->first()->assignRole('superadmin');


        factory(Order::class, 50)->create();
        factory(Material::class, 50)->create();

        Model::reguard();
    }
}