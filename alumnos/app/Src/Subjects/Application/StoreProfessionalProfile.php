<?php

namespace App\Src\Subjects\Application;

use App\Models\ProfessionalProfile;
use App\Models\Subject;
use Illuminate\Http\Request;

class StoreProfessionalProfile
{

    public function hanlde(Subject $subject, Request $request)
    {
        $professionalProfile = $subject->professionalProfiles()->first();

        if ($professionalProfile) {
            $professionalProfile->update([
                'academic_level' => $request->professional_profile_academic_level,
                'teaching_experience' => $request->professional_profile_teaching_experience,
                'professional_experience' => $request->professional_profile_professional_experience,
            ]);
            return;
        }

        $professionalProfile = ProfessionalProfile::create([
            'academic_level' => $request->professional_profile_academic_level,
            'teaching_experience' => $request->professional_profile_teaching_experience,
            'professional_experience' => $request->professional_profile_professional_experience,
        ]);

        $subject->professionalProfiles()->attach([$professionalProfile->id]);
    }
}
