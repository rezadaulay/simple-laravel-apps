<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New User
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <nav class="rounded-md w-full">
                <ol class="list-reset flex">
                <li><a href="{{route('dashboard')}}" class="text-blue-600 hover:text-blue-700">{{ __('Dashboard') }}</a></li>
                <li><span class="text-gray-500 mx-2">&nbsp;/&nbsp;</span></li>
                <li><a href="{{route('users.index')}}" class="text-blue-600 hover:text-blue-700">Users</a></li>
                <li><span class="text-gray-500 mx-2">&nbsp;/&nbsp;</span></li>
                <li class="text-gray-500">Add New</li>
                </ol>
            </nav>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('catch_error'))
                    <div class="text-red-600 mb-4" role="alert">
                        {{ session('catch_error') }}
                    </div>
                    @endif
                    <form method="POST" enctype="multipart/form-data" action="{{ route('users.store') }}">
                        @csrf
                        @method('POST')

                        <div>
                            <x-input-label for="name" :value="__('Name *')" />
            
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email *')" />
            
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password *')" />
                            <ul class="text-sm text-gray-500 space-y-1 mt-2">
                                <li>Min 6 chars.</li>
                            </ul>
            
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" :value="old('password')" required />
            
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="flex items-center mt-4">
                            <x-primary-button>
                                Submit
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
