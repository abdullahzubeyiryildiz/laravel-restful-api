<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Return_;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        return Product::all();
//        return response()->json(Product::all(),200);
//        return response(Product::all(), 200);
//        return response(Product::paginate(10),200);
//        $offset = $request->offset ? $request->offset : 0;
//        $limit = $request->limit ? $request->limit : 10;
        $offset = $request->has('offset') ? $request->query('offset') : 0;
        $limit = $request->has('limit') ? $request->query('limit') : 10;
        $qb = Product::query();
        if ($request->has('q'))
            $qb->where('name', 'like', '%' . $request->query('q') . '%');
//      return response(Product::offset($offset)->limit($limit)->get(), 200);
        if ($request->has('sortBy'))
            $qb->orderBy($request->query('sortBy'), $request->query('sort', 'DESC'));

        $data = $qb->offset($offset)->limit($limit)->get();
        return response($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//         $input = $request->all();
//         $product = Product::create($input);
        $product = new Product;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price = $request->price;
        $product->save();
        return response([
            "data" => $product,
            "message" => "Product created."
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        Return $product;
//        return  response($product,200);

        $product = Product::find($id);
        if ($product)
            return response($product, 200);
        else
            return response(['message' => 'Product not found!'], 404);
//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

//        $input = $request->all();
//        $product->update($input);


        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price = $request->price;
        $product->save();

        return response([
            "data" => $product,
            "message" => "Product updated."
        ], 200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response([
            'message' => 'Product deleted'
        ], 200);
    }
}
