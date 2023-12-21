@extends('user_template.layouts.user_profile_template')
@section('profilecontent')
Welcome {{Auth::user()->name}} 
@endsection