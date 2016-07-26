@extends('layouts.app')
<?php $title="blocked"; ?>
@section('htmlheader_title')
    {{ trans('adminlte_lang::message.pagenotfound') }}
@endsection

@section('contentheader_title')
    Unauthorize Access
@endsection

@section('$contentheader_description')
@endsection

@section('main-content')

<div class="error-page">
    <h2 class="headline text-red"> 403</h2>
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Stop! Unauthorize Access is forbidden</h3>
        <p>
          Ypu do not have the permission to access this page.
          <a href='{{ url('/home') }}'>{{ trans('adminlte_lang::message.returndashboard') }}</a>
        </p>

    </div><!-- /.error-content -->
</div><!-- /.error-page -->
@endsection
