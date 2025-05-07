<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    /**
     * Get all Items
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Item::all(); // Fetch all Items from the database
        return response()->json($customers);
    }
}
