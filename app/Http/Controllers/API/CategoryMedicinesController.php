<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CategoryMedicines;
use Illuminate\Http\Request;

class CategoryMedicinesController extends Controller
{
    public function index()
    {
        $categoryMedicines = CategoryMedicines::all();
        echo $categoryMedicines;
    }

    public function store(Request $request)
    {
        $categoryMedicines = new CategoryMedicines();
        $categoryMedicines->parent_id = $request->input('parent_id');
        $categoryMedicines->category_name = $request->input('category_name');
        $categoryMedicines->content = $request->input('content');
        $categoryMedicines->image = $request->file('image')->store("categoryMedicines");
        $categoryMedicines->save();

        return response()->json([
            'status' => 200,
            'message' => 'Add Success',
        ]);
    }

    public function delete($id)
    {
        $result = CategoryMedicines::where("id", $id)->delete();
        if ($result) {
            return ["result" => "Bạn đã xóa thành công sản phẩm"];
        } else {
            return ["result" => "Bạn đã xóa sản phẩm thất bại"];
        }
    }

    public function updateCategory($id, Request $request)
    {
        $categoryMedicines = CategoryMedicines::find($id);
        $categoryMedicines->parent_id = $request->input('parent_id');
        $categoryMedicines->category_name = $request->input('category_name');
        $categoryMedicines->content = $request->input('content');
        if ($request->file('image')) {
            $categoryMedicines->image = $request->file('image')->store('categoryMedicines');
        }
        $categoryMedicines->save();
        return $categoryMedicines;
    }

    public function getCategory($id)
    {
        return CategoryMedicines::where("id", $id)->first();
    }
}
