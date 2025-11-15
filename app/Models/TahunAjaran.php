<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TahunAjaran extends Model
{
    protected $connection = 'mysql';
    protected $table = 'tahun_ajaran';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tahun_mulai',
        'tahun_akhir',
    ];

    public function semesters(): HasMany
    {
        return $this->hasMany(Semester::class);
    }
}
