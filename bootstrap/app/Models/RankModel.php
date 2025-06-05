<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RankModel extends Model
{
    protected $table = 'tbl_ranking';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'masterlist_id',
        'field',
        'current_qua',
        'current_rank',
        'updated_field',
        'updated_qua',
        'updated_rank',
        'justification',
        'certificate_path',
        'tor_path',
        'cert_earning_units_path',
        'requested_rank',
        'status',
        'last_promotion_date',
        'remarks'
    ];

    public function masterlist()
    {
        return $this->belongsTo(MasterlistModel::class, 'masterlist_id', 'id');
    }

    public function history()
    {
        return $this->hasMany(RankingHistoryModel::class, 'masterlist_id', 'masterlist_id');
    }
}