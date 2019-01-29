<?php

namespace App\Exports;
use App\Product;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataExport implements FromCollection, WithHeadings
{
    public function headings():array
    {
        return [
            'id',
            'name',
            'slug',
            'details',
            'price',
            'description',
            'featured',
            'quantity',
            'image',
            'created_at',
            'updated_at',
            'cause',
            'date',
            'venue',
            'donated_by',
            'private',
            'time',
            'status',
            'fee'
        ];
    }
    public function collection()
    {
        return Product::all();
    }
}