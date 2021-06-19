<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IdProofTest extends TestCase
{
    /**
     * Master - Id Proof
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testIdProofAreStoredCorrectly(){

        $title = 'New Id Proof';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/id-proof',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testIdProofAreFetchedCorrectly() {

        $idProof = factory('App\Models\Masters\IdProof', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/id-proof',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Id Proof'
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

    public function testIdProofAreUpdatedCorrectly() {

        $idProof = factory(\App\Models\Masters\IdProof::class)->create([
            'title' => 'Id Proof'
        ]);

        $title = 'New Id Proof';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/id-proof/'. $idProof->id, $payload);
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
