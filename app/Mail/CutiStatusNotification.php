<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CutiStatusNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $status;
    public $catatan;

    public function __construct($user, $status, $catatan = null)
    {
        $this->user = $user;
        $this->status = $status;
        $this->catatan = $catatan;
    }

    public function build()
    {
        return $this->subject('Status Pengajuan Cuti')
            ->markdown('emails.cuti.status');
    }
}
