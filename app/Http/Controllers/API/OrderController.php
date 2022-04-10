<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\Medicines;
use App\Models\Orders;
use App\Models\OrdersDetail;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index($id)
    {
        $cartmedicines = Orders::where('user_id', $id)->get();
        return $cartmedicines;
    }

    public function indexDetail($id)
    {
        $cartmedicines = OrdersDetail::where('order_id', $id)->join('medicines', 'medicines.id', '=', 'orders_details.medicine_id')->get();
        return $cartmedicines;
    }

    public function addOrder(Request $request)
    {
        $order = new Orders();
        $order->date_booking = $request->input('date_booking');
        $order->user_id = $request->input('user_id');
        $order->receiver = $request->input('receiver');
        $order->address_booking = $request->input('address_booking');
        $order->total = $request->input('total');
        $order->save();

        $id = Orders::where('user_id', $request->input('user_id'))->orderBy('id', 'desc')->first()->id;

        $cartmedicines = Carts::where('user_id', $request->input('user_id'))->join('medicines', 'medicines.id', '=', 'carts.medicines_id')->get();

        foreach ($cartmedicines as $item) {
            $orderdetail = new OrdersDetail();
            $orderdetail->medicine_id = $item['medicines_id'];
            $orderdetail->order_id = $id;
            $orderdetail->amount = $item['medicines_qty'];
            $orderdetail->price = $item['price'] - $item['discount'];
            $orderdetail->save();

            $medicines = Medicines::find($item['medicines_id']);
            $medicines->amount -= $item['medicines_qty'];
            $medicines->save();
        }
        Carts::where("user_id", $request->input('user_id'))->delete();
        return response()->json([
            'status' => 202,
            'message' => "Đặt hàng thành công",
        ]);
    }

    public function search($key)
    {
        return Orders::where("id", "like", "%$key%")->get();
    }

    public function all()
    {
        $cartmedicines = Orders::join("users", 'users.id', '=', 'orders.user_id')->get();
        return $cartmedicines;
    }
}
