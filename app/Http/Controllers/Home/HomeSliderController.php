<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlide;
use Illuminate\Http\Request;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class HomeSliderController extends Controller
{
    //
    public function HomeSlider(){

        $homeslide=HomeSlide::find(1);
        return view(
            'admin.home_slide.home_slide_all',
            [
                'homeslide'=>$homeslide
            ]);
    }
    //update home slider
    public function UpdateSlider(Request $request){
        //return "Hi";

        // Apply validation rules using the $request->validate() method
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_title' => 'nullable|string|max:255',
            'video_url' => 'nullable|url',
            'home_slide_image_button' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
        ]);
        //this id from form(where field is hidden)
        $slide_id = $request->id;
        $stored_slider_data=HomeSlide::find($slide_id);

       //return $stored_slider_data;
        //store data into database/update into databasae
        $stored_slider_data->title=$request->title;
        $stored_slider_data->short_title=$request->short_title;
        $stored_slider_data->video_url=$request->video_url;
        //return $stored_slider_data;
        try{
            // Check image is selected or not
            if($request->hasFile('home_slide_image_button')) {

                // If the old image exists, delete it first
                if ($stored_slider_data->home_slide && file_exists(public_path($stored_slider_data->home_slide))) {
                    unlink(public_path($stored_slider_data->home_slide));
                }

                //if selected than recive the image
                $recive_file = $request->file('home_slide_image_button');

                // create image manager with desired driver
                $manager = new ImageManager(new Driver());

                // read image from file system
                $image = $manager->read($request->file('home_slide_image_button'));

                // resize image proportionally to 300px width
                $image->scale(636,852);




                //make file name unique
                //$fileName = time() . '_' . $recive_file->getClientOriginalName();
                //here Hmsi_microsecond_imageExtention
                $timestamp = date('YmdHis'); // Get the current date and time (Year, Month, Day, Hour, Minute, Second)
                $milliseconds = sprintf('%05d', (int) (microtime(true) * 1000) % 1000); // Get the milliseconds
                $fileName = $timestamp . '_' . $milliseconds . '_' . $recive_file->getClientOriginalName();


                // Define the destination path for the uploaded file
                //make destination path where will file storing
                //$destinationPath = public_path('upload/home_slide');
                $relativePath ='upload/home_slide';
                $destinationPath = public_path('upload/home_slide');

                // Create the directory if it doesn't exist
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }




                // Move the file to the destination path
                $image->save($destinationPath.DIRECTORY_SEPARATOR .$fileName);

                //store file name in database
                $stored_slider_data['home_slide']=$relativePath.'/' .$fileName;
            }
            //return $store_data;
            $stored_slider_data->save();

            return back()->with([
                'message' => 'Home Slide Update Succesfully',
                'alert-type' => 'info',
            ]);

            //same thing(back===home.slide)
            return redirect()->route('home.slide')->with([
                'message' => 'Home Slide Update Succesfully',
                'alert-type' => 'info',
            ]);

        }catch (Exception $e){
            // Log the error
            Log::error('Error updating user profile: ' . $e->getMessage());

            // Redirect with error message
            return redirect()->back()->withErrors('Something went wrong. Please try again later.');
        }

    }
}
