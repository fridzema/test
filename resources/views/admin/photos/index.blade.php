@extends('admin.layouts.basic')

@section('stylesheets')
	<link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
@endsection

@section('content')
<form id="dropzone" class="dropzone">
  <div class="dz-message" data-dz-message><i class="upload icon"></i></div>
</form>

<div class="ui segment">
  <div class="ui four cards" id="photos">
   @foreach($photos as $photo)
    <div class="card" data-model-id="{{$photo->id}}">
      <div class="content">
        <div class="ui mini buttons right floated blue">
          <div class="ui icon button drag-handle"><i class="move icon"></i></div>
          <div class="ui icon button"><i class="pencil icon"></i></div>
          <div class="ui icon button" onclick="event.preventDefault(); document.getElementById('delete-form').submit();"><i class="trash icon"></i></div>
          <form id="delete-form" method="post" action="{{ route('photos.destroy', $photo->id) }}" style="display: none;">
            <input name="_method" type="hidden" value="DELETE" />
            {{ csrf_field() }}
          </form>
        </div>

        <div class="ui ribbon label black">{{$photo->filename}}</div>
        <div class="description">

        </div>
      </div>
      <div class="image">
        <img class="ui image" src="{{ $photo->url }}" alt="Photo not found" title="{{$photo->filename}}" />
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection

@section('scripts')
	<script src="{{asset('js/admin.js')}}"></script>
	<script type="text/javascript">Dropzone.autoDiscover = false;</script>
@endsection