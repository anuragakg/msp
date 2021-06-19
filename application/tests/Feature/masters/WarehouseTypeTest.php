<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WarehouseTypeTest extends TestCase
{
     /**
     * Master - Warehouse Type
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testWarehouseTypeAreStoredCorrectly(){

        $title = 'New Warehouse Type';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/warehouse-type',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testWarehouseTypeAreFetchedCorrectly() {

        $warehouseType = factory('App\Models\Masters\WarehouseType', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/warehouse-type',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Warehouse Type'
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

    public function testWarehouseTypeAreUpdatedCorrectly() {

        $warehouseType = factory(\App\Models\Masters\WarehouseType::class)->create([
            'title' => 'Warehouse Type'
        ]);

        $title = 'New Warehouse Type';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/warehouse-type/'. $warehouseType->id, $payload);
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
