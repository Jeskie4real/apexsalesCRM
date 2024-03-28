<?php

namespace App\Services;

use App\Models\Invoice;

class InvoiceService
{
    public static function generateInvoiceNumber(): string
    {
        // Logic to generate invoice number
        $lastInvoice = Invoice::latest()->first();

        if ($lastInvoice) {
            // Increment the last invoice number
            $lastNumber = (int) substr($lastInvoice->invoice_number, 3);
            $newNumber = $lastNumber + 1;
        } else {
            // If no previous invoices, start from 1
            $newNumber = 1;
        }

        $formattedNumber = sprintf('INV%05d', $newNumber);

        return $formattedNumber;
    }
}
