@extends('layouts.app')

<head>
	<title>My Booking History</title>
</head>

@section('content')

<div class="container">

@if($pastBookings->count() === 0)
	<h2>You don't have any finished bookings!</h2>

@else
    	<table class="table">
    		<thead class="thead-dark">
    			<th>Car Brand</th>
                <th>Car name</th>
                <th>Booking date</th>
                <th>Booking hours</th>
                <th>Booking charge</th>
    		</thead>
    		<tbody>
    			@foreach($pastBookings as $pastBooking)
    				<tr>
    				<td>{{ $pastBooking->brand }}</td>
                    <td>{{ $pastBooking->name }}</td>
    				<td>{{ $pastBooking->created_at }}</td>
    				<td>{{ $pastBooking->hours }}</td>
                    <td>${{ $pastBooking->charge }}</td>
    				<tr>
    			@endforeach
    		</tbody>
    	</table>

@endif

</div>

@endsection