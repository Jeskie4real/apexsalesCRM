<?php

namespace App\Http\Controllers;


use App\Models\Quote;
use App\Models\QuoteItem;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\Seller;
use LaravelDaily\Invoices\Invoice;

class InvoiceReportController extends Controller
{
    public function __invoke(Request $request, $inv)
    {
        $myInvoice = \App\Models\Invoice::find($inv)->load(['invoiceItems','invoiceItems.item', 'quote','contact']);




        $customer = new Buyer([
            'name' => $myInvoice->contact->first_name . ' ' . $myInvoice->contact->last_name,
            'custom_fields' => [
                'email' => $myInvoice->contact->email,
            ],
        ]);

        $seller = new Party([
            'name' => 'MyCRM INC.',
            'address' => 'P.O Box 123-00100 Nairobi',
            'custom_fields' => [
                'email' => 'email@mycrm.crm',
            ],
        ]);

        $items = [];

        foreach ($myInvoice->invoiceItems as $myInvoiceItem) {

//            dd($myInvoiceItem->item);
            $items[] = (new InvoiceItem())
                ->title($myInvoiceItem->item->name)
                ->pricePerUnit($myInvoiceItem->item->price)
                ->subTotalPrice($myInvoiceItem->item->price * $myInvoiceItem->quantity)
                ->quantity($myInvoiceItem->quantity);

        }

        $invoice = Invoice::make()
            ->currencyCode('KES')
            ->sequence($myInvoice->id)
            ->buyer($customer)
            ->seller($seller)
            ->totalAmount($myInvoice->total)
            ->notes('Goods once sold are not refundable.')
            ->addItems($items);

        if ($request->has('preview')) {
            return $invoice->stream();
        }

        return $invoice->download();
    }
}
