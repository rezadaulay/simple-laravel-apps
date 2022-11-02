<?php

namespace App\Listeners\Article;

use App\Events\Article\ArticleCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;
use App\Repositories\Eloquent\ArticleRepository;

class HandleCacheWhenCreated implements ShouldQueue
{
    protected $repository;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->repository = new ArticleRepository;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ArticleCreated  $event
     * @return void
     */
    public function handle(ArticleCreated $event)
    {
        $repository = $this->repository;
        Cache::tags('articles')->flush();
        return Cache::tags('articles')->rememberForever('article_detail_' . $event->article->id , function () use ($event, $repository) {
            return $repository->find($event->article->id);
        });
    }
}
