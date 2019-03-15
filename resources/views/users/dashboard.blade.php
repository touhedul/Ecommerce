@extends('layouts.user_profile')

@section('title')
Index
@endsection
@section('content')
<p><h3>Welcome {{$user->name}}</h3></p>
@endsection