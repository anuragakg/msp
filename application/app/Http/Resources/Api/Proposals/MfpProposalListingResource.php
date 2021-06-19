<?php
 
namespace App\Http\Resources\Api\Proposals;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Proposals\MfpCoverageResource;
use App\Models\Proposals\Mfp_procurement;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MfpProposalListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $state = '';
        $district = '';
        $block = '';
        $procurement = Mfp_procurement::where('proposal_id',$this->proposal_id)->first();
        $getUser = isset($this->getUser)?$this->getUser:'';
        //$submitted_by = $getUser->name.' '.$getUser->middle_name.' '.$getUser->last_name;
        if($getUser){
            $state = $getUser->getUserDetails->getState->title;
            $district = $getUser->getUserDetails->getDistrict->title;
            $block = isset($getUser->getUserDetails->getBlock->title)?$getUser->getUserDetails->getBlock->title:'';
        }
        
        $submitted_by = $this->getProposedStatusLogs->where('assigned_to',Auth::user()->id)->where('mfp_procurement_id',$procurement->id)->first()->assigned_by;
        $userData = User::where('id',$submitted_by)->first();
        $submitted_by = $userData->name.' '.$userData->last_name;
        switch ($this->status) {
            case '1':
                $status_text='Approved';
                break;
            case '2':
                $status_text='Revert';
                break;
            case '3':
                $status_text='Reject';
                break;    
            default:
                $status_text='Pending';
                break;
        }
        switch ($this->current_status) {
            case '1':
                $current_status_text='Recommended';
                break;
            case '2':
                $current_status_text='Revert';
                break;
            case '3':
                $current_status_text='Reject';
                break;    
            default:
                $current_status_text='Pending';
                break;
        }
        return [
            'id' => $this->id,
            'ref_id' => $this->ref_id,
            'proposal_id' => $this->proposal_id,
            'consolidated_id'=>!empty($this->consolidated_id)?$this->getConsolidated->reference_number:'-',
            //'mfp_coverage'=>$this->getMfpCoverage,
            'mfps'=>$this->getMfpCoverage->count(),
            'quantity'=>$this->getMfpCommodity->sum('currentqty'),
            'value'=> $this->getMfpCommodity->sum('currentval'),
            'status' => $this->status,
            'status_text' => $status_text,
            'current_status_text' => $current_status_text,
            'current_status' => $this->current_status,
            'total_value'=>$this->getSummary->total_fund_require,
            'submitted_on' => $this->submission_date?date('d-M-Y',strtotime($this->submission_date)):date('d-M-Y',strtotime($this->created_at)),
            'submitted_by'=> $submitted_by,
            'state'=> $state,
            'district'=> $district,
            'block'=> $block,
            'remarks'=> ($this->remarks)?$this->remarks:'NA',
            'fund_release'=> 'NA',
            //'submitted_by_user_name'=> $submitted_by_name,
        ];
    }
}
