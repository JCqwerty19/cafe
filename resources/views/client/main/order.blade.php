@extends('client.layouts.main')

@section('title')
Cafe
@endsection

@section('content')

<!-- start banner Area -->
<section class="gallery-area section-gap">
	<div class="container mt-5">
        <h1 class="text-center mb-4">Choice!</h1>

		<!-- products cascading -->
        <div class="row">			
			@foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->content }}</p>
						<h5 class="card-text">${{ $product->price }}</h5><br>
                        <button class="btn btn-success" onclick="addToCart('{{ $product->name }}', '{{ $product->price }}', '{{ $product->id }}')">Add</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

		<!-- end products cascading -->
		
		<!-- form -->
		<form action="{{ route('order.make') }}" method="POST">
			@csrf

			
			
			<!-- Clear cart button -->
			<button type="button" class="btn btn-danger btn-sm" onclick="clearCart()">Clear cart</button>
			<br><br>

			<!-- products table -->
			<table class="table table-bordered table-striped">
				<thead class="thead-dark">
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Price for one</th>
						<th>Amount</th>
						<th>Total price</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody id="table-body">
				
				</tbody>
			</table>
			<!-- end products table -->

			<!-- personal info -->
			<div class="container mt-5">
    			<h2>Set your info</h2>
    			<div class="form-group">
    			    <label for="name">Name</label>
    			    <input type="text" class="form-control" name="customer_name" id="name" placeholder="Text your name" value="{{ old('customer_name') }}">
					@error('customer_name')
					<p class="text-danger">{{ $message }}</p>
					@enderror
    			</div>
    			<div class="form-group">
    			    <label for="phone">Phone number</label>
    			    <input type="tel" class="form-control" name="customer_phone" id="phone" placeholder="Text your phone number" value="{{ old('customer_phone') }}">
					@error('customer_phone')
					<p class="text-danger">{{ $message }}</p>
					@enderror
    			</div>
    			<div class="form-group">
    			    <label for="deliveryOption">Obtaining method</label>
    			    <select class="form-control" name="obtaining" id="deliveryOption" value="{{ old('obtaining') }}" onchange="toggleAddressField()">
    			        <option value="pickup">Pickup</option>
						<option value="hall">Cafe</option>
    			        <option value="delivery">Delivery</option>
    			    </select>
					@error('obtaining')
					<p class="text-danger">{{ $message }}</p>
					@enderror
    			</div>

				

    			<div class="form-group d-none" id="addressField">
    			    <label for="address">Address</label>
    			    <input type="text" class="form-control" name="address" id="address" placeholder="Text your address" value="{{ old('address') }}">
					@error('address')
					<p class="text-danger">{{ $message }}</p>
					@enderror
					<br>
    			</div>

				<h6>Order price: $<span id="order-price">0</span></h6>
				

				<h6 id="additionalPriceType">Additional Price: $<span id="additionalPriceInt">0</span><input type="text" id="additionalPriceInput" name="additional_price" class="invisible" value=""></h6>

				<!-- Total price -->
				<h2>Total price: $<span id="total-price">0</span></h2>
				<input type="text" name="total_price" class="invisible" id="total_price_input" value=""><br>
    			<button type="submit" class="btn btn-primary">Sent</button>
			</div>
			<!-- end personal info -->
		</form>
		<!-- end form -->
    </div>
</section>

@endsection