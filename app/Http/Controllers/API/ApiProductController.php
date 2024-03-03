<?php
namespace App\Http\Controllers\API;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ApiProductController extends Controller
{
    /**
     * Get the list of API of Producto
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function getProductAPI () {

        $productos = Product::orderBy('id', 'asc')->get()->toArray();
        return response()->json($productos);

    }

    public function postProductAPI(Request $request)
    {
        // Verifica si ya existe un producto con el mismo nombre o código
        $checkProductByName = Product::where('name', $request->get('name'))->first();
        $checkProductByCode = Product::where('code', strtoupper($request->get('code')))->first();
    
        if ($checkProductByName) {
            return response()->json([
                'message' => "¡El producto ya existe con este nombre!"
            ], Response::HTTP_CONFLICT); 
        }
    
        if ($checkProductByCode) {
            return response()->json([
                'message' => "¡El código del producto ya existe!"
            ], Response::HTTP_CONFLICT);
        }
    
        // Crea una instancia del producto
        $producto = new Product();
    
        $producto->category_id = $request->get('category_id');
        $producto->name = $request->get('name');
        $producto->code = strtoupper($request->get('code'));
        $producto->cost_price = $request->get('cost_price');
        $producto->mrp = $request->get('mrp');
        $producto->unit = $request->get('unit');
        $producto->status = 1; 
        $producto->quantity = $request->get('opening_stock'); 
        $producto->opening_stock = $request->get('opening_stock');
    
        // Manejo de la imagen del producto
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName(); 
            $destination_path = public_path('uploads/products');
            $file->move($destination_path, $filename);
            $producto->image = $filename;
        }
    
        // Guarda el producto en la base de datos
        $producto->save();
    
        return response()->json([
            'message' => "¡Producto creado con éxito!",
            'producto' => $producto
        ], Response::HTTP_CREATED);
    }
    

    public function showProductAPI ($producto) {

        $producto = Product::find($producto);

        return response()->json([
         'producto' => $producto
        ],Response::HTTP_CREATED);

    }

    public function updateProductAPI(Request $request, $producto)
    {
        // Busca el producto a actualizar
        $producto = Product::find($producto);
    
        // Si no se encuentra el producto, devuelve un mensaje de error
        if (!$producto) {
            return response()->json([
                'message' => "¡El producto no existe!"
            ], Response::HTTP_NOT_FOUND);
        }
    
        // Actualiza los valores del producto con los datos recibidos
        $producto->category_id = $request->get('category_id');
        $producto->name = $request->get('name');
        $producto->code = strtoupper($request->get('code'));
        $producto->cost_price = $request->get('cost_price');
        $producto->mrp = $request->get('mrp');
        $producto->unit = $request->get('unit');
        $producto->status = 1; 
        $producto->quantity = $request->get('opening_stock'); 
        $producto->opening_stock = $request->get('opening_stock');
    
        // Manejo de la imagen del producto
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName(); 
            $destination_path = public_path('uploads/products');
            $file->move($destination_path, $filename);
            $producto->image = $filename;
        }
    
        // Guarda los cambios en el producto
        $producto->save();
    
        return response()->json([
            'message' => "¡Producto actualizado con éxito!",
            'producto' => $producto
        ], Response::HTTP_OK);
    }
    
    public function deleteProductAPI ($producto) {

        $producto = Product::find($producto);

        if(count($producto->sells) == 0 && count($producto->purchases) == 0){

            $producto->delete();
            return response()->json([
             'message' => "Producto eliminado con éxito",
             'producto' => $producto
            ],Response::HTTP_CREATED);

        } else {

            return response()->json([
            'message' => "Producto esta asociado a compras",
            ],Response::HTTP_CREATED);

        }   


    }

    public function getCategoryProducts ($categoria) {

        $category = Category::find($categoria);
    	$productos = $category->product()->orderBy('name', 'asc')->get();
    	return response()->json($productos);

    }

    public function getFrequent (Request $request) {
        
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();

        $productos = Product::whereHas('sells', function ($query) use ($start, $end) {
        $query->whereBetween('created_at', [$start, $end]);
        })->take(25)->get();

        if (count($productos) == 0) {
            $productos = Product::latest()->take(25)->get();
        }

        return response()->json($productos);
    }

}
