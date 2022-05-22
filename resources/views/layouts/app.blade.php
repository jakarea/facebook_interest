<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base_url" content="{{ url('') }}">
    <title>FB Ad Keyword Search</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('public/assets/style.css?var=1.5')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
         <!--toastr notification css-->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>
@guest
    <header>
        <div class="header-container">
        <div class="logo"><h1><a href="{{route('home')}}"><span>Interest</span> Hacker</a></h1></div>
        <!-- <ul>
           <li><a href="{{ route('facebook.login') }}" class="theme-btn"> Login</a></li>
            <li><a href="" class="theme-btn"> Register</a></li>
        </ul> -->
        </div>
    </header>
@else 
    <header>
        <div class="header-container">
        <div class="logo"><h1><a href="{{route('home')}}"><span>Interest</span> Hacker</a></h1></div>
        <ul>
            <li class="active"><a href="{{route('home')}}">Home</a></li>
            <li><a href="#"> Donate</a></li>
            <li><a href="#"> How To</a></li>
            <li><a href="#"> Support</a></li>
            <li><a href="{{route('user.logout')}}" class="theme-btn"> Logout</a></li>
        </ul>
        </div>
    </header>
 @endguest 
   @yield('content')
    
    
    <footer>
        <div class="footer-container">
            <div class="logo-menu">
            <div class="footer-logo"><h1>Facebook Interest Finder</h1></div>
            <ul>
            <li><a href="#"> Donate</a></li>
            <li><a href="#"> How To</a></li>
            <li><a href="#"> Support</a></li>
            </ul>
        </div>
        <div class="social-links">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
        </div>
         <div class="copyright-bar">
            <p>Copyright © 2021 FB Interest Finder</p>
            <p><a href=""></a></p>
        </div>
    </footer>
 
    
    
    @stack('js')

 <!-----------------js for toastr notification----------------->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@if(Session::has('success'))
<script>
  toastr.options.closeButton = true;
  toastr.options.progressBar = true;
  toastr.success('{{ Session::get('success') }}', 'Success')
</script>
@endif
@if(Session::has('error'))
<script>
  toastr.options.closeButton = true;
  toastr.options.progressBar = true;
  toastr.error('{{ Session::get('error') }}', 'Error')
</script>
@endif
@if(Session::has('info'))
<script>
  toastr.options.closeButton = true;
  toastr.options.progressBar = true;
  toastr.info('{{ Session::get('info') }}', 'Info')
</script>
@endif
@if(Session::has('warning'))
<script>
  toastr.options.closeButton = true;
  toastr.options.progressBar = true;
  toastr.warning('{{ Session::get('warning') }}', 'Warning')
</script>
@endif
<!-----------------//----------------->
 
</body>

</html>
