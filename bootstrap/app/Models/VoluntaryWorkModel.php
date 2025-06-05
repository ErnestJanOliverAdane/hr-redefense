<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoluntaryWorkModel extends Model
{
    protected $table = 'voluntary_works';
    public $timestamps = true; // or false if not needed
    protected $primaryKey = 'id';
    protected $fillable = [
        'personal_informations_id',
        'organization_name',
        'organization_address',
        'from_date',
        'to_date',
        'hours',
        'position'
    ];


    public function personalInformation()
    {
        return $this->belongsTo(PersonalInformationModel::class, 'personal_information_id');
    }
}