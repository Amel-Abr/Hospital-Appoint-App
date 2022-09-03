@extends('layouts.app3')

@section('titl')
Patients
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



    <h1 style="margin-top:10px;margin-bottom: 10px;">List Of Patients <br><br></h1>
    {{-- <button class="btnn btn-primary mb-1 mt-2" data-toggle="modal" data-target="#addDoctor">
        <i class="material-icons align-top mr-1">person_add</i>
        Add
   </button> --}}
  <div class="card-body bg-white" style="margin: 20px">
       
    <table class="table table-striped table-bordered">
      <thead>
          {{-- <tr style="background-color: #435d7d">
            <th colspan="9" class="text-light" style="font-size: 25px">Liste des Etudiants</th>
          </tr> --}}
          <tr>
              <th>Full Name</th>
              <th>address</th>
              <th>Phone</th>
              <th>Email</th>
              @if ($isAdmin)
                   <th colspan="3">Actions</th>
              @endif
           
          </tr>
      </thead>
      <tbody>
        @foreach ($patients as $patient)
          <tr>
              <td>{{ $patient->fullname }}</td>
              <td>{{ $patient->address }}</td>
              <td>{{ $patient->phone }}</td>
              <td>{{ $patient->email }}</td>
               @if ($isAdmin)
              <td class="text-center">
                  <a href="javascript:void(0)"
                   data-toggle="modal" data-target="#editPatientModal" 
                   onclick="editPatient({{$patient->id}})">
                      <img src="/images/edit.png" alt="edit" width="25">
                  </a>
        
              </td>   
             
             
         
              <td class="text-center">
                <a href="javascript:void(0)" 
                data-toggle="modal" data-target="#deletePatientModal" 
                onclick="deletePatient({{$patient->id}})" >
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



   


  {{-- *****************************************edit patient************************** --}}
  <div class="modal fade" id="editPatientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Patient</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="editPatientForm"  action="{{ Route('admin.updateP') }}" method="POST">
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
                    <div class="input-group-text"><i class="fa fa-map-marker" aria-hidden="true"></i>
                    </div>
                  </div>
                  <input type="text" class="form-control" id="address" name="address" placeholder="Address">
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

              <div class="modal-footer">
                <button type="button" class="btnn btn-secondary" data-dismiss="modal">Cancel</button>
                <input type="submit" value="Update" class="btnn btn-primary">
              </div>
            </form>
        </div>
        
      </div>
    </div>
  </div>

  

  {{-- *****************************************delete patient************************** --}}

<div class="modal fade" id="deletePatientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Patient</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Do you really want to remove this patient ?</p>
          <small class="font-weight-bold" style="color:#edb200;">
              <i class="fas fa-exclamation-triangle"></i>
              This action can not be canceled !
          </small>
          <div class="modal-footer">
            <button type="button" class="btnn btn-secondary" data-dismiss="modal">Cancel</button>
            <form id="deletePatientForm" method="POST">
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
     function editPatient(id){
      // $('#editDoctorModal').modal('toggle');
      $.get('/patient/' + id, function(patient){
        $('#fullname').val(patient.fullname);
        $('#address').val(patient.address);
        $('#phone').val(patient.phone);
        $('#email').val(patient.email);
        $('#id').val(patient.id);
      });

     
    }
    


    function deletePatient(id){
      // $('#deleteDoctorModal').modal('toggle');
      $('#deletePatientForm').attr('action', '/patient/' + id);
    }
  </script>
</main>
@endsection