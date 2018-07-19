<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Product;
use App\Purchase;
use App\ProductCategory;
use App\Bank;
use App\Unit;
use App\Store;
use App\Payment;
use App\PaymentType;
use Illuminate\Support\Facades\Schema;

class ProductsController extends Controller
{

    public function index()
	{
	    return Product::all();
	}
	
	public function showAll()
	{
		// https://laravel.com/docs/5.6/queries#joins
        $purchases = DB::table('purchases')
        ->leftJoin('products', 'product_id', '=', 'products.id')
        ->leftJoin('product_categories', 'category_id', '=', 'product_categories.id')
        ->leftJoin('units', 'unit_id', '=', 'units.id')
        ->leftJoin('payments', 'payment_id', '=', 'payments.id')
        ->leftJoin('stores', 'store_id', '=', 'stores.id')
        ->leftJoin('payment_types', 'type_id', '=', 'payment_types.id')
        ->leftJoin('banks', 'bank_id', '=', 'banks.id')
        ->select('purchases.id', 'product_categories.name as category', 'products.name as name', 'products.pack_size', 'units.name as unit', 
			'unit_price', 'qty', 'stores.name as store', 'date', 'payment_id', 'payment_types.name as payment_type', 'banks.name as bank', 'instalment')
		// ->whereNotNull('payment_id')
		->orderBy('date', 'desc')
		->get();
		// ->toSql();

        return response()->json($purchases, 200);
	}

	public function lastPurchased()
	{
		// https://laravel.com/docs/5.6/queries#joins
        $purchases = DB::table('purchases')
        ->leftJoin('products', 'product_id', '=', 'products.id')
        ->leftJoin('product_categories', 'category_id', '=', 'product_categories.id')
        ->leftJoin('units', 'unit_id', '=', 'units.id')
        ->leftJoin('payments', 'payment_id', '=', 'payments.id')
        ->leftJoin('stores', 'store_id', '=', 'stores.id')
        ->leftJoin('payment_types', 'type_id', '=', 'payment_types.id')
        ->leftJoin('banks', 'bank_id', '=', 'banks.id')
        ->select('purchases.id', 'product_categories.name as category', 'products.name as name', 'products.pack_size', 'units.name as unit', 
			'unit_price', 'qty', 'stores.name as store', 'date', 'payment_id', 'payment_types.name as payment_type', 'banks.name as bank', 'instalment')
		->whereNotNull('payment_id')
		->orderBy('date', 'desc')
		->paginate(2);

        return response()->json($purchases, 200);
	}

	public function carts()
	{
		// https://laravel.com/docs/5.6/queries#joins
        $purchases = DB::table('purchases')
        ->leftJoin('products', 'product_id', '=', 'products.id')
        ->leftJoin('product_categories', 'category_id', '=', 'product_categories.id')
        ->leftJoin('units', 'unit_id', '=', 'units.id')
        ->leftJoin('payments', 'payment_id', '=', 'payments.id')
        ->select('purchases.id', 'product_categories.name as category', 'products.name as name', 'products.pack_size', 'units.name as unit', 
			'unit_price', 'qty', 'payment_id')
		->whereNull('payment_id')
		->orderBy('name', 'desc')
		->get();

        return response()->json($purchases, 200);
	}

	public function purchasesHistory(Request $request, $key)
	{
		// https://laravel.com/docs/5.6/queries#joins
        $purchases = DB::table('purchases')
        ->leftJoin('products', 'product_id', '=', 'products.id')
        ->leftJoin('product_categories', 'category_id', '=', 'product_categories.id')
        ->leftJoin('units', 'unit_id', '=', 'units.id')
        ->leftJoin('payments', 'payment_id', '=', 'payments.id')
        ->leftJoin('stores', 'store_id', '=', 'stores.id')
        ->leftJoin('payment_types', 'type_id', '=', 'payment_types.id')
        ->leftJoin('banks', 'bank_id', '=', 'banks.id')
        ->select('purchases.id', 'product_categories.name as category', 'products.name as name', 'products.pack_size', 'units.name as unit', 
			'unit_price', 'qty', 'stores.name as store', 'date', 'payment_id', 'payment_types.name as payment_type', 'banks.name as bank', 'instalment')
		->where('products.id', '=', $key)
		->whereNotNull('payment_id')
		->orderBy('date', 'desc')
		->get();

        return response()->json($purchases, 200);
	}

	public function listProduct(Request $request, $key)
	{
		// https://laravel.com/docs/5.6/queries#joins
        $products = DB::table('products')
        ->where('name', 'like', '%'.$key.'%')
		->get();

        return response()->json($products, 200);
	}

	public function filter(Request $request, $entity, $id)
	{
		$route = $request->route();
		$tableName = with(new ProductCategory)->getTable();
		// dd(Schema::getColumnListing('product_categories'));
		// dd($route->entity);
		
		$entity = '';
		switch ($route->entity) {
			case "category":
				$entity = with(new ProductCategory)->getTable();
				break;
			case "product":
				$entity = with(new Product)->getTable();
				break;
			case "store":
				$entity = with(new Store)->getTable();
				break;
			case "payment":
				$entity = with(new Payment)->getTable();
		}
		// dd($entity);
		
		// https://laravel.com/docs/5.6/queries#joins
        $purchases = DB::table('purchases')
        ->leftJoin('products', 'purchases.id', '=', 'products.id')
        ->leftJoin('product_categories', 'category_id', '=', 'product_categories.id')
        // ->leftJoin('unit', 'Unit', '=', 'unit_id')
        ->leftJoin('payments', 'payment_id', '=', 'payments.id')
        ->leftJoin('stores', 'store_id', '=', 'stores.id')
        // ->leftJoin('paymenttype', 'payments.PaymentType', '=', 'paymenttype.ID')
        // ->leftJoin('bank', 'Bank', '=', 'bank.ID')
        ->select('purchases.id', 'product_categories.name as category', 'products.name as name',
			'unit_price', 'qty', 'stores.name as store', 'date', 'product_categories.id as category_id', 'products.id as product_id', 'stores.id as store_id', 'payment_id')
		->where($entity.'.id', '=', $id)
        ->get();
        // ->toSql();

		// dd($purchases);
        return response()->json($purchases, 200);
	}

