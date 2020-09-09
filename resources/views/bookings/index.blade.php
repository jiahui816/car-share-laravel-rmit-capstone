@extends('layouts.app')

<head>
	<title>Find a Car</title>
	
    {!! $map['js'] !!}

    @if($show === 2)
    <script type="text/javascript">

        var countDownDate = new Date(new Date("{{ $bookinginfo->created_at }}").getTime() + 15*60000)

        var x = setInterval(function() {

        var now = new Date().getTime();
        var distance = countDownDate - now;
        
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("free_time").innerHTML = minutes + " : " + seconds;

        if (distance < 0) {
            clearInterval(x);
            document.getElementById("free_time").innerHTML = "Your free time has used out.";
          }
        }, 1000);

   
    </script>
    @endif
</head>

@section('content')

<div class="row">

    @if($show === 2)
        <div class="container">

            <h2>Your Current Booking Information</h2>
            <br>
            <h3>Car information</h3>
            <ul>
                <li>Car Name: {{ $car->brand }} {{ $car->name }}</li>
                <li>Current Location: {{ $car->location }}</li>
                <li>Plate Number: </li>
            </ul>

            <br>
            <h3>Booking Information</h3>
            <ul>
                <li>Booking starts at: {{ $bookinginfo -> created_at}}</li>
                <li>Price/Hour: {{ $car->price }}</li>
            </ul>
            <h3>You have 15 minutes free time to use this car.</h3>
            <h4>Free time left:</h4>
            <p id="free_time"></p>
            {!! $map['html'] !!}
            <a href="bookings/{{ $bookinginfo->id }}/edit"><button class="btn btn-primary">Return Car</button></a>

        </div>
    @else

    
	<div class="col-4">
    	<table class="table">
    		<thead class="thead-dark">
    			<th>Car name</th>
    			<th>Seats Number</th>
    			<th>Price / Day</th>
    			<th>Book</th>
    		</thead>
    		<tbody>
    			@foreach($cars as $car)
    				<tr>
    				<td>{{ $car->brand }} {{ $car->name }}</td>
    				<td>{{ $car->seats }}</td>
    				<td>${{ $car->price }}</td>
    				<td>
                        <form action="/bookings/create" method="GET">
                            @csrf
                            <input type="hidden" name="car_id" value={{ $car->id }}>
                            <button type ='submit' class="btn btn-primary">Book</button>
                        </form>
                    </td>
    				<tr>
    			@endforeach
    		</tbody>
    	</table>

    </div>

	<div class="col-8"> 
		<h2>Find a Car near you</h2>
		{!! $map['html'] !!}
    </div>
    @endif
    

</div>
@endsection
