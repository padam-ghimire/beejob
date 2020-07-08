<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'user_type'=>'seeker',
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'user_id'=> App\User::all()->random()->id,
        'company_name'=>$name=$faker->company,
        'slug'=>str_slug($name),
        'address'=>$faker->address,
        'website'=>$faker->domainName,
        'phone'=>$faker->phoneNumber,
        'logo'=>'/bee-animated-gif-36.gif',
        'display_picture'=>'banner.png',
        'slogan' => $name,
        'description'=>$faker->paragraph(3,8),

    ];
});






$factory->define(App\Job::class, function (Faker $faker) {
    return [
        'user_id' =>App\User::all()->random()->id,
        'company_id'=>App\Company::all()->random()->id,
        // 'category_id'=>App\Category::all()->random()->id,
        'category_id'=>rand(1,10),
        'vacancies'=>rand(1,20),
        'title'=>$title=$faker->text,
        'gender'=>$faker->randomElement(['Open','Male','Female']),
        'salary'=>rand(5000,2000000),
        'position'=>$faker->jobTitle,
        'address'=>$faker->address,
        'type'=>'part time',
        'description'=>$faker->paragraph(3,8),
        'experiences'=>rand(1,10),
        'slug'=>str_slug($title),
        'status'=>rand(0,1),
        'deadline'=>$faker->DateTime,
        'roles_responsibilities'=>$faker->text



    ];
});

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        
        'name'=>$name=$faker->company,
    ];
});

