<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class SendFeeConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $name;
    protected $path;

    public function __construct(User $user)
    {
        $this->user = $user;
        $invID = DB::table('sections')->where('name', $user['section'])->get()->first()->reference . DB::table('invoices')->where('section', $user['section'])->get()->count();
        $this->name = $user['name'] . ' ' . $user['surname'] . 'Proof of Payment';
        $this->path = 'invoices/' . $user['section'] . '/' . $invID . $user['name'] . $user['surname'] . '.pdf';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome to The Crete Trip experience!')->
        from('noreply@thecretetrip.org', 'The Crete Trip 2018')->
        view('mails.sendFeeConfirmation')->
        with([
            'user' => $this->user,
        ])->
        attach($this->path, [
            'as' => $this->name . '.pdf',
            'mime' => 'application/pdf',
        ]);
    }
}
