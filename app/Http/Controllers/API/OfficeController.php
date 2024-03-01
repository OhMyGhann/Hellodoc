<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Office;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\OfficeResource;
class OfficeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offices = Office::all();
    
        return $this->sendResponse(OfficeResource::collection($offices), 'Offices retrieved successfully.');
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
            'hospital_affiliation_id' => 'required',
            'time_slot_per_client_in_min' => 'required',
            'first_consultation_fee' => 'required',
            'followup_consultation_fee' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'zip' => 'required',
    
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $office = Office::create($input);
   
        return $this->sendResponse(new OfficeResource($office), 'Office created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $office = Office::find($id);
  
        if (is_null($office)) {
            return $this->sendError('Office not found.');
        }
   
        return $this->sendResponse(new OfficeResource($office), 'Office retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Office $office)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'doctor_id' => 'required',
            'hospital_affiliation_id' => 'required',
            'time_slot_per_client_in_min' => 'required',
            'first_consultation_fee' => 'required',
            'followup_consultation_fee' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'zip' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $office->doctor_id = $input['doctor_id'];
        $office->hospital_affiliation_id = $input['hospital_affiliation_id'];
        $office->time_slot_per_client_in_min = $input['time_slot_per_client_in_min'];
        $office->first_consultation_fee = $input['first_consultation_fee'];
        $office->followup_consultation_fee = $input['followup_consultation_fee'];
        $office->street_address = $input['street_address'];
        $office->city = $input['city'];
        $office->state = $input['state'];
        $office->country = $input['country'];
        $office->zip = $input['zip'];

        $office->save();
   
        return $this->sendResponse(new OfficeResource($office), 'Office updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $office)
    {
        $office->delete();
   
        return $this->sendResponse([], 'Office deleted successfully.');
    }
}