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
}
