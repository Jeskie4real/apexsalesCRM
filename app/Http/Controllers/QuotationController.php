<?php

namespace App\Http\Controllers;


use App\Models\Quote;
use App\Models\QuoteItem;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice;

class QuotationController extends Controller
{
    public function __invoke(Request $request, Quote $quote)
    {
        $quote->load(['quoteItems.item', 'deal','deal.contact']);

        $customer = new Buyer([
            'name' => $quote->deal->contact->first_name . ' ' . $quote->deal->contact->last_name,
            'custom_fields' => [
                'email' => $quote->deal->contact->email,
            ],
        ]);

        $items = [];

//        foreach ($quote->quoteItems as $item) {
//            $items[] = (new QuoteItem())
////                ->name($item->item->name)
//                ->price($item->price)
////                ->subTotal($item->price * $item->quantity)
//                ->quantity($item->quantity);
//        }
//
//        $invoice = Invoice::make()
//            ->sequence($quote->id)
//            ->buyer($customer)
//            ->taxRate($quote->taxes)
//            ->totalAmount($quote->total)
//            ->addItems($items);
//
//        if ($request->has('preview')) {
//            return $invoice->stream();
//        }

        return $invoice->download();
    }
}
