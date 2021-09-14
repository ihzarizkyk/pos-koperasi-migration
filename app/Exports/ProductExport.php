<?php 

namespace App\Exports;
    
use Illuminate\Support\Facades\DB;
use App\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
    
class ProductExport implements FromArray, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    use Exportable;

    protected $cari;

    function __construct($products) {
        $this->item[] = $products;
    }

    public function array():array
    {
        foreach ($this->item as $value) {
            return $value;
        }
    }

    public function headings(): array
    {
        return [
            'Kode Barang',
            'id categories',
            'Barang',
            'Berat Barang',
            'Merk',
            'Laba Rupiah',
            'Laba Persen',
            'Stok Barang',
            'Harga',
            'HPP',
            'Keterangan',
            'created_at',
            'updated_at'
        ];
    }
}