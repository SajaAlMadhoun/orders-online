<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Driver;

use Illuminate\Support\Facades\Validator;

class ordersController extends Controller
{


    public function index()
    {
        $orders = Order::with('driver')->get();
        $drivers = Driver::all();
        
        return view('orders', ['orders' => $orders, 'drivers' => $drivers]);
    }



    public function store(Request $request)
    {
        $rules = [
            'item' => ['required'],
            'quantity' => ['required'],
            'driver'=>['required'],
            'type'=>['required'],


        ];
        $clean = $request->validate($rules);


        // $order = new Order();
        // $order->order_date = date('d-m-y');
        // $order->item = $request->input('item');
        // $order->type =  $request->get("type");
        // $order->quantity = $request->input('quantity');
        // $order->driver_id = $request->input('driver');
        // $order->status = $request->input('status');
        // $order->save();

        $order = Order::create([
         'order_date'=>date('y-m-d'),
         'item'=>$request->item,
         'type'=>$request->type,
         'quantity'=>$request->quantity,
         'driver_id'=>$request->driver,
        //  'status'=>$request->status
        ]);

       // dd($order);


        return redirect('/orders');
    }

    public function changeStatus(Request $request){
        try {
            if($request->status == '2') {
                $status = '1';
            } else $status = '2';

            $result = Order::where('id' , $request->order_id)->update(['status' => $status]);
            $order = Order::find($request->order_id);
            if($result) return ['status' => true, 'order' => $order];
            else return ['status' => false ];
        } catch (\Exception $e) {
            return [ 'status' => false,
                'error' => $e->getMessage()
            ];
        }
        
    }



   
}
