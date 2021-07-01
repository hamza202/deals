<?php
namespace App\Exports;

use App\Models\Advertiser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AccountExport implements FromCollection, WithHeadings
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


        $data1 = Advertiser::where('active_account',1)
            ->whereBetween('created_at', [$this -> from,$this -> to])
            ->count();
        $data2 = Advertiser::where('active_account',2)
            ->whereBetween('created_at', [$this -> from,$this -> to])
            ->count();
        $data3 = Advertiser::where('active_account',3)
            ->whereBetween('created_at', [$this -> from,$this -> to])
            ->count();

        $ds = collect([
            (object) [
                'Email' => $data1,
                'Mobile' => $data2,
                'Whatsapp' => $data3,

            ],
        ]);

        return $ds;
    }

    public function headings(): array
    {
        return [
            'Email' ,
            'Mobile',
            'Whatsapp',
        ];
    }

}
