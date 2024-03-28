<?php

namespace App\Services;

use App\Models\Quote;


class QuotationService
{
    public static function generateQuoteReference(): string
    {
        // Logic to generate invoice number
        // For example, you might fetch the last invoice number from the database
        $lastQuote = Quote::latest()->first();

        if ($lastQuote) {
            // Increment the last invoice number
            $lastNumber = (int) substr($lastQuote->reference, 3);
            $newNumber = $lastNumber + 1;
        } else {
            // If no previous invoices, start from 1
            $newNumber = 1;
        }

        // Format the new invoice number (you can adjust the format as needed)
        $formattedNumber = sprintf('QUOT%05d', $newNumber);

        return $formattedNumber;
    }
}
