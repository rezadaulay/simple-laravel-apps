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
                        <div style="width: 100%; text-align:right">
                            <a class="underline" href="{{route('articles.edit', ['article' => $article->id])}}">Edit Article</a>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="title" :value="__('Title')" />
                            <p>{{$article->title}}</p>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="content" :value="__('Content')" />
                            <p>{!! nl2br($article->content) !!}</p>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="article_image" :value="__('Article Image')" />
                            <img src="{{$article->article_image_url}}" style="max-width: 200px;" alt="">
                        </div>
                        <div class="mt-4">
                            <x-input-label for="article_creator" :value="__('Creator Name')" />
                            <p>{{$article->article_creator}}</p>
                        </div>
                        <form method="POST" enctype="multipart/form-data" action="{{ route('articles.destroy', ['article' => $article->id]) }}" onsubmit="return confirm('Do you really want to delete this article?');">
                            @csrf
                            @method('DELETE')
    
                            <div class="flex items-center mt-4">
                                <x-primary-button>
                                    Delete
                                </x-primary-button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
