<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    public function eCommerce(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        // Fetch stock list (all products with quantity)
        $stockList = Product::select('name', 'quantity')->orderBy('name')->get();

        return view("ecommerce.main", [
            'categories'    =>  $categories,
            'products'      =>  $products,
            'stockList'     =>  $stockList,
        ]);
    }
}
