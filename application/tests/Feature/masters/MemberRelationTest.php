<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MemberRelationTest extends TestCase
{
    /**
     * Master - Member Relation
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testMemberRelationAreStoredCorrectly(){

        $title = 'New Member Relation';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/member-relation',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testMemberRelationAreFetchedCorrectly() {

        $memberRelation = factory('App\Models\Masters\MemberRelation', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/member-relation',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Member Relation'
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

    public function testMemberRelationAreUpdatedCorrectly() {

        $memberRelation = factory(\App\Models\Masters\MemberRelation::class)->create([
            'title' => 'Member Relation'
        ]);

        $title = 'New Member Relation';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/member-relation/'. $memberRelation->id, $payload);
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
