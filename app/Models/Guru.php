<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $connection = 'mysql';
    protected $table = 'guru';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_guru',
        'kelamin',
        'nip',
        'is_active',
    ];
}
