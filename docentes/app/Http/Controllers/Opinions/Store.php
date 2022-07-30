<?php

namespace App\Http\Controllers\Opinions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Src\Opinions\StoreOpinions;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Opinion;

class store extends Controller
{
    public function __invoke(Request $r){
        $op = new Opinion();
        $op->user_id = $r->user_id;
        $op->message = $r->message;
        (new StoreOpinions)->handle($op);

        Alert::success('¡Opinión enviada!');
        return redirect()->back();
    }
}
