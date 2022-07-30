<?php

namespace App\Http\Controllers\Plannings;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Delete extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Planning $planning)
    {
        $planning->delete();

        Alert::success('Planeación eliminada');
        return redirect()->back();
    }
}
