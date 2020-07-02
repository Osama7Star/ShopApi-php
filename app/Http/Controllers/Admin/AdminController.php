<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CarProducer;
use App\Car;
use App\Images;
use App\Location;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;




class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.role:Admin');
    }

    // add new Producer
    public function createProducer(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:car_producer',
        ]);
       
        $cartype = new CarProducer;
        $cartype->name = $request->name;
        $cartype->save();

        
        return response()->json([
            "message" => "Car Producer Record Created"
        ], 201);
    }

    // Delete Producer .
    public function deleteProducer(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);

        CarProducer::where('id', $request->id)->delete();

        return response()->json([
            "message" => 'Car Producer Deleted successfully',
        ], 201);
    }

    // edit Producer.
    public function editProducer(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:car_producer,name,'.$request->id.',id',
        ]);
       
        CarProducer::where('id', $request->id)
                    ->update(array('name' => $request->name));

        return response()->json([
            "message" => 'Producer Updated Successfully',
        ], 201);
    }

    // list of all Cars
    public function getCarList(Request $request)
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
                'status' => true, 
                'data' => ['empty'], 
                'msg' => 'no car found with this query string.'
            ], 404);
        }
    }

    // list of all solds Cars
    public function getSoldCarList(Request $request)
    {

        $soldCarList = Car::where('car_status', 'Sold')->get();
        
        if(count($soldCarList)){
            return response()->json([
                'status' => true, 
                'data' => $soldCarList, 
                'msg' => 'Sold Car List Retrieved Successfully.'
            ]);
        }else{
            return response()->json([
                'status' => true, 
                'data' => ['empty'], 
                'msg' => 'no car found with this query string.'
            ], 404);
        }
    }

    // list of all waiting Cars
    public function getWaitingCarList(Request $request)
    {

        $waitingCarList = Car::where('published', 'Not Published')->get();;
        
        if(count($waitingCarList)){
            return response()->json([
                'status' => true, 
                'data' => $waitingCarList, 
                'msg' => 'Waiting Car List Retrieved Successfully.'
            ]);
        }else{
            return response()->json([
                'status' => true, 
                'data' => ['empty'], 
                'msg' => 'no car found with this query string.'
            ], 404);
        }
    }

    // get user
    public function getUser(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);

        $user = User::where('id', $request->id)
               ->get();

        if(count($user)){
            return response()->json([
                'status' => true, 
                'data' => $user, 
                'msg' => 'User Retrieved Successfully.'
            ]);
        }else{
            return response()->json([
                "message" => "no user found with this query string"
            ], 404);
        }
    }

    // get user
    public function getWaitingUserList(Request $request)
    {
        $waitingUserList = User::where('status', 'Not Active')->get();;
        
        if(count($waitingUserList)){

            return response()->json([
                'status' => true, 
                'data' => $waitingUserList, 
                'msg' => 'Waiting User List Retrieved Successfully.'
            ]);
        }else{
            return response()->json([
                'status' => true, 
                'data' => ['empty'], 
                'msg' => 'no user found with this query string.'
            ], 404);
        }
    }

    // Publish The Car.
    public function carPublish(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);
       
        Car::where('id', $request->id)
                    ->update(array('published' => 'Published'));

        return response()->json([
            "message" => 'Car Published Successfully',
        ], 201);
    }

    // Un Publish The Car.
    public function carUnpublish(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);
       
        Car::where('id', $request->id)
                    ->update(array('published' => 'Not Published'));

        return response()->json([
            "message" => 'Car Unpublished Successfully',
        ], 201);
    }

    // list of all users
    public function getUserList(Request $request)
    {

        $userList = User::all();
        
        if(count($userList)){

            return response()->json([
                'status' => true, 
                'data' => $userList, 
                'msg' => 'User List Retrieved Successfully.'
            ]);
        }else{
            return response()->json([
                "message" => "no user found with this query string."
            ], 404);
        }
    }

    // list of all Agency
    public function getAgencyList(Request $request)
    {
        $agencyList = User::where('role', 'agency')
               ->get();
        
        if(count($agencyList)){

            foreach($agencyList as $agency){
                $allCarCount = Car::where('owner_id', $agency->id)
                ->count();
    
                $soldCarCount = Car::where('owner_id', $agency->id)
                ->Where('car_status', '=', 1)
                ->count();

                $agency->allCarCount = $allCarCount;
                $agency->soldCarCount = $soldCarCount;
            }

            return response()->json([
                'status' => true, 
                'data' => $agencyList, 
                'msg' => 'Agency List Retrieved Successfully.'
            ]);
        }else{
            return response()->json([
                'status' => true, 
                'data' => ['empty'], 
                'msg' => 'no agency found with this query string.'
            ], 404);
        }
    }

    // car count
    public function getCarCount(Request $request)
    {
        $carCount = Car::count();

        return response()->json([
            'status' => true, 
            'data' => $carCount, 
            'msg' => 'All Car Count Retrieved Successfully.'
        ]);
    }

    // car sold count
    public function getSoldCarCount(Request $request)
    {

        $soldCarCount = Car::Where('car_status', '=', 'Sold')
        ->count();

        return response()->json([
            'status' => true, 
            'data' => $soldCarCount, 
            'msg' => 'Sold Car Count Retrieved Successfully.'
        ]);
    }

    // car waiting count
    public function getWaitingCarCount(Request $request)
    {

        $witingCarCount = Car::Where('published', '=', 'Not Published')
        ->count();

        return response()->json([
            'status' => true, 
            'data' => $witingCarCount, 
            'msg' => 'Witing Car Count Retrieved Successfully.'
        ]);
    }

    // user count
    public function getUserCount(Request $request)
    {

        $userCount = User::count();

        return response()->json([
            'status' => true, 
            'data' => $userCount, 
            'msg' => 'User Count Retrieved Successfully.'
        ]);
    }

    // waiting user count
    public function getWaitingUserCount(Request $request)
    {

        $userCount = User::Where('status', '=', 'Not Active')
        ->count();

        return response()->json([
            'status' => true, 
            'data' => $userCount, 
            'msg' => 'Waitign User Count Retrieved Successfully.'
        ]);
    }

    // susbend user
    public function susbendUser(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);
       
        User::where('id', $request->id)
                    ->update(array('status' => 'Susbended'));

        return response()->json([
            "message" => 'User Susbended Successfully',
        ], 201);
    }

    // un susbend user
    public function unSusbendUser(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);
       
        User::where('id', $request->id)
                    ->update(array('status' => 'Active'));

        return response()->json([
            "message" => 'User Un Susbended Successfully',
        ], 201);
    }

    // activiate user
    public function activiateUser(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);
       
        User::where('id', $request->id)
                    ->update(array('status' => 'Active'));

        return response()->json([
            "message" => 'User Activiated Successfully',
        ], 201);
    }

    // de activiate user
    public function deActiviateUser(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);
       
        User::where('id', $request->id)
                    ->update(array('status' => 'Not Active'));

        return response()->json([
            "message" => 'User De Activiated Successfully',
        ], 201);
    }

    
}
