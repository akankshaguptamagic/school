<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class GroupChatController extends Controller
{
     public function index()
      {

          return view('groupchat.chat');

      }
      public function retrieve($id){


      }
      public function write(Request $request){
        $date=date("Ymd");
        $filename=$date.'.txt';

        $username=Auth::user()->firstname.' '.Auth::user()->lastname;
        $groupid=$request->group_id;
        $filepath='chat/groupchat/'.$groupid.'/'.$filename;
        $dirpath='chat/groupchat/'.$groupid;
        /*
        * check if Directory exists if not then create with permissions
        */
        if(!is_dir($dirpath)){
            mkdir($dirpath, 0777, true);
        }
        /*
        * check if file exists if not then create with permissions
        */

        if (!file_exists($filepath)) {

          $file='chat/groupchat/'.$groupid.'/'.$filename;
          $fp = fopen("$file","wb");
        }
        try{
        $content=$username.' : '.$_POST['text']." \n";

        if($fp = file_put_contents("$filepath",$content,FILE_APPEND)==false){
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
        $filepath='chat/groupchat/'.$id.'/'.$filename;
        if(file_exists($filepath)){
          $data=file_get_contents("$filepath");
          echo nl2br($data);
        }
        else{
          echo '';
        }

      }
}
