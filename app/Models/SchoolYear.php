<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolYear extends Model
{
    protected $connection = 'mysql';
    protected $table = 'school_years';
    protected $primaryKey = 'id';
    protected $fillable = [
        'year_start',
        'year_end',
    ];

    public function semesters(): HasMany
    {
        return $this->hasMany(Semester::class);
    }
}
