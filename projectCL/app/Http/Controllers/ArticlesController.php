<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function index(Article $article)
    {

        $articles = $article->with('tags', 'user');

        $req = \request();
        $filters = json_decode($req->input('filters'), true);

        foreach ($filters as $key => $value) if (!(empty($value['val']))) {
            switch ($key) {
                default:
                    $articles = $articles->where($value['key'], $value['val']);
                    break;
            }
        }



        return response()->json([
            'data' => $articles->orderBy('created_at', 'desc')->get()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Article $article
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Article $article )
    {
        $request->validate([
            'cat_id' => 'required',
            'user_id' => 'required',
            'title' => 'required',
            'content' => 'required'
        ]);


        $title = $request->input('title');
        $images = $request->input('images');
        $content = $request->input('content');

        $idx = 0;

        $s3URL = \env('AWS_S3_URL');

        if ($images) {
            foreach ($images as $image)
            {
                $idx++;

                $arr = explode(';base64,', $image);

                $arr[0] = str_replace('data:image/', '', $arr[0]);
                $arr[1] = str_replace(' ', '+', $arr[1]);
                $tempFileName = $title.'_'.$idx.'.'.$arr[0];


                $uploadFolder = $title;

                $filePath = Storage::disk('s3')->put('/'.$uploadFolder.'/'.$tempFileName,base64_decode($arr[1]),'public');
                $url = $s3URL.$uploadFolder.'/'.$tempFileName;


                $content = str_replace($image, $url, $content);

            }
        }

        $task = $article->create([
            'cat_id' => $request->input('cat_id'),
            'user_id' => $request->input('user_id'),
            'title' => $title,
            'content' => $content,
        ]);

        return response()->json([
            'content' => $task,
            'data' => 'task has been created!'
        ], 201);
    }

    /**
     * Display the specified resource.
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {

        $comments = $article->comments()->with('replies')->whereNull('parent_id')->latest()->get();

        return response()->json([
            'data' => $article,
            'comments' => $comments
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $outs = $article->update($request->all());

        return response()->json([
            'data' => $outs
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $outs = $article->delete();

        return response()->json([
            'data' => $outs
        ], 200);
    }
}
