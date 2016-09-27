<?php

namespace App\Http\Controllers;

use App\Category;
use App\Student;
use App\Resource;
use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
	public function index(Request $request)
	{
		$categories = Category::all()->sortBy('name');

		return view('admin.categories.index', compact('categories'));
	}

	public function edit($id)
	{
		$category = Category::findOrFail($id);

		return view('admin.categories.edit', compact('category'));
	}

	public function store(CategoryRequest $request)
	{
		Category::create($request->all());

		return redirect('/admin/categories');
	}

	public function update($id, CategoryRequest $request)
	{
		$category = Category::findOrFail($id);

		$category->update($request->all());

		return redirect('/admin/categories');
	}

	public function destroy(Category $categories)
	{
		if ($categories->resources()->count() == 0)
		{
			$categories->delete();
		}

		return redirect('/admin/categories');
	}

}
