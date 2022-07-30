<?php

namespace App\Http\Controllers\Plannings;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Publish extends Controller
{
    public function __invoke(Planning $planning)
    {
        $planning->publish();

        Alert::success('La planeación ha sido publicada');

        return redirect()->route('subjects.plannings.index',[$planning->subject]);
    }
}
