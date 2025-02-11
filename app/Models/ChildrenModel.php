<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildrenModel extends Model
{
    protected $table = 'children';
    protected $fillable = [
        'personal_informations_id',
        'name',
        'date_of_birth'
    ];


    public function personalInformation()
    {
        return $this->belongsTo(PersonalInformationModel::class, 'personal_information_id');
    }
}
