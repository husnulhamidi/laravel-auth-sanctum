<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $data = $this->categoryService->getAllCategories();

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string|max:191",
            "description" => "required|string",
        ]);

        return response()->json($this->categoryService->createCategory($data));
    }

    public function show($id){
        return response()->json($this->categoryService->getCategoryByID($id));
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            "name" => "required|string|max:191",
            "description" => "required|string",
        ]);

        return response()->json($this->categoryService->updateCategory($id, $data));
    }

    public function destroy($id){
        return response()->json(['deleted' => $this->categoryService->deleteCategory($id)]);
    }
}
