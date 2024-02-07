<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProveedorActivo;

class Provider extends Model
{
    use HasFactory;

    public function user()
{
    return $this->hasMany(User::class, 'proveedor_id');
}

    protected static function booted()
    {
        static::updated(function ($provider) {
            if ($provider->isDirty('estado') && $provider->estado == 1) {
                $email = $provider->email;
                $password = '(Contraseña con la que se registró).'; // Reemplaza esto por la contraseña real del proveedor

                Mail::to($email)->send(new ProveedorActivo($email, $password));
            }
        });
    }


}
