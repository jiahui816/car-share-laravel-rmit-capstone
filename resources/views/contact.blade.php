@extends('layouts.app')
<head>
	<title>Car List</title>
</head>

@section('content')
<div class="container">

	<h2>About This Website</h2>
	<p>This assignment is for <strong>COSC2408(Programming Project 1)</strong>. Our team was requested to build an online car share system that shows the locations of cars and parking spaces for users to rent and return. In this car share web application, users and the manager are the main two types of users. User can book cars and returns cars. Manager can add cars, remove cars and track every cars’ location.
	</p>
	<br>
	<h2>Contact Details</h2>
	<table class="table">
    <thead class="thead-dark">
      <tr>
        <th>Student Number</th>
        <th>Name</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>s3666770</td>
        <td>Xinghao Li</td>
        <td>s3666770@student.rmit.edu.au</td>
      </tr>
      <tr>
        <td>s3687233</td>
        <td>Jia Hui Liou</td>
        <td>s3687233@student.rmit.edu.au</td>
      </tr>
      <tr>
        <td>s3626967</td>
        <td>Jinglai Li</td>
        <td>s3626967@student.rmit.edu.au</td>
      </tr>
      <tr>
        <td>s3644269</td>
        <td>Ziqi Huang</td>
        <td>s3644269@student.rmit.edu.au</td>
      </tr>
    </tbody>
  </table>
</div>

@endsection