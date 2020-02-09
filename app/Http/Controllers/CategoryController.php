<?php

namespace App\Http\Controllers;

use App\Category;


class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        // $this->middleware('age',['except'=>['tanpa']]);
    }

    public function create(Request $request){
        $data = Category::create([ 
            'name' => $request->name,
            'iduser' => $request->iduser,
        ]);
        if($data){
            return response()->json([
                'success'=>true,
                'messages'=>'successfully create category',
                'data' => $data
            ],201);
        }
    }
}
