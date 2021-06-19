<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OfficeBearerRoleTest extends TestCase
{
    /**
     * Master - Office Bearer Role
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testOfficeBearerRoleAreStoredCorrectly(){

        $title = 'New Office Bearer Role';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/office-bearer-role',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testOfficeBearerRoleAreFetchedCorrectly() {

        $officeBearerRole = factory('App\Models\Masters\OfficeBearerRole', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/office-bearer-role',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Office Bearer Role'
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

    public function testOfficeBearerRoleAreUpdatedCorrectly() {

        $officeBearerRole = factory(\App\Models\Masters\OfficeBearerRole::class)->create([
            'title' => 'Office Bearer Role'
        ]);

        $title = 'New Office Bearer Role';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/office-bearer-role/'. $officeBearerRole->id, $payload);
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
