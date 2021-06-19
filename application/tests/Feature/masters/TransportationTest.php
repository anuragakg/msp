<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TransportationTest extends TestCase
{
    /**
     * Master - Transportation
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testTransportationAreStoredCorrectly(){

        $title = 'New Transportation';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/transportation',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testTransportationAreFetchedCorrectly() {

        $transportation = factory('App\Models\Masters\Transportation', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/transportation',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Transportation'
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

    public function testTransportationAreUpdatedCorrectly() {

        $transportation = factory(\App\Models\Masters\Transportation::class)->create([
            'title' => 'Transportation'
        ]);

        $title = 'New Transportation';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/transportation/'. $transportation->id, $payload);
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
