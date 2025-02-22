<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seance extends Model {
    use HasFactory;

    protected $table = 'seance';
    protected $primaryKey = 'id_seance';
    protected $fillable = ['nb_chevaux', 'debut_seance', 'fin_seance', 'id_secretaire', 'id_client', 'id_type_seance', 'id_moniteur'];

    public function secretaire() {
        return $this->belongsTo(Secretaire::class, 'id_secretaire');
    }

    public function client() {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public function typeSeance() {
        return $this->belongsTo(TypeSeance::class, 'id_type_seance');
    }

    public function moniteur() {
        return $this->belongsTo(Moniteur::class, 'id_moniteur');
    }

    public function chevaux() {
        return $this->belongsToMany(Cheval::class, 'seance_cheval', 'id_seance', 'id_cheval');
    }
}
