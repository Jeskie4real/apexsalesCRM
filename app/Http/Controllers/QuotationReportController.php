<?php

namespace App\Http\Controllers;


use App\Models\Quote;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Invoice;

class QuotationReportController extends Controller
{
    public function __invoke(Request $request, Quote $quote)
    {
        $quote->load(['quoteItems.item', 'deal','deal.contact','organization']);

        $customer = new Buyer([
            'name' => $quote->deal->contact->first_name . ' ' . $quote->deal->contact->last_name,
            'custom_fields' => [
                'email' => $quote->deal->contact->email,
            ],
        ]);

        $customFields = $quote->deal?->organization?->pluck('name','value') ?? [];
        $seller = new Party([
            'name' => 'MyCRM INC.',
            'address' => 'P.O Box 123-00100 Nairobi',
            'custom_fields' => $customFields,
        ]);

        $items = [];

        foreach ($quote->quoteItems as $quoteItem) {

//            dd($quoteItem->item);
            $items[] = (new InvoiceItem())
                ->title($quoteItem->item->name)
                ->pricePerUnit($quoteItem->item->price)
                ->subTotalPrice($quoteItem->item->price * $quoteItem->quantity)
                ->quantity($quoteItem->quantity);

        }

        $invoice = Invoice::make()
            ->template('quote')
            ->currencyCode('KES')
            ->sequence($quote->id)
            ->buyer($customer)
            ->seller($seller)
            ->taxRate(0)
            ->totalAmount($quote->total)
            ->addItems($items);

        if ($request->has('preview')) {
            return $invoice->stream();
        }

        return $invoice->download();
    }
}
