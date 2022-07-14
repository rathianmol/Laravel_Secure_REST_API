<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Patient::all();
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
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:1',
            'date_of_birth' => 'required|date',
            'email' => 'required|email|unique:patients',
            'phone' => 'required|string|unique:patients',
            'ssn' => 'nullable|numeric',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|min:2|max:2',
            'zip_code' => 'required|string',
            'case_description' => 'required|string|min:3|max:1000',
            'food_allergies' => 'nullable|string|min:3|max:1000',
            'medicine_allergies' => 'nullable|string|min:3|max:1000',
            'insect_allergies' => 'nullable|string|min:3|max:1000',
            'other_allergies' => 'nullable|string|min:3|max:1000',
            'previous_illnesses' => 'nullable|string|min:3|max:1000',
            'current_illnesses' => 'nullable|string|min:3|max:1000',
            'physical_disabilities' => 'nullable|string|min:3|max:1000',
            'respitory_condition' => 'nullable|string|min:3|max:1000',
            'heart_condition' => 'nullable|string|min:3|max:1000',
            'hearing_condition' => 'nullable|string|min:3|max:1000',
            'visual_condition' => 'nullable|string|min:3|max:1000',
            'siezures' => 'nullable|string|min:3|max:1000',
            'current_medications' => 'nullable|string|min:3|max:1000',
        ]);

        // return Patient::create($request->all());
        $patient = Patient::create($request->all());
        return response()->json([
            'message' => 'Patient successfully created',
            'patient' => $patient
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = "";
        $patient = Patient::where('id', '=', $id)->first();

        if(is_null($patient)) {
            $message = $message = "Patient with ID: $id not found.";
            $patient = [];
        } else {
            $message = "Patient with ID: $id found.";
        }
        
        return response()->json([
            'message' => $message,
            'patient' => $patient,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:1',
            'date_of_birth' => 'required|date',
            'email' => 'required|email',
            'phone' => 'required|string',
            'ssn' => 'nullable|numeric',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|min:2|max:2',
            'zip_code' => 'required|string',
            'case_description' => 'required|string|min:3|max:1000',
            'food_allergies' => 'nullable|string|min:3|max:1000',
            'medicine_allergies' => 'nullable|string|min:3|max:1000',
            'insect_allergies' => 'nullable|string|min:3|max:1000',
            'other_allergies' => 'nullable|string|min:3|max:1000',
            'previous_illnesses' => 'nullable|string|min:3|max:1000',
            'current_illnesses' => 'nullable|string|min:3|max:1000',
            'physical_disabilities' => 'nullable|string|min:3|max:1000',
            'respitory_condition' => 'nullable|string|min:3|max:1000',
            'heart_condition' => 'nullable|string|min:3|max:1000',
            'hearing_condition' => 'nullable|string|min:3|max:1000',
            'visual_condition' => 'nullable|string|min:3|max:1000',
            'siezures' => 'nullable|string|min:3|max:1000',
            'current_medications' => 'nullable|string|min:3|max:1000',
        ]);

        $message = "";
        $patient = Patient::where('id', '=', $id)->first();

        if(is_null($patient)) {
            $message = $message = "Patient with ID: $id not found.";
            $patient = [];
        } else {
            $message = "Patient with ID: $id updated.";
            $patient->update($request->all());

        }
        
        return response()->json([
            'message' => $message,
            'patient' => $patient,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = "";
        $patient = Patient::where('id', '=', $id)->first();

        if(is_null($patient)) {
            $message = $message = "Patient with ID: $id not found.";
        } else {
            Patient::destroy($id);
            $message = "Patient with ID: $id successfully deleted.";
        }
        
        return response()->json([
            'message' => $message,
        ]);
    }

    public function search(Request $request)
    {
        $patients = Patient::query();

        if(!is_null($request->first_name)) {
            $patients->orWhere("first_name", "LIKE", "%{$request->first_name}%");
        }

        if(!is_null($request->middle_name)) {
            $patients->orWhere("middle_name", "LIKE", "%{$request->middle_name}%");
        }

        if(!is_null($request->last_name)) {
            $patients->orWhere("last_name", "LIKE", "%{$request->last_name}%");
        }

        if(!is_null($request->email)) {
            $patients->orWhere("email", "LIKE", "%{$request->email}%");
        }

        if(!is_null($request->phone)) {
            $patients->orWhere("phone", "LIKE", "%{$request->phone}%");
        }

        if(!is_null($request->ssn)) {
            $patients->orWhere("ssn", "LIKE", "%{$request->ssn}%");
        }

        return $patients->get();
    }
}