@extends('layouts.app3')


@section('titl')
Doctors

@endsection

@section('imgUser')admin
@endsection
@section('user')
<h5>admin</h5>
{{-- <form method="POST" action="{{ route('logout') }}">
    @csrf
   <button type="submit">Logout</button>
</form> --}}

@endsection
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


    <h1 style="margin-top:10px;margin-bottom: 10px;">List Of Doctors <br><br></h1>
    @if ($isAdmin)
       <button class="btnn btn-primary btnM" data-toggle="modal" data-target="#addDoctor">
        {{-- <i class="material-icons align-top mr-1">person_add</i> --}}
        <img src="/images/add-user.png"  width="18">
      
        Add
   </button>
    @endif
   
  <div class="card-body bg-white" style="margin: 20px">
       
    <table class="table table-striped table-bordered">
      <thead>
          {{-- <tr style="background-color: #435d7d">
            <th colspan="9" class="text-light" style="font-size: 25px">Liste des Etudiants</th>
          </tr> --}}
          <tr >
              <th>Full Name</th>
              <th>Department</th>
              <th>Phone</th>
              <th>Email</th>
           @if ($isAdmin)
           <th colspan="3">Actions</th>
           @endif
           
             
          </tr>
      </thead>
      <tbody>
        @foreach ($doctors as $doctor)
          <tr>
              <td>{{ $doctor->fullname }}</td>
              <td>{{ $doctor->department }}</td>
              <td>{{ $doctor->phone }}</td>
              <td>{{ $doctor->email }}</td>
              @if ($isAdmin)


             <td class="text-center">
              <a href="javascript:void(0)"
              data-toggle="modal" data-target="#addAppointModal" 
              onclick="addAppoint({{$doctor->id}})" class="btnn get">
                 Get Appointment
             </a>
            </td>



           <td class="text-center">
                <a href="javascript:void(0)"
                 data-toggle="modal" data-target="#editDoctorModal" 
                 onclick="editDoctor({{$doctor->id}})">
                    <img src="/images/edit.png" alt="edit" width="25">
                </a>
      
            </td>
               
            <td class="text-center">
              <a href="javascript:void(0)" 
              data-toggle="modal" data-target="#deleteDoctorModal" 
              onclick="deleteDoctor({{$doctor->id}})" >
                <img src="/images/delete.png" alt="delete" width="25">
              </a>
            </td>    
             @endif

              
             
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="d-flex justify-content-center"  style="margin-bottom: 10px; margin-top: 10px;">
        {{ $doctors->links() }}
      </div>
  </div>


     
{{-- *****************************************modals************************** --}}
 {{-- *****************************************Add Appointment************************** --}}
 <div class="modal fade" id="addAppointModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Get Appointment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addAppointForm"  action="{{ Route('admin.storeA') }}" method="POST">
          @csrf
            <input type="hidden" name="id" id="id">

            <div class="col-auto">
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-user"></i></div>
                </div>
                <input type="text" class="form-control" id="fullnameP" name="fullnameP" placeholder="FullName">
              </div>
            </div>


            <div class="col-auto">
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-phone"></i></div>
                </div>
                <input type="text" class="form-control" id="phoneP" name="phoneP" placeholder="Phone">
              </div>
            </div>

            <div class="col-auto">
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-map-marker" aria-hidden="true"></i>
                  </div>
                </div>
                <input type="text" class="form-control" id="addressP" name="addressP" placeholder="Address">
              </div>
            </div>

            <div class="col-auto">
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                </div>
                <input type="email" class="form-control" id="emailP" name="email" placeholder="Email">
              </div>
            </div>

            <div class="col-auto">
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-user-md" aria-hidden="true"></i>
                  </div>
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
              <input type="submit" value="Ok" class="btnn btn-primary">
            </div>
          </form>
      </div>
      
    </div>
  </div>
</div>



{{-- *****************************************add doctor************************** --}}
<div class="modal fade" id="addDoctor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Doctor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ Route('admin.store') }}" method="POST">
            @csrf
              

              <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                  </div>
                  <input type="text" class="form-control"  name="fullname" placeholder="FullName">
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
                  <input type="text" class="form-control" name="phone" placeholder="Phone">
                </div>
              </div>

              <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                  </div>
                  <input type="email" class="form-control" name="email" placeholder="Email">
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
          <form id="editDoctorForm"  action="{{ Route('admin.updateD') }}" method="POST">
            @csrf
              @method('PUT')
              <input type="hidden" name="idD" id="idD">
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

              <div class="modal-footer">
                <button type="button" class="btnn btn-secondary" data-dismiss="modal">Cancel</button>
                <input type="submit" value="Update" class="btnn btn-primary">
              </div>
            </form>
        </div>
        
      </div>
    </div>
  </div>

  

  {{-- *****************************************delete doctor************************** --}}

<div class="modal fade" id="deleteDoctorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Doctor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Do you really want to remove this doctor ?</p>
          <small class="font-weight-bold" style="color:#edb200;">
              <i class="fas fa-exclamation-triangle"></i>
              This action can not be canceled !
          </small>
          <div class="modal-footer">
            <button type="button" class="btnn btn-secondary" data-dismiss="modal">Cancel</button>
            <form id="deleteDoctorForm" method="POST">
              @csrf
              @method('DELETE')
              <input type="submit" value="Delete" class="btnn btn-danger">
            </form>
            
          </div>
        </div>
        
      </div>
    </div>
  </div>
  
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bandle.min.js"></script>

{{-- ********************************************js************************************* --}}

  <script>
      function addAppoint(id ){
     
      $.get('/admin/' + id, function(doctor){
        $('#fullnameD').val(doctor.fullname);
        $('#id').val(doctor.id);
      });
    

}

    function editDoctor(id){
      // $('#editDoctorModal').modal('toggle');
      $.get('/admin/' + id, function(doctor){
        $('#fullname').val(doctor.fullname);
        $('#department').val(doctor.department);
        $('#phone').val(doctor.phone);
        $('#email').val(doctor.email);
        $('#idD').val(doctor.id);
      });

     
    }
    


    function deleteDoctor(id){
      // $('#deleteDoctorModal').modal('toggle');
      $('#deleteDoctorForm').attr('action', '/admin/' + id);
    }
  </script>
</main>
@endsection