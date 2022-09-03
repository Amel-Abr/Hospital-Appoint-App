<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = [
            [
            'id' => '1',
            'name' => 'Hospital 1',
            'img' => 'mahdia.jpg',
            ],
            [
                'id' => '2',
                'name' => 'Hospital 2',
                'img' => 'memon.jpg',
                ],
                [
                    'id' => '3',
                    'name' => 'Hospital 3',
                    'img' =>  'damar.webp'
                    ],
            ];

        return view('patient.patientHome')->with([
            'cards' =>$cards 
        ]) ;
       
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function show(Hospital $hospital)
    {
        $doctors = User::where('isAdmin', '!=', true)->paginate(8);
        $patient = Auth::guard('patient')->user();
        return view('patient.listDoctor',['doctors' => $doctors , 'patient' => $patient ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function edit(Hospital $hospital)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */

    public function showDoct($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }
    public function update(Request $request, Hospital $hospital)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hospital $hospital)
    {
        //
    }
}
