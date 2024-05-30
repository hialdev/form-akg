<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    protected $table = 'folder';

    public function forms(){
        return $this->hasMany(Form::class,'id_folder');
    }

    // Definisikan relasi untuk parent folder
    public function parent()
    {
        return $this->belongsTo(Folder::class, 'id_parent_folder');
    }

    // Definisikan relasi untuk child folders
    public function children()
    {
        return $this->hasMany(Folder::class, 'id_parent_folder');
    }
}
