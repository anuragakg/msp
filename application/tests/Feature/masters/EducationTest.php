<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EducationTest extends TestCase
{
    /**
     * Master - Education
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testEducationAreStoredCorrectly(){

        $title = 'New Education';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/education',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testEducationAreFetchedCorrectly() {

        $education = factory('App\Models\Masters\Education', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/education',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Education'
            ])
        ])
        ->assertJsonStructure([
            'status',
            'data' => [
                    '*' => [
                            'id',
                            'title'
                        ]
                ]
        ]);
    }

    public function testEducationAreUpdatedCorrectly() {

        $education = factory(\App\Models\Masters\Education::class)->create([
            'title' => 'Education'
        ]);

        $title = 'New Education';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/education/'. $education->id, $payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title' => $title
            ]
        ]);
    }
}
