<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DesignationTest extends TestCase
{
    /**
     * Master - Designation
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testDesignationAreStoredCorrectly(){

        $title = 'New Designation';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/designation',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testDesignationAreFetchedCorrectly() {

        $designation = factory('App\Models\Masters\Designation', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/designation',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Designation'
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

    public function testDesignationAreUpdatedCorrectly() {

        $designation = factory(\App\Models\Masters\Designation::class)->create([
            'title' => 'Designation'
        ]);

        $title = 'New Designation';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/designation/'. $designation->id, $payload);
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
