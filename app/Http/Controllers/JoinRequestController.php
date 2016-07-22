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
       
	 $is_sch = DB::table('parent_details')->where('sch_id',Input::get('school'))->get();
		$flag=0;
		foreach($is_sch as $p_info)
		{
			$is_info = DB::table('parent_details')->where([['email',Input::get('email')],['name',Input::get('firstname')." ".Input::get('lastname')],['child_name',Input::get('childs_firstname').Input::get('childs_lastname')],['classroom',Input::get('classroom')],['mobile_no',Input::get('mobile_no')],['sch_id',$p_info->sch_id]])->get();
			echo Input::get('school');
			
		}
		
		
		
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
