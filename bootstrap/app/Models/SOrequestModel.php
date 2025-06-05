<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SOrequestModel extends Model
{
    protected $table = 'tbl_so_request';
    protected $primaryKey = 'soreqid';
    protected $fillable = [
        'employee_id',
        'Email',
        'tin',
        'birthdate',
        'birthplace',
        'purpose',
        'attachment',
        'status',
        'created_at',
        'updated_at',
    ];

    public function masterlist()
    {
        return $this->belongsTo(MasterlistModel::class, 'employee_id', 'employee_id');
    }

    public function isApproved()
    {
        return $this->status === 'approve';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isRejected()
    {
        return $this->status === 'reject';
    }


}
