<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Company;
use App\Job;
use App\Category;

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
        User::factory()->count(10)->create();
        Company::factory()->count(10)->create();
        Category::factory()->count(10)->create();
        Job::factory()->count(10)->create();

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
