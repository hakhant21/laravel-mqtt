<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
           @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="">
        <div class="container mx-auto">
            <div class="mt-2 px-4">
                <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-4">
                    @foreach ($sales as $sale)
                        <div class="bg-gray-200 rounded-lg p-4 shadow-lg">
                            <div class="flex justify-between items-center">
                                <p>Depenser No:</p>
                                <p>{{ $sale->dep_no }}</p>
                            </div>
                            <div class="flex justify-between items-center">
                               <p>Nozzle No:</p>
                               <p>{{ $sale->nozzle_no }}</p>
                            </div>
                            <div class="flex justify-between items-center">
                                <p>Preset Amount:</p>
                                <p>{{ $sale->preset }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </body>
</html>
