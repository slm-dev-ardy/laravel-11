<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link preload href="/image/favicon.ico" rel="icon">
    <link preload href="/image/favicon.ico" rel="apple-touch-icon">


    <title>{{ $title ?? 'Page Title' }}</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body>
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed bottom-4 right-4 z-50 w-full max-w-sm bg-white rounded-lg shadow-lg border-l-4 border-green-500 overflow-hidden">

            <div class="p-4 flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p class="text-sm font-medium text-gray-900">Sukses!</p>
                    <p class="mt-1 text-sm text-gray-500">{{ session('success') }}</p>
                </div>

                <div class="ml-4 flex-shrink-0 flex">
                    <button @click="show = false"
                        class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none">
                        <span class="sr-only">Close</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="h-1 bg-green-500 w-full animate-[shrink_4s_linear_forwards]"
                style="animation: shrink 4s linear forwards;"></div>
        </div>

        <style>
            @keyframes shrink {
                from {
                    width: 100%;
                }

                to {
                    width: 0%;
                }
            }
        </style>
    @endif
    {{ $slot }}
</body>

</html>
