<?php

namespace App\Http\Controllers\Plannings\Ecaas;

use App\Http\Controllers\Controller;
use App\Models\Ecaa;
use App\Models\Planning;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Store extends Controller
{
    public function __invoke(Planning $planning, Request $request)
    {
        $planning
            ->ecaas()
            ->delete();

        $request
            ->collect('dates')
            ->filter()
            ->map(function ($date) use ($planning) {
                $planning->ecaas()->create([
                    'date'=>$date
                ]);
            });

        Alert::success("fechas actualizadas correctamente");
        return redirect()->back();
    }
}
