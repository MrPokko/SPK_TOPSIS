<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;
    protected $table = 'alternatifs';
    protected $primaryKey = 'id_alternatif';
    public $timestamps = false;

    protected $fillable = [
        'nama_alternatif',
    ];
    public function nilais()
    {
        return $this->hasMany(Nilai::class, 'id_alternatif');
    }
    public function hasil_topsis()
    {
        return $this->hasOne(HasilTopsis::class, 'id_alternatif', 'id_hasil');
    }
    
}
