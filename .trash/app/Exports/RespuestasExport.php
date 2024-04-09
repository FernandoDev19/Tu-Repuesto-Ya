<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Answer;

class RespuestasExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Answer::all();
    }

    public function headings(): array{
        return [
            'Id',
            'Solicitud',
            'Proveedor',
            'Repuestos',
            'Precios',
            'Comentarios',
            'Fecha de creación'
        ];
    }

    public function map($answer): array{
        return [
            $answer->id,
            $answer->idSolicitud,
            $answer->idProveedor,
            implode(', ', json_decode($answer->repuesto)),
            implode(', ', json_decode($answer->precio)),
            $answer->comentarios,
            $answer->created_at
        ];
    }
}
