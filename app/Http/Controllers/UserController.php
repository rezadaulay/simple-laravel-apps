<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    protected $repository;
    public function __construct()
    {
        $this->repository = new UserRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.user.index',[
            'users' => $this->repository->index($request)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Users\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
		try{
            $data = $this->repository->create($request);
            DB::commit();
            return redirect()->route('users.show', ['user' => $data->id]);
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
        return view('pages.user.show', [
            'user' => $this->repository->find($id)
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
        return view('pages.user.edit', [
            'user' => $this->repository->find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Users\UpdateRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
		try{
            $data = $this->repository->update($id, $request);
            DB::commit();
            return redirect()->route('users.show', ['user' => $data->id]);
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
            return redirect()->route('users.index')->with('success_msg', 'Sukses menghapus data');
        } catch(\Exception $e){
            DB::rollback();
            report($e);
            return redirect()->back()->with('catch_error', 'Proses data gagal, silahkan coba lagi');
        }
    }
}
