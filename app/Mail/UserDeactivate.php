<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserDeactivate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }




    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from(['address' => 'followup@cat-sw.com', 'name' => 'CAT Follow Up APP'])
            ->subject('Your account on CAT Follow Up APP has been deactivated')
            ->view('mail.deactive')
            ->with([
                'userName' => $this->user->name
            ]);

    }
}
