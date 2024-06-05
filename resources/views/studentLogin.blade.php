@extends('layouts.loginlayout')
  
@section('content')
<style>
  *{
    margin:0;
    padding: 0;
    box-sizing: border-box;
  }
  body{
    background: linear-gradient(
      45deg,
      rgba(9, 100, 38, 0.7),  /* Greenish color with reduced blue and increased green */
      rgba(9, 100, 38, 0.7)
    ),url('assets/images/scott.jpg');
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  .form-div{
    width: 35%;
    background: white;
    padding: 20px;
    position: absolute;
    right: 0;
    height: 100%;
  }

  .main{
    width: 100%;
    height: 100%;
    position: relative;
  }

  .footer{
    position: absolute;
    bottom: 10px;
    margin: 20px;
    color: #fff;
  }

  .name{
    position: absolute;
    bottom: 30px;
    margin: 50px 20px;
    color: #fff;
    font-size: 1.6em;
  }

  @media (max-width: 768px) {
    body{
      background: linear-gradient(
        45deg,
        rgba(9, 100, 38, 0.7),  /* Greenish color with reduced blue and increased green */
        rgba(9, 100, 38, 0.7)
      );
    }
    .form-div {
      width: 90%;
      height: auto;
      position: static;
      margin: auto;
      padding: 20px;
    }
    .footer, .name {
      position: static;
      margin: 20px;
      text-align: center;
    }
  }

</style>

<main class="main">

  <header></header><!-- form -->
  <div class="form-div">
    <span><a href="/">Admin login</a></span>
    <div class="d-flex mb-5 mt-5 justify-content-center">
      <img class="img-fluid" src="{{url('assets/abdugbg.png')}}" alt="cbt" height="200" width="60%">
    </div>
    <form method="POST" action="{{ route('loginStudent') }}">
      @csrf
      <!-- .form-group -->
      <div class="form-group">
        <div class="form-label-group">
          <input id="text1" type="text" class="form-control @error('reg_no') is-invalid @enderror" name="reg_no" value="{{ old('reg_no') }}" autocomplete="email" autofocus>
          <label for="inputUser">Enter Matric number</label>
          @error('reg_no')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>  
      </div><!-- /.form-group -->

      <!-- .form-group -->
      <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
      </div><!-- /.form-group -->
      
      <!-- recovery links -->
      <div class="text-center pt-3">
        <a href="#" class="link">Forgot Password?</a>
      </div><!-- /recovery links -->
    </form><!-- /.auth-form -->
  </div>
  <!-- copyright -->
  
  <div class="name footer">
    Computer Based Test
  </div>
  <footer class="footer">
    ©2024 All Rights Reserved.
  </footer>
</main><!-- /.auth -->
@endsection
