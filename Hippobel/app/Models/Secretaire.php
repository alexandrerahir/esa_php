<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Secretaire extends Authenticatable {
    use Notifiable;

    protected $table = 'secretaire';
    protected $primaryKey = 'id_secretaire';

    protected $fillable = ['nom_secretaire', 'prenom_secretaire', 'email_secretaire', 'password'];

    protected $hidden = ['password', 'remember_token'];
}
