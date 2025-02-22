<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model {
    use HasFactory;

    protected $table = 'client';
    protected $primaryKey = 'id_client';
    protected $fillable = ['nom_client', 'email_client', 'telephone_client'];

    public function seances() {
        return $this->hasMany(Seance::class, 'id_client');
    }
}
