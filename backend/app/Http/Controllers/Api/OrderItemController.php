<?php

namespace App\Http\Controllers\Api;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderItemController extends Controller
{
    /**
     * Get all items
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = OrderItem::all(); // Fetch all items from the database
        return response()->json($items);
    }
}
