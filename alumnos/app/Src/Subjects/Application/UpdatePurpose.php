<?php

namespace App\Src\Subjects\Application;

use App\Models\Subject;
use Illuminate\Http\Request;

class UpdatePurpose
{
    public function handle(Request $request, Subject $subject)
    {
        $subject->update([
            'purpose' => $request->subject_purpose
        ]);
    }
}
