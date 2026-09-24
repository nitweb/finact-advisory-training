<?php

namespace App\Mail;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class BookOrderThankYouMail extends Mailable
{
    use SerializesModels;

    public function __construct(public Order $order) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Thank you for your order ' . $this->order->invoice);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.book_order_thank_you',
            with: ['invoiceUrl' => route('frontend.book.invoice.token', $this->order->invoice_token)]
        );
    }

    public function attachments(): array
    {
        try {
            $order = $this->order->loadMissing('items');

            $pdf = Pdf::loadView('frontend.pdf.book_order_invoice', compact('order'))
                ->setPaper('a4', 'portrait')
                ->output();

            return [
                Attachment::fromData(fn () => $pdf, $order->invoice . '.pdf')
                    ->withMime('application/pdf'),
            ];
        } catch (\Throwable $e) {
            // Mail must still go out even if the PDF fails
            Log::error('Invoice PDF attach failed: ' . $e->getMessage());
            return [];
        }
    }
}
