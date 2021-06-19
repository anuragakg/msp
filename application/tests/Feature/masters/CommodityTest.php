<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommodityTest extends TestCase
{
    /**
     * Master - Commodity
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testCommodityAreStoredCorrectly(){

        $title = 'New Commodity';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/commodity',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testCommodityAreFetchedCorrectly() {

        $commodity = factory('App\Models\Masters\Commodity', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/commodity',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Commodity'
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

    public function testCommodityAreUpdatedCorrectly() {

        $commodity = factory(\App\Models\Masters\Commodity::class)->create([
            'title' => 'Commodity'
        ]);

        $title = 'New Commodity';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/commodity/'. $commodity->id, $payload);
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
