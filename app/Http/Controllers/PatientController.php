<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        
        $data = [
            'Message' => 'Get all Patients',
            'Data' => $patients
        ];

        return response()->json($data, 200);
    }

    public function show($id)
    {   
        $patients = Patient::find($id);

        if ($patients){
            $data = [
                'Message' => 'Get Detail Patient',
                'Data' => $patients
            ];

            return response()->json($data, 200);
        } else{
            $data = [
                'Message' => 'Data not found'
            ];

            return response()->json($data, 404);
        }
    }

    public function store(Request $request)
    {
        $input = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
            'in_date_at' => $request->in_date_at,
            'out_date_at' => $request->out_date_at,
        ];

        $validateData = $request->validate([
            'name' => 'required|string',
            'phone' => 'required',
            'address' => 'required|string',
            'status' => 'required',
            'in_date_at' => 'required|date',
            'out_date_at' => 'nullable',
        ]);

        $patients = Patient::create($input);
        $patients = Patient::create($validateData);

        $data = [
            'message' => 'Success create data',
            'data' => $patients
        ];

        return response()->json($patients, 201);
    }

    public function update(Request $request, $id)
    {
        $patients = Patient::find($id);

        if ($patients){
            $input = [
                'name' => $request->name ?? $patients->name,
                'phone' => $request->phone ?? $patients->phone,
                'address' => $request->address ?? $patients->address,
                'status' => $request->status ?? $patients->status,
                'in_date_at' => $request->in_date_at ?? $patients->in_date_at,
                'out_date_at' => $request->out_date_at ?? $patients->out_date_at
            ];

            $patients->update($input);

            $data = [
                'message' => 'Patient Updated',
                'data' => $patients
            ];

            return response()->json($data, 200);
        } else{
            $data = [
                'message' => 'Patient not found' 
            ];

            return response()->json($data, 404);
        }
    }

    public function destroy(Request $request, $id)
    {
        $patients = Patient::find($id);

        if ($patients){
            $patients->delete();

            $data = [
                'message' => 'Student is deleted'
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Student is not found'
            ];

            return response()->json($data, 404);
        }
    }
}
