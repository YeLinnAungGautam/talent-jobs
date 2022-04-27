<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Blog::all();
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|mimes:jpeg,png',
        ]);
        $blog= Blog::create([
            'title' => $fields['title'],
            'description' => $fields['description'],
            'image' => $fields['image']
        ]);
        return response([
            'message' => 'Created Successful'
        ], 401);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = blog::find($id);
        return $blog;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $blog)
    {
        $blog = Blog::find($blog);
        $blog->title = $request->title;
        $blog->description = $request->description;
        // $blog->image = $request->image;
        $blog->save();
        // $success = $blog->update([
        //     'title' => request('title'),
        //     'description'=> request('description'),
        //     'image' => request('image'),
        // ]);
        return [
            'success' => $blog,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $success = $blog->delete();
        return [
            'success' => $success
        ];
    }
    /**
     * Search For a name.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function searchblog($name){
            $blog = Blog::where('title','like','%'.$name.'%')->orWhere('description','like','%'.$name.'%')->paginate(6);
            return $blog;
    }
}
