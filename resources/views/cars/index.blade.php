@extends('layouts.app')

<head>
	<title>Car List</title>
    {!! $map['js'] !!}
    <script type="text/javascript">

        @for($i = 0; $i < $carNum; $i++)
            var marker_{!! $i !!};
            setInterval(function(){
                updatePosition(marker_{!! $i !!});
                }
                ,300);
        @endfor

        function updatePosition (marker){
            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();
            
            var newValues = randomMoving(lat, lng);
            lat = newValues[0];
            lng = newValues[1];
            marker.setPosition(new google.maps.LatLng(lat,lng));
        }

        function randomMoving(lat, lng){
            var num = Math.floor(Math.random() * 3) + 1
            if (num == 1) {
                return [lat-0.00001, lng-0.0001];
            }else if (num == 2) {
                return [lat+0.00001, lng-0.0001];
            }else if (num == 3) {
                return [lat+0.00001, lng+0.0001];
            }else{
                return [lat-0.00001, lng+0.0001];
            }
        }

    </script>
</head>

@section('content')

<div class="container">
 <h2>Real time map</h2>
 {!! $map['html'] !!}

 <br>

<h2>All cars information</h2>
 <table class="table">
    <thead class="thead-dark">
      <tr>
        <th>Car ID</th>
        <th>Car Brand</th>
        <th>Car Name</th>
        <th>Price/Hour</th>
        <th>Status</th>
        <th>Plate Number</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($cars as $car)
      <tr>
        <td>{{ $car->id }}</td>
        <td>{{ $car->brand }}</td>
        <td>{{ $car->name }}</td>
        <td>${{ $car->price }}</td>
        <td>{{ $car->plate }}</td>
        <td>{{ $car->status }}</td>
        <td>
            <a href="/cars/{{ $car->id }}/edit"><button class="btn btn-primary">Update</button></a>
            <form action="/cars/{!! $car->id !!}" method="POST" onsubmit="return confirm('Are you sure you want to delete this car?');">
            @csrf
            @method('delete')
            <button class="btn btn-danger" type="submit">Delete</button>
            </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>

</div>
@endsection
