@extends('client.layouts.admin')

@section('title')
Create post
@endsection

@section('content')
<div class="container mt-5">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header text-center">
                   <h3>Create post</h3>
               </div>
               <div class="card-body">
                   <form action="{{ route('post.make') }}" method="POST">
                    @csrf
                       <div class="form-group">
                           <label for="title">Title</label>
                           <input type="text" class="form-control" name="title" id="title" placeholder="Text title" value="{{ old('title') }}">
                           @error('title')
                           <p class="text-danger">{{ $message }}</p>
                           @enderror
                       </div>
                       <div class="form-group">
                           <label for="content">Content</label>
                           <textarea class="form-control" name="content" id="content" rows="6" placeholder="Text here...">{{ old('content') }}</textarea>
                           @error('content')
                           <p class="text-danger">{{ $message }}</p>
                           @enderror
                       </div>
                       <button type="submit" class="btn btn-primary btn-block">Create</button>
                   </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection