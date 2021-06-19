<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class YearTest extends TestCase
{
    /**
     * Master - Year
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testYearAreStoredCorrectly(){

        $title = 'New Year';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/year',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testYearAreFetchedCorrectly() {

        $year = factory('App\Models\Masters\Year', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/year',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Year'
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

    public function testYearAreUpdatedCorrectly() {

        $year = factory(\App\Models\Masters\Year::class)->create([
            'title' => 'Year'
        ]);

        $title = 'New Year';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/year/'. $year->id, $payload);
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
