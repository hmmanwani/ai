<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectMail;
use App\Mail\WFHRequestMail;

class MailService
{
    protected $sendEmails = true;

    public function sendMail($to, $subject, $view, $data = [], $cc = [])
    {
        if ($this->sendEmails) {
            Mail::send($view, $data, function ($message) use ($to, $subject, $cc) {
                $message->to($to)->subject($subject);

                // Add cc if provided
                if (!empty($cc)) {
                    $message->cc($cc);
                }
            });
        }
    }

    public function enableEmails()
    {
        $this->sendEmails = true;
    }

    public function disableEmails()
    {
        $this->sendEmails = false;
    }
}
