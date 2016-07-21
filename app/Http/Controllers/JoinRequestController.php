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
        //$validator = Validator::make(Input::all(), JoinRequest::$rules);
//		if ($validator->fails()) 
//		{
//			// get the error messages from the validator
//			$messages = $validator->messages();
//			// redirect our user back to the form with the errors from the validator
//			return Redirect::back()->withErrors($validator);
//		}
		///////////////Here is the code to match request record to actual school database record and check condition to verify user...If user request record is completely match to school record then user receive email//////
		$sch_id=ParentDetail::where('sch_id', '=', $request->school)->get();
		$flag=0;
		foreach($sch_id as $sch)
		{
		$name=$request->firstname.' '.$request->lastname;
		$child_name=$request->childs_firstname.' '.$request->childs_lastname;
		$detail=ParentDetail::where('email',"'$request->email'")->get()->count();
				//print_r($detail);
				//$c=count($detail);
				//echo $c;
			//$c=count($detail);
			//echo $c;
				
			if(!$detail)
			{
			echo "kk";
				$flag=1;
				break;
			}
			
		}
		echo "<br>";	
		echo $request->email;
		echo "<br>";
		echo $request->firstname." ".$request->lastname;
		echo "<br>";
		echo $request->childs_firstname." ".$request->childs_lastname;
		echo "<br>";
		echo $request->classroom;
		echo "<br>";
		echo $request->mobile_no;
		echo "<br>";
		echo $sch->sch_id;
		echo "<br>";
		echo $flag;
		// $detail=ParentDetail::find(array('email' => $request->email));
		if($flag)
		
		  echo "exist";
	 	else
			echo "not exist";
		
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
}
