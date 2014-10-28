@extends('template/structure')

@section('content')
  <div class="row">
    <div class="col-md-3">
       <a href="#" class="thumbnail">
         <img src="http://placehold.it/250x250">
       </a>
    </div>
    <div class="col-md-9">
      <div class="panel panel-primary">
        <div class="panel-heading">
          {{ $user->getUsername()."'s " }}Profile
        </div>
        <div id="signupbox" class="panel-body">
          <form class="form-horizontal" role="form" action="{{ action('CustomerController@editProfile') }}" method="POST">
            <ul class="errors">
              @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
              @endforeach
            </ul>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="email">E-mail</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="email"
                   id="email" placeholder="Enter Email"
                   value="{{$user->getEmail()}}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="email">Phone</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="phone"
                   id="phone" placeholder="Enter Phone Number"
                   value="{{$user->getPhone()}}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="address">Address</label>
                <div class="col-sm-10">
                  <textarea id="address" name="address" class="form-control" 
                    rows="5" placeholder="Enter Address">{{$user->getAddress()}}</textarea>
                </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label" for="current-password">Current Password</label>
              <div class="col-sm-10">
              <input type="password" class="form-control" name="current-password"
                 id="password" placeholder="Enter current password">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label" for="password">New Password</label>
              <div class="col-sm-10">
              <input type="password" class="form-control" name="password"
                 id="password" placeholder="Enter password">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label" for="password_confirmation">Confirm Password</label>
              <div class="col-sm-10">
              <input type="password" class="form-control" name="password_confirmation"
                 id="password-confirm" placeholder="Confirm password">
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="col-sm-offset-5 btn btn-primary">Edit</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div> <!-- /div-row -->
@stop
