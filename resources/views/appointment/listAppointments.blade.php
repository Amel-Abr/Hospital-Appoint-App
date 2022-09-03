@extends('layouts.app3')

@section('titl')
Appointments
@endsection

@section('imgUser')admin
@endsection
{{-- @section('user')
<h5>admin</h5> --}}
{{-- <form method="POST" action="{{ route('logout') }}">
    @csrf
   <button type="submit">Logout</button>
</form> --}}

{{-- @endsection --}}

@php
   $isAdmin=Auth::user()->isAdmin;
@endphp
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



    <h1 style="margin-top:10px;margin-bottom: 10px;">List Of Appointments <br><br></h1>
    @if (!$isAdmin)
    <button class="btnn btn-primary mb-1 mt-2" data-toggle="modal" data-target="#addAppointment">
        <i class="material-icons align-top mr-1">add</i>
        Add
   </button>
   @endif
  <div class="card-body bg-white" style="margin: 20px">
       
    <table class="table table-striped table-bordered">
      <thead>
          {{-- <tr style="background-color: #435d7d">
            <th colspan="9" class="text-light" style="font-size: 25px">Liste des Etudiants</th>
          </tr> --}}
          <tr>
            <th>Patient Name</th>
            <th>Patient Phone</th>
            <th>Patient Address</th>
            <th>Patient email</th>
            <th>Doctor Name</th>
            <th>Date</th>
            <th>Time</th>
              {{-- @if ($isAdmin) --}}
                   <th colspan="3">Actions</th>
              {{-- @endif --}}
           
          </tr>
      </thead>
      <tbody>
        @foreach ($appointments as $appointment)
          <tr>
            <td>{{ $appointment->patientName }}</td>
            <td>{{ $appointment->patientphone }}</td> 
            <td>{{ $appointment->patientAddress }}</td>
            <td>{{ $appointment->patientEmail }}</td>
            <td>{{ $appointment->doctornName }}</td>
            <td>{{ $appointment->date }}</td>
            <td>{{ $appointment->time }}</td>

            <td class="text-center">
              <a href="javascript:void(0)"
               data-toggle="modal" data-target="#editAppointmentModal" 
               onclick="editAppointment({{$appointment->id}})">
                  <img src="/images/edit.png" alt="edit" width="25">
              </a>
    
          </td>   
               @if ($isAdmin)
              
             
             
         
              <td class="text-center">
                <a href="javascript:void(0)" 
                data-toggle="modal" data-target="#deleteAppointmentModal" 
                onclick="deleteAppointment({{$appointment->id}})" >
                  <img src="/images/delete.png" alt="delete" width="25">
                </a>
              </td>
              @endif
          </tr>
        @endforeach
      </tbody>
    </table>
    {{-- <div class="d-flex justify-content-center"  style="margin-bottom: 10px; margin-top: 10px;">
        {{ $doctors->links() }}
      </div> --}}
  </div>


     
{{-- *****************************************modals************************** --}}
<div class="modal fade" id="editAppointmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Appointment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editAppointmentForm"  action="{{ Route('admin.updateA') }}" method="POST">
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
                  <div class="input-group-text"><i class="fas fa-phone"></i></div>
                </div>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
              </div>
            </div>

            <div class="col-auto">
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-map-marker" aria-hidden="true"></i>
                  </div>
                </div>
                <input type="text" class="form-control" id="address" name="address" placeholder="Address">
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
                  <div class="input-group-text"><i class="fa fa-user-md" aria-hidden="true"></i>  </div>
                </div>
                <input type="text" class="form-control" id="fullnameD" name="fullnameD" placeholder="Doctor Name">
              </div>
            </div>
           


            <div class="col-auto ">
              <div class="input-group mb-2 col-sm-6">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                <input type="date" class="form-control" id="date" name="date" placeholder="Date">
              </div>
            </div>
        
          <div class="col-auto ">
            <div class="input-group mb-2 col-sm-6">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-clock"></i></div>
              </div>
              <input type="time" class="form-control" id="time" name="time" placeholder="Time">
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




  {{-- *****************************************edit patient************************** --}}
  <div class="modal fade" id="addAppointment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Appointment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ Route('doctor.storeA') }}" method="POST">
            @csrf
              
            <div class="col-auto">
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-user"></i></div>
                </div>
                <input type="text" class="form-control" id="fullname" name="fullnameP" placeholder="FullName">
              </div>
            </div>
            <div class="col-auto">
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-phone"></i></div>
                </div>
                <input type="text" class="form-control" id="phone" name="phoneP" placeholder="Phone">
              </div>
            </div>
            <div class="col-auto">
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-map-marker"></i></div>
                </div>
                <input type="text" class="form-control" id="address" name="addressP" placeholder="Address">
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
           
            {{-- <div class="col-auto">
              <div class="input-group mb-2">
                 <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-user-md" aria-hidden="true"></i>  </div>
                </div>
                <input type="text" class="form-control" id="fullnameD" name="fullnameD" placeholder="Doctor Name">
              </div>
            </div> --}}
            <div class="col-auto ">
              <div class="input-group mb-2 col-sm-6">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                <input type="date" class="form-control" id="date" name="date" placeholder="Date">
              </div>
            </div>
        
          <div class="col-auto ">
            <div class="input-group mb-2 col-sm-6">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-clock"></i></div>
              </div>
              <input type="time" class="form-control" id="time" name="time" placeholder="Time">
            </div>
          </div>
  
  
           
              <div class="modal-footer">
                <button type="button" class="btnn btn-secondary" data-dismiss="modal">Cancel</button>
                <input type="submit" value="Add" class="btnn btn-primary">
              </div>
            </form>
        </div>
        
      </div>
    </div>
  </div>
  

  {{-- *****************************************delete patient************************** --}}

<div class="modal fade" id="deleteAppointmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Appointment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Do you really want to remove this Appointment ?</p>
          <small class="font-weight-bold" style="color:#edb200;">
              <i class="fas fa-exclamation-triangle"></i>
              This action can not be canceled !
          </small>
          <div class="modal-footer">
            <button type="button" class="btnn btn-secondary" data-dismiss="modal">Cancel</button>
            <form id="deleteAppointmentForm" method="POST">
              @csrf
              @method('DELETE')
              <input type="submit" value="Delete" class="btnn btn-danger">
            </form>
            
          </div>
        </div>
        
      </div>
    </div>
  </div>
  


{{-- ********************************************js************************************* --}}

  <script>
     function editAppointment(id){
      // $('#editDoctorModal').modal('toggle');
      $.get('/appointment/' + id, function(appointment){
        $('#fullname').val(appointment.patientName);
        $('#address').val(appointment.patientAddress);
        $('#phone').val(appointment.patientphone);
        $('#email').val(appointment.patientEmail);
        $('#fullnameD').val(appointment.doctornName);
        $('#date').val(appointment.date);
        $('#time').val(appointment.time);
        $('#id').val(appointment.id);
      });

     
    }
    


    function deleteAppointment(id){
      // $('#deleteDoctorModal').modal('toggle');
      $('#deleteAppointmentForm').attr('action', '/appointment/' + id);
    }
  </script>
</main>
@endsection