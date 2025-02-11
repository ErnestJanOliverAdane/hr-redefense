<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyBackgroundModel extends Model
{
    protected $table = 'family_backgrounds';

    protected $fillable = [
        'personal_informations_id',
        'spouse_surname',
        'spouse_first_name',
        'spouse_middle_name',
        'spouse_name_extension',
        'spouse_occupation',
        'spouse_employer',
        'spouse_business_address',
        'spouse_telephone',
        'father_surname',
        'father_first_name',
        'father_middle_name',
        'father_name_extension',
        'mother_surname',
        'mother_first_name',
        'mother_middle_name',
        'mother_maiden_name'
    ];

    public function personalInformation()
    {
        return $this->belongsTo(PersonalInformationModel::class, 'personal_information_id', 'id');
    }
}