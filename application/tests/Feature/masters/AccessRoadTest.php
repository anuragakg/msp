<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AccessRoadTest extends TestCase
{
    /**
     * Master - Access Road
     *
     * @return void
     */
    use DatabaseTransactions;

    public function testAccessRoadAreStoredCorrectly(){

        $title = 'New Access Road';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/access-road',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testAccessRoadAreFetchedCorrectly() {

        $accessRoad = factory('App\Models\Masters\AccessRoad', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/access-road',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Access Road'
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

    public function testAccessRoadAreUpdatedCorrectly() {

        $accessRoad = factory(\App\Models\Masters\AccessRoad::class)->create([
            'title' => 'Access Road'
        ]);

        $title = 'New Road';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/access-road/'. $accessRoad->id, $payload);
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
