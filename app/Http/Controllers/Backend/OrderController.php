<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CanceledOrderDataTable;
use App\DataTables\DeliveredOrderDataTable;
use App\DataTables\DroppedOffOrderDataTable;
use App\DataTables\OrderDataTable;
use App\DataTables\OutForDeliveryOrderDataTable;
use App\DataTables\PendingOrderDataTable;
use App\DataTables\ProcessedOrderDataTable;
use App\DataTables\ShippedOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.index');
    }

    /**pending orders view */
    public function pendingOrders(PendingOrderDataTable $dataTable){
        return $dataTable->render('admin.order.pending-order');
    }

    /**pending orders view */
    public function processedOrders(ProcessedOrderDataTable $dataTable){
        return $dataTable->render('admin.order.processed-order');
    }

    /**dropped off orders view */
    public function droppedOffOrders(DroppedOffOrderDataTable $dataTable){
        return $dataTable->render('admin.order.dropped-off-order');
    }

    /**shipped orders view */
    public function shippedOrders(ShippedOrderDataTable $dataTable){
        return $dataTable->render('admin.order.shipped-order');
    }

    /**out for delivery orders view */
    public function outForDeliveryOrders(OutForDeliveryOrderDataTable $dataTable){
        return $dataTable->render('admin.order.out-for-delivery-order');
    }

    /**delivered orders view */
    public function deliveredOrders(DeliveredOrderDataTable $dataTable){
        return $dataTable->render('admin.order.delivered-order');
    }

    /**canceled orders view */
    public function canceledOrders(CanceledOrderDataTable $dataTable){
        return $dataTable->render('admin.order.canceled-order');
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
        $order = Order::findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);

        //delete order products
        $order->orderProducts()->delete();
        //delete transaction
        $order->transaction()->delete();

        $order->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully']);
    }

    public function changeOrderStatus(Request $request){
        $order = Order::findOrFail($request->id);
        $order->order_status = $request->status;
        $order->save();
        return response(['status' => 'success', 'message' => 'Order status updated successfully']);
    }

    public function changePaymentStatus(Request $request){
        $paymentStatus = Order::findOrFail($request->id);
        $paymentStatus->payment_status = $request->status;
        $paymentStatus->save();
        return response(['status' => 'success', 'message' => 'Payment status updated successfully']);
    }
}
