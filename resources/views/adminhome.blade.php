@extends('layouts.app3')

@section('titl')
Dashboard
@endsection
@section('imgUser')admin
@endsection 

@section('user')
<h5>admin</h5>


@endsection

{{-- @section('sidHome')

<li>
    <a href="{{ url('/home') }}"  class="active" ><span class="fa fa-home" ></span>
    <span>Dashboard</span></a>
  </li>

@endsection --}}

@section('content_main')
<main>
    <div class="cards">
        <div class="card-single">
            <div>
                <h1>{{ \App\Models\User::count()-1}} </h1>
                <a href="{{ url('admin/doctors') }}"> 
                <span style='font-size:16px'>Doctors</span>
                </a>
            </div>
            <div class="imgDash">
                <img src="/images/doctor1.png" width="120px" height="90px" alt="">
            </div>
            {{-- <div class="iconss">
                <span class='fas fa-user-md' 
                style='font-size:35px;'>
            </span>
            </div> --}}
        </div>
        
        <div class="card-single">
            <div>
                <h1>{{ \App\Models\Appointment::count()}} </h1>
                <a href="{{ url('admin/appointments') }}"> 
                <span style='font-size:16px'>Appointments</span>
                </a>
            </div>
            <div class="imgDash">
                <img src="/images/appoint1.png" width="100px" height="90px" alt="">
            </div>
            {{-- <div>
                <span class="far fa-calendar-alt" 
                {{-- style='font-size:32px;color:rgb(35, 35, 211)' --}}
                {{-- ></span> --}}
            {{-- </div>  --}}
        </div>
       
        <div class="card-single">
            <div>
                <h1>{{ \App\Models\Patient::count()}} </h1>
                <a href="{{ url('admin/patients') }}"> 
                <span style='font-size:16px'>Patients</span>
                </a>
            </div>

            <div class="imgDash">
                <img src="/images/patieDash.png" width="100px" height="100px" alt="">
            </div>

            {{-- <div>
                <span class="fas fa-procedures"
                 {{-- style='font-size:32px;color:rgb(35, 35, 211)' --}}
                {{-- ></span> --}}
            {{-- </div> --}}
        </div>
    </div>

</main>
@endsection
 