<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use DB;
class User extends Authenticatable
{
  /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
      protected $fillable = [
          'firstname','lastname', 'email', 'password','relationship_to_child','phone_no_1','phone_no_2','street','city','state','zip','country','profile_picture'
      ];

      /**
       * The attributes excluded from the model's JSON form.
       *
       * @var array
       */
      protected $hidden = [
          'password', 'remember_token',
      ];

      /*
      *  relation from child info table
      */
      public function child()
      {
          return $this->hasOne(ChildInfo::class,'users_id','id');
      }

      public function chatdata(){
        $rooms = DB::table('child_info')->join('teachers_rooms','teachers_rooms.id','=','child_info.teacher_room_id')->select('teacher_room_id','room_no')->where('users_id',Auth::user()->id)->distinct()->get();
        $inc=0;
      foreach ($rooms as $room) {
      //  $out[$room->teacher_room_id]['room_name']=$room->room_no;
        $users= DB::table('child_info')->join('users', 'users.id', '=', 'child_info.users_id')->select('users_id','users.firstname','users.lastname')->where('teacher_room_id',$room->teacher_room_id)->where('users.id','!=',Auth::user()->id)->distinct()->get();
        foreach ($users as  $value) {

          $out[$inc]['name']=$value->firstname.' '.$value->lastname;
          $out[$inc]['id']=$value->users_id;
          $inc++;
        }

      }

// echo '<pre/>';
  //  print_r($out);exit;
      return $out;
  }




  }
