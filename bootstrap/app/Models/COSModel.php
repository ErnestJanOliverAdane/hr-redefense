<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class COSModel extends Model
{
    use HasFactory;

    protected $table = 'cos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'masterlist_id',
        'date',
        'sex',
        'eligibility',
        'workstatus',
        'yearsofservice',
        'natureofwork',
        'specificnatureofwork',
    ];
    
    public function masterlist()
    {
        return $this->belongsTo(MasterlistModel::class, 'masterlist_id');
    }
}
