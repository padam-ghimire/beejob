<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Job;

class JobPostingTest extends TestCase
{
    // use RefreshDatabase;
   
    /** @test */
    public function jobCanBePosted()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post('jobs/create/job',[
            
            'user_id' =>5,
            'company_id'=>4,
            'category_id' => 1,
            'title' => 'This is test job',
            'position' => 'Test position',
            'address' => 'test address',
            'type' =>'part time',
            'roles_responsibilties' =>'Test roles and responsibilities.',
            'description' => "test description",
            'slug' =>'test-slug',
            'status'=>1,
            'deadline' =>'2020-12-12',
            'vacancies'=>5,
            'salary'=> '50000',
            'gender' =>'Male',
             'experiences'=>4
        ]);
        // $response->assertOk();
        $response->assertStatus(200);
        // $response->assertResponseStatus(302);
        // $this->assertRedirectedToRoute('login');


        // $response->assertCount(1,Job::all());
    }
    
}
