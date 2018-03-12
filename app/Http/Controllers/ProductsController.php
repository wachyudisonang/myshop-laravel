<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductCategory;

class ProductsController extends Controller
{

    public function index()
	{
	    return Product::all();
	}

    public function indexCategory()
	{
	    return ProductCategory::all();
	}

	public function show(Product $product)
	{
	    return $product;
	}

	public function store(Request $request)
    {
		// $this->validate($request, [
		// 	'Name' => 'required|max:255',
		// 	'Variant' => 'required|max:255',
		// 	'PackSize' => 'required|integer',
		// 	'Key' => 'required',
		// 	'CategoryID' => 'required|integer',
		// 	'UnitID' => 'required|integer',
		// ]);
	    $product = Product::create($request->json()->all());
	    // $category = Category::create($request->input['CategoryID']);

	    return response()->json($product, 201);
	}

	public function update(Request $request, Product $product)
	{
	    $product->update($request->all());

	    return response()->json($product, 200);
	}

	public function delete(Product $product)
	{
	    $product->delete();

	    return response()->json(null, 204);
	}

}