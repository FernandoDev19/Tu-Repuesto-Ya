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
        return Provider::select('id', 'nit_empresa', 'razon_social', 'departamento', 'municipio', 'direccion', 'celular', 'telefono', 'email', 'rut', 'camara_comercio', 'estado')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'NIT',
            'Razon social',
            'Departamento',
            'Municipio',
            'Direccion',
            'Celular',
            'Telefono',
            'Email',
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
            $provider->departamento,
            $provider->municipio,
            $provider->direccion,
            $provider->celular,
            $provider->telefono,
            $provider->email,
            $provider->rut ? 'Sí' : 'No',
            $provider->camara_comercio ? 'Sí' : 'No',
            $provider->estado ? 'activo' : 'inactivo'
        ];
    }
}

