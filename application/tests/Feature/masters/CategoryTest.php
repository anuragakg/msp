<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
{
    /**
     * Master - Category
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testCategoryAreStoredCorrectly(){

        $title = 'New Category';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/category',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testCategoryAreFetchedCorrectly() {

        $category = factory('App\Models\Masters\Category', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/category',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Category'
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

    public function testCategoryAreUpdatedCorrectly() {

        $category = factory(\App\Models\Masters\Category::class)->create([
            'title' => 'Category'
        ]);

        $title = 'New Category';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/category/'. $category->id, $payload);
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
