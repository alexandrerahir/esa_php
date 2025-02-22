<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeanceCheval extends Model {
    use HasFactory;

    protected $table = 'seance_cheval';
    protected $primaryKey = 'id';
    protected $fillable = ['id_seance', 'id_cheval'];

    public function seance() {
        return $this->belongsTo(Seance::class, 'id_seance', 'id_seance');
    }

    public function cheval() {
        return $this->belongsTo(Cheval::class, 'id_cheval', 'id_cheval');
    }
}
