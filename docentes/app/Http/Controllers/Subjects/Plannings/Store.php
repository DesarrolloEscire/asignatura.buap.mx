<?php

namespace App\Http\Controllers\Subjects\Plannings;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class Store extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Subject $subject)
    {
        $planning = Planning::create([
            'subject_id' => $subject->id
        ]);

        $planning
            ->users()
            ->sync([Auth::user()->id => ['type' => 'autor']]);

        $subjectTitle = $planning->subject->title;

        Alert::success('Planeación creada', "para la asignatura de $subjectTitle");
        return redirect()->route('my-plannings.index');
    }
}
