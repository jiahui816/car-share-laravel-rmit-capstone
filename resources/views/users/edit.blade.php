@extends('layouts.app')

<head>
	<title>Update My Info</title>
	
</head>

@section('content')
	
	<div class="container">
		<h2>Update My Info</h2>

		<div class="form-group">
			<form action="/users/{{ $user->id }}" method="POST">
				@csrf
				@method('PATCH')
				<p>Name:</p>
				<input type="text" name="name" class="form-control" value = "{{ $user->name }}">
				<p>Phone:</p>
				<input type="text" name="phone" type="tel" class="form-control" value = "{{ $user->phone }}">
				<p>Email:</p>
				<input type="text" name="email" type="email" class="form-control" value = "{{ $user->email }}">
				<p>Address:</p>
				<input type="text" name="address" class="form-control" value = "{{ $user->address }}">
				<p>License Number:</p>
				<input type="text" name="license" class="form-control" value = "{{ $user->license }}">
				<br>

				<h2>My Payment Info</h2>
				<p>Credit Card Number:</p>
				<input type="text" name="credit" class="form-control" value = "{{ $user->credit }}">
				<br>

				<button type="submit" class="btn btn-primary">Update</button>		
			</form>
		</div>
	</div>

@endsection