<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WarehousePremisesTest extends TestCase
{
     /**
     * Master - Warehouse Premises
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testWarehousePremisesAreStoredCorrectly(){

        $title = 'New Warehouse Premises';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/warehouse-premises',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testWarehousePremisesAreFetchedCorrectly() {

        $warehousePremises = factory('App\Models\Masters\WarehousePremises', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/warehouse-premises',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Warehouse Premises'
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

    public function testWarehousePremisesAreUpdatedCorrectly() {

        $warehousePremises = factory(\App\Models\Masters\WarehousePremises::class)->create([
            'title' => 'Warehouse Premises'
        ]);

        $title = 'New Warehouse Premises';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/warehouse-premises/'. $warehousePremises->id, $payload);
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
