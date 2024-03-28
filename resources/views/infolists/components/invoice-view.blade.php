<iframe src="{{ URL::signedRoute('invoice.pdf', [$record->id, 'preview' => true]) }}" style="min-height: 100svh;"
    class="w-full">
</iframe>
