<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    protected $connection = 'mysql';
    protected $table = 'school_years';
    protected $primaryKey = 'id';
    protected $fillable = [
        'year_start',
        'year_end',
    ];
}
