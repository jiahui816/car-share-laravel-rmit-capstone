@extends('layouts.app')

<head>
	<title>Update Car</title>
	
</head>

@section('content')
	
	<div class="container">
		<h2>Update Car</h2>

		<div class="form-group">
			<form action="/cars/{{ $car->id }}" method="POST">
				@csrf
				@method('PATCH')
				<p>Car Brand:</p>
				<input type="text" name="brand" class="form-control" value = "{{ $car->brand }}">

				<p>Car Name:</p>
				<input type="text" name="name" class="form-control" value = "{{ $car->name }}">
				
				<p>Price:</p>
				<input type="number" name="price" min="1" class="form-control" value = "{{ $car->price }}">

				<p>Seats:</p>
				<input type="number" name="seats" min="1" class="form-control" value = "{{ $car->seats }}">

				<p>Plate number:</p>
				<input type="text" name="plate" class="form-control" value = "{{ $car->plate }}">

				<p>Status:</p>
				<select class="form-control" name="status" value = "{{ $car->status }}">
					<option value="available">Available</option>
					<option value="unavailable">Unavailable</option>
				</select>

				
				<button type="submit" class="btn btn-primary">Update</button>		
			</form>
		</div>
	</div>

@endsection