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
        return Provider::select('id', 'nit_empresa', 'razon_social', 'pais','departamento', 'municipio', 'direccion', 'celular', 'telefono', 'representante_legal', 'contacto_principal', 'marcas_preferencias', 'email', 'email_secundario', 'especialidad', 'rut', 'camara_comercio', 'estado')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'NIT',
            'Razon social',
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
            'Estado'
        ];
    }

    public function map($provider): array
    {
        return [
            $provider->id,
            $provider->nit_empresa,
            $provider->razon_social,
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
            $provider->estado ? 'activo' : 'inactivo'
        ];
    }
}

