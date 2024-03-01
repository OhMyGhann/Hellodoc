<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Specialization;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\SpecializationResource;

class SpecializationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specializations = Specialization::all();
    
        return $this->sendResponse(SpecializationResource::collection($specializations), 'Specializations retrieved successfully.');
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
            'specialization_name' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $specialization = Specialization::create($input);
   
        return $this->sendResponse(new SpecializationResource($specialization), 'Specialization created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $specialization = Specialization::find($id);
  
        if (is_null($specialization)) {
            return $this->sendError('Specialization not found.');
        }
   
        return $this->sendResponse(new SpecializationResource($specialization), 'Specialization retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specialization $specialization)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'specialization_name' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $specialization->specialization_name = $input['specialization_name'];
        $specialization->save();
   
        return $this->sendResponse(new SpecializationResource($specialization), 'Specialization updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialization $specialization)
    {
        $specialization->delete();
   
        return $this->sendResponse([], 'Specialization deleted successfully.');
    }
}
