<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\App_Booking_Channel;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\AppBookingChannelResource;

class AppBookingChannelController extends Controller
{
    public function index()
    {
        $appbookingchannels = App_Booking_Channel::all();
    
        return response()->json(['data' => AppBookingChannelResource::collection($appbookingchannels)], 200);
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
            'app_booking_channel_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $appbookingchannel = App_Booking_Channel::create($request->all());

        return response()->json(['data' => new AppBookingChannelResource($appbookingchannel)], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appbookingchannel = App_Booking_Channel::find($id);

        if (is_null($appbookingchannel)) {
            return response()->json(['error' => 'appbookingchannel not found.'], 404);
        }

        return response()->json(['data' => new AppointmentResource($appbookingchannel)], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppBookingChannel $appbookingchannel)
    {
        $validator = Validator::make($request->all(), [
            'app_booking_channel_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $appbookingchannel->update($request->all());

        return response()->json(['data' => new AppBookingChannelResource($appbookingchannel)], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(App_Booking_Channel $appbookingchannel)
    {
        $appbookingchannel->delete();

        return response()->json(null, 204);
    }
}

