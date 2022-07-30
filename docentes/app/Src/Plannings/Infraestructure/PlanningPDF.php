<?php

namespace App\Src\Plannings\Infraestructure;

use App\Models\Evidence;
use App\Models\Instrument;
use App\Models\Planning;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDF;
use Illuminate\Http\Response;

/**
 * The Didactic planning transformed to PDF File
 * 
 */
class PlanningPDF
{

    public $planning;
    public $subject;
    public $responsibleIds;
    public $collaboratorIds;
    public $genericCompetences;
    public $specificCompetences;
    public $instruments;

    public function __construct(Planning $planning)
    {
        $this->planning = $planning;
        $this->subject = $planning->subject;
        $this->responsibleIds = $planning->users()->wherePivot('type','autor')->get()->implode('identifier', ', ') ?? 'N/A';
        $this->collaboratorIds = $planning->users()->wherePivot('type','colaborador')->get()->implode('identifier', ', ') ?? 'N/A';
        $this->genericCompetences = $planning->subject->competences()->generic()->get();
        $this->specificCompetences = $planning->subject->competences()->specific()->get();
        $this->evidences = Evidence::get();
        $this->instruments = Instrument::get();
    }

    /**
     * The view file which contains the html to convert as a PDF
     * 
     * @return string 
     */
    public function view(): string
    {
        return 'pdfs.plannings';
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
                'planning' => $this->planning,
                'subject' => $this->subject,
                'responsibleIds' => $this->responsibleIds,
                'collaboratorIds' => $this->collaboratorIds,
                'genericCompetences' => $this->genericCompetences,
                'specificCompetences' => $this->specificCompetences,
                'evidences' => $this->evidences,
                'instruments' => $this->instruments
            ]
        );
    }

    /**
     * Download the PDF in the user computer
     * 
     */
    public function download(): Response
    {
        return $this->build()->download(
            $this->filename()
        );
    }

    /**
     * Stream the PDF in the user browser window
     *
     */
    public function stream(): Response
    {
        return $this->build()->stream(
            $this->filename()
        );
    }

    /**
     * filename which will be named the downloaded file
     * 
     */
    public function filename(): string
    {
        return 'planeacion-didactica.pdf';
    }
}
