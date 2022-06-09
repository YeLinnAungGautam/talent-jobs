<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use File;
use Illuminate\Support\Facades\Storage;
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
        // $blogs_pictures = $request->file('image')->store('public/uploads/blog_pictures');
        $destinationPath = public_path().'/blog_images';
        $request->file = $request->file('image')->getClientOriginalName();
        $fileName = $request->file('image')->getClientOriginalName(); 
        $request->file('image')->move($destinationPath,$fileName);
        $blog= Blog::create([
            'title' => $fields['title'],
            'description' => $fields['description'],
            'image' => $fileName
        ]);
        return response([
            'message' => 'Created Successful'
        ], 201);
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
    public function update($id, Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|mimes:jpeg,png',
        ]);
            $blog_update = Blog::find($id);
            if($blog_update){
                if($request->hasFile('image') != null){
                    $image_name = time().'.'.$request->image->extension();
                    $request->image->move(public_path('/blog_images'),$image_name);
                    $old_path = public_path().'/blog_images'.$blog_update->image;
                        if(File::exists($old_path)){
                            File::delete($old_path);
                             $blog_update->update([
                                'title' => $request->title,
                                'description' => $request->description,
                                'image' => $image_name
                                ]);
                        }
                        else{
                            $blog_update->update([
                                'title' => $request->title,
                                'description' => $request->description,
                                'image' => $image_name
                                ]);
                        }
                }
                else{
                    $blog_update->update([
                        'title' => $request->title,
                        'description' => $request->description,
                        ]);
                }
            }
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
