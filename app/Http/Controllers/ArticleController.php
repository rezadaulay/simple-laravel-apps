<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Article\StoreRequest;
use App\Http\Requests\Article\UpdateRequest;
use App\Repositories\Eloquent\ArticleRepository;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    protected $repository;
    public function __construct()
    {
        $this->repository = new ArticleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.article.index',[
            'articles' => $this->repository->index($request)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Articles\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
		try{
            $data = $this->repository->create($request);
            DB::commit();
            return redirect()->route('articles.show', ['article' => $data->id]);
        } catch(\Exception $e){
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->with('catch_error', 'Proses data gagal, silahkan coba lagi');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.article.show', [
            'article' => $this->repository->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.article.edit', [
            'article' => $this->repository->find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Articles\UpdateRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        DB::beginTransaction();
		try{
            $data = $this->repository->update($id, $request);
            DB::commit();
            return redirect()->route('articles.show', ['article' => $data->id]);
        } catch(\Exception $e){
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->with('catch_error', 'Proses data gagal, silahkan coba lagi');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
		try{
            $data = $this->repository->delete($id);
            DB::commit();
            return redirect()->route('articles.index')->with('success_msg', 'Sukses menghapus data');
        } catch(\Exception $e){
            DB::rollback();
            report($e);
            return redirect()->back()->with('catch_error', 'Proses data gagal, silahkan coba lagi');
        }
    }
}
