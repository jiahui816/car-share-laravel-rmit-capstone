@extends('layouts.app')

<head>
	<title>Confirm Booking</title>
    
</head>

@section('content')

<div class="container">
	<h2>Confirm Booking</h2>
	<br>
	
	<div class="row">
		
		<div class="col-6">		
			<h3>Car Information</h3>
			<p>Car Brand: {{ $car->brand }}</p>
			<p>Car Name: {{ $car->name }}</p>
			<p>Seats Number: {{ $car->seats }}</p>
			<p>Price/Hour: ${{ $car->price }}</p>
			<p>Location: {{ $car->location }}</p>
		</div>

		<div class="col-6">
			<h3>Customer Information</h3>
			<p>Customer Name: {{ $user->name }}</p>
			<p>License Number: {{ $user->license }}</p>
		</div>

	</div>

		<form action="/bookings" method="POST" >
			@csrf
			<input type="hidden" name="car_id" value={{ $car->id }}>
			<input type="hidden" name="user_id" value={{ $user->id }}>
			<input type="hidden" name="status" value="booking">
			<button type="submit" class="btn btn-primary">Confirm</button>
		</form>

</div>


@endsection