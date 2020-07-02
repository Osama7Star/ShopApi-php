<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Http\Resources\User as UserResource;
use Illuminate\Hashing\BcryptHasher;
use App\User;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.role:Admin,Agency,Customer');
    }

     /**
     * Get Login User
     * 
     * 
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        // var_dump(request->bearerToken());
        $user = Auth::user();

        $data = new UserResource($user);
        $token = $request->bearerToken();

        return response()->json([
            'token' => $token,
            'data' => $data
        ]);

    }


     /**
     * Update Profile
     * 
     * 
     * @param UpdateProfileRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(UpdateProfileRequest $request)
    {        
        $this->validate($request, [
            'id' => 'required',
            'image' => 'required|image|dimensions:max_width=1024,max_height=1024|mimes:jpeg,png',
            'name' => 'required',
        ]);
        
        if(!$request->hasFile('image')) {
            return response()->json(['upload_file_not_found'], 400);
        }
        $file = $request->file('image');
        if(!$file->isValid()) {
            return response()->json(['invalid_file_upload'], 400);
        }
        $path = public_path() . '/uploads/images/store/';
        $file->move($path, $file->getClientOriginalName());

        // $section->image = '/uploads/images/store/'.$file->getClientOriginalName();
        $image = '/uploads/images/store/'.$file->getClientOriginalName();

        $result = User::where('id', $request->id)
                    ->update(array('name' => $request->name, 'image' => $image));

        if($result >= 1){
            return response()->json([
                "message" => "User Updated Successfully",
                'result' => $result,
            ], 201);
        }else{
            return response()->json([
                "message" => "failed to update the user",
                'result' => $result,
            ], 201);
        }
    }

     /**
     * Update Profile
     * 
     * 
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!(new BcryptHasher)->check($value, Auth::user()->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'new_password' => 'required',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        $user = $request->user();

        $user->update([
            'password' => bcrypt($request->new_password),
        ]);

        $data = new UserResource($user);

        return response()->json(compact('data'));
    }
}
