<?php

namespace App\Queries\MisReport;

use App\Models\Proposed\ProposedLocation;
use App\Models\Proposed\Vdvk;
use Illuminate\Database\Eloquent\Builder;

class MisReportSanctionAmountVdvkQuery extends MisBaseQuery
{

    /**
     * MO get haat market query in proposed haat market linkage
     * @param string $id Resource ID
     * @return Vdvk
     */
    public function __construct($serviceName, $filters = [])
    {
        $this->query = $this->viewAllQuery($serviceName);
        $this->filters = $filters;
    }

    public function viewAllQuery($serviceName)
    {

        $user = $this->getUser();

        $mappings = [
            1 => 'getMisReport'.$serviceName.'Admin',
            2 => 'getMisReport'.$serviceName.'TrifedAdmin',
            3 => 'getMisReport'.$serviceName.'TrifedUser',
        ];

        return $mappings;

    }

    public function executeMethods()
    {

        $user = $this->getUser();
        if (isset($this->query[$user->role])) {
            return call_user_func([$this, $this->query[$user->role]], $user, $this->filters);
        }

        return abort(403,'Role based query is not defined.');
    }

    private function getMisReportSanctionedAmountMo($user, $filters)
    {
        return Vdvk::where([
            'user_id' => $user->id,
        ])
            ->whereHas('getProposedLocation', function (Builder $query) use ($filters) {
                $query->where('state', $filters['state']);
            })->has('getSanctionLetters')->get();
    }

    /**
     * State implementing officer
     */
    private function getMisReportSanctionedAmountSio($user, $filters)
    {
        $userState = $user->getUserDetails->state ?? 0;
        return Vdvk::whereHas('getProposedLocation', function (Builder $query) use ($userState) {
            $query->where('state', $userState);
        })->has('getSanctionLetters')->get();
    }

    /**
     * District implementing officer
     */
    private function getMisReportSanctionedAmountDio($user, $filters)
    {
        $userDetails = $user->getUserDetails;
        $userState = $userDetails->state ?? 0;
        $userDistrict = $userDetails->district ?? 0;
        return Vdvk::whereHas('getProposedLocation', function (Builder $query) use ($userState, $userDistrict) {
            $query->where('state', $userState);
            $query->where('district', $userDistrict);
        })->has('getSanctionLetters')->get();
    }

    /**
     * State Nodal Department
     */
    private function getMisReportSanctionedAmountSnd($user, $filters)
    {
        $userState = $user->getUserDetails->state ?? 0;
        return Vdvk::whereHas('getProposedLocation', function (Builder $query) use ($userState) {
            $query->where('state', $userState);
        })->has('getSanctionLetters')->get();
    }

    /**
     * Admin
     */
    private function getMisReportSanctionedAmountAdmin($user,$filters)
    {
        return Vdvk::whereHas('getProposedLocation', function (Builder $query) use ($filters) {
             if (isset($filters['state'])) {
                $query->where('state', $filters['state']);
            }
            if (isset($filters['district'])) {
                $query->where('district', $filters['district']);
            }
            if (isset($filters['block'])) {
                $query->where('block', $filters['block']);
            }
        })->has('getSanctionLetters');
    }

    /**
     * TrifedAdmin
     */
    private function getMisReportSanctionedAmountTrifedAdmin($user,$filters)
    {
        return Vdvk::whereHas('getProposedLocation', function (Builder $query) use ($filters) {
            if(isset($filters['state'])){
            $query->where('state', $filters['state']);
        }
        })->has('getSanctionLetters');
    }

    /**
     * TrifedUser
     */
    private function getMisReportSanctionedAmountTrifedUser($user, $filters)
    {
        return Vdvk::whereHas('getProposedLocation', function (Builder $query) use ($filters) {
            if(isset($filters['state'])){
            $query->where('state', $filters['state']);
        }
        })->has('getSanctionLetters');
    }
}
