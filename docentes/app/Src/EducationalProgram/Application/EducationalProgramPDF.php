<?php

namespace App\Src\EducationalProgram\Application;

use App\Models\Subject;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDF;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

/**
 * Programa de Asignatura to PDF File
 *
 */
class EducationalProgramPDF
{
    public $academicUnit;
    public $subject;
    public $areaName;
    public $collaborators;
    public $synopsisList;
    public $professionalProfile;

    public function __construct(Subject $subject)
    {
        $this->academicUnit = $subject->academicUnits()->exists() ? $subject->academicUnits()->first()->name : 'Formación general universitaria';
        $this->subject = $subject;
        $this->areaName = $subject->areas()->exists() ? $subject->areas()->first()->name : null;
        $this->collaborators = $subject->collaborators;
        $this->synopsisList = !$subject->synopsis()->exists() ? 'No registrado' : $this->getSynopsis($subject->synopsis()->get());
        $this->professionalProfile = !$subject->professionalProfiles()->exists() ? NULL : $subject->professionalProfiles()->first();
    }

    private function getSynopsis($synopsis): String
    {
        $synopsisList = "";
        $synopsisLength = sizeof($synopsis) - 1;
        foreach ($synopsis as $index => $synopsisItem) {
            $synopsisList .= ($synopsisItem->description . (($index < $synopsisLength) ? ', ' : NULL));
        }

        return $synopsisList;
    }

    /**
     * The view file which contains the html to convert as a PDF
     *
     * @return string
     */
    public function view(): string
    {
        return 'pdfs.didactic-plannings.educational-program';
    }

    /**
     * Builds the PDF
     *
     */
    public function build(): DomPDF
    {
        return Pdf::loadView(
            $this->view(),
            [
                'academicUnit' => $this->academicUnit,
                'subject' => $this->subject,
                'areaName' => $this->areaName,
                'collaborators' => $this->collaborators,
                'synopsisList' => $this->synopsisList,
                'professionalProfile' => $this->professionalProfile
            ]
        );
    }

    /**
     * Download the PDF in the user computer
     *
     */
    public function stream(): Response
    {
        return $this->build()->stream(
            $this->filename()
        );
    }

    public function output()
    {
        return $this->build()->output();
    }

    public function store()
    {
        $subjectId = $this->subject->id;
        $folder = "subject_programs/$subjectId";
        Storage::makeDirectory($folder);
        $filename = date("Y-m-d-H-m-s");
        $path = "$folder/$filename";

        Storage::put(
            $path,
            $this->output(),
        );

        $this->subject->subjectPrograms()->create([
            'path' => $path
        ]);
    }

    /**
     * filename which will be named the downloaded file
     *
     */
    public function filename(): string
    {
        return 'programa-asignatura.pdf';
    }
}
