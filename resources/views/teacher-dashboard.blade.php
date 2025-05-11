<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            Dashboard (ครู)
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-8">
                <p class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-6">
                    👩‍🏫 สวัสดี <strong>{{ Auth::user()->name }}</strong>
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
