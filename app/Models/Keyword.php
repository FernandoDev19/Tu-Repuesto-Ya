<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    use HasFactory;

    public function categoria(){
        return $this->belongsTo(Category::class, 'id_categoria');
    }
}
