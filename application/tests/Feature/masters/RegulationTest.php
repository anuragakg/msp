<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegulationTest extends TestCase
{
    /**
     * Master - Regulation
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testRegulationAreStoredCorrectly(){

        $title = 'New Regulation';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/regulation',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testRegulationAreFetchedCorrectly() {

        $regulation = factory('App\Models\Masters\Regulation', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/regulation',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Regulation'
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

    public function testRegulationAreUpdatedCorrectly() {

        $regulation = factory(\App\Models\Masters\Regulation::class)->create([
            'title' => 'Regulation'
        ]);

        $title = 'New Regulation';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/regulation/'. $regulation->id, $payload);
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