    public function listCategories()
	{
	    return ProductCategory::all();
	}

	public function listUnits()
	{
		return Unit::all();
	}

	public function paymentOptions()
	{
		$bank = Bank::all();
		$ptype = PaymentType::all();
		$store = Store::all();

		$allData = array_merge(
					['banks' => $bank->toArray()], 
					['payment_types' => $ptype->toArray()],
					['stores' => $store->toArray()]
				);

		return response()->json($allData, 200);
	}

	public function productOptions()
	{
		$unit = Unit::all();
		$cat = ProductCategory::all();

		$allData = array_merge(['units' => $unit->toArray()], ['product_categories' => $cat->toArray()]);

		return response()->json($allData, 200);
	}

	public function show(Product $product)
	{
	    return $product;
	}

	public function init(Request $request)
    {
		$input = $request->json()->all();
		// dd($input['name']);
		// $this->validate($request, [
		// 	'Name' => 'required|max:255',
		// 	'Variant' => 'required|max:255',
		// 	'PackSize' => 'required|integer',
		// 	'Key' => 'required',
		// 	'CategoryID' => 'required|integer',
		// 	'UnitID' => 'required|integer',
		// ]);
		
		$sad = ProductCategory::create(['name' => $input['category_id']]);
		$lalala = DB::table('product_categories')
        ->where('name', '=', $input['category_id'])
		->first();

	    $product = Product::create([
			'name' => $input['name'],
			'pack_size' => $input['pack_size'],
			'category_id' => $lalala->id,
			'unit_id' => $input['unit_id'],
		]);

	    return response()->json($product, 201);
	}
	
	public function store(Request $request)
    {
		// $this->validate($request, [
		// 	'Name' => 'required|max:255',
		// 	'Variant' => 'required|max:255',
		// 	'PackSize' => 'required|integer',
		// 	'name' => 'required',
		// 	'CategoryID' => 'required|integer',
		// 	'UnitID' => 'required|integer',
		// ]);
	    // $product = Product::create($request->json()->all());
		
		$input = $request->json()->all();
		
		$catID = empty($input['category_id']) ? NULL : $input['category_id'];
		if (!empty($input['category_id']) && !is_numeric($input['category_id'])) {
			ProductCategory::create(['name' => $input['category_id']]);
			$lalala = DB::table('product_categories')
			->where('name', '=', $input['category_id'])
			->first();
			$catID = $lalala->id;
		}
		
		$unitID = empty($input['unit_id']) ? NULL : $input['unit_id'];
		// if (!empty($input['unit_id']) && !is_numeric($input['unit_id'])) {
		// 	Unit::create(['name' => $input['unit_id']]);
		// 	$lalalay = DB::table('units')
		// 	->where('name', '=', $input['unit_id'])
		// 	->first();
		// 	$unitID = $lalalay->id;
		// }

	    $product = Product::create([
			'name' => $input['name'],
			'pack_size' => $input['pack_size'],
			'category_id' => $catID,
			'unit_id' => $unitID,
		]);

	    return response()->json($product, 201);
	}

	public function storepurchase(Request $request)
    {
	    $product = Purchase::create($request->json()->all());

	    return response()->json($product, 201);
	}

	public function storepayment(Request $request)
    {
		$input = $request->json()->all();
		
		$storeID = empty($input['store_id']) ? NULL : $input['store_id'];
		if (!empty($input['store_id']) && !is_numeric($input['store_id'])) {
			$sad = Store::create(['name' => $input['store_id']]);
			$lalala = DB::table('stores')
			->where('name', '=', $input['store_id'])
			->first();
			$storeID = $lalala->id;
		}
		
		$typeID = empty($input['type_id']) ? NULL : $input['type_id'];
		if (!empty($input['type_id']) && !is_numeric($input['type_id'])) {
			$hg = PaymentType::create(['name' => $input['type_id']]);
			$lll = DB::table('payment_types')
			->where('name', '=', $input['type_id'])
			->first();
			$typeID = $lll->id;
		}
		
		$bankID = empty($input['bank_id']) ? NULL : $input['bank_id'];
		if (!empty($input['bank_id']) && !is_numeric($input['bank_id'])) {
			$hgfds = Bank::create(['name' => $input['bank_id']]);
			$yfgx = DB::table('banks')
			->where('name', '=', $input['bank_id'])
			->first();
			$bankID = $yfgx->id;
		}
		
	    $payment = Payment::create([
			'amount' => $input['amount'],
			'store_id' => $storeID,
			'type_id' => $typeID,
			'bank_id' => $bankID,
			'instalment' => $input['instalment'],
			'trx_code' => uniqid()
			]);
			
		$array = $input['items'];
		Purchase::whereIn('id', $array)->update(['payment_id' => $payment->id]);

	    return response()->json($payment, 201);
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