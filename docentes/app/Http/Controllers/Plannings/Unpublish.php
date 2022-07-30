<?php

namespace App\Http\Controllers\Plannings;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Unpublish extends Controller
{
    public function __invoke(Planning $planning)
    {
        $planning->unpublish();

        Alert::success('La planeación ha sido despublicada.');
        return redirect()->back();
    }
}
