<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory('App\User',10)->create();
        factory('App\Company',10)->create();
        factory('App\Job',10)->create();
        factory('App\Category',10)->create();

        Role::truncate();

        $role = Role::create([
            'type'=> 'admin'
        ]);

        
        $admin= User::create([
            'id' => random_int(100,10000),
            'name' => 'Padam Ghimire',
            'email' =>'admin@beejob.com',
            'password' => bcrypt('master123'),
            'email_verified_at'=> NOW()
        ]);
        
        $admin->roles()->attach($role);

    }
}
