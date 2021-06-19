<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BuiltUpAreaTest extends TestCase
{
    /**
     * Master - Built Up Area
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testBuiltUpAreaAreStoredCorrectly(){

        $title = 'New Built Up Area';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/built-up-area',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testBuiltUpAreaAreFetchedCorrectly() {

        $builtUpArea = factory('App\Models\Masters\BuiltUpArea', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/built-up-area',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Built Up Area'
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

    public function testBuiltUpAreaAreUpdatedCorrectly() {

        $builtUpArea = factory(\App\Models\Masters\BuiltUpArea::class)->create([
            'title' => 'Built Up Area'
        ]);

        $title = 'New Built Up Area';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/built-up-area/'. $builtUpArea->id, $payload);
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
