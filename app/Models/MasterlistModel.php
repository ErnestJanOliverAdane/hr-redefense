<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class MasterlistModel extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $table = 'masterlist';
    protected $primaryKey = 'id';
    protected $fillable = [
        'employee_id',
        'full_name',
        'last_name',
        'first_name',
        'middle_initial',
        'contact_information',
        'employment_status',
        'job_title',
        'department',
        'job_type',
        'password',
        'plain_password',
        'rank',
        'qualification',
        'field'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'date' => 'datetime'
    ];

    public function contractuals()
    {
        return $this->hasMany(ContructualModel::class, 'masterlist_id');
    }

    public function cosreps()
    {
        return $this->hasMany(COSModel::class, 'masterlist_id');
    }

    public function ranking()
    {
        return $this->hasMany(RankModel::class, 'masterlist_id');
    }


    public function getEmploymentType()
    {
        return $this->employment_status;
    }

    public function personal_information()
    {
        return $this->hasOne(PersonalInformationModel::class, 'employee_id', 'employee_id');
    }



}
