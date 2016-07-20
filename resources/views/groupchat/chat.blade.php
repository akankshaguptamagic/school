<?php $title="chat"; ?>
@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

<div id="ChatBig">
    <div id="ChatMessages" style="overflow:auto;padding-bottom:auto;"></div>
    <br/>
    <div class="col-lg-12">
      <div align="left">
        <input type="text" id="text" class="form-control col-lg-12"  style="width:90%;float:left" ><br/><br/>
        <button type="submit" class="btn btn-success" name="msg_send" value="SEND" style="float:left">SEND</button>
      </div>
    </div>
  </div>
@endsection
@section('script')
<script>


</script>

@endsection
