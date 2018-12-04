@extends('admin.layouts.basic')

@section('stylesheets')
	<link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
@endsection

@section('content')
<form id="dropzone" class="dropzone">
  <div class="dz-message" data-dz-message><span>Upload</span></div>
</form>

<div id="photos">
  <div class="ui four cards">
	 @foreach($photos as $photo)
    <div class="card">
      <div class="image">
        <img class="ui image" src="{{ $photo->getUrl }}" alt="Photo not found" title="{{$photo->filename}}" />
      </div>
     <div class="content">
      <div class="header">{{$photo->filename}}</div>
      <div class="meta">
        <a>jpg</a>
      </div>
{{--       <div class="description">
        Matthew is an interior designer living in New York.
      </div>
      </div>
      <div class="extra content">
        <span class="right floated">
          Joined in 2013
        </span>
        <span>
          <i class="user icon"></i>
          75 Friends
        </span>
      </div> --}}
      </div>
    </div>
    @endforeach
  </div>
{{--     <a data-model-id="{{ $photo->id }}" data-order-id="@if(!is_null($photo->id)){{ $photo->id }}@endif">
      <img src="{{ asset($photo->getMedia('images')->first()->getUrl('small')) }}" alt="Photo not found" title="{{$photo->filename}}" />
      <button class="btn drag-handle">
        <img src="{{asset('icons/move.svg')}}" width="20" height="20" />
      </button>
     <button type="submit" class="btn delete" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
      <img src="{{asset('icons/trash.svg')}}" width="20" height="20" />
     </button>
    <form id="delete-form" method="post" action="{{ route('photos.destroy', $photo->id) }}" style="display: none;">
      <input name="_method" type="hidden" value="DELETE" />
      {{ csrf_field() }}
    </form>
    </a> --}}
</div>
@endsection

@section('scripts')
	<script src="{{asset('js/admin.js')}}"></script>
	<script type="text/javascript">Dropzone.autoDiscover = false;</script>
@endsection