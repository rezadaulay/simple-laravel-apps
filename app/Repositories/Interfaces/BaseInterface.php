<?php

namespace App\Repositories\Interfaces;
use Illuminate\Foundation\Http\FormRequest;

interface BaseInterface
{
    public function index(FormRequest $request);

    public function find(String $id);

    public function create(FormRequest $request);

    public function update(String $id, FormRequest $request);

    public function delete(String $id);  
}