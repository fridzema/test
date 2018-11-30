@extends('frontend.layouts.basic')

@section('content')
	<img src="{{ asset($photo->getMedia('images')->first()->getUrl('large')) }}" alt="Photo-{{ $photo->id }}" width="1800" />
@endsection