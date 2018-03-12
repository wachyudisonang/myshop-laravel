<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TestProduct;

class TestProductsController extends Controller
{
    public function index()
	{
	    return TestProduct::all();
	}

	public function show(TestProduct $testproduct)
	{
	    return $testproduct;
	}

	public function store(Request $request)
    {
		$this->validate($request, [
        'title' => 'required|unique:products|max:255',
        'description' => 'required',
        'price' => 'integer',
        'availability' => 'boolean',
    ]);
	    $testproduct = TestProduct::create($request->all());

	    return response()->json($testproduct, 201);
	}

	public function update(Request $request, Product $testproduct)
	{
	    $testproduct->update($request->all());

	    return response()->json($testproduct, 200);
	}

	public function delete(TestProduct $testproduct)
	{
	    $testproduct->delete();

	    return response()->json(null, 204);
	}
}
