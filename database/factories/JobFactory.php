<?php

namespace Database\Factories;

use App\Job;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\User;
use App\Company;
use App\Category;

class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition(): array
    {
        $title = $this->faker->sentence;

        return [
            'user_id'       => User::factory(),
            'company_id'    => Company::factory(),
            'category_id'   => Category::factory(),
            'vacancies'     => $this->faker->numberBetween(1, 20),
            'title'         => $title,
            'gender'        => $this->faker->randomElement(['Open','Male','Female']),
            'salary'        => $this->faker->numberBetween(5000, 2000000),
            'position'      => $this->faker->jobTitle,
            'address'       => $this->faker->address,
            'type'          => 'part time',
            'description'   => $this->faker->paragraph(3),
            'experiences'   => $this->faker->numberBetween(1,10),
            'slug'          => Str::slug($title),
            'status'        => $this->faker->boolean,
            'deadline'      => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'roles_responsibilities' => $this->faker->text,
        ];
    }
}