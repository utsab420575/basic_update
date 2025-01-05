<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //Logout
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        //After logout redirect to login and send session data for showing tostr message
        $notification=array(
            "message"=>'Profile Logout Sucessfully',
            "alert-type"=>'info');
        return redirect()->route('login')->with($notification);
        //return redirect('/login')->with($notification);
    }
    public function Profile(){
        /*If no user is authenticated (e.g., the user isn't logged in),
        calling Auth::user() will return null, and
        attempting to access ->id will throw an error.
        To avoid this, you can use: Auth::check()*/
        if (Auth::check()) {
            // Auth::user() fetches the current authenticated user's row from the users table as an instance of the User model.
            //Access Data: You can access the properties of the retrieved User object directly, like $user->id, $user->name, etc.
            $id = Auth::user()->id;
            $admin_data=User::find($id);
            //return $admin_data;
            return view('admin.admin_profile_view',["admin_data"=>$admin_data]);
        } else {
            // Handle unauthenticated state
        }
    }
    public function EditProfile(){
        if (Auth::check()) {
            // Auth::user() fetches the current authenticated user's row from the users table as an instance of the User model.
            //Access Data: You can access the properties of the retrieved User object directly, like $user->id, $user->name, etc.
            $id = Auth::user()->id;
            $edit_data=User::find($id);
            return view('admin.admin_profile_edit',["edit_data"=>$edit_data]);
        } else {
            // Handle unauthenticated state
        }
    }
    public function StoreProfile(Request $request){
        // Validation
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // Ignore the current user's email during validation
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:users,email,' . Auth::user()->id, // Ignore the current user's email
            ],
            // Ignore the current user's username during validation
            'user_name' => [
                'required',
                'string',
                'unique:users,user_name,' . Auth::user()->id, // Ignore the current user's username
                'regex:/^[a-zA-Z0-9_]+$/', // Only letters, numbers, and underscores
            ],
            'profile_image_button' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (Auth::check()) {
            try{
                // Auth::user() fetches the current authenticated user's row from the users table as an instance of the User model.
                //Access Data: You can access the properties of the retrieved User object directly, like $user->id, $user->name, etc.
                $id = Auth::user()->id;
                $store_data=User::find($id);
                $store_data->name=$request->name;
                $store_data->email=$request->email;
                $store_data->user_name=$request->user_name;

                // Check image is selected or not
                if($request->hasFile('profile_image_button')) {

                    // If the old image exists, delete it first
                    if ($store_data->profile_image && file_exists(public_path('upload/admin_images/' . $store_data->profile_image))) {
                        unlink(public_path('upload/admin_images/' . $store_data->profile_image));
                    }
                    //if selected than recive the image
                    $recive_file = $request->file('profile_image_button');



                    //make file name unique
                    //$fileName = time() . '_' . $recive_file->getClientOriginalName();
                    //here Hmsi_microsecond_imageExtention
                    $timestamp = date('YmdHis'); // Get the current date and time (Year, Month, Day, Hour, Minute, Second)
                    $milliseconds = sprintf('%05d', (int) (microtime(true) * 1000) % 1000); // Get the milliseconds
                    $fileName = $timestamp . '_' . $milliseconds . '_' . $recive_file->getClientOriginalName();


                    // Define the destination path for the uploaded file
                    //make destination path where will file storing
                    $destinationPath = public_path('upload/admin_images');

                    // Create the directory if it doesn't exist
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                    // Move the file to the destination path
                    $recive_file->move($destinationPath,$fileName);

                    //store file name in database
                    $store_data['profile_image']=$fileName;
                }
                //return $store_data;
                $store_data->save();

                $notification=array(
                    "message"=>'Admin Profile Updated Sucessfully',
                    "alert-type"=>'success');
                return redirect()->route('admin.profile')->with($notification);
            }catch (Exception $e){
                // Log the error
                Log::error('Error updating user profile: ' . $e->getMessage());

                // Redirect with error message
                return redirect()->back()->withErrors('Something went wrong. Please try again later.');
            }
        } else {
            // Handle unauthenticated state
            // Redirect if not authenticated
            return redirect()->route('login')->withErrors('You need to be logged in to perform this action.');
        }
    }
    public function ChangePassword(){
        return view('admin.admin_change_password');
    }

    public function UpdatePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:5',
            'confirm_password' => 'required|min:5|same:new_password',
        ], [
            'confirm_password.same' => 'The confirm password does not match the new password.',
        ]);

        $id=Auth::user()->id;
        $user=User::find($id);
        if(!Hash::check($request->old_password,$user->password)){
            //Flash message for old password not correct
            return redirect()->back()->with([
                'message' => 'The old password is incorrect.',
                'alert-type' => 'error'
            ]);
           // session()->flash('message', 'The old password is incorrect.');
           // return redirect()->back();
        }
        // Update the password
        $user->update(['password' => Hash::make($request->new_password)]);
        // Success message
        return redirect()->back()->with([
            'message' => 'Data saved successfully!',
            'alert-type' => 'success'
        ]);
    }
}
