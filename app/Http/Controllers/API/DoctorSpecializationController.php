<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Doctor_Specialization;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\DoctorSpecializationResource;

class DoctorSpecializationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctorSpecializations = Doctor_Specialization::all();

        return $this->sendResponse(DoctorSpecializationResource::collection($doctorSpecializations), 'Doctor specializations retrieved successfully.');
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
            'doctor_id' => 'required',
            'specialization_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $doctorSpecialization = Doctor_Specialization::create($request->all());

        return $this->sendResponse(new DoctorSpecializationResource($doctorSpecialization), 'Doctor specialization created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctorSpecialization = Doctor_Specialization::find($id);

        if (is_null($doctorSpecialization)) {
            return $this->sendError('Doctor specialization not found.');
        }

        return $this->sendResponse(new DoctorSpecializationResource($doctorSpecialization), 'Doctor specialization retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor_Specialization $doctorSpecialization)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
            'specialization_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $doctorSpecialization->update($request->all());

        return $this->sendResponse(new DoctorSpecializationResource($doctorSpecialization), 'Doctor specialization updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor_Specialization $doctorSpecialization)
    {
        $doctorSpecialization->delete();

        return $this->sendResponse([], 'Doctor specialization deleted successfully.');
    }
}
