<?php

namespace App\Repositories\Eloquent;

use Symfony\Component\HttpFoundation\Request;
use App\Models\User;
use App\Repositories\Interfaces\BaseInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserRepository implements BaseInterface
{
    protected $model;
    public function __construct()
    {
        $this->model = new User;
    }

    public function index(Request $request) {
        $data = $this->model;
        if ($request->has('name') && $request->name != '') {
            $data = $data->where('name', 'LIKE', '%'.$request->name.'%');
        }
        if ($request->has('email') && $request->email != '') {
            $data = $data->where('email', $request->email);
        }
        if ($request->has('order_by') && in_array($request->order_by, [
            'name', 'email'
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
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    }

    public function update(String $id, Request $request)  {
        $data = $this->find($id);
        $data->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->has('password') ? Hash::make($request->password) : $data->password
        ]);
        return $data;
    }

    public function delete(String $id) {
        $data = $this->find($id);
        $data->delete();
    }
}