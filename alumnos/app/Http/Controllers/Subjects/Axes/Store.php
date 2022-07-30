<?php

namespace App\Http\Controllers\Subjects\Axes;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Src\Subjects\Application\StoreAxes;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Store extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Subject $subject)
    {
        (new StoreAxes)->handle(
            $this->removeNullValues($request->axis_descriptions),
            $subject
        );

        Alert::success('¡Ejes actualizados!');
        return redirect()->back();
    }

    private function removeNullValues(?array $axisDescriptions)
    {
        return $axisDescriptions ? array_filter($axisDescriptions) : [];
    }
}
