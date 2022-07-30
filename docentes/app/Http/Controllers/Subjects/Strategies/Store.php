<?php

namespace App\Http\Controllers\Subjects\Strategies;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Strategy;
use App\Src\Shared\Application\AttachStrategies;
use App\Src\Subjects\Application\StoreStrategies;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Store extends Controller
{
    public function __invoke(Request $request, Subject $subject)
    {
        (new AttachStrategies)->handle(
            $this->removeNullValues($request->strategy_descriptions),
            $subject
        );

        Alert::success('¡Estrategias actualizadas!');
        return redirect()->back();
    }

    private function removeNullValues(?array $strategyIds)
    {
        return $strategyIds ? array_filter($strategyIds) : [];
    }
}
