@extends('template.base')

@section('body')
  <h1> <?php if(isset($user)) echo "Welcome $user->username !!!"?> This is home page</h1>
  <p>Coming Soon :3</p>
@stop
