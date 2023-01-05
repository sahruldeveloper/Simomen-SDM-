<?php

namespace App\Mail\dosen;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailPensiunDosenFromSistem extends Mailable
{
    use Queueable, SerializesModels;
    public $dataDosen;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataDosen)
    {
        $this->dataDosen = $dataDosen;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('petinggi@gmail.com')
            ->view('email.dosen.EmailPensiunDosenFromSistem');
    }
}