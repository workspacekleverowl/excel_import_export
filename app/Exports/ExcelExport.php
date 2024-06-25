<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExcelExport implements FromCollection, WithHeadings, WithMapping
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return [
            'Season',
            'Sum of Ordered Quantity',
            'Fabric Cost per GMT',
           ' Trim Cost',
           ' FOB',
           ' MRP'
        ];
    }

    public function map($row): array
    {
        return [
            $row['season'],
            $row['sum_quantity'],
            $row['fabric_cost_per_gmt'],
            $row['trim_cost'],
            $row['fob'],
            $row['mrp'],

        ];
    }
}
