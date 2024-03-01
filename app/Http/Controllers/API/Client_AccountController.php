<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client_Account;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ClientAccountResource;

class Client_AccountController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client_Account::all();
    
        return response()->json(['data' => ClientAccountResource::collection($clients)], 200);
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
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required',
            'email' => 'required|email|unique:client__accounts,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $client = Client_Account::create($request->all());

        return response()->json(['data' => new ClientAccountResource($client)], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client_Account::find($id);

        if (is_null($client)) {
            return response()->json(['error' => 'Client account not found'], 404);
        }

        return response()->json(['data' => new ClientAccountResource($client)], 200);
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
        $client = Client_Account::find($id);

        if (is_null($client)) {
            return response()->json(['error' => 'Client account not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required',
            'email' => 'required|email|unique:client__accounts,email,' . $client->id,
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $client->update($request->all());

        return response()->json(['data' => new ClientAccountResource($client)], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client_Account::find($id);

        if (is_null($client)) {
            return response()->json(['error' => 'Client account not found'], 404);
        }

        $client->delete();

        return response()->json(null, 204);
    }
}
