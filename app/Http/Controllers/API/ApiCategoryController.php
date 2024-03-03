<?php
namespace App\Http\Controllers\API;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class ApiCategoryController extends Controller
{
    /**
     * Get the list of API of Categoría
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function getCategoryAPI () {

        $categorias = Category::orderBy('id', 'asc')->get()->toArray();
        return response()->json($categorias);

    }

    public function postCategoryAPI (Request $request) {

        $categoria = Category::create($request->all());

        return response()->json([
         'message' => "Categoría creada con éxito",
         'categoria' => $categoria
        ],Response::HTTP_CREATED);

    }

    public function showCategoryAPI ($categoria) {

        $categoria = Category::find($categoria);

        return response()->json([
         'categoria' => $categoria
        ],Response::HTTP_CREATED);

    }

    public function updateCategoryAPI (Request $request, $categoria) {

        $categoria = Category::find($categoria);
        
        $categoria->update($request->all());
        return response()->json([
         'message' => "Categoría actualizada con éxito",
         'categoria' => $categoria
        ],Response::HTTP_CREATED);

    }

    public function deleteCategoryAPI ($categoria) {
     
        $categoria = Category::find($categoria);

        if(count($categoria->product) == 0){

            $categoria->delete();
            return response()->json([
            'message' => "Categoría eliminada con éxito",
            'categoria' => $categoria
            ],Response::HTTP_CREATED);

        } else {

            return response()->json([
            'message' => "Categoría tiene productos relacionados"
            ],Response::HTTP_CREATED);

        }   
    }
    
}
