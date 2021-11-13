<?php

namespace App\Http\Controllers;

#mengimport Model Patient untuk interaksi dengan database
use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    #membuat method index
    public function index()
    {
        #mengambil semua data dari Patient
        $patients = Patient::all();
        
        if($patients){
            $data = [
                'Message' => 'Get all Resource',
                'Data' => $patients
            ];
            #mengirim respon dengan bentuk JSON
            return response()->json($data, 200);
        }else{
            $data = [
                'message' => 'Resource is empty'
            ];
            #mengirim respon dengan bentuk JSON
            return response()->json($data, 404);
        }


    }

    #membuat method show
    public function show(Request $request, $id)
    {   
        #mencari data Patient menggunakan id
        $patients = Patient::find($id);
        
        #menggunakan if agar lebih lengkap
        if ($patients){
            $data = [
                'Message' => 'Get Detail Resource',
                'Data' => $patients
            ];
            #mengembalikan respon dengan bentuk JSON dan kode 200
            return response()->json($data, 200);
        } else{
            $data = [
                'Message' => 'Resource not found'
            ];
            #mengembalikan respon dengan bentuk JSON dan kode 404
            return response()->json($data, 404);
        }
    }
    
    #membuat method search
    public function search(Request $request)
    {   
        #mencari data Patient menggunakan nama 
        $patients = Patient::where('name', $request->name)->get();
        // dd($patients);
        #menggunakan if agar lebih lengkap
        if(!empty($patients)){
            $data = [
                'Message' => 'Get Detail Patient',
                'Data' => $patients
            ];
            #mengembalikan respon dengan bentuk JSON dan kode 200
            return response()->json($data, 200);
        }else{
            $data = [
                'Message' => 'Data not found'
            ];
            #mengembalikan respon dengan bentuk JSON dan kode 404
            return response()->json($data, 404);
        }
    }

    public function positive()
    {   
        #mencari data Patient menggunakan status
        $patients = Patient::where('status', 'positive')->get();
        // dd($patients);
        #menggunakan if agar lebih lengkap
        if(!empty($patients)){
            $data = [
                'Message' => 'Get positive patient',
                'Data' => $patients
            ];
            #mengembalikan respon dengan bentuk JSON dan kode 200
            return response()->json($data, 200);
        }else{
            $data = [
                'Message' => 'Resource is empty'
            ];
            #mengembalikan respon dengan bentuk JSON dan kode 404
            return response()->json($data, 404);
        }
    }

    public function dead()
    {   
        #mencari data Patient menggunakan status dead
        $patients = Patient::where('status', 'dead')->get();
        // dd($patients);
        #menggunakan if agar lebih lengkap
        if(!empty($patients)){
            $data = [
                'Message' => 'Get negative patient',
                'Data' => $patients
            ];
            #mengembalikan respon dengan bentuk JSON dan kode 200
            return response()->json($data, 200);
        }else{
            $data = [
                'Message' => 'Resource is empty'
            ];
            #mengembalikan respon dengan bentuk JSON dan kode 404
            return response()->json($data, 404);
        }
    }

    public function recovered()
    {   
        #mencari data Patient menggunakan status recovered
        $patients = Patient::where('status', 'recovered')->get();
        // dd($patients);
        #menggunakan if agar lebih lengkap
        if(!empty($patients)){
            $data = [
                'Message' => 'Get recovered patient',
                'Data' => $patients
            ];
            #mengembalikan respon dengan bentuk JSON dan kode 200
            return response()->json($data, 200);
        }else{
            $data = [
                'Message' => 'Resource is empty'
            ];
            #mengembalikan respon dengan bentuk JSON dan kode 404
            return response()->json($data, 404);
        }
    }

    public function store(Request $request)
    {
        #membuat validasi 
        $validateData = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'status' => 'required',
            'in_date_at' => 'required|date',
            'out_date_at' => 'nullable',
        ]);

        #menggunakan model Patient untuk insert data
        $patients = Patient::create($validateData);

        $data = [
            'message' => 'Resource is added successfully',
            'data' => $patients
        ];
        #menguirim data bentuk json dan kode 201
        return response()->json($data, 201);
    }

    public function update(Request $request, $id)
    {
        #menggunakan model Patient untuk mendapatkan id yang mau diupdate
        $patients = Patient::find($id);

        if ($patients){
            #menangkap data request
            $input = [
                'name' => $request->name ?? $patients->name,
                'phone' => $request->phone ?? $patients->phone,
                'address' => $request->address ?? $patients->address,
                'status' => $request->status ?? $patients->status,
                'in_date_at' => $request->in_date_at ?? $patients->in_date_at,
                'out_date_at' => $request->out_date_at ?? $patients->out_date_at
            ];

            #mengupdate data
            $patients->update($input);

            $data = [
                'message' => 'Resource is updated successfully',
                'data' => $patients
            ];
            #mengembalikan data dalam bentuk json dan kode 200
            return response()->json($data, 200);
        } else{
            $data = [
                'message' => 'Resource not found' 
            ];
            #mengembalikan data dalam bentuk json dan kode 404
            return response()->json($data, 404);
        }
    }

    public function destroy(Request $request, $id)
    {
        #menggunakan model Patient untuk mendapatkan id yang mau didelete
        $patients = Patient::find($id);

        if ($patients){
            #men-delete data
            $patients->delete();

            $data = [
                'message' => 'Resource is deleted successfully'
            ];
            #mengembalikan data json dan kode 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found'
            ];
            #mengembalikan data json dan kode 400
            return response()->json($data, 404);
        }
    }
}
