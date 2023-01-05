<?php

namespace App\Mail\pegawai;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailPangkatPegawaiFromSistem extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $nama_pangkat;
    public $nama_golongan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $nama_pangkat, $nama_golongan)
    {
        $this->data = $data;
        $this->nama_pangkat = $nama_pangkat;
        $this->nama_golongan = $nama_golongan;
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
            ->view('email.pegawai.EmailPangkatPegawaiFromSistem');
    }
}