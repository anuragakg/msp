<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WarehouseAgeTest extends TestCase
{
    /**
     * Master - Warehouse Age
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testWarehouseAgeAreStoredCorrectly(){

        $title = 'New Warehouse Age';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/warehouse-age',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testWarehouseAgeAreFetchedCorrectly() {

        $warehouseAge = factory('App\Models\Masters\WarehouseAge', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/warehouse-age',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Warehouse Age'
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

    public function testWarehouseAgeAreUpdatedCorrectly() {

        $warehouseAge = factory(\App\Models\Masters\WarehouseAge::class)->create([
            'title' => 'Warehouse Age'
        ]);

        $title = 'New Warehouse Age';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/warehouse-age/'. $warehouseAge->id, $payload);
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
