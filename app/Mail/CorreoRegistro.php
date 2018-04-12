<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CorreoRegistro extends Mailable
{
    use Queueable, SerializesModels;
    private $username = null;
    private $passwd = null;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $passwd)
    {
        $this->username = $username;
        $this->passwd = $passwd;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.correoregistro')
            ->with('username', $this->username)
            ->with('passwd', $this->passwd)
            ->subject('Creación de cuenta');
    }
}
