<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LevelTest extends TestCase
{
    /**
     * Master - Level
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testLevelAreStoredCorrectly(){

        $title = 'New Level';
        $slug = 'Slug';
        $description = 'Description';
        $payload    =   [
            'title'  => $title,
            'slug'  => $slug,
            'description'  => $description
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/level',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
                'slug'  => $slug,
                'description'  => $description
            ]
        ]);
    }

    public function testLevelAreFetchedCorrectly() {

        $level = factory('App\Models\Masters\Level', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/level',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Level',
                'slug' => 'Slug',
                'description' => 'Description'
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

    public function testLevelAreUpdatedCorrectly() {

        $level = factory(\App\Models\Masters\Level::class)->create([
            'title' => 'Level',
            'slug' => 'Slug',
            'description' => 'Description'
        ]);

        $title = 'New Level';
        $slug = 'Slug';
        $description = 'Description';
        $payload    =   [
            'title'  => $title,
            'slug'  => $slug,
            'description'  => $description
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/level/'. $level->id, $payload);
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
