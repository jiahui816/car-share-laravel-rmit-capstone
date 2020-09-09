@extends('layouts.app')

<head>
	<title>Make your payment</title>
	
</head>

@section('content')
	
	<div class="container">
		<h2>Make Your Payment</h2>

		<h3>Car information</h3>
		<ul>
			<li>Car Brand: {{ $car->brand }}</li>
			<li>Car Name: {{ $car->name }}</li>
			<li>Price/Hour: ${{ $car->price }}</li>
		</ul>

		<h3>Charge information</h3>
		<ul>
			<li>Total time used: {{ $hours }} hours</li>
			<li>Total charge: ${{ $charge }}</li>
		</ul>

		<h3>Payment method</h3>
		<ul>
			<li>Credit Card Number: {{ $user->credit }}</li>
			<li>Customer Name: {{ $user->name }}</li>
			<li>Bill Address: {{ $user->address }}</li>
		</ul>

		<div class="form-group">
			<form action="/bookings/{{ $booking->id }}" method="POST">
				@csrf
				@method('PATCH')
				<p>Current Location: </p>
				<input type="text" name="location" required class="form-control">
				<input type="hidden" name="charge" value = {{ $charge }}>
				<input type="hidden" name="hours" value = {{ $hours }}>
				<br>
				<br>

				<button type="submit" class="btn btn-primary"> Submit </button>		
			</form>
		</div>
	</div>

@endsection