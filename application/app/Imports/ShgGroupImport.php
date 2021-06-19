<?php

namespace App\Imports;

use App\Models\Shg\ShgGroup;
use App\Models\Shg\ShgGatherers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;

class ShgGroupImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $data)
    {
        $shgGroupData = new ShgGroup();
        DB::beginTransaction();
        try {

            $shgGroupData->title = $data['title'];
            $shgGroupData->bank_ac_no = $data['bank_ac_no'];
            $shgGroupData->ifsc_code = $data['ifsc_code'];
            $shgGroupData->total_corpus = $data['total_corpus'];
            $shgGroupData->coordinating_agency = $data['coordinating_agency'];
            $shgGroupData->st_members = $data['st_members'];
            $shgGroupData->corpus_to_invest = $data['corpus_to_invest'];
            $shgGroupData->contact_person = $data['contact_person'];
            $shgGroupData->contact_person_mobile = $data['contact_person_mobile'];
            $shgGroupData->is_ajeevika = $data['is_ajeevika'];
            $shgGroupData->ajeevika_value = $data['ajeevika_value'];
            $shgGroupData->shg_group_no = $data['shg_group_no'];
            $shgGroupData->created_by = Auth::user()->id;
            $shgGroupData->updated_by = Auth::user()->id;
            $shgGroupData->save();


            $shgIds = $data['shg_ids'];
            $shgIds = explode(',', $shgIds);

            $shgIdArray = ShgGatherers::whereIn('name_of_tribal',$shgIds)->pluck('id')->toArray();
            
            /** Create Shg Group relation Mapping */
           
            $mapped = [];
            foreach ($shgIdArray as $key => $value) {
                $mapped[$value] = [
                    'created_by' => 0,
                    'updated_by' => 0,
                ];
            }
            $shgGroupData->getShgGathererGroupsRelation()->sync($mapped);
    
            DB::commit();
            return $shgGroupData;

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function startCell() {
        return A1;
    }
}