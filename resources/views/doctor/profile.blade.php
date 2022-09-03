@extends('layouts.app3')


@section('titl')
 Profile

@endsection
{{-- @section('imgUser')6
@endsection --}}
@section('user')
<h5>doctor<h5>


@endsection

{{-- @section('sidHome')
<li class="list"> 
    <a href="{{ url('/home') }}"><span class="fas fa-user-alt"></span> 
 <span>Profile</span></a>
 </li>

@endsection --}}


@section('style')

<style>
    .liProfil{
        font-size: 16px;
        line-height: 45px;
        margin-left: 80px;
    }
</style>
@endsection

@section('content_main')
<main>
  @if ($errors->any())
  <div class="flag note note--error" style="margin-top:50px">
    @foreach ($errors->all() as $error)
      <div class="flag__image note__icon">
        <i class="fa fa-times"></i>
      </div>
        <div class="flag__body note__text">
          {{ $error }}
        </div>
      <a href="#" class="note__close">
        <i class="fa fa-times"></i>
      </a>
    @endforeach
  </div>
@endif

@if(session('success'))
<div class="flag note note--success" style="margin-top:50px">
  <div class="flag__image note__icon">
    <i class="fa fa-check"></i>
  </div>
  <div class="flag__body note__text">
    {{ session('success') }}
  </div>
  <a href="#" class="note__close">
    <i class="fa fa-times"></i>
  </a>
</div>
@endif

@if(session('status'))
<div class="flag note note--success" style="margin-top:50px">
  <div class="flag__image note__icon">
    <i class="fa fa-check"></i>
  </div>
  <div class="flag__body note__text">
    Votre mot de passe a ete bien reintialise !!
  </div>
  <a href="#" class="note__close">
    <i class="fa fa-times"></i>
  </a>
</div>
@endif







    <div class="d-flex flex-column justify-content-center" 
    {{-- style="background-colo   r: rgb(253, 249, 249) " --}}
    >
        <div class="justify-content-center align-items-center"  style=" margin-top:50px; margin-bottom: 20px;">
            
          <div class="card "style=" width: 100%">
             <h2> my profile</h2>
            <ul>
        
                <li class="liProfil"><b>Full Name:    </b>{{ $doctor->fullname }} </li>
                <li class="liProfil"><b>Department :</b> {{ $doctor->department }} </li>
                <li class="liProfil"><b>Phone :</b> {{ $doctor->phone }}</li>
                <li class="liProfil"><b>Email :</b> {{ $doctor->email }}</li>
                <br>
                <br>
                <a href="javascript:void(0)"  class="btnn btn-primary liProfil"
                 onclick="editDoctor({{ $doctor->id }})"
                 data-toggle="modal" data-target="#editDoctorModal" >
                    <i class="far fa-edit "></i>
                   Update
                </a>
            </ul>

           </div>
      </div>
           <br>
           {{-- <div class=" card"style=" width: 100%">
            <h2> Work information</h2>
           <ul>
          
               <li class="liProfil"><b>Start Day :    </b>{{ $doctor->startDay }} </li>
               <li class="liProfil"><b>Last Day :</b> {{ $doctor->lastDay }} </li>
               <li class="liProfil"><b>Start Time:</b> {{ $doctor->startTime }} </li>
               <li class="liProfil"><b>Last Time :</b> {{ $doctor->endTime }} </li>
               <li class="liProfil"><b>Duration :</b> {{ $doctor->duration }}</li>
               <br>
               <br>
               <a href="javascript:void(0)"  class="btnn btn-primary liProfil"
                onclick="editTime({{ $doctor->id }})"
                data-toggle="modal" data-target="#editTimeModal" >
                   <i class="far fa-edit "></i>
                  Update
               </a>
           </ul>

          </div> --}}
        </div>
        </div>





      
  {{-- *****************************************edit doctor************************** --}}
<div class="modal fade" id="editDoctorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Doctor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="editDoctorForm" action="{{ Route('doctor.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
              @method('PUT')
              <input type="hidden" name="id" id="id">
              <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                  </div>
                  <input type="text" class="form-control" id="fullname" name="fullname" placeholder="FullName">
                </div>
              </div>

              <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-hospital"></i></div>
                  </div>
                  <select name="department" id="department"  class="form-control">
                    <option value="Cardiology">Cardiology</option>
                    <option value="Radiology">Radiology</option>
                    <option value="Dermatology">Dermatology</option>
                    <option value="Gastroenterology">Gastroenterology</option>
                    <option value="Pediatrics">Pediatrics</option>
                </select>
                </div>
              </div>

              <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-phone"></i></div>
                  </div>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                </div>
              </div>

              <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                  </div>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
              </div>

              <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-lock"></i></div>
                  </div>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
              </div>

              <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-lock"></i></div>
                  </div>
                  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password Confirmation">
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btnn btn-secondary" data-dismiss="modal">Cancel</button>
                <input type="submit" value="Update" class="btnn btn-primary">
              </div>
            </form>
        </div>
        
      </div>
    </div>
  </div>


{{-- ************************************************************************************************ --}}



{{-- <div class="modal fade" id="editTimeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Time</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editTimeForm" action="{{ Route('doctor.updateTime') }}" method="POST" enctype="multipart/form-data">
          @csrf
            @method('PUT')
            <input type="hidden" name="id" id="id">
            <div class="col-auto form-row">
              <div class="input-group mb-2 col-sm-6">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                <input type="date" class="form-control" id="startDay" name="startDay" placeholder="Start Day">
              </div>
  
              <div class="input-group mb-2 col-sm-6">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                <input type="date" class="form-control" id="lastDay" name="lastDay" placeholder="Last Day">
              </div>
            </div>
            <div class="col-auto form-row">
              <div class="input-group mb-2 col-sm-6">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-clock"></i></div>
                </div>
                <input type="time" class="form-control" id="startTime" name="startTime" placeholder="Start Time">
              </div>
  
              <div class="input-group mb-2 col-sm-6">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-clock"></i></div>
                </div>
                <input type="time" class="form-control" id="endTime" name="endTime" placeholder="End Time">
              </div>
            </div>
            <div class="col-auto form-row">
              <div class="input-group mb-2 col-sm-6">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-hourglass-start"></i></div>
                </div>
                <input type="time" class="form-control" id="duration" name="duration" placeholder="Duration">
              </div>
  
            </div>
            <div class="modal-footer">
              <button type="button" class="btnn btn-secondary" data-dismiss="modal">Cancel</button>
              <input type="submit" value="Update" class="btnn btn-primary">
            </div>
          </form>
      </div>
      
    </div>
  </div>
</div> --}}


  
{{-- ********************************************js************************************* --}}

<script>
    function editDoctor(id){
        $('#fullname').val('{{$doctor->fullname}}');
        $('#department').val('{{$doctor->department}}');
        $('#phone').val('{{$doctor->phone}}');
        $('#email').val('{{$doctor->email}}');
        $('#id').val('{{$doctor->id}}');
       
   
      }


        // function editTime(id){
        // $('#startDay').val('{{$doctor->startDay}}');
        // $('#lastDay').val('{{$doctor->lastDay}}');
        // $('#startTime').val('{{$doctor->startTime}}');
        // $('#endTime').val('{{$doctor->endTime}}');
        // $('#duration').val('{{ $doctor->duration }}')
        // $('#id').val('{{$doctor->id}}');
       
        // }
     
   
    


   
  </script>
</main>
@endsection