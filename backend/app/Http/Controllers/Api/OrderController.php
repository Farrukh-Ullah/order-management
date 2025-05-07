<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Item;  // Ensure you are importing Item model
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
{
    $query = Order::with('customer')->whereHas('customer');

    // Filter by status if provided
    if ($request->has('status') && !empty($request->status)) {
        $query->where('status', $request->status);
    }

    // Filter by customer_id if provided
    if ($request->has('customer_id') && !empty($request->customer_id)) {
        $query->where('customer_id', $request->customer_id);
    }

    // Get the filtered results
    $orders = $query->get();

    return response()->json($orders);
}

    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'status' => 'required|in:pending,processing,completed,cancelled',
            'order_date' => 'required|date',
            'item_ids' => 'required|array',  // Ensure item_ids is an array
            'item_ids.*' => 'exists:items,id',  // Ensure all item_ids exist in the `items` table
        ]);

        // Create the order
        $order = Order::create([
            'customer_id' => $validated['customer_id'],
            'status' => $validated['status'],
            'order_date' => $validated['order_date'],
        ]);

        // Create order items by iterating through the item_ids
        foreach ($validated['item_ids'] as $itemId) {
            // Retrieve the item name from the Item model
            $item = Item::find($itemId);
            
            // Check if the item exists before proceeding
            if ($item) {
                $order->orderItems()->create([
                    'item_id' => $itemId,
                    'product_name' => $item->name,
                    'price' => $item->price,
                    'quantity' => 1,
                ]);
            }
        }

        return response()->json($order, 201);
    }

    // Show order summary with related customer and items
    public function showSummary($id)
    {
        $order = Order::with('customer', 'items')->findOrFail($id); // Assuming you have customer and items relationship

        return response()->json($order);
    }

    // Edit order details (status, customer, etc.)
    public function updateOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Validate the incoming request
        $request->validate([
            'status' => 'required|string|max:255',
            'customer_id' => 'required|exists:customers,id', // Example validation for customer_id
        ]);

        // Update the order with validated data
        $order->update([
            'status' => $request->status,
            'customer_id' => $request->customer_id, // Example of updating customer
        ]);

        return response()->json($order);
    }

}
