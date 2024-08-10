<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $list=Order::where('status','!=',0)
        ->orderBy('created_at','DESC')
        ->get();
        
        return view("backend.order.index",compact('list'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::find($id);
        if($order ==  null)
        {
            return redirect()->route('admin.order.index');
        }

        return view("backend.order.show",compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function status (string $id)
    {
        $order = Order::find($id);
        if ($order == null) {
            return redirect()->route('admin.order.index');
        }
        $order->status = ($order->status == 1) ? 2: 1;
        $order->updated_at = date('Y-m-d H:i:s');
        $order->save();
        return redirect()->route('admin.order.index');
    }
    public function delete(string $id)
    {
        $order = Order::find($id);
            if ($order == null) {
                return redirect()->route('admin.order.index');
            }
        $order->status = 0;
        $order->updated_at = date('Y-m-d H:i:s');
        $order->updated_by = Auth::id() ?? 1;
        $order->save();
        return redirect()->route('admin.order.index');
    }
    public function trash()
    {
        $list=Order::where('status','=',0)
        ->orderBy('created_at','DESC')
        ->get();
        return view("backend.order.trash",compact('list'));
    }
    public function destroy (string $id)
    {
        $order = Order::find($id);
        if ($order == null) {
        return redirect()->route('admin.order.index');
        }
        $order->delete();
        return redirect()->route('admin.order.trash');
    }
    public function restore(string $id)
    {
        $order = Order::find($id);
        if ($order == null) {
            return redirect()->route('admin.order.index');
        }
    $order->status = 2;
    $order->updated_at = date('Y-m-d H:i:s');
    $order->updated_by = Auth::id() ?? 1;
    $order->save();
    return redirect()->route('admin.order.index');
    }
}
