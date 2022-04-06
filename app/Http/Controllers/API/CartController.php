<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\Medicines;
use Exception;
use Faker\Provider\Medical;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\all;

session_start();

class CartController extends Controller
{
    public function store(Request $request)
    {

        if ($request->input('user_id') == "") {
            return response()->json([
                'status' => 202,
                'message' => 'Add Success',
            ]);
        }


        $cartmedicines = new Carts();
        try {
            $cartmedicines->user_id = $request->input('user_id');
            $cartmedicines->medicines_id = $request->input('medicines_id');
            $cartmedicines->medicines_qty = $request->input('medicines_qty');
            $medicines = Medicines::find($request->input('medicines_id'));
            $cartmedicines->subtotal = ($medicines['price'] - $medicines['discount']) * $request->input('medicines_qty');
            $cartmedicines->save();
            return response()->json([
                'status' => 205,
                'message' => 'Add Success',
            ]);
        } catch (Exception $ex) {

            $medicines_qty = DB::table('carts')
                ->join('medicines', 'medicines.id', '=', 'carts.medicines_id')
                ->where('user_id', $request->input('user_id'))
                ->where('medicines_id', $request->input('medicines_id'))->select('medicines_qty', 'amount')->first();
            foreach ($medicines_qty as $key => $value) {
                if ($key == "medicines_qty") {
                    $qty = $value;
                }
                if ($key == "amount") {
                    $amount = $value;
                }
            }

            if (($qty + $cartmedicines->medicines_qty) <= $amount) {
                $money = ($qty + $cartmedicines->medicines_qty) * $cartmedicines->subtotal;
                if ($money < 0)
                    $money *= (-1);
                DB::table('carts')
                    ->where('user_id', $request->input('user_id'))
                    ->where('medicines_id', $request->input('medicines_id'))
                    ->update(['medicines_qty' => $qty + $cartmedicines->medicines_qty, 'subtotal' => $money]);
                return response()->json([
                    'status' => 205,
                    'message' => 'Add Success',
                ]);
            }

            $cartmedicines = Carts::where('user_id', $request->input('user_id'))->get();
            return response()->json([
                'status' => 201,
                'message' => 'Add Failure',
            ]);
        }
    }

    public function delete($id)
    {
        $result = Carts::where("medicines_id", $id)->delete();
        if ($result) {
            return ["result" => 200];
        } else {
            return ["result" => 201];
        }
    }

    public function GetCartMedicines($id)
    {
        $cartmedicines = Carts::where('user_id', $id)->join('medicines', 'medicines.id', '=', 'carts.medicines_id')->get();
        return $cartmedicines;
    }
}
