<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use DB;
use GMaps;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all();

        $carNum = $cars->count();

        $config['center'] = 'auto';
        $config['zoom'] = '12';
        GMaps::initialize($config);

        foreach ($cars as $car) {
            
            $lat = $this->getLocation($car->location)['lat'];
            $lng = $this->getLocation($car->location)['lng'];

            $marker['position'] = $lat.','.$lng;
            $marker['infowindow_content'] = $car->name;
            $marker['icon'] = '/imgs/car.png';

            GMaps::add_marker($marker);

            
        }
        $map = GMaps::create_map();

        return view('cars.index', ['cars' => $cars, 'map' => $map, 'carNum' => $carNum]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
         'brand' => 'required',
         'seats' => 'required|integer',
         'name' => 'required',
         'price' => 'required|numeric',
         'location' => 'required',
         'status' => 'required',
         'plate' => 'required'
     ]);

        $car = Car::create($validatedData);
        
        return redirect('/cars');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return view('cars.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        return view('cars.edit',['car'=>$car]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        $validatedData = $request->validate([
         'brand' => 'required',
         'seats' => 'required|integer',
         'name' => 'required',
         'price' => 'required|numeric',
         'status' => 'required',
         'plate' => 'required'
        ]);

        $car->update($validatedData);

        return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect('/cars');
    }


    private function getLocation($address){

        $address = str_replace(' ', '+', $address);
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&key=AIzaSyD1q4rW7w9N4OWLFsYk642cLrTCn2YFe2g';
        $resp_json = file_get_contents($url);
        $resp = json_decode($resp_json, true);

        return $resp['results'][0]['geometry']['location'];
    }

}
