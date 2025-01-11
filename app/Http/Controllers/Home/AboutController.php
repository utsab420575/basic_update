<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;


class AboutController extends Controller
{
    //
    public function AboutPage(){

        $aboutpage=About::find(1);
        return view(
            'admin.about_page.about_page_all',
            [
                'aboutpage'=>$aboutpage
            ]);
    }
    public function UpdateAbout(Request $request){
        $validated=$request->validate([
            'title' => 'nullable|string|max:255', // Allows null or a string with max length of 255
            'short_title' => 'nullable|string|max:255', // Same as above
            'short_description' => 'nullable|string', // Allows null or any string
            'long_description' => 'nullable|string', // Allows null or any string
            'about_image_button' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
        ]);
        //this id from form(where field is hidden)
        $about_id = $request->id;
        $stored_about_data=About::find($about_id);

        if($stored_about_data){
            //store data into database/update into databasae
            $stored_about_data->title=$request->title;
            $stored_about_data->short_title=$request->short_title;
            $stored_about_data->short_description=$request->short_description;
            $stored_about_data->long_description=$request->long_description;

            try{
                // Check image is selected or not
                if($request->hasFile('about_image_button')) {

                    // If the old image exists, delete it first
                    if ($stored_about_data->about_image && file_exists(public_path($stored_about_data->about_image))) {
                        unlink(public_path($stored_about_data->about_image));
                    }

                    //if selected than recive the image
                    $recive_file = $request->file('about_image_button');

                    // create image manager with desired driver
                    $manager = new ImageManager(new Driver());

                    // read image from file system
                    $image = $manager->read($request->file('about_image_button'));

                    // resize image proportionally to 300px width
                    $image->scale(523,605);




                    //make file name unique
                    //$fileName = time() . '_' . $recive_file->getClientOriginalName();
                    //here Hmsi_microsecond_imageExtention
                    $timestamp = date('YmdHis'); // Get the current date and time (Year, Month, Day, Hour, Minute, Second)
                    $milliseconds = sprintf('%05d', (int) (microtime(true) * 1000) % 1000); // Get the milliseconds
                    $fileName = $timestamp . '_' . $milliseconds . '_' . $recive_file->getClientOriginalName();


                    // Define the destination path for the uploaded file
                    //make destination path where will file storing
                    //$destinationPath = public_path('upload/home_slide');
                    $relativePath ='upload/home_about';
                    $destinationPath = public_path('upload/home_about');

                    // Create the directory if it doesn't exist
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }




                    // Move the file to the destination path
                    $image->save($destinationPath.DIRECTORY_SEPARATOR .$fileName);

                    //store file name in database
                    $stored_about_data['about_image']=$relativePath.'/' .$fileName;

                    //feedback message
                    $notification=array(
                        'message' => 'About Page Updated with Image Successfully',
                        'alert-type' => 'info'
                    );
                }else{
                    $notification=array(
                        'message' => 'About Page Updated without Image Successfully',
                        'alert-type' => 'info'
                    );
                }
                //return $store_data;
                $stored_about_data->save();

                return back()->with($notification);

            }catch (Exception $e){
                // Log the error
                Log::error('Error updating user profile: ' . $e->getMessage());

                // Redirect with error message
                return redirect()->back()->withErrors('Something went wrong. Please try again later.');
            }

        }else{
            return back()->with([
                'message' => 'Database is empty please insert first data from admin',
                'alert-type' => 'info',
            ]);
        }

    }

}
