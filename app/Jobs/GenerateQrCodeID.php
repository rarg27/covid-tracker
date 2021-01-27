<?php

namespace App\Jobs;

use App\Mail\QRCodeEmail;
use App\Models\Resident;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;

class GenerateQrCodeID implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Resident $resident;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Resident $resident)
    {
        $this->resident = $resident;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            ob_start();
            $id = $this->resident->id;
            $qrcode = $this->resident->id.'|'.$this->resident->name;
            include base_path('public/res/qrcodeid.php');
            $content = ob_get_clean();

            $outputFolder = storage_path('pdfs');

            if (!is_dir($outputFolder)) {
                mkdir($outputFolder, 0755, true);
            }

            $output = $outputFolder.DIRECTORY_SEPARATOR.uniqid().'.pdf';

            $html2pdf = new Html2Pdf('L', 'A6', 'en');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($content);
            $pdf = $html2pdf->output($output, 'S');

            Mail::to($this->resident->email)->send(new QRCodeEmail($this->resident, $pdf));
        } catch (Html2PdfException $e) {
            $html2pdf->clean();
            \Log::error($e->getMessage());
        }
    }
}
