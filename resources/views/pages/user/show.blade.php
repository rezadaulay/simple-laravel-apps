<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Detail
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
                <li class="text-gray-500">Detail</li>
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

                        <div style="width: 100%; text-align:right">
                            <a class="underline" href="{{route('users.edit', ['user' => $user->id])}}">Edit User</a>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <p>{{$user->name}}</p>
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <p>{{$user->email}}</p>
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
