<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
          $appointments = Appointment::all();
        return view('appointment.listAppointments')->with([
            'appointments'=> $appointments
              ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function indexD(Appointment $appointment)
    {
        $doctor=Auth::user();
        $id= $doctor->id;
        $appointments = $appointment->where("doctorID","=",$id)->get();
        // $appointments = Appointment::all();
        return view('appointment.listAppointments')->with([
            'appointments'=> $appointments
              ]); 
    }

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
            'fullnameP' => ['required', 'string', 'max:255'],
            'phoneP' => 'required',
            'addressP' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'fullnameD' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
          
        ]);

    
        $email=$request->email;
        $patient = Patient::where('email',$email) -> first();
        // $patientID = Patient::select('id')->where('email', $email)->first();
        // $patient = Patient::find($patientID); 
        //DB::table('patients')->where('email', $email)->first();
      if($patient==null)
      {
        
        $patient = new Patient();
        $patient->fullname = $request->fullnameP;
        $patient->phone = $request->phoneP;
        $patient->address = $request->addressP;
        $patient->email = $request->email;
         $patient->save();

        $appointment = new Appointment();
    
        $appointment->patientName =  $patient->fullname ;
        $appointment->patientphone =  $patient->phone;
        $appointment->patientAddress = $patient->address;
        $appointment->patientEmail =  $patient->email;
        $appointment->doctornName = $request->fullnameD;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->patientID = $patient->id;
        $appointment->doctorID = $request->id;

        $appointment->save();




     
    
    
    }else{
      
        // $patient_id = DB::table('patients')->where('email', $email)->first()->id;
     
        // $userId = $user->ID;
    //    $patient = Patient::find($patient_id); 
        $appointment = new Appointment();
        $appointment->patientName =  $request->fullnameP;
        $appointment->patientphone =  $request->phoneP;
        $appointment->patientAddress = $request->addressP;
        $appointment->patientEmail =  $request->email;
        $appointment->doctornName = $request->fullnameD;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->patientID = $patient->id;
        $appointment->doctorID = $request->id;

        $appointment->save();
    
    }


       
        
     

        return redirect()->back()->with('success', 'The Appointment has been successfully added!!');
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
        return response()->json($appointment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            // 'fullname' => ['required', 'string', 'max:255'],
            // 'phone' => 'required',
            // 'address' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255'],
            // 'fullnameD' => ['required', 'string', 'max:255'],
           
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i:s'],
          
        ]);
    
       
        $appointment = Appointment::find($request->id);
        
        // $appointment->patientname = $request->fullname;
        // $appointment->patientphone = $request->phone;
        // $appointment->addressPatient = $request->address;
        // $appointment->emailPatient = $request->email;
        // $appointment->doctorname = $request->fullnameD;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        // $appointment->patientID = $request->idP;
        // $appointment->doctorID = $request->id;

        $appointment->save();

        return redirect()->back()->with('success', 'The Appointment has been successfully added!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Appointment::destroy($id);
        return redirect()->back()->with('success', 'The Appointment has been deleted !!');
    }
}
