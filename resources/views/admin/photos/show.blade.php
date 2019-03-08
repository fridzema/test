@extends('admin.layouts.basic')

@section('content')
{{-- {{dd($photo)}} --}}
{{--   <div class="ui styled fluid accordion">
    <div class="active title">
      <i class="dropdown icon"></i>
      Info
    </div>
    <div class="active content">

    </div>
    <div class="title">
      <i class="dropdown icon"></i>
      How do you acquire a dog?
    </div>
    <div class="content">
      <p>Three common ways for a prospective owner to acquire a dog is from pet shops, private owners, or shelters.</p>
      <p>A pet shop may be the most convenient way to buy a dog. Buying a dog from a private owner allows you to assess the pedigree and upbringing of your dog before choosing to take it home. Lastly, finding your dog from a shelter, helps give a good home to a dog who may not find one so readily.</p>
    </div>
  </div> --}}


  <div class="ui segment">
    <div class="ui ribbon label">{{$photo->filename}}</div>
    <br />
    <br />
    <img src="{{$photo->thumbnails['1000']}}" class="ui image fluid" />

  </div>
@endsection