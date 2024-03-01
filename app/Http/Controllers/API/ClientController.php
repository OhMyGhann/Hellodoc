<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client_Review;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ClientResource;

class ClientController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientReviews = Client_Review::all();
    
        return response()->json(['data' => ClientResource::collection($clientReviews)], 200);
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
            'doctor_id' => 'required',
            'is_review_anonymous' => 'required',
            'wait_time_rating' => 'required',
            'bedside_manner_rating' => 'required',
            'overall_rating' => 'required',
            'review' => 'required',
            'is_doctor_recommended' => 'required',
            'review_date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $clientReview = Client_Review::create($request->all());

        return response()->json(['data' => new ClientResource($clientReview)], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clientReview = Client_Review::find($id);

        if (is_null($clientReview)) {
            return response()->json(['error' => 'Client review not found'], 404);
        }

        return response()->json(['data' => new ClientResource($clientReview)], 200);
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
        $clientReview = Client_Review::find($id);

        if (is_null($clientReview)) {
            return response()->json(['error' => 'Client review not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_account_id' => 'required',
            'doctor_id' => 'required',
            'is_review_anonymous' => 'required',
            'wait_time_rating' => 'required',
            'bedside_manner_rating' => 'required',
            'overall_rating' => 'required',
            'review' => 'required',
            'is_doctor_recommended' => 'required',
            'review_date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $clientReview->update($request->all());

        return response()->json(['data' => new ClientResource($clientReview)], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clientReview = Client_Review::find($id);

        if (is_null($clientReview)) {
            return response()->json(['error' => 'Client review not found'], 404);
        }

        $clientReview->delete();

        return response()->json(null, 204);
    }
}
