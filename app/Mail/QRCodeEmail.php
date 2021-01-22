<?php

namespace App\Mail;

require_once base_path().'/phpqrcode/qrlib.php';

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QRCodeEmail extends Mailable
{
    use Queueable, SerializesModels;

    private string $qrCode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $qrCode)
    {
        $this->qrCode = $qrCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $filename = sprintf('tmp_qrcode_%s.png', strval(now()->timestamp));

        \QRcode::png($this->qrCode, $filename, QR_ECLEVEL_H, 8, 2);

        $data = file_get_contents($filename);

        unlink($filename);

        return $this->subject('Brgy. Bagbag Covid Tracker | QR Code')
            ->view('admin.mail.qrcode')
            ->with('qrCode', $data)
            ->attachData($data, 'qr_code.png', [
                'mime' => 'image/png',
            ]);
    }
}
