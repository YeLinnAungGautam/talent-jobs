<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use File;
use Illuminate\Support\Facades\Storage;
use App\Models\PushNotification;
use Response;

class BlogController extends Controller
{
    public function bulksend($id,$blogObj){
        $title = "Talent and Jobs Created a new Blog";
        $body = "let's check out what new blog is about";
        $img = "logo.png";
        $comment = new PushNotification();
        $comment->title = $title;
        $comment->body = $body;
        $comment->image = $img;
        $comment->save();

        $message = [
        "blog"=>$blogObj,
        "type"=>"blog"];

        $url = 'https://fcm.googleapis.com/fcm/send';
        $dataArr = array('click_action' => 'FLUTTER_NOTIFICATION_CLICK', 'status'=>"done" , "payload"=>$message);
        $notification = array('title' =>$title, 'body' => $body, 'image'=> $img, 'sound' => 'default', 'badge' => '1',);
        $arrayToSend = array('to' => "/topics/myTopic", 'notification' => $notification, 'data' => $dataArr, 'priority'=>'high');
        $fields = json_encode ($arrayToSend);
        $headers = array (
            'Authorization: key=' . "AAAAHSrCVjw:APA91bF1emPvEP6-FAuaVwW5x1ju-mb_6ltmw-Ppx40gG_D0UShFhyPEE6FpeaCpDXF4yghOH965vsP0H4vxEaf4-LBS5i-a0WPP07nIaQuweF16vjn2H-OIBoKQpB6UHQwlEzvT7I1F",
            'Content-Type: application/json'
        );

        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

        $result = curl_exec ( $ch );
        //var_dump($result);
        curl_close ( $ch );
      
        return $result;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();
         if(count($blogs) <= 0){
            return  Response::json([
                'message ' => "No Data Found"
            ], 404);
                }
        else{
            return $blogs;
        }
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
            'image' => $fileName,
            'slug' => $request->slug,
            'blog_unique_id' => $request->blog_unique_id,
            'sharable_link' => $request->sharable_link
        ]);
        // $this->bulksend($blog->id,$blog);
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

    public function showDetail($id)
    {
        $blog = blog::where('blog_unique_id',$id)->first();
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
                                'image' => $image_name,
                                'slug' => $request->slug
                                ]);
                        }
                        else{
                            $blog_update->update([
                                'title' => $request->title,
                                'description' => $request->description,
                                'image' => $image_name,
                                'slug' => $request->slug
                                ]);
                        }
                }
                else{
                    $blog_update->update([
                        'title' => $request->title,
                        'description' => $request->description,
                        'slug' => $request->slug
                        ]);
                }
            }
    }

    public function updateBlog($id,Request $request)
    {
        $blog = Blog::where('blog_unique_id',$id)->update(["open_in_link"=>$request->open_in_link]);
        // $job->open_in_link = $request->open_in_link;
        // $job->save();
       
        return  Response::json([
            'message ' => "Successfully Updated"
        ],200);
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
