<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class OrderController extends Controller
{

    public function getUserOrders($id)
    {
        try {
            $orders = DB::table('orders')
                ->where('user_id', $id)
                ->leftJoin('pizzas', 'pizzas.id', '=', 'orders.pizza_id')
                ->select('orders.*', 'pizzas.name as pizza_name')
                ->get();
            return response()->json(['status' => Controller::STATUS_OK, 'message' => 'Pizzas retrieved successfully', 'data' => $orders]);

        } catch (\Exception $e) {
            return response()->json(['status' => Controller::STATUS_NOT_FOUND, 'message' => 'There was an error getting the orders']);

        }
    }

    public function storeOrders(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.pizza_id' => 'required|integer',
            'orders.*.user_id' => 'required|integer',
            'orders.*.size' => 'required|numeric',
            'orders.*.quantity' => 'required|numeric',
            'orders.*.price' => 'required|numeric',
            'orders.*.address' => 'required|string',
            'orders.*.phone_number' => 'required|string',
        ]);


        try {

            $createdOrders = Order::insert($request->orders);
            if($createdOrders){
                return [
                    "status" => Controller::STATUS_OK,
                    "message" => "The order created successfully",
                ];
            }
            return [
                "status" => Controller::STATUS_NOT_FOUND,
                "message" => "There was a problem storing order",
            ];

        } catch (\Exception $e) {

            return [
                "status" => Controller::STATUS_NOT_FOUND,
                "message" => "There was a problem creating the pizza",
            ];
        }

    }

}