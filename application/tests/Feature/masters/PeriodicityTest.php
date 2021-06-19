<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PeriodicityTest extends TestCase
{
    /**
     * Master - Periodicity
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testPeriodicityAreStoredCorrectly(){

        $title = 'New Periodicity';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/periodicity',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testPeriodicityAreFetchedCorrectly() {

        $periodicity = factory('App\Models\Masters\Periodicity', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/periodicity',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Periodicity'
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

    public function testPeriodicityAreUpdatedCorrectly() {

        $periodicity = factory(\App\Models\Masters\Periodicity::class)->create([
            'title' => 'Periodicity'
        ]);

        $title = 'New Periodicity';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/periodicity/'. $periodicity->id, $payload);
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
