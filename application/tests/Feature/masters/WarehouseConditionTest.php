<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WarehouseConditionTest extends TestCase
{
    /**
     * Master - Warehouse Condition
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testWarehouseConditionAreStoredCorrectly(){

        $title = 'New Warehouse Condition';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/warehouse-condition',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testWarehouseConditionAreFetchedCorrectly() {

        $warehouseCondition = factory('App\Models\Masters\WarehouseCondition', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/warehouse-condition',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Warehouse Condition'
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

    public function testWarehouseConditionAreUpdatedCorrectly() {

        $warehouseCondition = factory(\App\Models\Masters\WarehouseCondition::class)->create([
            'title' => 'Warehouse Condition'
        ]);

        $title = 'New Warehouse Condition';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/warehouse-condition/'. $warehouseCondition->id, $payload);
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
