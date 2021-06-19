<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrgTypeTest extends TestCase
{
    /**
     * Master - Org Type
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testOrgTypeAreStoredCorrectly(){

        $title = 'New Org Type';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/org-type',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testOrgTypeAreFetchedCorrectly() {

        $orgType = factory('App\Models\Masters\OrgType', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/org-type',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Org Type'
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

    public function testOrgTypeAreUpdatedCorrectly() {

        $orgType = factory(\App\Models\Masters\OrgType::class)->create([
            'title' => 'Org Type'
        ]);

        $title = 'New Org Type';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/org-type/'. $orgType->id, $payload);
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
