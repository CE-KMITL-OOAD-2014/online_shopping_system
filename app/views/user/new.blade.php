@extends('template.structure')

@section('content')
  <div class="row">
    <div class="col-lg-8 col-lg-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">
          Sign Up
        </div>
        <div id="signupbox" class="panel-body">
          <form class="form-horizontal" role="form" action="{{ action('CustomerController@create') }}" method="POST">
            <ul class="errors">
              @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
              @endforeach
            </ul>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="username">Username</label>
              <div class="col-sm-10">
              <input type="text" class="form-control" name="username"
                 id="username"
                 placeholder="Enter Username">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label" for="password">Password</label>
              <div class="col-sm-10">
              <input type="password" class="form-control" name="password"
                 id="password" placeholder="Enter password">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label" for="password_confirmation">Password</label>
              <div class="col-sm-10">
              <input type="password" class="form-control" name="password_confirmation"
                 id="password-confirm" placeholder="Confirm password">
              </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="email">E-mail</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="email"
                   id="email" placeholder="Enter Email">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="email">Phone</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="phone"
                   id="phone" placeholder="Enter Phone Number">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="address">Address</label>
                <div class="col-sm-10">
                  <textarea id="address" name="address" class="form-control" rows="5" placeholder="Enter Address"></textarea>
                </div>
            </div>

            <div class="form-group">
              <button type="submit" class="col-sm-offset-5 btn btn-primary">Sign Up</button>
            </div>


          </form>
        </div>
      </div>
    </div> <!-- /col -->
  </div>
@stop
