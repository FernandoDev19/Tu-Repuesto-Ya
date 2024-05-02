<?php
// Exporta una hoja de excel de todos los proveedores

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Provider;

class ProveedorExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Provider::select('id', 'nit_empresa', 'nombre_comercial', 'razon_social', 'gerente', 'administrador', 'pais','departamento', 'municipio', 'direccion', 'celular', 'telefono', 'representante_legal', 'contacto_principal', 'marcas_preferencias', 'email', 'email_secundario', 'especialidad', 'rut', 'camara_comercio', 'ha_cotizado', 'sesion', 'estado')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'NIT',
            'Nombre comercial',
            'Razon social',
            'Gerente',
            'Administrador',
            'pais',
            'Departamento',
            'Municipio',
            'Direccion',
            'Celular',
            'Celular 2°',
            'Representante legal',
            'Contacto principal',
            'Preferencias de Marcas',
            'Email',
            'Email Secundario',
            'Especialidad/es',
            'RUT',
            'Camara de comercio',
            '¿Ha cotizado?',
            'Sesión',
            'Estado'
        ];
    }

    public function map($provider): array
    {
        return [
            $provider->id,
            $provider->nit_empresa,
            $provider->nombre_comercial,
            $provider->razon_social,
            $provider->gerente,
            $provider->administrador,
            $provider->pais,
            $provider->departamento,
            $provider->municipio,
            $provider->direccion,
            $provider->celular,
            $provider->telefono,
            $provider->representante_legal,
            $provider->contacto_principal,
            json_decode($provider->marcas_preferencias),
            $provider->email,
            $provider->email_secundario,
            json_decode($provider->especialidad),
            $provider->rut ? 'Sí' : 'No',
            $provider->camara_comercio ? 'Sí' : 'No',
            $provider->ha_cotizado ? 'Sí ha cotizado' : 'No ha cotizado',
            $provider->sesion ? 'Sesión activa' : 'Sesión inactiva',
            $provider->estado ? 'Estado activo' : 'Estado inactivo'
        ];
    }
}

