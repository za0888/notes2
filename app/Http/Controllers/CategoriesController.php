<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny',Category::class);
    }

    public function create()
    {
        $this->authorize('create',Category::class);
    }

    public function store(Request $request)
    {
        $this->authorize('create',Category::class);
    }


    public function show(Category $category)
    {
        $this->authorize('view',$category);

    }

    public function edit(Category $category)
    {
        $this->authorize('update',Category::class);
    }

    public function update(Request $request, Category $category)
    {
        $this->authorize('update',Category::class);
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete',Category::class);
    }
}
