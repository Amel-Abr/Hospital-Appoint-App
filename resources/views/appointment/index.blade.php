@extends('adminlte::page')



@section('title')
     Liste of Appointements | Hospital Appointement Application
@endsection
@section('content_header')
     <h1>Liste of Appointements</h1>
@endsection

@section('content')
     <div class="container">
       <div class="row ">
           <div class="col-md-10 mx-auto">
               <div class="card my-5">
                   <div class="card-header bg-white">
                       <div class="text-center text-uppercase">
                           <h4>Appointements</h4>
                       </div>
                   </div>
                   <div class="card-body bg-white">
                   <table id="myTable" class=" table table-bordered table-striped">
                       <thead>
                           <tr>
                               <th>ID</th>
                               <th>Fullname</th>
                               <th>Departement</th>
                               <th>Hired</th>
                               <th></th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach ($appointements as $key => $appointement)
                            <tr>
                               <td>{{ $key+=1 }}</td>
                               <td>{{ $appointement->fullname }}</td>
                               <td>{{ $appointement->depart }}</td>
                               <td>{{ $appointement->hire_date }}</td>
                               <td class="d-flex justify-content-center align-items-center">
                                   <a href="{{ route('Appointements.show',$appointement->registration_number)}}"
                                    class="btn btn-sm btn-primary">
                                   <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('Appointements.edit',$appointement->registration_number)}}"
                                    class="btn btn-sm btn-warning mx-2">
                                   <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('Appointements.destroy',$appointement->registration_number) }}" method="post">
                                @method('DELETE')
                                @csrf
                                </form>
                                <button type="submit"
                                class="btn btn-sm btn-danger">
                                <i class="fas fa-trash "></i>
                                </button>
                               </td>
                            </tr> 
                           @endforeach
                       </tbody>

                   </table>
               </div>
               </div>
           </div>
       </div>
     </div>
@endsection

@section('js')
 <script>
     $(document).ready(function(){
         $('#myTable').DataTable({
         dom : 'Bfrtip',
        // buttons : [
          //   'copy','excel','csv','pdf','print','colvis'
        // ]
         });
     });
 </script>
@endsection