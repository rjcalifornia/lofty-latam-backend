<?php

namespace App\Mail;

use App\Models\Payments;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;
use App\Services\PaymentService;
use Illuminate\Support\Str;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected PaymentService $paymentService;

    public function __construct(protected Payments $payment)
    {
        $this->paymentService = new PaymentService;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address("soporte@loftylatam.com", "Soporte Lofty"),
            subject: 'Recibo de pago de alquiler digital',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $logo = storage_path('img/home.png');
        $img = base64_encode(file_get_contents($logo));
        return new Content(
            view: 'email.digital-receipt',
            with: ['logo' => $img]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {   $pdf = $this->paymentService->sendEmailPDF($this->payment->id);
        $uuid = Str::uuid(4)->toString();
        return [
            Attachment::fromData(fn () =>$pdf, 'recibo_digital_' . $uuid .'.pdf')
            ->withMime('application/pdf')
        ];
    }
}
