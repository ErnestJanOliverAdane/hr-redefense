<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationalBackgroundModel extends Model
{

    protected $table = 'educational_backgrounds';
    public $timestamps = true; // or false if not needed
    protected $primaryKey = 'id';
    protected $fillable = [
        'personal_informations_id',
        'level',
        'school_name',
        'degree_course',
        'period_from',
        'period_to',
        'highest_level_earned',
        'year_graduated',
        'academic_honors'
    ];


    public function personalInformation()
    {
        return $this->belongsTo(PersonalInformationModel::class, 'personal_information_id');
    }
}
