<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicines;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\all;

class MedicinesController extends Controller
{
    public function index()
    {
        $medicines = DB::table('medicines')->get();
        echo $medicines;
    }

    public function store(Request $request)
    {
        $medicines = new Medicines();
        $medicines->name = $request->input('name');
        $medicines->category_id = $request->input('category_id');
        $medicines->title = $request->input('title');
        $medicines->discount = $request->input('discount');
        $medicines->price = $request->input('price');
        $medicines->amount = $request->input('amount');
        $medicines->content = $request->input('content');
        $medicines->image = $request->file('image')->store("medicines");
        $medicines->save();

        return response()->json([
            'status' => 200,
            'message' => 'Add Success',
        ]);
    }

    public function delete($id)
    {
        $result = Medicines::where("id", $id)->delete();
        if ($result) {
            return ["result" => "Bạn đã xóa thành công sản phẩm"];
        } else {
            return ["result" => "Bạn đã xóa sản phẩm thất bại"];
        }
    }

    public function getMedicines($id)
    {
        return Medicines::where("id", $id)->first();
    }

    public function updateMedicines($id, Request $request)
    {
        $medicines = Medicines::where("id", $id)->first();
        $medicines->name = $request->input('name');
        $medicines->category_id = $request->input('category_id');
        $medicines->title = $request->input('title');
        $medicines->discount = $request->input('discount');
        $medicines->price = $request->input('price');
        $medicines->amount = $request->input('amount');
        $medicines->content = $request->input('content');
        if ($request->file('image')) {
            $medicines->image = $request->file('image')->store('medicines');
        }
        $medicines->save();
        return $medicines;
    }

    public function search($key)
    {
        return Medicines::where("name", "like", "%$key%")->get();
    }

    public function similarMedicines($id)
    {
        $medicines = Medicines::find($id);
        $similar = Medicines::where("category_id", $medicines["category_id"])->where("id", "!=", $id)->get();
        return $similar;
    }

    public function Pagination()
    {
        $medicines = Medicines::query()->paginate(8);
        return $medicines;
    }
}
