<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class PizzaController extends Controller
{


    public function storePizza(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'price_small' => 'required|numeric',
            'price_medium' => 'required|numeric',
            'price_large' => 'required|numeric',
            'image' => 'string',
        ]);


        try {

            $image = '';
            if ($request->has('image') && !empty($request->image)) {
                $image = $request->image;
            }

            $pizzaData = Pizza::create([
                'name' => $request->name,
                'price_small' => $request->price_small,
                'price_medium' => $request->price_medium,
                'price_large' => $request->price_large,
                'image' => $image,
            ]);
            return [
                "status" => Controller::STATUS_OK,
                "message" => "The pizza created successfully",
                "data" => $pizzaData
            ];

        } catch (\Exception $e) {

            return [
                "status" => Controller::STATUS_NOT_FOUND,
                "message" => "There was a problem creating the pizza",
            ];
        }

    }

    public function getPizzas(Request $request)
    {

        try {
            $pizzaData = Pizza::all();
            return response()->json(['status' => Controller::STATUS_OK, 'message' => 'Pizzas retrieved successfully', 'data'=>$pizzaData]);


        } catch (\Exception $e) {

            return response()->json(['status' => Controller::STATUS_NOT_FOUND, 'message' => 'There was an error getting the pizzas']);

        }


    }
}