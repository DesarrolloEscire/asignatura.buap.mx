<?php

namespace App\Mail\Subjects;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Subject;
use App\Models\SubjectObservation;

class ObservationsMail extends Mailable
{
    use Queueable, SerializesModels;

    
    public $subjectInformation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Subject $subjectModel, SubjectObservation $subjectObservationModel)
    {
        $this->subjectInformation = (object)[
            "subjectModel" => $subjectModel,
            "subjectObservationModel" => $subjectObservationModel
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.subjects.observations')
        ->subject('CREABUAP - Observaciones de asignatura');
    }
}
