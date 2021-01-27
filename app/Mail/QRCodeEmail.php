<?php

namespace App\Mail;

use App\Models\Resident;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QRCodeEmail extends Mailable
{
    use Queueable, SerializesModels;

    private Resident $resident;

    private string $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Resident $resident, string $pdf)
    {
        $this->resident = $resident;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Brgy. Bagbag Covid Tracker | QR Code')
            ->view('admin.mail.qrcode')
            ->with('resident', $this->resident)
            ->attachData($this->pdf, $this->resident->name.'.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
