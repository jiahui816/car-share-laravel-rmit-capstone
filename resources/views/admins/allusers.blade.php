@extends('layouts.app')

<head>
	<title>All users information</title>
    
</head>

@section('content')

	<div class="container">
		<table class="table">
		    <thead class="thead-light">
		      <tr>
		        <th>Name</th>
		        <th>Phone</th>
		        <th>Email</th>
		        <th>License No.</th>
		        <th>Address</th>
		        <th>Credit Card</th>
		      </tr>
		    </thead>
		    <tbody>
		    	@foreach($users as $user)
			      <tr>
			        <td>{{  $user->name  }}</td>
			        <td>{{  $user->phone  }}</td>
			        <td>{{  $user->email  }}</td>
			        <td>{{  $user->license  }}</td>
			        <td>{{  $user->address  }}</td>
			        <td>{{  $user->credit  }}</td>
			      </tr>
		      @endforeach
		    </tbody>
  </table>
	</div>
@endsection