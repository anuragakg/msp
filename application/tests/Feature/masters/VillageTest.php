<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VillageTest extends TestCase
{
    /**
     * Master - Village
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testVillageAreStoredCorrectly(){

        $title = 'New Village';
        $code = 'New Code';
        $payload    =   [
            'title'  => $title,
            'code'  => $code
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/village',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
                'code'  => $code,
            ]
        ]);
    }

    public function testVillageAreFetchedCorrectly() {

        $village = factory('App\Models\Masters\Village', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/village',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Village',
                'code' => 'Code'
            ])
        ])
        ->assertJsonStructure([
            'status',
            'data' => [
                    '*' => [
                            'id',
                            'title',
                            'code'
                        ]
                ]
        ]);
    }

    public function testVillageAreUpdatedCorrectly() {

        $village = factory(\App\Models\Masters\Village::class)->create([
            'title' => 'Village',
            'code' => 'Code',
        ]);

        $title = 'New Village';
        $code = 'New Code';
        $payload    =   [
            'title'  => $title,
            'code'  => $code
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/village/'. $village->id, $payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title' => $title,
                'code' => $code
            ]
        ]);
    }
}
