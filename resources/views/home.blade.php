@extends('layouts.app')

@section('content')
<div class="container mb-5 mt-5">
    <div class="row">
        <h1 class="col-4 ml-5">Hi</h1>
    </div>
    <div class="row">
    <form class="col ml-5 mr-5" action="{{route('home-new-post')}}" method="POST">
          <div class="form-group">
            <label for="judul-baru">Judul</label>
            <input type="text" class="form-control" name="judul-baru" id="judul-baru">
          </div>
          <div class="form-group">
            <label for="isi-baru">Isi</label>
            <textarea class="form-control" name="isi-baru" id="isi-baru" cols="30" rows="10"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Posting!</button>
          @csrf
        </form>
    </div>
    <div class="row justify-content-center mt-5 mb-3">
        <div class="col-2">
            <h2>Postingan</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        @if (!isset($posts))
            <div class="col-1">
                <small>Kosong.</small>
            </div>
        @else
        @foreach ($posts as $post)
        <div class="card col-4 m-1">
            <div class="card-body">
                @if (!Auth::user()->admin)
                @if ($post->published)
                <span class="badge badge-primary">Published</span>
                @else
                <span class="badge badge-secondary">Unpublished</span>
                @endif
                @endif
                <br>
                <h4 class="card-title">
                    {{$post['title']}}
                </h4>
            <h6 class="card-subtitle mb-2 text-muted">Dibuat oleh: {{$post['author']}}</h6>
            <p class="card-text">{{$post['value']}}</p>
            @if (Auth::user()->admin)
            <form action="{{ route('home-publish') }}" method="POST" class="text-right">
            @method('PUT')
            <input type="hidden" name="id" value="{{$post->id}}">
            @if ($post->published)
                <button type="submit" class="btn btn-outline-secondary" name="publish" value="0">Unpublish</button>
                @else
                <button type="submit" class="btn btn-primary" name="publish" value="1">Publish</button>
                @endif
            @csrf
            </form>
            @endif
            </div>
        </div>
        @endforeach
        @endif
</div>
@endsection
