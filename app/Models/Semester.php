<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $connection = 'mysql';
    protected $table = 'semesters';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'school_year_id',
        'is_active',
    ];
}
