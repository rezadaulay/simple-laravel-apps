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
            
            <div class="flex items-center mt-4">
                <a href="{{route('articles.create')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Add New
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form class="flex items-center" style="max-width: 600px;">
                        <div class="mr-2 ">
                            <x-text-input id="title" placeholder="Search by title" class="block mt-1 w-full" type="text" name="title" :value="request()->title" />
                        </div>
                        <!-- ... -->
                        <div class="ml-2">
                            <x-text-input id="article_creator" placeholder="Search by creator" class="block mt-1 w-full" type="text" name="article_creator" :value="request()->article_creator" />
                        </div>
                        <div class="ml-2 ">
                            <x-primary-button>
                                Search
                            </x-primary-button>
                        </div>
                    </form>
                    <div class="overflow-x-auto relative mt-4">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6 sm:text-left">
                                        Title
                                    </th>
                                    <th scope="col" class="py-3 px-6 sm:text-left">
                                        Creator
                                    </th>
                                    <th scope="col" class="py-3 px-6 sm:text-left">
                                        Created At
                                    </th>
                                    <th scope="col" class="py-3 px-6 sm:text-left">
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($articles->count() > 0)
                                    @foreach ($articles as $article)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="py-4 px-6">
                                                {{$article->title}}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{$article->article_creator}}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{$article->created_at->format('d-m-Y H:i')}}
                                            </td>
                                            <td class="py-4 px-6">
                                                <div class="flex items-center">
                                                    <div class="text-center mr-2">
                                                        <a class="underline" href="{{route('articles.show', ['article' => $article->id])}}">Detail</a>
                                                    </div>
                                                    <div class="text-center ml-2">
                                                        <a class="underline" href="{{route('articles.edit', ['article' => $article->id])}}">Edit</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td colspan="4" class="py-4 px-6 text-center">
                                        no articles 
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="flex items-center mt-4">
                        {{$articles->appends(request()->all())->links()}}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
