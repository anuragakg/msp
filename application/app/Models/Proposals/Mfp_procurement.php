<?php

namespace App\Models\Proposals;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Mfp_procurement_dia_release;
use App\Models\Masters\FinancialYear;
use App\Models\Masters\District;
use App\Models\Actualdetail\Overhead_collection_level;
use App\Models\Actualdetail\Overhead_labour_charges;
use App\Models\Actualdetail\Overhead_weighment_charges;
use App\Models\Actualdetail\Overhead_transportation_charges;
use App\Models\Actualdetail\Overhead_service_charges;
use App\Models\Actualdetail\Overhead_warehouse_labour_charges;
use App\Models\Actualdetail\Overhead_warehouse_charges;
use App\Models\Actualdetail\Overhead_estimated_wastages;
use App\Models\Actualdetail\Overhead_service_charges_dia;
use App\Models\Actualdetail\Overhead_other_costs;
use App\Models\Proposals\Mfp_storage_actual_other;
use App\Models\Actualdetail\Mfp_procurement_actual_detail;
use App\Models\Mfp_procurement_dia_release_commodity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Mfp_procurement extends Model
{
    use SoftDeletes;
    protected $table = 'mfp_procurement';
    
    protected $fillable = [
        'year_id',
        'user_id',
        'status',
        'submission_status',
        'proposed_amount',
        'remarks',
        'is_draft',
        'proposal_id',
        'consolidated_id',
        'reference_id',
        'assigned_by',
        'assigned_to',
        'current_status',
        'is_assigned_next_level',
        'current_scrutiny_level_id',
        'current_status_log_id',
        
        'is_released',
        'released_amount',
        'has_released_to_procurement_agent',
        'released_amount_procurement_agent',
        'commission_amount',
        'approval_date',
        'approved_by',
        'actual_tribal_amount_paid',
        'total_mfp_storage_value',
        'total_overhead_paid_value',
        'created_by',
        'updated_by',
        'submission_date',
        'assigned_date',
    ];
    
    public function getUser()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }
    public function getUserDetails()
    {
        return $this->hasOne(UserDetail::class, 'user_id','user_id');
    }


   
    public function getProposedFinancialYear()
    {
        return $this->hasOne(FinancialYear::class, 'id', 'year_id')->select(['id','title']);
    }
    public function getProposedStatusLogs()
    {
        return $this->hasMany(Mfp_procurement_status_log::class, 'mfp_procurement_id', 'id');
    }
    
    public function getMfpCoverage()
    {
        return $this->hasMany(Mfp_coverage::class, 'mfp_procurement_id', 'id');
    }
    public function getMfpCollectionLevel()
    {
        return $this->hasMany(Mfp_procurement_collection_level::class, 'mfp_procurement_id', 'id');
    }
    public function getMfpSeasonality()
    {
        return $this->hasMany(Mfp_seasonality::class, 'mfp_procurement_id', 'id');
    }

    public function getMfpCommodity()
    {
        return $this->hasMany(Mfp_procurement_commodity::class, 'mfp_procurement_id', 'id');
    }

    public function getMfpDisposal()
    {
        return $this->hasMany(Mfp_procurement_disposal::class, 'mfp_procurement_id', 'id');
    }

    /****
     * Get Mfp Labour charges
     */
    public function getMfpLabourCharges(){
        return $this->hasMany(Mfp_procurement_labour_charges::class, 'mfp_procurement_id', 'id');   
    }

    /****
     * Get Mfp Weightment charges
     */
    public function getMfpWeightmentCharges(){
        return $this->hasMany(Mfp_procurement_weightment_charges::class, 'mfp_procurement_id', 'id');   
    }

    /****
     * Get Mfp Transportation charges
     */
    public function getMfpTransportationCharges(){
        return $this->hasMany(Mfp_procurement_transportation_charges::class, 'mfp_procurement_id', 'id');   
    }

    /****
     * Get Mfp Service charges
     */
    public function getMfpServiceCharges(){
        return $this->hasMany(Mfp_procurement_service_charges::class, 'mfp_procurement_id', 'id');   
    }
   
    /****
     * Get Mfp Warehouse labour charges 
     */
    public function getMfpWarehouseLabourCharges()
    {
        return $this->hasMany(Mfp_procurement_warehouse_labour_charges::class, 'mfp_procurement_id', 'id');
    }
    
    /****
     * Get Mfp Warehouse charges 
     */
    public function getMfpWarehouseCharges(){
        return $this->hasMany(Mfp_procurement_warehouse_charges::class, 'mfp_procurement_id', 'id');   
    }
    
    /****
     * Get Mfp Estimated wastages
     */
    public function getEstimatedWastages(){
        return $this->hasMany(Mfp_procurement_estimated_wastages::class, 'mfp_procurement_id', 'id');   
    }
     /****
     * Get Mfp Estimated wastages
     */
    public function getMfpServiceChargesDIA(){
        return $this->hasMany(Mfp_procurement_service_charges_at_dia::class, 'mfp_procurement_id', 'id');   
    }
    
    /****
     * Get Mfp Labour charges
     */
    public function getMfpOtherCosts(){
        return $this->hasMany(Mfp_procurement_other_costs::class, 'mfp_procurement_id', 'id');   
    }
    /****
     * Get Mfp Labour charges
     */
    public function getSummary(){
        return $this->hasOne(Mfp_procurement_summary::class, 'mfp_procurement_id', 'id');   
    }

    public function getConsolidated(){
        return $this->hasOne(Mfp_procurement_consolidated::class, 'id', 'consolidated_id');   
    }
    public function getDiaReleasedProcurements(){
        return $this->hasOne(Mfp_procurement_dia_release::class, 'mfp_procurement_id', 'id');   
    }

    public function getDiaReleasedToProcurementsAgent(){
        return $this->hasMany(Mfp_procurement_dia_release::class, 'mfp_procurement_id', 'id');   
    }

    /****
     * Get Actual Overhead cost of packing material charges
     */
    public function getActualOverheadCollectionLevel()
    {
        return $this->hasMany(Overhead_collection_level::class, 'mfp_procurement_id', 'id');
    }
    /****
     * Get Actual Overhead Labour charges
     */
    public function getActualOverheadLabourCharges(){
        return $this->hasMany(Overhead_labour_charges::class, 'mfp_procurement_id', 'id');   
    }

    /****
     * Get Actual Overhead Weightment charges
     */
    public function getActualOverheadWeightmentCharges(){
        return $this->hasMany(Overhead_weighment_charges::class, 'mfp_procurement_id', 'id');   
    }

    /****
     * Get Actual Overhead Transportation charges
     */
    public function getActualOverheadTransportationCharges(){
        return $this->hasMany(Overhead_transportation_charges::class, 'mfp_procurement_id', 'id');   
    }

    /****
     * Get Actual Overhead Service charges
     */
    public function getActualOverheadServiceCharges(){
        return $this->hasMany(Overhead_service_charges::class, 'mfp_procurement_id', 'id');   
    }
   
    /****
     * Get Actual Overhead Warehouse labour charges 
     */
    public function getActualOverheadWarehouseLabourCharges()
    {
        return $this->hasMany(Overhead_warehouse_labour_charges::class, 'mfp_procurement_id', 'id');
    }
    
    /****
     * Get Actual Overhead Warehouse charges 
     */
    public function getActualOverheadWarehouseCharges(){
        return $this->hasMany(Overhead_warehouse_charges::class, 'mfp_procurement_id', 'id');   
    }
    
    /****
     * Get Actual Overhead Estimated wastages
     */
    public function getActualOverheadEstimatedWastages(){
        return $this->hasMany(Overhead_estimated_wastages::class, 'mfp_procurement_id', 'id');   
    }
     /****
     * Get Actual Overhead Estimated wastages
     */
    public function getActualOverheadServiceChargesDIA(){
        return $this->hasMany(Overhead_service_charges_dia::class, 'mfp_procurement_id', 'id');   
    }
    
    /****
     * Get Actual Overhead Other costs
     */
    public function getActualOverheadOtherCosts(){
        return $this->hasMany(Overhead_other_costs::class, 'mfp_procurement_id', 'id');   
    }

    public function getActualMfpStorage(){
        return $this->hasone(Mfp_storage_actual::class, 'ref_id', 'ref_id');   
    }
    public function getActualMfpStorageOther(){
        return $this->hasMany(Mfp_storage_actual_other::class, 'mfp_procurement_id', 'id');   
    }


    public function getActualTribalDetail(){
        return $this->hasMany(Mfp_procurement_actual_detail::class, 'mfp_procurement_id', 'id');   
    }

    public function getMfpStorageActualOther(){
        return $this->hasMany(Mfp_storage_actual_other::class, 'mfp_procurement_id', 'id');   
    }

    /**
     * Get DIA release commodity
     */
    public function getDiaReleaseCommodity(){
        return $this->hasMany(Mfp_procurement_dia_release_commodity::class, 'mfp_procurement_id', 'id')->where('procurement_agent',Auth::user()->id);  
    }

     



}
