<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Keyword;
use App\Models\Category;

class categoriasExcelExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Keyword::with('categoria')->select('id', 'palabra_clave', 'id_categoria')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Palabras clave',
            'Categorias'
        ];
    }

    public function map($keyword): array
    {
        $categoria = $keyword->categoria;
        return [
            $keyword->id,
            $keyword->palabra_clave,
            $categoria ? $categoria->nombre_categoria : null
        ];
    }
}
