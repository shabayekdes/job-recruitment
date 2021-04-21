<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TermCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $term;
    public $post;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($term, $post)
    {
        $this->term = $term;
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.terms', [
            'term' => $this->term,
            'id' => $this->post->ID,
        ]);
    }
}
