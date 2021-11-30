<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $hidden = ['descripcion','id','updated_at','created_at','pivot'];

	public function videos(){

	    return $this->hasMany(Video::class, 'cursos_id');
	}

	 public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'cursos_usuarios','usuarios_id', 'cursos_id');
    }
}
