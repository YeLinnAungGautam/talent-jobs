<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PushNotification;

class PushNotificationController extends Controller
{
    //
    public function index()
    {
        $push_notifications = PushNotification::orderBy('created_at', 'desc')->get();
        return view('notification.index', compact('push_notifications'));
    }

    public function bulksend(Request $req){

        $comment = new PushNotification();
        $comment->title = $req->input('title');
        $comment->body = $req->input('body');
        $comment->image = $req->input('image');
        $comment->save();

        $url = 'https://fcm.googleapis.com/fcm/send';
        $dataArr = array('click_action' => 'FLUTTER_NOTIFICATION_CLICK', 'id' => $req->id,'status'=>"done");
        $notification = array('title' =>$req->title, 'text' => $req->body, 'image'=> $req->image, 'sound' => 'default', 'badge' => '1',);
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
}
