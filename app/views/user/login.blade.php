@extends('template.base')

@section('body')
  <div class="row">
    <div class="col-lg-8 col-lg-offset-2">
      <div class="panel panel-info">
        <div class="panel-heading">
          Log In
        </div>
        <div id="signupbox" class="panel-body">
          <form class="form-horizontal" role="form" action="{{ url('login') }}" method="POST">
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
              <button type="submit" class="col-sm-offset-5 btn btn-primary">Log In</button>
            </div>

            <hr/>
            Doesn't have account? Sign up <a href="{{ url('signup')}}" >here</a>
          </form>
        </div>
      </div>
    </div> <!-- /col -->
  </div>
@stop
