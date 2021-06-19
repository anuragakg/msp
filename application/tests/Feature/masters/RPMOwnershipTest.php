<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RPMOwnershipTest extends TestCase
{
    /**
     * Master - RPM Ownership
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testRPMOwnershipAreStoredCorrectly(){

        $title = 'New RPM Ownership';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/rpm-ownership',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testRPMOwnershipAreFetchedCorrectly() {

        $boundaryWall = factory('App\Models\Masters\RPMOwnership', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/rpm-ownership',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'RPM Ownership'
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

    public function testRPMOwnershipAreUpdatedCorrectly() {

        $boundaryWall = factory(\App\Models\Masters\RPMOwnership::class)->create([
            'title' => 'RPM Ownership'
        ]);

        $title = 'New RPM Ownership';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/rpm-ownership/'. $boundaryWall->id, $payload);
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
