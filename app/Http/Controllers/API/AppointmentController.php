<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\AppointmentResource;

class AppointmentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::all();
    
        return response()->json(['data' => AppointmentResource::collection($appointments)], 200);
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
            'user_account_id' => 'required',
            'office' => 'required',
            'probable_start_time' => 'required',
            'actual_end_time' => 'required',
            'status' => 'required',
            'appointment_taken_date' => 'required',
            'app_booking_channel_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $appointment = Appointment::create($request->all());

        return response()->json(['data' => new AppointmentResource($appointment)], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment = Appointment::find($id);

        if (is_null($appointment)) {
            return response()->json(['error' => 'Appointment not found.'], 404);
        }

        return response()->json(['data' => new AppointmentResource($appointment)], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validator = Validator::make($request->all(), [
            'user_account_id' => 'required',
            'office' => 'required',
            'probable_start_time' => 'required',
            'actual_end_time' => 'required',
            'status' => 'required',
            'appointment_taken_date' => 'required',
            'app_booking_channel_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $appointment->update($request->all());

        return response()->json(['data' => new AppointmentResource($appointment)], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return response()->json(null, 204);
    }
}
