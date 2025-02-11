<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkExperienceModel extends Model
{
    protected $table = 'work_experiences';
    public $timestamps = true; // or false if not needed
    protected $primaryKey = 'id';
    protected $fillable = [
        'personal_informations_id',
        'position_title',
        'department',
        'monthly_salary',
        'salary_grade',
        'status_of_appointment',
        'govt_service',
        'from_date',
        'to_date'
    ];

    protected $dates = [
        'from_date',
        'to_date'
    ];

    public function personalInformation()
    {
        return $this->belongsTo(PersonalInformationModel::class, 'personal_information_id');
    }
}