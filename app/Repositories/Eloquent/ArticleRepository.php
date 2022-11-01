<?php

namespace App\Repositories\Eloquent;

use Symfony\Component\HttpFoundation\Request;
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

    public function index(Request $request) {
        $data = $this->model;
        if ($request->has('title') && $request->title != '') {
            $data = $data->where('title', 'LIKE', '%'.$request->title.'%');
        }
        if ($request->has('article_creator') && $request->article_creator != '') {
            $data = $data->where('article_creator', 'LIKE', '%'.$request->article_creator.'%');
        }
        if ($request->has('order_by') && in_array($request->order_by, [
            'title', 'article_creator'
        ])) {
            $data = $data->orderBy($request->order_by, $request->has('ascending') && $request->ascending == 0 ? 'DESC' : 'ASC');
        } else {
            $data = $data->orderBy('created_at', 'ASC');
        }
        return $data->paginate($request->has('limit') && $request->limit < 50 ? $request->limit : 10);
    }

    public function find(String $id) {
        return $this->model->findOrFail($id);
    }

    public function create(Request $request)  {
        return $this->model->create([
            'title' => $request->title,
            'content' => $request->content,
            'article_image' => $request->file('article_image')->store('uploads/article_images'),
            'article_creator' => $request->article_creator,
        ]);
    }

    public function update(String $id, Request $request)  {
        $data = $this->find($id);
        $article_image = $data->article_image;
        // if ($request->hasFile('article_image')) {}
        //  ? $request->file('article_image')->store('uploads/article_images') : $data->article_image
        return $this->model->create([
            'title' => $request->title,
            'content' => $request->content,
            'article_image' => $article_image,
            'article_creator' => $request->article_creator,
        ]);}

    public function delete(String $id) {
        $data = $this->find($id);
        Storage::delete($data->article_image);
        $data->delete();
    }
}