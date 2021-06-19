<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CoordinatingAgencyTest extends TestCase
{
    /**
     * Master - Market Type
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testMarketTypeAreStoredCorrectly(){

        $title = 'New Market Type';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/coordinating-agency',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testMarketTypeAreFetchedCorrectly() {

        $marketType = factory('App\Models\Masters\MarketType', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/coordinating-agency',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Market Type'
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

    public function testMarketTypeAreUpdatedCorrectly() {

        $marketType = factory(\App\Models\Masters\MarketType::class)->create([
            'title' => 'Market Type'
        ]);

        $title = 'New Market Type';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/coordinating-agency/'. $marketType->id, $payload);
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
