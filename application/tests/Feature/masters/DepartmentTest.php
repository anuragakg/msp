<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DepartmentTest extends TestCase
{
    /**
     * Master - Department
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testDepartmentAreStoredCorrectly(){

        $title = 'New Department';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/department',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testDepartmentAreFetchedCorrectly() {

        $department = factory('App\Models\Masters\Department', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/department',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Department'
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

    public function testDepartmentAreUpdatedCorrectly() {

        $department = factory(\App\Models\Masters\Department::class)->create([
            'title' => 'Department'
        ]);

        $title = 'New Department';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/department/'. $department->id, $payload);
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
