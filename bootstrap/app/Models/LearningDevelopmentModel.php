<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningDevelopmentModel extends Model
{
    protected $table = 'learning_developments';
    public $timestamps = true; // or false if not needed
    protected $primaryKey = 'id';
    protected $fillable = [
        'personal_informations_id',
        'title',
        'from_date',
        'to_date',
        'hours',
        'type',
        'conducted_by'
    ];
    protected $dates = [
        'from_date',
        'to_date',
        'created_at',
        'updated_at'
    ];

    public function personalInformation()
    {
        return $this->belongsTo(PersonalInformationModel::class, 'personal_information_id');
    }
}