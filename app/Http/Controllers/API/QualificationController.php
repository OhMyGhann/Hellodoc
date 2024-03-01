<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Qualification;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\QualificationResource;

class QualificationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qualifications = Qualification::all();
    
        return $this->sendResponse(QualificationResource::collection($qualifications), 'Qualifications retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'doctor_id' => 'required',
            'qualification_name' => 'required',
            'institute_name' => 'required',
            'procurement_year' => 'required',

            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $qualification = Qualification::create($input);
   
        return $this->sendResponse(new QualificationResource($qualification), 'Qualification created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $qualification = Qualification::find($id);
  
        if (is_null($qualification)) {
            return $this->sendError('Qualification not found.');
        }
   
        return $this->sendResponse(new QualificationResource($qualification), 'Qualification retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Qualification $qualification)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'doctor_id' => 'required',
            'qualification_name' => 'required',
            'institute_name' => 'required',
            'procurement_year' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $qualification->doctor_id = $input['doctor_id'];
        $qualification->qualification_name = $input['qualification_name'];
        $qualification->institute_name = $input['institute_name'];
        $qualification->procurement_year = $input['procurement_year'];

        $qualification->save();
   
        return $this->sendResponse(new QualificationResource($qualification), 'Qualification updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Qualification $qualification)
    {
        $qualification->delete();
   
        return $this->sendResponse([], 'Qualification deleted successfully.');
    }
}
