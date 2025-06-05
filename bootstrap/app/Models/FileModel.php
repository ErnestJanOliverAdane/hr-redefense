<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileModel extends Model
{
    protected $table = 'files';
    protected $fillable = [
        'masterlist_id',
        'name',
        'path',
        'size',
        'type'
    ];
}