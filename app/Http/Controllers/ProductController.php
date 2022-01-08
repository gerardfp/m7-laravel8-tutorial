<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;
use App\Http\Requests\ProductListRequest;

use App\Providers\UploadFileProvider;
use App\Exceptions\UploadFileException;

class ProductController extends Controller
{
    private $product;
    private $uploadService;
    private $error = '';
    public function __construct()
    {
        $this->product = new Product();
    }
    public function save(ProductListRequest $request, UploadFileProvider $UploadFileService)
    {
        $success = false;
        try {
            //Use uploadService (can throw UploadFileException)
            $this->uploadService = $UploadFileService;
            $this->uploadService->uploadFile($request->file('imagen'));

            //Creamos un nuevo producto
            $product = new Product;
            $product->imagen  = $request->imagen->getClientOriginalName();
            $product->name = $request->input('name');
            $product->desc  = $request->input('desc');
            $product->price  = $request->input('price');
            $product->category_id  = $request->input('category');
            //Save new product (can throw QueryException)
            $success = $product->save();
        } catch (UploadFileException $exception) {
            //$this->error = $exception->getMessage();
            $this->error = $exception->customMessage();
        } catch (\Illuminate\Database\QueryException $exception) {
            $this->error = "Error con los datos introducidos: " . $exception->getMessage();
        }
        //Redirigimos a la pagina del formulario de nuevo producto pasandole el resultado de registro
        return redirect()->action([ProductController::class, 'new'], ['success' => $success])->withError($this->error);
    }

    public function search(ProductListRequest $request)
    {
        //This option allow to keep the value in the view Form using:
        //{{old('priceMin')}}
        $request->flash();

        $products = $this->product->query();

        if ($request->filled('priceMin')) {
            $products->priceMin($request->input('priceMin'));
        }

        if ($request->filled('priceMax')) {
            $products->priceMax($request->input('priceMax'));
        }

        if ($request->filled('name')) {
            $products->name($request->input('name'));
        }

        if ($request->filled('category')) {
            $products->category($request->input('category'));
        }

        /**
         * USING JOIN in our table
         */

        //OPTION1: Using JOIN in the model
        $products->joinCategory();

        //OPTION 2: Adding join to the query (same result)
        //$products->leftJoin('categories', 'products.category_id', '=', 'categories.id');;

        //OPTION 3: New query ONLY with the join (without filters)
        //$products = Product::LeftJoin('categories', 'products.category_id', '=', 'categories.id');


        /*
        * API request
        */
        //To work with API, we will return the data as json (no used for now)
        //if ($request->ajax()) return response()->json($list);


        //AS is a result of two tables we have to select the elements to get from the query wuth ['products.*', 'categories.name as category']
        return view('products')->with('productos', $products->get(['products.*', 'categories.name as category']));
    }
    public function list()
    {
        $products = $this->product->query();
        $products->joinCategory();
        return view('products')->with('productos', $products->get(['products.*', 'categories.name as category']));
    }


    public function new()
    {
        $categories = Category::get();
        return view('new_product')->with('categories', $categories);
    }
    public function addToChart(ProductListRequest $request)
    {
        $carrito = $request->session()->get('carrito', []);
        array_push($carrito, $request->input('productname'));
        $request->session()->put('carrito', $carrito);

        //Redirect to page who send the request:
        return redirect(url()->previous());
    }
    public function emptyChart(Request $request)
    {
        $request->session()->forget('carrito');
        return redirect()->route('welcome');
    }
}
