<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id, $r_type = 'tumu'){
//        return "Product Id: .$id, Type:: $r_type";
//      1-Yol  return view('product', ['id' => $id, 'name'=>'Product 1', 'r_type' => $r_type]);
            //2.Yol
        $name = 'Product 1';
        $categories = ['Categori 1', 'Categori 2', 'Categori 3'];
         return view('product', compact('id', 'name', 'r_type','categories'));
       // 3-Yol return view('product')-> with('id', $id)->with( 'name',$name)->with('r_type',$r_type);
    }
}
