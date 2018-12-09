@extends('admin.layouts.basic')

@section('content')
  <uploader></uploader>
  <photo-grid></photo-grid>
@endsection

@section('scripts')
	<script src="{{asset('js/admin.js')}}"></script>
	<script type="text/javascript">Dropzone.autoDiscover = false;</script>
@endsection