<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\School;
use App\TeachersRoom;
use App\ParentDetail;
use App\JoinRequest;
use DB;
use Session;
use Mail;
//use Input;
class JoinRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$schools= School::pluck('school_names', 'id');
		return view('joinrequest.joinrequest', compact('schools'));
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
      $is_info = DB::table('parent_details')->where([['email',Input::get('email')],['name',Input::get('firstname')." ".Input::get('lastname')],['child_name',Input::get('childs_firstname')." ".Input::get('childs_lastname')],['classroom',Input::get('classroom')],['mobile_no',Input::get('mobile_no')],['sch_id',Input::get('school')]])->get();
			
		if($is_info)
		{
		  $data = new JoinRequest;
		  $qry=DB::table('schools')->select('school_names')->where('id',Input::get('school'))->first();
		  $data->email = Input::get('email');
		  $data->firstname = Input::get('firstname');
		  $data->lastname = Input::get('lastname');
		  
		  $data->school = $qry->school_names;
	      $data->childs_firstname = Input::get('childs_firstname');
		  $data->childs_lastname = Input::get('childs_lastname');
		  $data->relationship_to_child = Input::get('relationship_to_child');
		  $data->classroom = Input::get('classroom');
		  $data->mobile_no = Input::get('mobile_no');
		  $data->note = Input::get('note');
		  $confirmation_code = str_random(30);
		  $data->email_confirmation_code=$confirmation_code;
		  $data->save();
		
		  Mail::send('emails.verify', compact('confirmation_code'), function($message) {
	 	   $message->to(Input::get('email'), Input::get('firstname'))->subject('Verify your email address');
		  });
		}
		else
		{
			Session::flash('message', 'Sorry Your details are not matched with school!!!');
			return Redirect::back();
		}	
		
		Session::flash('message', 'Request Sent Successfully..Please Check Email To Process Further!!!!');
			 return Redirect::back();
		
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
	
	public function categoryDropDownData()
		{
		

 		  $cat_id = Input::get('cat_id');
		  $subcategories = TeachersRoom::where('school_id', '=', $cat_id)
                  ->orderBy('room_no', 'asc')
                  ->get();
        
		 return \Response::json($subcategories);


	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	
	 public function confirm($confirmation_code)
    	 {
			if( ! $confirmation_code)
			{
				return view('auth.login');
			}
	
			
			$user = JoinRequest::where('email_confirmation_code', $confirmation_code)->first();
			
			if ( ! $user)
			{
				return view('auth.login');
			}
			
		//	$user->email_confirmed = 1;
			//$user->email_confirmation_code = null;
			//$user->save();
			
			Session::flash('message', 'Thanks For Verifying Your Email Address!!!!');
			return view('auth.register')->with('user',$user);
		
		
  	   }
}
