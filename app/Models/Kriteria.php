<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'Kriterias';
    protected $primaryKey = 'id_kriteria';
    public $timestamps = false;

    use HasFactory;

    protected $fillable = ['nama_kriteria', 'bobot'];

    public function nilais()
    {
        return $this->hasMany(Nilai::class, 'id_kriteria');
    }
}
