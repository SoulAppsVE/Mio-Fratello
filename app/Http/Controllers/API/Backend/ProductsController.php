<?php

namespace App\Http\Controllers\API\Backend;

use App\Product;
use App\Category;
use App\Tasa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;


class ProductsController extends Controller
{
    public function getFrequent (Request $request) {
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();

        $products = Product::whereHas('sells', function ($query) use ($start, $end) {
        $query->whereBetween('created_at', [$start, $end]);
        })->take(25)->get();



        if (count($products) == 0) {
            $products = Product::latest()->take(25)->get();
        }

        $tasa = Tasa::all()->last();
        $dolar = $tasa->tasa;
    	return new ProductCollection($products);
        //return response()->json(['dolar' => $dolar, 'products' => $products]);
    }

    public function getCategoryProducts (Category $category, Request $request) {
    	$products = $category->product()->orderBy('name', 'asc')->get();
      $tasa = Tasa::all()->last();
      $dolar = $tasa->tasa;
    	return new ProductCollection($products);
    }
    public function getProductByBarcode (Request $request, $barcode) {
    	$product = Product::where('code', $barcode)->first();
    	$found = $product ? true : false;
    	$data = $found ? new ProductResource($product) : [];
    	return response()->json(['found' => $found, 'product' => $data]);
    }


    public function getProductBySearch (Request $request, $search) {
        $products = Product::orderBy('name', 'asc');

        $products->where(function($q) use($search) {
            $q->where('name', 'LIKE', '%' . $search . '%');
        });

        $found = $products->count() > 0 ? "yes" : "no";

        if($found == "no"){
            $products = Product::orderBy('name', 'asc')->where('code','LIKE', '%' . $search . '%');
        }

        return new ProductCollection($products->get());
    }


}
