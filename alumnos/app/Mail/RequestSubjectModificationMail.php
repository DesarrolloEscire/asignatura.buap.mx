<?php

namespace App\Mail;

use App\Models\Subject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestSubjectModificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectModel;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Subject $subject, string $message)
    {
        $this->subjectModel = $subject;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.subjects.request-modification')
            ->subject("Solicitud de modificación de asignatura");
    }
}
