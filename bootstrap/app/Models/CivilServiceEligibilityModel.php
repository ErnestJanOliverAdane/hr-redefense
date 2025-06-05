<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CivilServiceEligibilityModel extends Model
{
    protected $table = 'civil_service_eligibilities';
    public $timestamps = true; // or false if not needed
    protected $primaryKey = 'id';
    protected $fillable = [
        'personal_informations_id',
        'eligibility',
        'rating',
        'exam_date',
        'exam_place',
        'license_number',
        'release_date'
    ];


    public function personalInformation()
    {
        return $this->belongsTo(PersonalInformationModel::class, 'personal_information_id');
    }
}