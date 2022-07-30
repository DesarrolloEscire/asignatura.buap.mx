<?php

namespace App\Exceptions;

use App\Mail\ExceptionOccuredMail;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            $this->sendEmail($e);
        });
    }

    public function sendEmail(Throwable $exception)
    {
        $user = auth()->user();

        $content['message'] = $exception->getMessage();
        $content['file'] = $exception->getFile();
        $content['line'] = $exception->getLine();
        $content['user'] = $user ? "$user->id | $user->name | $user->email" : "N/A";
        $content['trace'] = $exception->getTrace();

        $content['url'] = request()->url();
        $content['body'] = request()->all();
        $content['ip'] = request()->ip();

        Mail::to('cguzman@ibsaweb.com')->send(new ExceptionOccuredMail($content));
    }
}
