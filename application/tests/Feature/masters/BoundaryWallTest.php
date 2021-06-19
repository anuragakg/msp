<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BoundaryWallTest extends TestCase
{
    /**
     * Master - Boundary Wall
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testBoundaryWallAreStoredCorrectly(){

        $title = 'New Boundary Wall';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/boundary-wall',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testBoundaryWallAreFetchedCorrectly() {

        $boundaryWall = factory('App\Models\Masters\BoundaryWall', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/boundary-wall',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Boundary Wall'
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

    public function testBoundaryWallAreUpdatedCorrectly() {

        $boundaryWall = factory(\App\Models\Masters\BoundaryWall::class)->create([
            'title' => 'Boundary Wall'
        ]);

        $title = 'New Boundary Wall';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/boundary-wall/'. $boundaryWall->id, $payload);
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
