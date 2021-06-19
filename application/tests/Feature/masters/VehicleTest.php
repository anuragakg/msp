<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VehicleTest extends TestCase
{
    /**
     * Master - Vehicle
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testVehicleAreStoredCorrectly(){

        $title = 'New Vehicle';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/vehicle',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testVehicleAreFetchedCorrectly() {

        $vehicle = factory('App\Models\Masters\Vehicle', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/vehicle',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Vehicle'
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

    public function testVehicleAreUpdatedCorrectly() {

        $vehicle = factory(\App\Models\Masters\Vehicle::class)->create([
            'title' => 'Vehicle'
        ]);

        $title = 'New Vehicle';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/vehicle/'. $vehicle->id, $payload);
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
