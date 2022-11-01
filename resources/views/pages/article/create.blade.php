<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Article
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <nav class="rounded-md w-full">
                <ol class="list-reset flex">
                <li><a href="{{route('dashboard')}}" class="text-blue-600 hover:text-blue-700">{{ __('Dashboard') }}</a></li>
                <li><span class="text-gray-500 mx-2">&nbsp;/&nbsp;</span></li>
                <li><a href="{{route('articles.index')}}" class="text-blue-600 hover:text-blue-700">Articles</a></li>
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
                    <form method="POST" enctype="multipart/form-data" action="{{ route('articles.store') }}">
                        @csrf
                        @method('POST')

                        <div>
                            <x-input-label for="title" :value="__('Title')" />
            
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
            
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="content" :value="__('Content')" />
                            <ul class="text-sm text-gray-500 space-y-1 mt-2">
                                <li>Min 100 chars.</li>
                            </ul>

                            <textarea  id="content" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="content" required rows="10">{{ old('content') }}</textarea> 
            
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="article_image" :value="__('Creator Image')" />
            
                            <ul class="text-sm text-gray-600 space-y-1 mt-2">
                                <li>Max 1000 kilobytes.</li>
                            </ul>
                            <x-text-input id="article_image" class="block mt-1 w-full" type="file" name="article_image" :value="old('article_image')" required />
            
                            <x-input-error :messages="$errors->get('article_image')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="article_creator" :value="__('Creator Name')" />
            
                            <x-text-input id="article_creator" class="block mt-1 w-full" type="text" name="article_creator" :value="old('article_creator')" required />
            
                            <x-input-error :messages="$errors->get('article_creator')" class="mt-2" />
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
