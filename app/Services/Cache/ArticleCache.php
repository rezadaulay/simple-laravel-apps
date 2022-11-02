<?php

namespace App\Services\Cache;
 
use Illuminate\Support\Facades\Cache;
use App\Repositories\Eloquent\ArticleRepository;

class ArticleCache
{
    protected $repository;
    public function __construct()
    {
        $this->repository = new ArticleRepository;
    }

    public function list()
    {
        $repository = $this->repository;
        return Cache::tags('articles')->rememberForever('article_listing_page_' . (request()->has('page') ? 1 : request()->page) , function () use ($repository) {
            return $repository->index();
        });        
    }

    public function single($id)
    {
        $repository = $this->repository;
        return Cache::tags('articles')->rememberForever('article_detail_' . $id , function () use ($repository, $id) {
            return $repository->find($id);
        });        
    }
}