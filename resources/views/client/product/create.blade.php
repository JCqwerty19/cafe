@extends('client.layouts.admin')

@section('title')
Create product
@endsection

@section('content')
<div class="container mt-5">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header text-center">
                   <h3>Create product</h3>
               </div>
               <div class="card-body">
                   <form action="{{ route('product.make') }}" method="POST">
                    @csrf
                        <div class="form-group">
                           <label for="image">Image</label>
                           <input type="text" class="form-control" name="image" id="image" placeholder="Put link to image" value="{{ old('image') }}">
                           @error('image')
                           <p class="text-danger">{{ $message }}</p>
                           @enderror
                       </div>
                       <div class="form-group">
                           <label for="title">Product name</label>
                           <input type="text" class="form-control" name="title" id="title" placeholder="Product title" value="{{ old('title') }}">
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
                       <div class="form-group">
                           <label for="price">Price for product</label>
                           <input type="text" class="form-control" name="price" id="price"  placeholder="Text here..." value="{{ old('price') }}">
                           @error('price')
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