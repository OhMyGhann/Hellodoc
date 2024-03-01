<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Doctor;
use Validator;
use App\Http\Resources\DoctorResource;
use Symfony\Component\HttpFoundation\Response;

class DoctorController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::all();
        return $this->sendResponse(DoctorResource::collection($doctors), 'Doctors retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'professional_statement' => 'required',
            'practicing_from' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $image_path = $request->file('image')->store('image', 'public');

        $input = $request->all();
        $input['image'] = $image_path;

        $doctor = Doctor::create($input);

        return $this->sendResponse(new DoctorResource($doctor), 'Doctor created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = Doctor::find($id);

        if (is_null($doctor)) {
            return $this->sendError('Doctor not found.');
        }

        return $this->sendResponse(new DoctorResource($doctor), 'Doctor retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'professional_statement' => 'required',
            'practicing_from' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $image_path = $request->file('image')->store('image', 'public');
        $input = $request->all();
        $input['image'] = $image_path;
        
        $doctor->name = $input['name'];
        $doctor->professional_statement = $input['professional_statement'];
        $doctor->practicing_from = $input['practicing_from'];
        $doctor->image = $input['image'];
        $doctor->save();

        return $this->sendResponse(new DoctorResource($doctor), 'Doctor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        return $this->sendResponse([], 'Doctor deleted successfully.');
    }
}
