<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Articles
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <nav class="rounded-md w-full">
                <ol class="list-reset flex">
                <li><a href="{{route('dashboard')}}" class="text-blue-600 hover:text-blue-700">{{ __('Dashboard') }}</a></li>
                <li><span class="text-gray-500 mx-2">&nbsp;/&nbsp;</span></li>
                <li class="text-gray-500">Articles</li>
                </ol>
            </nav>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
