<?php

namespace Tests\Feature\masters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PhoneTypeTest extends TestCase
{
    /**
     * Master - Phone Type
     *
     * @return void
     */
    use DatabaseTransactions;
    
    public function testPhoneTypeAreStoredCorrectly(){

        $title = 'New Phone Type';
        $payload    =   [
            'title'  => $title
        ];

        $httpRequest = $this->json('POST', '/api/v1/masters/phone-type',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'title'  => $title,
            ]
        ]);
    }

    public function testPhoneTypeAreFetchedCorrectly() {

        $phoneType = factory('App\Models\Masters\PhoneType', 1)->create();

        $httpRequest = $this->json('GET', '/api/v1/masters/phone-type',[]);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => array([
                'title' => 'Phone Type'
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

    public function testPhoneTypeAreUpdatedCorrectly() {

        $phoneType = factory(\App\Models\Masters\PhoneType::class)->create([
            'title' => 'Phone Type'
        ]);

        $title = 'New Phone Type';
        $payload    =   [
            'title'  => $title
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/masters/phone-type/'. $phoneType->id, $payload);
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
