<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Events;
use App\User;
use Auth;
use App\TeachersRooms;
use App\SocialGroups;
use App\ChildInfo;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index(Request $request)
    {
      $user = new User();
      // for getting all data of child info table for getting events and teachers rooms and groups
      $child_info=User::find(Auth::user()->id)->child;
      //event data
      $events=Events::where('school_id',$child_info->sch_id)->get();
      // for group chat
      //teachers rooms data
      // $rooms=TeachersRooms::where('school_id',$child_info->sch_id)->get();
      // $request->session()->put('class_rooms',$rooms);
      // //groups list that logged in user subscried to
      // $groups=SocialGroups::where('sch_id',$child_info->sch_id)->get();
      // // session
      // $request->session()->put('groups',$groups);
      // group chat ends here
      $chatdata=$user->chatdata();

      $request->session()->put('chats',$chatdata);

      return view('home')->with('content',json_encode($events));

    }
}
