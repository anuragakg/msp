<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MarketRegulationTest extends TestCase
{
    /**
     * Master - Market Regulation
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testMarketRegulationAreStoredCorrectly(){

        $title = 'New Market Regulation';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/market-regulation',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testMarketRegulationAreFetchedCorrectly() {

        $marketRegulation = factory('App\Models\Masters\MarketRegulation', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/market-regulation',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Market Regulation'
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

    public function testMarketRegulationAreUpdatedCorrectly() {

        $marketRegulation = factory(\App\Models\Masters\MarketRegulation::class)->create([
            'title' => 'Market Regulation'
        ]);

        $title = 'New Market Regulation';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/market-regulation/'. $marketRegulation->id, $payload);
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
