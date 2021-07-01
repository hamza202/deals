<?php

namespace App\Exports;

use App\Models\Advertiser;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CommissionsExport implements FromCollection, WithHeadings
{
    const active = array();


    public function __construct($active)
    {

        $this->active = $active;

    }


    public function collection()
    {
        return collect((object)[$this->active]);
    }

    public function headings(): array
    {
        return [
            'Commissions accept',
            'Commissions Value',
            'Bank name',
            'Name',
            'Phone',
            'Email',
            'Value',
            'Advertising',

        ];
    }

}
