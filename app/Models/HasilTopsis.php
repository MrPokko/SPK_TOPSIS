<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilTopsis extends Model
{
    use HasFactory;
    protected $table = 'hasiltopsis';
    protected $primaryKey = 'id_hasil';
    public $timestamps = false;

    protected $fillable = ['id_alternatif', 'nilai_preferensi', 'urutan'];
    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'id_alternatif', 'id_hasil');
    }
}
