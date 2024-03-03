<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithCustomStartCell, ShouldAutoSize, WithDrawings, WithTitle, WithHeadings
{

    public function __construct($products)
    {
        $this->products = $products;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->products;
    }

    public function startCell(): string
    {
        return 'A4';
    }
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('SistemaPOS');
        $drawing->setDescription('SistemaPOS');
        $drawing->setPath(public_path('/img/small-logo-white.png'));
        $drawing->setHeight(40);
        $drawing->setCoordinates('A1');

        return $drawing;
    }
    public function title(): string
    {
        return 'Productos';
    }

    public function headings(): array
    {
        return [
            'COD.',
            'DESCRIPCIÓN',
            'CANT.',
            'UND',
            'PRECIO',
        ];
    }
}
