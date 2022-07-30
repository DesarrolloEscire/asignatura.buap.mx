<?php

namespace App\Http\Controllers\Plannings\Users;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Attach extends Controller
{
    public function __invoke(Request $request, Planning $planning)
    {
        $collaboratorIds = $request->user_ids;

        $authorUserIds = $planning
            ->users()
            ->wherePivot('type', 'autor')
            ->get()
            ->pluck('id')
            ->toArray();

        $planning
            ->users()
            ->syncWithPivotValues($authorUserIds, ['type' => 'autor']);

        $planning
            ->users()
            ->syncWithoutDetaching($collaboratorIds);

        Alert::success('Usuarios actualizados');
        return redirect()->back();
    }
}
