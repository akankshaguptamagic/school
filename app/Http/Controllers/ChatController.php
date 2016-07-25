<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\User;

class ChatController extends Controller
{

   public function chat(){

     return view('chat.chat');
   }


   public function write(Request $request){
     $date=date("Ymd");
     $filename=$date.'.txt';


     $username=Auth::user()->firstname.' '.Auth::user()->lastname;
     $receiver_id=$request->receiver_id;
     $receiver_name=User::find($receiver_id);
  //  echo  $receiver_name->lastname;
    // print_r($receiver_name);exit;
     $f_name=$receiver_name->firstname;
     $l_name=$receiver_name->lastname;
     $r_name=$f_name.' '.$l_name;
    // print_r($name);
     //echo $r_name;exit;

     $filepath='chat/chat/'.$receiver_id.'/'.$filename;
     $dirpath='chat/chat/'.$receiver_id;
     $sender_dir='chat/chat/'.Auth::user()->id;
     $sender_file_path='chat/chat/'.Auth::user()->id.'/'.$filename;
     /*
     * check if Directory exists if not then create with permissions
     */
     if(!is_dir($dirpath)){
         mkdir($dirpath, 0777, true);
     }

     /*
     * check if Directory exists if not then create with permissions
     */
     if(!is_dir($sender_dir)){
         mkdir($sender_dir, 0777, true);
     }
     /*
     * check if file exists if not then create with permissions
     */

     if (!file_exists($filepath)) {

       $file='chat/chat/'.Auth::user()->id.'/'.$filename;
       $fp = fopen("$file","wb");
     }
     if (!file_exists($sender_file_path)) {

       $file='chat/chat/'.Auth::user()->id.'/'.$filename;
       $fp = fopen("$file","wb");
     }
     $send_id=Auth::user()->id;

     try{
       $sender_array = array("time" =>date('h:i:s A'), 'sender_id' =>"$send_id", 'receiver_id' =>"$receiver_id",
       "sender_name"=>Auth::user()->firstname.' '.Auth::user()->lastname,'receiver_name'=>"$r_name", 'msg' =>"$request->text","side"=>'RIGHT');

       $receiver_array = array("time" =>date('h:i:s A'), 'sender_id' =>"$send_id", 'receiver_id' =>$receiver_id,
       "sender_name"=>Auth::user()->firstname.' '.Auth::user()->lastname,'receiver_name'=>"$r_name", 'msg' =>"$request->text","side"=>'LEFT');

    //encoding the PHP array
      $sender_content=json_encode($sender_array).'<$$>';
      $receiver_content=json_encode($receiver_array).'<$$>';

     if($fp = file_put_contents("$filepath",$sender_content,FILE_APPEND)==false){
       throw new Exception("Error Processing Request", 1);
     }
     if($fp2 = file_put_contents("$sender_file_path",$receiver_content,FILE_APPEND)==false){
       throw new Exception("Error Processing Request", 1);
     }
   }
   catch(Exception $e) {
             return response()->json(['responseText' => 'Error in Processing Request!'], 500);
         }

     return response()->json(['responseText' => 'Success!'], 200);

   }


   public function receive($id){
     $date=date('Ymd');
     $filename=$date.'.txt';
     $filepath='chat/chat/'.$id.'/'.$filename;
     if(file_exists($filepath)){
       $data=file_get_contents("$filepath");
       echo nl2br($data);
     }
     else{
       echo '';
     }

   }


}
