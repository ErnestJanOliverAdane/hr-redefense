<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestModel extends Model
{
    protected $table = 'tbl_coe_req';
    protected $primaryKey = 'coe_id';
    protected $fillable = [
        'employee_id',
        'FirstName',
        'LastName',
        'Email',
        'Position',
        'DateStarted',
        'MonthlyCompensationText',
        'MonthlyCompensationDigits',
        'proof_payment_path',
        'status',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approve';
    const STATUS_REJECTED = 'reject';

    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isApproved()
    {
        return $this->status === self::STATUS_APPROVED;
    }

    public function isRejected()
    {
        return $this->status === self::STATUS_REJECTED;
    }

    public function approve()
    {
        $this->status = self::STATUS_APPROVED;
        $this->save();
    }

    public function reject()
    {
        $this->status = self::STATUS_REJECTED;
        $this->save();
    }

    public function getStatusBadgeClass()
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'bg-warning',
            self::STATUS_APPROVED => 'bg-success',
            self::STATUS_REJECTED => 'bg-danger',
            default => 'bg-secondary'
        };
    }

    public function masterlist()
    {
        return $this->belongsTo(MasterlistModel::class, 'employee_id', 'employee_id');
    }
}