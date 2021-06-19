<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\EmailTemplate;

class GenericMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $description;
    public $subject;
    protected $type;
    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($description, $type, $data, $subject)
    {
        $this->subject = $subject;
        $this->type = $type;
        $this->data = $data;
        $this->description = $description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject($this->subject);

        if ($this->type == 'Trifed-Demo') {
            $description = str_replace("__name__", $this->data->first_name, $this->description);
            return $this->view('mail')->with('description', $description);
        }
    }
}
