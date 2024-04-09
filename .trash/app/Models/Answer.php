<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    public function solicitud()
    {
        return $this->belongsTo(Solicitude::class, 'idSolicitud');
    }

    public function proveedor()
    {
        return $this->belongsTo(Provider::class, 'idProveedor');
    }
}
