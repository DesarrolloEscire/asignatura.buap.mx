<?php

namespace App\Http\Controllers\Subjects\Criteria;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Criteria;
use App\Src\Shared\Domain\BusinessException;
use App\Src\Subjects\Application\StoreCriteria;
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

        try {
            (new StoreCriteria)->handle(
                $this->removeNullValues($request->criteria),
                $subject
            );
        } catch (BusinessException $e) {
            Alert::error($e->getMessage());
            return redirect()->back();
        }

        Alert::success('¡Criterios actualizados!');
        return redirect()->back();
    }

    private function removeNullValues(?array $criterionDescriptions): array
    {
        return $criterionDescriptions ? array_filter($criterionDescriptions) : [];
    }
}
