<?php

namespace App\Repositories\Eloquent;

use App\Models\Article;
use App\Repositories\Interfaces\BaseInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class ArticleRepository implements BaseInterface
{
    protected $model;
    public function __construct()
    {
        $this->model = new Article;
    }

    public function index(FormRequest $request) {}

    public function find(String $id) {
        return $this->model->findOrFail($id);
    }

    public function create(FormRequest $request)  {
        return $this->model->create([
            'title' => $request->title,
            'content' => $request->content,
            'article_image' => $request->file('article_image')->store('uploads/article_images'),
            'article_creator' => $request->article_creator,
        ]);
    }

    public function update(String $id, FormRequest $request)  {}

    public function delete(String $id) {
        $data = $this->model->findOrFail($id);
        Storage::delete($data->article_image);
        $data->delete();
    }
}