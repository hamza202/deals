<?php

namespace App\Exports;

use App\Models\Advertiser;
use App\Models\KnowUs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KnowExport implements FromCollection, WithHeadings
{

    const  from = null;
    const to = null;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function collection()
    {
        $know_us = KnowUs::all();
        $data = [];

        foreach ($know_us as $new) {
            $data_new = Advertiser::where('know_us', $new->id)
                ->whereBetween('created_at', [$this->from, $this->to])
                ->count();
            array_push($data , ['name' => $new -> name , 'count' => $data_new]);
        }

        $ds = collect([array_values($data)]);

        return $ds;
    }

    public function headings(): array
    {
        return [
            'name',
            'count',
        ];
    }

}
