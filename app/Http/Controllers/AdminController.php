<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        //After logout redirect to login
        return redirect('/login');
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
}
