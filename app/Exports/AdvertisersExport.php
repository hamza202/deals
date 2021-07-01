<?php
namespace App\Exports;

use App\Models\Advertiser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdvertisersExport implements FromCollection, WithHeadings
{

 const  from = null;
const to = null;

    public function __construct($from ,$to)
    {
        $this -> from = $from;
        $this ->to = $to;
    }

    public function collection()
    {


        $data = Advertiser::select(['id','name','email','phone','created_at'])->whereBetween('created_at', [$this -> from,$this -> to])
            ->get();

        return $data;
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Email',
            'phone',
            'Created at',
        ];
    }

}
