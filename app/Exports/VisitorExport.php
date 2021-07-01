<?php
namespace App\Exports;

use App\Models\Advertiser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Sarfraznawaz2005\VisitLog\Facades\VisitLog;

class VisitorExport implements FromCollection, WithHeadings
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



        $data1 = Advertiser::whereBetween('created_at', [$this -> from,$this -> to])
            ->count();
        $data2 = VisitLog::all()->whereBetween('created_at', [$this -> from,$this -> to])->count();

        $ds = collect([
            (object) [
                'Users' => $data1,
                'Visitors' => $data2,

            ],
        ]);

        return $ds;
    }

    public function headings(): array
    {
        return [
            'Users',
            'Visitors',
        ];
    }

}
