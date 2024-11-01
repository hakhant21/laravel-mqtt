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
    <body class="min-h-screen">
        <div class="mb-5 px-4">
            <div class="max-w-7xl mx-auto mt-3">
                <div class="mt-2 px-4">
                    <form action="{{ route('publish') }}" method="POST">
                        @csrf
                        <div class="my-2">
                            <label for="topic">Topic</label>
                            <input type="text" name='topic' placeholder="detpos/device/preset/1" class="border-2 border-black w-full py-2 rounded-lg">
                        </div>
                        <div class="my-2">
                            <label for="message">Message</label>
                            <input type="text" name='message' placeholder="01P0010000" class="border-2 border-black w-full py-2 rounded-lg">
                        </div>
                        <div class="flex justify-end items-center mt-2">
                            <x-primary-button type='submit'>
                                {{ __('Send') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto">
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

                <div class="px-2 py-2 mt-1">
                    {{ $sales->links() }}
                </div>
            </div>
        </div>
    </body>
</html>
