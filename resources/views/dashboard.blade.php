<!-- resources/views/dashboard.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <!-- Button to go to the lingo page -->
    <div class="flex justify-center mt-4">
        <a href="{{ route('lingo.index') }}" class="bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded-lg text-xl">
            Go to Lingo
        </a>
    </div>
</x-app-layout>
