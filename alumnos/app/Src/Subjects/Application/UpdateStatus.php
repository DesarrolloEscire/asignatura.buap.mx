<?php

namespace App\Src\Subjects\Application;

use App\Mail\RequestSubjectModificationMail;
use App\Models\Subject;
use App\Models\Synopsis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UpdateStatus
{

    public function handle(Subject $subject, Request $request)
    {

        $subject->update([
            'type' => $request->subject_type
        ]);

        if ($subject->is_creation) {
            $subject->reviewers()->detach();
        }

        if (!$subject->is_update) {
            $subject->synopsis()->detach();
        }

        $message = $request->input('message');

        if ($message) {
            $adminsitratorEmails = User::administrators()->get()->pluck('email')->flatten()->toArray();

            Mail::to(
                $adminsitratorEmails
            )->send(
                new RequestSubjectModificationMail($subject, $message)
            );
        }

        $newSynopys = collect($request->synopsis_descriptions)
            ->map(function ($synopsisDescription) {
                return Synopsis::firstOrCreate([
                    'description' => $synopsisDescription
                ]);
            });

        $subject
            ->synopsis()
            ->sync($newSynopys->pluck('id'));
    }
}
