<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Solicitude;

class ProveedorController extends Controller
{
    
    function dashboard()
    {
        // Nombre del usuario
        $name = auth()->user()->name;

        $usuario = User::where('name', $name)->first();

        $ft = $usuario->ft_perfil;

        // Vista principal del administrador
        return view('admin.index', compact('name', 'ft'));
    }

    public function verSolicitudNoti($idSoli, $idNoti)
    {
        // Nombre del usuario
        $name = auth()->user()->name;

        $usuario = User::where('name', $name)->first();

        $ft = $usuario->ft_perfil;

        $solicitud = Solicitude::where('id', $idSoli)->first();
        
        $notification = auth()->user()->unreadNotifications->find($idNoti);
        
        if ($notification) {
            $notification->markAsRead();
        }

        return view('admin.nuevaSolicitudRepuesto', compact('name', 'ft', 'solicitud'));
    }
} 
