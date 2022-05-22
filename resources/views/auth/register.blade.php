@extends('layouts.app')

@section('content')
<style type="text/css">
  /* Login */
/* Full-width input fields */
input[type=text], input[type=password] {

  width: 30%;
  padding: 15px;
  margin: 0 auto;
  display: inline-block;
  border: 2px solid blue;
  background: #f1f1f1;
}


input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;

}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit/register button */
.registerbtn {
  background-color: dodgerblue;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 20%;
  opacity: 0.9;
  margin: 0 auto;
}

.registerbtn:hover {
  opacity:1;

}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;

}

</style>
<div class="container">
<form method="POST" action="{{ route('register') }}">
    @csrf
  <div class="container">
    <br><br><br>
    <h1 style="text-align: center; color: #7c3aed">Register</h1>
    <p style="text-align: center; color: dodgerblue;">Please fill in this form to Create account.</p>
    <hr>

    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Enter Name" autofocus>
    <br>
    <div style="text-align: center; color: red;">
    @error('name')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>
   <br><br>
    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Email">
    <br>
    <div style="text-align: center; color: red;">
    @error('email')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
    @enderror
   </div>
    <br><br>
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter New password">
    <br>
    <div style="text-align: center; color: red;">
      @error('password')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>    
    <br><br>
    <input id="password-confirm" type="password" class="form-control"  name="password_confirmation" required autocomplete="new-password" placeholder="Enter Confirm password">
    <br>
    <div style="text-align: center; color: red;">
    @error('password-confirm')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
    @enderror
    </div>
  <br><br>
    <button type="submit" class="registerbtn">Register</button>
  </div>
</form>
    </div>
@endsection
