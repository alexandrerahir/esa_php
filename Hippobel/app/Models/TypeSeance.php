<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeSeance extends Model{
    use HasFactory;

    protected $table = 'type_seance';
    protected $primaryKey = 'id_type_seance';
    protected $fillable = ['nom_type_seance'];

    public function seances() {
        return $this->hasMany(Seance::class, 'id_type_seance');
    }
}
