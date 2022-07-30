<?php

namespace App\Http\Controllers\Subjects\Resources;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Src\Shared\Application\StoreResources;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Store extends Controller
{
    public function __invoke(Request $request, Subject $subject)
    {
        (new StoreResources)->handle(
            $this->removeNullValues($request->resource_descriptions),
            $subject
        );

        Alert::success('¡recursos actualizados!');
        return redirect()->back();
    }

    private function removeNullValues(?array $resourceIds)
    {
        return $resourceIds ? array_filter($resourceIds) : [];
    }
}
