<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProposedLocationTest extends TestCase
{
    /**
     * Proposed Location
     *
     * @return void
     */
    use DatabaseTransactions;

    public function testProposedLocationAreStoredCorrectly(){

        $payload    =   [
            'kendra_name' => 'Kendra name 2',
            'permanent_address' => 'Permanent address',
            'temporary_address' => 'Temp Address',
            'pin_code' => '232343',
            'state' => '1',
            'district' => '1',
            'block' => '1',
            'leader' => '1',
            'leader_mobile' => '3456789012',
            'leader_email' => 'xnwi@gmail.com',
            'deputy_leader' => '1',
            'deputy_leader_mobile' => '3327764532',
            'deputy_leader_email' => 'cbwu@gmail.com',
            'accounts' => 'euhu1312111',
            'procurement' => 'dcdcd433',
            'training' => 'cdew4343',
            'value_addition' => 'dwefwe4434',
            'marketing' => 'deef4434',
            'it' => 'sdfefe454',
            'bank_account_no' => '34234343432',
            'ifsc_code' => 'ICICI0000012',
            'additional_info' => 'ced343sdsa232432',
            'status' => '1',
        ];

        $httpRequest = $this->json('POST', '/api/v1/proposed/proposed-location',$payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'kendra_name' => 'Kendra name 2',
                'permanent_address' => 'Permanent address',
                'temporary_address' => 'Temp Address',
                'pin_code' => '232343',
                'state' => '1',
                'district' => '1',
                'block' => '1',
                'leader' => '1',
                'leader_mobile' => '3456789012',
                'leader_email' => 'xnwi@gmail.com',
                'deputy_leader' => '1',
                'deputy_leader_mobile' => '3327764532',
                'deputy_leader_email' => 'cbwu@gmail.com',
                'accounts' => 'euhu1312111',
                'procurement' => 'dcdcd433',
                'training' => 'cdew4343',
                'value_addition' => 'dwefwe4434',
                'marketing' => 'deef4434',
                'it' => 'sdfefe454',
                'bank_account_no' => '34234343432',
                'ifsc_code' => 'ICICI0000012',
                'additional_info' => 'ced343sdsa232432',
                'status' => '1',
            ]
        ]);
    }

    public function testProposedLocationAreUpdatedCorrectly() {

        $proposedLocation = factory(\App\Models\Proposed\ProposedLocation::class)->create([
            'kendra_name' => 'Kendra name 2',
            'permanent_address' => 'Permanent address',
            'temporary_address' => 'Temp Address',
            'pin_code' => '232343',
            'state' => '1',
            'district' => '1',
            'block' => '1',
            'leader' => '1',
            'leader_mobile' => '3456789012',
            'leader_email' => 'xnwi@gmail.com',
            'deputy_leader' => '1',
            'deputy_leader_mobile' => '3327764532',
            'deputy_leader_email' => 'cbwu@gmail.com',
            'accounts' => 'euhu1312111',
            'procurement' => 'dcdcd433',
            'training' => 'cdew4343',
            'value_addition' => 'dwefwe4434',
            'marketing' => 'deef4434',
            'it' => 'sdfefe454',
            'bank_account_no' => '34234343432',
            'ifsc_code' => 'ICICI0000012',
            'additional_info' => 'ced343sdsa232432',
            'status' => '1',
        ]);

        $kendra_name = 'New kendra Name';
        $payload    =   [
            'kendra_name' => $kendra_name,
            'permanent_address' => 'Permanent address',
            'temporary_address' => 'Temp Address',
            'pin_code' => '232343',
            'state' => '1',
            'district' => '1',
            'block' => '1',
            'leader' => '1',
            'leader_mobile' => '3456789012',
            'leader_email' => 'xnwi@gmail.com',
            'deputy_leader' => '1',
            'deputy_leader_mobile' => '3327764532',
            'deputy_leader_email' => 'cbwu@gmail.com',
            'accounts' => 'euhu1312111',
            'procurement' => 'dcdcd433',
            'training' => 'cdew4343',
            'value_addition' => 'dwefwe4434',
            'marketing' => 'deef4434',
            'it' => 'sdfefe454',
            'bank_account_no' => '34234343432',
            'ifsc_code' => 'ICICI0000012',
            'additional_info' => 'ced343sdsa232432',
            'status' => '1',
        ];
        
        $httpRequest = $this->json('PUT', '/api/v1/proposed/proposed-location/'. $proposedLocation->id, $payload);
        $httpRequest
        ->assertStatus(200)
        ->assertJson([
            'status' => 1,
            'data' => [
                'kendra_name' => $kendra_name,
                'permanent_address' => 'Permanent address',
                'temporary_address' => 'Temp Address',
                'pin_code' => '232343',
                'state' => '1',
                'district' => '1',
                'block' => '1',
                'leader' => '1',
                'leader_mobile' => '3456789012',
                'leader_email' => 'xnwi@gmail.com',
                'deputy_leader' => '1',
                'deputy_leader_mobile' => '3327764532',
                'deputy_leader_email' => 'cbwu@gmail.com',
                'accounts' => 'euhu1312111',
                'procurement' => 'dcdcd433',
                'training' => 'cdew4343',
                'value_addition' => 'dwefwe4434',
                'marketing' => 'deef4434',
                'it' => 'sdfefe454',
                'bank_account_no' => '34234343432',
                'ifsc_code' => 'ICICI0000012',
                'additional_info' => 'ced343sdsa232432',
                'status' => '1',
            ]
        ]);
    }
}
