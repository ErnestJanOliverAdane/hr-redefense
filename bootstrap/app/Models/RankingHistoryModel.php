<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankingHistoryModel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_ranking_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'masterlist_id',
        'employee_id',
        'previous_rank',
        'current_rank',  // Make sure this is here
        'current_qua',
        'requested_rank',
        'justification',
        'certificate_path',
        'cert_earning_units_path',
        'tor_path',
        'status',
        'remarks'
    ];

    /**
     * Get the employee record associated with the ranking history.
     */
    public function employee()
    {
        return $this->belongsTo(MasterlistModel::class, 'masterlist_id');
    }

    /**
     * Get the current ranking record associated with this history entry.
     */
    public function ranking()
    {
        return $this->belongsTo(RankModel::class, 'masterlist_id', 'masterlist_id');
    }
}