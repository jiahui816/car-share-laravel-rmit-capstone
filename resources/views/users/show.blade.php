@extends('layouts.app')

<head>
	<title>My Details</title>
</head>

@section('content')

	<div class="container">
		<h2>My information</h2>
		<ul>
			<li>My Name: {{ $user->name }}</li>
			<li>My Email Address: {{ $user->email }}</li>
			<li>Phone Number: {{ $user->phone }}</li>
			<li>Home Address: {{ $user->address }}</li>
			<li>License Number: {{ $user->license }}</li>
		</ul>

		<h2>My Payment information</h2>
		<ul>
			<li>Credit Card Number: {{ $user->credit }}</li>
		</ul>

		<br>
		<br>

		<a href="/users/{{ $user->id }}/edit"><button class="btn btn-primary">Update My Info</button></a>

		<br>
		<br>
		<br>
		<br>
		<form action="/users/{!! $user->id !!}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account?');">
			@csrf
			@method('delete')
		<button class="btn btn-danger" type="submit">Delete My Account</button>
		</form>
		
	</div>

@endsection