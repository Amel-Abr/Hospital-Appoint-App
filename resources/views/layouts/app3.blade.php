<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hospital Appointements</title>
    <script src="{{ asset('/js/app.js') }}" defer></script>
    <script>/js/app.js</script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" 
      integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="/css/styles.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" 
      integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
 
  @yield('style')
</head>
<body>
 
{{--  home section  --}}
<input type="checkbox" id="nav-toggle">
<div class="sidebar">
   <div class="sidebar-brand">
        {{-- <h2> --}}
           {{-- <span class="lab la-accusoft "></span><span>HOTAPP</span> --}}
      <h2><div class="logo">
           <img src="/images/logo4.jpg" alt="">
               <span> Med<span style="color:blueviolet">Care</span></span>
          </div>
        {{-- </h2> --}}</h2>
       </div>
       
   <div class="sidebar-menu">
       <ul>
        {{-- @yield('sidHome') --}}
        @php
            
        
        $isAdmin=Auth::user()->isAdmin;


        if($isAdmin)
        {
            $liN="dashboard";
            $icon="home";
            $url="admin";
            $name="admin";
            $img="admin";
            $action="action1";
            $act="'act1'";
        }
        else {
            $liN="profile";
            $icon="user-alt";
            $url="doctor";
            $name=Auth::user()->fullname;
            $img="doct";
            $action="action2";
            $act="'act2'";
        }
             
        




       
        
       @endphp
       


        <li>
            <a href="{{ url('/home') }}" class="{{ Route::currentRouteName() == 'home' ? 'active' : ''  }}" ><span class="fa fa-{{$icon}}" ></span>
            <span>{{ $liN }}</span></a>
          </li> 
          {{-- {{ $act }}{{ $action }} --}}

          
          {{-- <li class="list">  --}}
            {{-- <a href="{{ url('Doctor/profile') }}"><span class="fas fa-user-alt"></span>  --}}
         {{-- <span>Profile</span></a> --}}
         {{-- </li> --}}
           
          <li>
            <a href="{{ url($url.'/doctors') }}" class="{{ Route::currentRouteName() == 'doctors' ? 'active' : ''  }}"><span class="fas fa-user-md"></span> 
          <span>Doctors</span></a>
          </li>
          <li>
            <a href="{{ url($url.'/appointments') }}" class="{{ Route::currentRouteName() == 'appointments' ? 'active' : ''  }}"><span class="far fa-calendar-alt"></span> 
          <span>Appointments</span></a>
          </li>
          <li>
            <a href="{{ url($url.'/patients') }}" class="{{ Route::currentRouteName() == 'patients' ? 'active' : ''  }}"><span class="fas fa-procedures"></span> 
          <span>Patients</span></a>
        </li>
        <li class="nav-log">
            {{-- style="cursor: pointer; nav-link--}}
            <a href="#" class=" text-danger" onclick="event.preventDefault(); 
            document.getElementById('logout-form').submit();" >
                {{-- <i class="material-icons align-top">logout</i> --}}
                <span ><img src="/images/logout1.png"  width="23px" height="23px" alt="" ></span>
                <span>Logout</span> 
            </a>
    
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
       </li>
       
       </ul>
   </div>
</div>

<div class="main-content">
    <header class="main-header">
        <h2>
            <label for="nav-toggle">
                <span class="las la-bars"></span>
            </label> 
            @yield('titl')
            {{-- Dashboard --}}
        </h2>
    {{-- @yield('imgUser') --}}
        <div class="user-wrapper">
            <img src="/images/{{$img}}.png" width="30px" height="30px" alt="">
            <div>
                <br>
                {{-- <br> --}}
               {{-- <span> Hello @yield('user')</span> --}}
              <h5> <span>{{ $name }}</span></h5>
                {{-- <h4>admin</h4> --}}
                
            </div>
        </div>
    </header>
    @yield('content_main')
   
    {{-- <main>
        <div class="cards">
            <div class="card-single">
                <div>
                    <h1>54</h1>
                    <span>Doctors</span>
                </div>
                <div>
                    <span class="las la-users"></span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1>76</h1>
                    <span>Appointements</span>
                </div>
                <div>
                    <span class="las la-users"></span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1>54</h1>
                    <span>Patients</span>
                </div>
                <div>
                    <span class="las la-users"></span>
                </div>
            </div>
        </div>

    </main> --}}
</div>







<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>
<script>/js/script.js</script>
</body>
</html>

