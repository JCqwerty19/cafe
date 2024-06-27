@extends('client.layouts.admin')

@section('title')
Update post
@endsection

@section('content')
<div class="container mt-5">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header text-center">
                   <h3>Update post</h3>
               </div>
               <div class="card-body">
                   <form action="{{ route('post.renew', $post) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                            <label for="image">Image</label><br>
                            <img src="{{ asset($post->image) }}" alt="{{ $post->name }}"><br><br>
                            <select id="image-source" onchange="toggleImageInput()">
                                <option value="file">Upload File</option><br>
                                <option value="url">Image URL</option>
                            </select>
                            <div id="file-input" style="display: none;">
                                <input type="file" id="image-file">
                            </div>
                            <div id="url-input" style="display: none;">
                                <input type="url" id="image-url">
                            </div>
                           @error('image')
                           <p class="text-danger">{{ $message }}</p>
                           @enderror
                        </div>
                       <div class="form-group">
                           <label for="title">Title</label>
                           <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{ $post->title }}">
                           @error('title')
                           <p class="text-danger">{{ $message }}</p>
                           @enderror
                       </div>
                       <div class="form-group">
                           <label for="content">Content</label>
                           <textarea class="form-control" name="content" id="content" rows="6" placeholder="Text here...">{{ $post->content }}</textarea>
                           @error('content')
                           <p class="text-danger">{{ $message }}</p>
                           @enderror
                       </div>
                       <div class="form-group">
                           <label for="price">Price for post</label>
                           <input type="text" class="form-control" name="price" id="price"  placeholder="Text here..." value="{{ $post->price }}">
                           @error('price')
                           <p class="text-danger">{{ $message }}</p>
                           @enderror
                       </div>
                       <button type="submit" class="btn btn-primary btn-block">Update</button>
                   </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection