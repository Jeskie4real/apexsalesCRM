<x-mail::message>
    Auto generated Invoice from {{ config('app.name') }}
    Invoice #: {{$nvoice->invoice_number}}
    Total Amount: {{$nvoice->total}}

</x-mail::message>
