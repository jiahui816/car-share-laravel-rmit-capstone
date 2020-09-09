@extends('layouts.app')

@section('content')


	<div class="container">
		<h2>Add a new Car</h2>
		<div class="form-group">
			<form action="/cars" method="POST">
				<p>Brand:</p>
				<input class="form-control" type="text" name="brand" name="brand">

				<p>Name:</p>
				<input class="form-control" type="text" name="name" name="car_name">

				<p>Seats Number:</p>
				<input class="form-control" type="number" name="seats" step="1" min="1">

				<p>Status:</p>
				<select class="form-control" name="status" >
					<option value="available">Available</option>
					<option value="unavailable">Unavailable</option>
				</select>

				<p>Plate number:</p>
				<input type="text" name="plate" class="form-control" >

				<p>Price:</p>
				<input class="form-control" type="number" name="price" min="0.00" step="0.01">

				<p>Location:</p>
				<input class="form-control" type="text" name="location">

				<br>
				
				<button type="submit" class="btn btn-primary"> Add </button>

				@csrf
			</form>

		</div>

	</div>


@endsection