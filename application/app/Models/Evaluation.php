<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluation extends Model
{
    use SoftDeletes;

    protected $table = 'evaluations';

    protected $fillable = ['mo_id', 'vdvk_id', 'date_of_evaluation', 'actual_observation', 'recommendation','evaluation', 'upload_supporting_documents', 'created_by', 'updated_by'];

    public function getMOName()
    {
    	return $this->belongsTo(User::class, 'mo_id');
    }
}
