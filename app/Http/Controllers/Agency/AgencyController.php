<?php

namespace App\Http\Controllers\Agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CarProducer;
use App\Car;
use App\Images;
use App\Location;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;




class AgencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.role:Admin,Agency');
    }

    // list of all Producers
    public function getProducerList(Request $request)
    {

        $carProducerList = CarProducer::all();
        
        if(count($carProducerList)){
            return response()->json([
                'status' => true, 
                'data' => $carProducerList, 
                'msg' => 'Car Producer List Retrieved Successfully.'
            ]);
        }else{
            return response()->json([
                'status' => true, 
                'data' => ['empty'], 
                'msg' => 'no car producer found with this query string.'
            ], 404);
        }
    }

    // get producer by id
    public function getProducer(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);

        $carproducer = CarProducer::find($request->id);
        
        if($carproducer !== NUll){
            return response()->json([
                'status' => true, 
                'data' => $carproducer, 
                'msg' => 'Car Producer Retrieved Successfully.'
            ]);
        }else{
            return response()->json([
                "message" => "no car producer found with this query string."
            ], 404);
        }
    }

    // add new Car
    public function createCar(Request $request)
    {
        $this->validate($request, [
            'model' => 'required',
            'owner_id' => 'required',
            'producer_id' => 'required',
            'sell_price' => 'required',
        ]);
       
        $car = new Car;
        $car->model = $request->model;
        $car->producer_id = $request->producer_id;
        $car->colour = $request->colour;
        $car->owner_id = $request->owner_id;
        $car->sell_price = $request->sell_price;
        $car->capacity = $request->capacity;
        
        $car->save();

        $car_id = DB::getPdo()->lastInsertId();

        if(count($request->images) > 0){
            foreach($request->images as $value){
                $image = new Images;
                $image->car_id = $car_id;
                $image->image = $value;
                $image->save();
            }
        }

        return response()->json([
            "message" => "Car Record Created"
        ], 201);
    }

    // Delete Car .
    public function deleteCar(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);

        Car::where('id', $request->id)->delete();

        return response()->json([
            "message" => 'Car Deleted successfully',
        ], 201);
    }

    // edit Car.
    public function editCar(Request $request)
    {
        $this->validate($request, [
            'model' => 'required',
            'id' => 'required',
            'producer_id' => 'required',
            'sell_price' => 'required',
        ]);
       
        Car::where('id', $request->id)
                    ->update(array('model' => $request->model, 'producer_id' => $request->producer_id,
                    'colour' => $request->colour, 'car_status' => $request->car_status,
                    'sell_price' => $request->sell_price, 'capacity' => $request->capacity));

        if(!empty($request->images)){
            if(count($request->images) > 0){
                foreach($request->images as $value){
                    $image = new Images;
                    $image->car_id = $request->id;
                    $image->image = $value;
                    $image->save();
                }
            }
        }
        
                
        return response()->json([
            "message" => 'Car Updated Successfully',
        ], 201);
    }

    // list of all Agency Cars
    public function getAgencyCarList(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);

        $carList = Car::where('owner_id', $request->id)
               ->get();
        
        if(count($carList)){
            return response()->json([
                'status' => true, 
                'data' => $carList, 
                'msg' => 'Agency Car List Retrieved Successfully.'
            ]);
        }else{
            return response()->json([
                'status' => true, 
                'data' => ['empty'], 
                'msg' => 'no car found with this query string.'
            ], 404);
        }
    }

    // list of all Agency Sold Cars
    public function getAgencySoldCarList(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);

        $soldCarList = Car::where('owner_id', $request->id)
                ->where('car_status', 'Sold')
                ->get();
        
        if(count($soldCarList)){
            return response()->json([
                'status' => true, 
                'data' => $soldCarList, 
                'msg' => 'Agency Sold Car List Retrieved Successfully.'
            ]);
        }else{
            return response()->json([
                'status' => true, 
                'data' => ['empty'], 
                'msg' => 'no car found with this query string.'
            ], 404);
        }
    }

    // list of all Agency Waiting Cars
    public function getAgencyWaitingCarList(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);

        $waitingCarList = Car::where('owner_id', $request->id)
                ->where('published', 'Not Published')
                ->get();
        
        if(count($waitingCarList)){
            return response()->json([
                'status' => true, 
                'data' => $waitingCarList, 
                'msg' => 'Agency Waiting Car List Retrieved Successfully.'
            ]);
        }else{
            return response()->json([
                'status' => true, 
                'data' => ['empty'], 
                'msg' => 'no car found with this query string.'
            ], 404);
        }
    }

    // Search for cars
    public function searchCar(Request $request)
    {

        $carList = Car::all();
        
        if(count($carList)){
            return response()->json([
                'status' => true, 
                'data' => $carList, 
                'msg' => 'Car List Retrieved Successfully.'
            ]);
        }else{
            return response()->json([
                'status' => false, 
                'data' => [], 
                'msg' => 'no car found with this query string.'
            ], 404);
        }
    }

    // get car by id
    public function getCar(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);
        $car = Car::find($request->id);
        
        if($car !== NUll){
            $car->images = $car->images;
            return response()->json([
                'status' => true, 
                'data' => $car, 
                'msg' => 'Car Retrieved Successfully.'
            ]);
        }else{
            return response()->json([
                'status' => false, 
                'data' => [], 
                'msg' => 'no car found with this query string.'
            ], 404);
        }
    }

    // add File
    public function addCarImages(Request $request)
    {
        $this->validate($request, [
            'images' => 'required',
        ]);

        $links = [];
        foreach($request->images as $key => $image){
            if(!$image->isValid()) {
                return response()->json(['invalid_file_upload'], 400);
            }
            $path = public_path() . '/uploads/images/store/';
            $image->move($path, $image->getClientOriginalName());
            $links[$key] = '/uploads/images/store/'.$image->getClientOriginalName();
        }

    return response()->json([
        "message" => "Files Uploaded Successfully",
        'files' => $links,
    ], 201);

    }

    // add Location Agency.
    public function addAgencyLocation(Request $request)
    {
        $this->validate($request, [
            'latitude' => 'required',
            'longitude' => 'required',
            'zoom' => 'required',
            'distrect' => 'required',
            'user_id' => 'required',
        ]);

        $location = new Location;
        $location->latitude = $request->latitude;
        $location->longitude = $request->longitude;
        $location->zoom = $request->zoom;
        $location->distrect = $request->distrect;
        $location->user_id = $request->user_id;
        
        $location->save();
        $location_id = DB::getPdo()->lastInsertId();


    return response()->json([
        "message" => "Location Added Successfully",
        'location_id' => $location_id,
    ], 201);

    }

    // edit Location Agency.
    public function editAgencyLocation(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'zoom' => 'required',
            'distrect' => 'required',
            'user_id' => 'required',
        ]);
        
        $result = Location::where('id', $request->id)
                    ->update(array('latitude' => $request->latitude, 'longitude' => $request->longitude,
                    'zoom' => $request->zoom, 'distrect' => $request->distrect,
                    'user_id' => $request->user_id));

        if($result >= 1){
            return response()->json([
                "message" => "Agency Location Updated Successfully",
                'result' => $result,
            ], 201);
        }else{
            return response()->json([
                "message" => "failed to update the location",
                'result' => $result,
            ], 201);
        }
    }

    // get Agency Location
    public function getAgencyLocation(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);
        $location = Location::take(1)->where('user_id', $request->id)->get();
        
        if(count($location)){
            return response()->json([
                'status' => true, 
                'data' => $location, 
                'msg' => 'Agency Location Retrieved Successfully.'
            ]);
        }else{
            return response()->json([
                'status' => false, 
                'data' => [], 
                'msg' => 'the agency dont have a location.'
            ], 404);
        }
    }

    // Delete Image .
    public function deleteImage(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);

        Images::where('id', $request->id)->delete();

        return response()->json([
            "message" => 'Image Deleted successfully',
        ], 201);
    }

    // get Car Views
    public function getCarViews(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);
        $car = Car::find($request->id);
        
        if($car !== NUll){
            return response()->json([
                'status' => true, 
                'views' => $car->views, 
                'msg' => 'Car Views Retrieved Successfully.'
            ]);
        }else{
            return response()->json([
                'status' => false, 
                'data' => [], 
                'msg' => 'no car found with this query string.'
            ], 404);
        }
    }

    // agency car count
    public function getAgencyCarCount(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);

        $agencyCarCount = Car::where('owner_id', $request->id)
        ->count();

        $soldCarCount = Car::where('owner_id', $request->id)
        ->Where('car_status', '=', 1)
        ->count();

        return response()->json([
            'status' => false, 
            'data' => $agencyCarCount, 
            'msg' => 'Agency Car Count Retrieved Successfully.'
        ]);
    }

    // agency sold car count
    public function getAgencySoldCarCount(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);
        
        $soldCarCount = Car::where('owner_id', $request->id)
        ->Where('car_status', '=', 'Sold')
        ->count();

        return response()->json([
            'status' => false, 
            'data' => $soldCarCount, 
            'msg' => 'Agency Sold Car Count Retrieved Successfully.'
        ]);
    }

    // agency Waiting car count
    public function getAgencyWaitingCarCount(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);
        
        $soldCarCount = Car::where('owner_id', $request->id)
        ->Where('published', '=', 'Not Published')
        ->count();

        return response()->json([
            'status' => false, 
            'data' => $soldCarCount, 
            'msg' => 'Agency Waiting Car Count Retrieved Successfully.'
        ]);
    }

}
