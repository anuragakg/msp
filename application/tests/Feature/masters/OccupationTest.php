<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OccupationTest extends TestCase
{
    /**
     * Master - Occupation
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testOccupationAreStoredCorrectly(){

        $title = 'New Occupation';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/occupation',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testOccupationAreFetchedCorrectly() {

        $occupation = factory('App\Models\Masters\Occupation', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/occupation',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Occupation'
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

    public function testOccupationAreUpdatedCorrectly() {

        $occupation = factory(\App\Models\Masters\Occupation::class)->create([
            'title' => 'Occupation'
        ]);

        $title = 'New Occupation';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/occupation/'. $occupation->id, $payload);
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
