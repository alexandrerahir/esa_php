<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cheval extends Model {
    use HasFactory;

    protected $table = 'cheval';
    protected $primaryKey = 'id_cheval';
    protected $fillable = ['nom_cheval', 'naissance_cheval', 'heure_max_cheval'];

    public function seances() {
        return $this->belongsToMany(Seance::class, 'seance_cheval', 'id_cheval', 'id_seance');
    }
}
