<?php

namespace App\Http\Controllers;

use App\Article;
// use Illuminate\Http\Request; 

class ArticlesController extends Controller
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

    public function list(){
        $articles = Article::orderBy('id','DESC')->get();
        // dd($articles);
        if (count($articles)!=0){
            return response()->json([
                'success' => true,
                'messages' => 'Success',
                'data' => $articles
            ],201);
        }else{
            return response()->json([
                'success' => false,
                'messages' => 'Data Belum tersedia',
                'data' => ''
            ],401);
        }
    }

    public function create(Request $request){

        $data = Article::create([
            'title' => $request->title, 
            'articles' => $request->articles, 
            'idcategory' => $request->idcategory, 
            'slug' => $request->slug, 
            'thumbnail' => $request->thumbnail, 
        ]);

        if($data){
            return response()->json([
                'success'=>true,
                'messages'=> 'Article Was Successfully created',
                'data' => $data,
            ],201);
        }else{
            return response()->json([
                'success' => true,
                'messages' => 'Failed to create Article',
                'data' => '',
            ],401);
        }
    }
}
