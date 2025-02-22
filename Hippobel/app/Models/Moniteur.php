<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;  

class Moniteur extends Model {
    use HasFactory;

    protected $table = 'moniteur';
    protected $primaryKey = 'id_moniteur';
    protected $fillable = ['nom_moniteur', 'prenom_moniteur', 'email_moniteur', 'telephone_moniteur'];

    public function seances() {
        return $this->hasMany(Seance::class, 'id_moniteur');
    }
}
