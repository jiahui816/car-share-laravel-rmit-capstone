<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Car;
use Illuminate\Http\Request;
use DB;
use GMaps;
use Auth;
use Carbon\Carbon;
use Redirect;
use Session;
use URL;
use Srmklive\PayPal\Services\ExpressCheckout;

class BookingController extends Controller
{   
    public function index()
    {   
        $show = 1;

        $user = Auth::user();
        $uid = $user->id;
        $isBooking = DB::table('bookings')->where([
            ['user_id', '=', $uid],
            ['status', '=', 'booking']
        ])->get();

        $config['center'] = 'auto';
        $config['zoom'] = '12';

        if($isBooking->count()==1){

            $show = 2;

            $bookinginfo = $isBooking->toArray()[0];

            $car = $this->getCar($bookinginfo->car_id);

            $lat = $this->getLocation($car->location)['lat'];
            $lng = $this->getLocation($car->location)['lng'];

            $config['directions'] = 'true';
            $config['directionsStart'] = 'auto';
            $config['directionsEnd'] = $lat.','.$lng;
            $config['directionsDivID'] = "";

            GMaps::initialize($config);

            $marker['position'] = $lat.','.$lng;
            $marker['infowindow_content'] = $car->name;
            $marker['icon'] = '/imgs/car.png';

            GMaps::add_marker($marker);

            $map = GMaps::create_map();

            return view('bookings.index',['show' => $show, 'car' => $car, 'bookinginfo' => $bookinginfo,'map' => $map,'lat'=>$lat, 'lng'=>$lng]);
        }

        GMaps::initialize($config);

        $cars = DB::select('select * from cars where status = ?', ['available']);   

        foreach ($cars as $car) {

            $lat = $this->getLocation($car->location)['lat'];
            $lng = $this->getLocation($car->location)['lng'];

            $marker['position'] = $lat.','.$lng;
            $marker['infowindow_content'] = $car->name;
            $marker['icon'] = '/imgs/car.png';
        
            GMaps::add_marker($marker);
            
        }

        $map = GMaps::create_map();
        
        return view('bookings.index', ['map' => $map, 'cars' => $cars, 'show' => $show]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request){

        $user = Auth::user();
        $car_id = $request->input('car_id');
        $car = $this->getCar($car_id);

        return view('bookings.create', ['car' => $car, 'user' => $user]);
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
         'car_id' => 'required',
         'user_id' => 'required',
        ]);

        $booking = Booking::create($validatedData);

        DB::table('cars')->where('id', $request->car_id)->update(['status' => 'booking']);

        return redirect('/bookings');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = Auth::user();
        $booking = $this->getBooking($id);

        if (($user->id === $booking->user_id) && ($booking->status === "booking")) {

            $now = Carbon::now();
            $min = $now->diffInMinutes($booking->created_at);
            $hours = 0;
            $charge = 0;

            $car = $this->getCar($booking->car_id);

            if ($min < 60) {
                    $charge = $car->price;
                    $hours = 1;
            }else{
                $hours = ceil($min / 60);
                $charge = $hours * $car->price;
            }


            return view('bookings.edit',['booking' => $booking, 'car' => $car, 'hours' => $hours, 'charge' => $charge, 'user' => $user]);
        }
        
        return redirect('/bookings');
    }


    public function update(Request $request, $id)
    {
        $charge = $request -> input('charge');

        $location = $request -> input('location');
        $hours = $request -> input('hours');
        $booking = $this->getBooking($id);
        DB::table('cars')->where('id', $booking ->car_id)->update(['location' => $location]);
        DB::table('bookings')->where('id', $id)->update(['hours' => $hours]);
        DB::table('bookings')->where('id', $id)->update(['charge' => $charge]);

        $data = [];
        $data['items'] = [
            [
                'name' => 'Car Share',
                'price' => $charge,
                'qty' => 1
            ]
        ];
  
        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order Invoice";
        $data['return_url'] = url('/users/finishPayment/'.$id);
        $data['cancel_url'] = url('/bookings');
        $data['total'] = $charge;
  
        $provider = new ExpressCheckout;
  
        $response = $provider->setExpressCheckout($data);

        return redirect($response['paypal_link']);
    }

    public function finishPayment($id){

        $booking = $this->getBooking($id);
        DB::table('bookings')->where('id', $id)->update(['status' => 'finished']);

        DB::table('cars')->where('id', $booking ->car_id)->update(['status' => 'available']);
        

        return redirect('/bookings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function past($id)
    {   
        if ($id != Auth::user()->id) {
            return redirect('/bookings');
        }

        $pastBookings = DB::table('bookings')->join('cars', 'bookings.car_id','=','cars.id')
        ->select('cars.brand','cars.name','bookings.created_at','bookings.hours','bookings.charge')
        ->where(['user_id' => $id],['bookings.status' => 'finished'])
        ->get();

        return view('bookings.past', ['pastBookings' => $pastBookings]);
    }


    private function getLocation($address){

        $address = str_replace(' ', '+', $address);
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&key=AIzaSyD1q4rW7w9N4OWLFsYk642cLrTCn2YFe2g';
        $resp_json = file_get_contents($url);
        $resp = json_decode($resp_json, true);

        return $resp['results'][0]['geometry']['location'];
    }


    private function getBooking($id){

        $booking = DB::table('bookings')->where('id', $id)->first();
        return $booking;
    }

    private function getCar($id){
        $car = DB::table('cars')->where('id', $id)->first();
        return $car;
    }

}
