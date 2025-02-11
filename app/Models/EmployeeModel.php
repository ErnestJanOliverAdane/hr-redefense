<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeModel extends Model
{
    use HasFactory;

    protected $table = 'add_employee';
    protected $primaryKey = 'employee_id ';
    protected $fillable = [

        'emp_first_name',
        'emp_last_name',
        'emp_email',
        'emp_phone_number',
        'department_id',
        'role',
    ];

    public function department()
    {
        return $this->belongsTo(DepartmentModel::class, 'department_id');
    }
}
