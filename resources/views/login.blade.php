@extends('templates.form')
@section('title', 'Login')

@section('form')

<div id="register-forum">
<form class="form-horizontal" action='login' method="POST">
    {{csrf_field()}}
  <fieldset>
    <div id="legend">
      <legend class="">Login</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Username</label>
      <div class="controls">
        <input type="text" id="username" name="username" placeholder="" class="input-xlarge">
     
      </div>
    </div>
 
   
  
    <div class="control-group">
      <!-- Password-->
      <label class="control-label" for="password">Password</label>
      <div class="controls">
        <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
    
      </div>
    </div>
 
   
 
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
          <br>
        <button name="login" type="submit" class="btn btn-success">Login</button>
        
      </div>
    </div>
      @if(isset($reg_suc))
      {{$reg_suc}}
      @endif
  </fieldset>
</form>
  
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    




@endsection