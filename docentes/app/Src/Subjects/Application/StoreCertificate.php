<?php

namespace App\Src\Subjects\Application;

use App\Models\Certificate;
use App\Models\Subject;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class StoreCertificate
{
    public function handle(UploadedFile $file = null, string $approvedAt, string $designedAt, string $lastUpdateAt, Subject $subject)
    {
        if (!$file && !$subject->certificates()->exists()) {
            throw new FileNotFoundException();
        }

        $certificate = $subject->certificates()->first();

        if ($file) {
            $path = Storage::putFileAs(
                'certificates',
                $file,
                $subject->id
            );

            $subject->certificates()->delete();

            $certificate = $subject->certificates()->create(['path' => $path]);
        }

        $certificate->update([
            'approved_at' => $approvedAt,
            'designed_at' => $designedAt,
            'last_update_at' => $lastUpdateAt
        ]);
    }
}
