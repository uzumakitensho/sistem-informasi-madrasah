<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Walas extends Model
{
    protected $connection = 'mysql';
    protected $table = 'walas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tahun_ajaran_id',
        'guru_id',
        'kelas_id',
    ];
}
