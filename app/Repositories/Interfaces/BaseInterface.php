<?php

namespace App\Repositories\Interfaces;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Request;

interface BaseInterface
{
    public function index(Request $request);

    public function find(String $id);

    public function create(Request $request);

    public function update(String $id, Request $request);

    public function delete(String $id);  
}