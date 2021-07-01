<?php

namespace App\Http\Controllers\BackEnd\Moderator;

use App\Http\Controllers\Controller;
use App\Models\FixedAdvertising;

class FixedAdvertisingController extends Controller
{
    public function index()
    {
        $rows = FixedAdvertising::with('advertising')->where('status', 0)->paginate(10);
        $rows_accepts = FixedAdvertising::with('advertising')->where('status', 1)->paginate(10);
        $rows_refuses = FixedAdvertising::with('advertising')->where('status', 5)->paginate(10);
        return view('back-end.moderator-panel.fixed-advertising', compact('rows', 'rows_accepts', 'rows_refuses'));
    }
}
