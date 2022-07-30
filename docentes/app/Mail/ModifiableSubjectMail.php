<?php

namespace App\Mail;

use App\Models\Subject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ModifiableSubjectMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectModel;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Subject $subject)
    {
        $this->subjectModel = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->markdown('mails.subjects.modifiable')
            ->subject("Una asignatura requiere modificaciones");
    }
}
