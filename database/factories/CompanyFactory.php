<?php

namespace Database\Factories;

use App\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\User;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        $name = $this->faker->company;

        return [
            'user_id'        => User::factory(),
            'company_name'   => $name,
            'slug'           => Str::slug($name),
            'address'        => $this->faker->address,
            'website'        => $this->faker->domainName,
            'phone'          => $this->faker->phoneNumber,
            'logo'           => '/bee-animated-gif-36.gif',
            'display_picture'=> 'banner.png',
            'slogan'         => $name,
            'description'    => $this->faker->paragraph(3),
        ];
    }
}