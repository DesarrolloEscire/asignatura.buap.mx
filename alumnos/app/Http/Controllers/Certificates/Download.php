<?php

namespace App\Http\Controllers\Certificates;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Download extends Controller
{
    public function __invoke(Certificate $certificate)
    {
        return response()->file( storage_path("app/".$certificate->path, "acta.pdf") );
    }
}
