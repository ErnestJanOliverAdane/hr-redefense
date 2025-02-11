<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherInformationModel extends Model
{
    protected $table = 'other_information';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = ['special_skills', 'distinctions', 'membership'];


    public function personalInformation()
    {
        return $this->belongsTo(PersonalInformationModel::class, 'personal_information_id');
    }
}