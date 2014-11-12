<!-- /var/www/html/onlineShoping/app/views/productView.blade.php -->
<!DOCTYPE html>
<html>
<head>
	<title>ProductTest</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" >
<link rel="stylesheet" href="{{asset('css/style.css')}}" >
<link rel="stylesheet" href="{{asset('css/nv.d3.css')}}" >
</head>
<body>
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <div class="navbar navbar-inverse navbar-static-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href=" {{ url('/') }} ">Sellon</a>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <!-- nothing to add now -->
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li><a href="{{ url('cart')}}"><span class="glyphicon glyphicon-shopping-cart"></span>cart</a></li>
          @if(isset($user))
          <li class="dropdown">
            <a href="#", class="dropdown-toggle" data-toggle="dropdown">{{ $user->getUsername(); }}<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ url('profile'); }}">Profile</a></li>
              <li><a href="{{ url('logout'); }}">Log out</a></li>
            </ul>
          </li>
          </a>
          @else
          <li><a href="{{ url('login')}}">Log in</a></li>
          @endif
        </ul>
      </div>
    </div>
  </div> <!-- /navbar -->

    @section('slideshow')
    @show

  <div class = "container" >
    <div class = "col-md-12 well">
            @yield('content')
    </div>
    <div class = "col-md-12 well">
            @section('second-content')
            @show
    </div>
  </div>

  <script src= "{{asset('js/bootstrap.min.js')}}" ></script>
  <!-- JQUERY -->
  <script type="text/javascript" src = "{{ asset('js/jquery.hideseek.min.js') }}" ></script>
  <script type="text/javascript" src = "{{ asset('js/main.js') }}"></script>
  <script type="text/javascript" src = "{{ asset('js/brain-socket.min.js') }}"></script>
  <!-- END OF JQUERY -->
  @section('script')
  @show
</body>
</html>
