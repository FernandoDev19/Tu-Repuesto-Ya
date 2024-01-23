<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

use App\Models\Solicitude;

class SolicitudesExport implements FromCollection, WithHeadings, WithMapping
{

    public function collection()
    {
        return Solicitude::select('id', 'respuestas', 'marca', 'referencia', 'modelo', 'tipo_de_transmision', 'repuesto', 'img_repuesto', 'categoria', 'comentario', 'nombre', 'correo', 'numero', 'pais', 'departamento', 'municipio', 'estado')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Respuestas',
            'Marca',
            'Referencia',
            'Modelo',
            'Transmisión',
            'Repuesto',
            'Imagen del repuesto',
            'Categoria',
            'Comentario',
            'Nombre',
            'Correo',
            'Celular',
            'Pais',
            'Departamento',
            'Municipio',
            'Estado'
        ];
    }

    public function map($solicitud): array
    {
        return [
            $solicitud->id,
            $solicitud->respuestas,
            $solicitud->marca,
            $solicitud->referencia,
            $solicitud->modelo,
            $solicitud->tipo_de_transmision,
            $solicitud->repuesto,
            json_decode($solicitud->img_repuesto),
            json_decode($solicitud->categoria),
            $solicitud->comentario,
            $solicitud->nombre,
            $solicitud->correo,
            $solicitud->numero,
            $solicitud->pais,
            $solicitud->departamento,
            $solicitud->municipio,
            $solicitud->estado ? 'Activa' : 'Inactiva'
        ];
    }
}
