<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function keyword(){
        return $this->hasMany(Keyword::class, 'id_categoria');
    }
}
