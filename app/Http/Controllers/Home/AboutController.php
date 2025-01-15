<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\MultiImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;


class AboutController extends Controller
{
    //
    public function AboutPage()
    {

        $aboutpage = About::find(1);
        return view(

            'admin.about_page.about_page_all',
            [
                'aboutpage' => $aboutpage
            ]);
    }

    public function UpdateAbout(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255', // Allows null or a string with max length of 255
            'short_title' => 'nullable|string|max:255', // Same as above
            'short_description' => 'nullable|string', // Allows null or any string
            'long_description' => 'nullable|string', // Allows null or any string
            'about_image_button' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
        ]);
        //this id from form(where field is hidden)
        $about_id = $request->id;
        $stored_about_data = About::find($about_id);

        if ($stored_about_data) {
            //store data into database/update into databasae
            $stored_about_data->title = $request->title;
            $stored_about_data->short_title = $request->short_title;
            $stored_about_data->short_description = $request->short_description;
            $stored_about_data->long_description = $request->long_description;

            try {
                // Check image is selected or not
                if ($request->hasFile('about_image_button')) {

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
                    $image->scale(523, 605);


                    //make file name unique
                    //$fileName = time() . '_' . $recive_file->getClientOriginalName();
                    //here Hmsi_microsecond_imageExtention
                    $timestamp = date('YmdHis'); // Get the current date and time (Year, Month, Day, Hour, Minute, Second)
                    $milliseconds = sprintf('%05d', (int)(microtime(true) * 1000) % 1000); // Get the milliseconds
                    $fileName = $timestamp . '_' . $milliseconds . '_' . $recive_file->getClientOriginalName();


                    // Define the destination path for the uploaded file
                    //make destination path where will file storing
                    //$destinationPath = public_path('upload/home_slide');
                    $relativePath = 'upload/home_about';
                    $destinationPath = public_path('upload/home_about');

                    // Create the directory if it doesn't exist
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }


                    // Move the file to the destination path
                    $image->save($destinationPath . DIRECTORY_SEPARATOR . $fileName);

                    //store file name in database
                    $stored_about_data['about_image'] = $relativePath . '/' . $fileName;

                    //feedback message
                    $notification = array(
                        'message' => 'About Page Updated with Image Successfully',
                        'alert-type' => 'info'
                    );
                } else {
                    $notification = array(
                        'message' => 'About Page Updated without Image Successfully',
                        'alert-type' => 'info'
                    );
                }
                //return $store_data;
                $stored_about_data->save();

                return back()->with($notification);

            } catch (Exception $e) {
                // Log the error
                Log::error('Error updating user profile: ' . $e->getMessage());

                // Redirect with error message
                return redirect()->back()->withErrors('Something went wrong. Please try again later.');
            }

        } else {
            return back()->with([
                'message' => 'Database is empty please insert first data from admin',
                'alert-type' => 'info',
            ]);
        }

    }

    public function HomeAbout()
    {
        $about_data = About::find(1);
        return view('frontend.about_page', ['about_data' => $about_data]);
    }

    public function AboutMultiImage()
    {
        return view('admin.about_page.multimage');
    }

    public function StoreMultiImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'about_multi_image_button' => 'required|array',
            'about_multi_image_button.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'about_multi_image_button.required' => 'Please select at least one image.',
            'about_multi_image_button.*.mimes' => 'Invalid file types detected.',
            'about_multi_image_button.*.image' => 'Invalid image files detected.',
        ]);

        if ($validator->fails()) {
            $validator->errors()->add('about_multi_image_button', 'One or more selected files are invalid.');
            return redirect()->back()->withErrors($validator)->withInput();
        }




        try {
            // Check image is selected or not
            if ($request->hasFile('about_multi_image_button')) {
                //retrive single image from all of the image
                foreach ($request->file('about_multi_image_button') as $single_file) {

                    // create image manager with desired driver
                    $manager = new ImageManager(new Driver());

                    // read image from file system
                    $image = $manager->read($single_file);

                    // resize image proportionally to 300px width
                    $image->scale(220, 220);


                    //make file name unique
                    //$fileName = time() . '_' . $recive_file->getClientOriginalName();
                    //here Hmsi_microsecond_imageExtention
                    $timestamp = date('YmdHis'); // Get the current date and time (Year, Month, Day, Hour, Minute, Second)
                    $milliseconds = sprintf('%05d', (int)(microtime(true) * 1000) % 1000); // Get the milliseconds
                    $fileName = $timestamp . '_' . $milliseconds . '_' . $single_file->getClientOriginalName();


                    // Define the destination path for the uploaded file
                    //make destination path where will file storing
                    //$destinationPath = public_path('upload/home_slide');
                    $relativePath = 'upload/multimage';
                    //absolute path for store in directory
                    $destinationPath = public_path('upload/multimage');

                    // Create the directory if it doesn't exist
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }


                    // Move the file to the destination path
                    $image->save($destinationPath . DIRECTORY_SEPARATOR . $fileName);

                    //store file name in database
                    MultiImage::create([
                        'multi_image'=>$relativePath.'/'.$fileName,
                        'created_at'=>Carbon::now()
                    ]);

                    //feedback message
                    $notification = array(
                        'message' => 'Uploaded Image Successfully',
                        'alert-type' => 'success'
                    );
                }
            } else {
                $notification = array(
                    'message' => 'No Image Uploaded',
                    'alert-type' => 'info'
                );
            }

            //stay in same page and show notification
           // return back()->with($notification);
            return redirect()->route('all.multi.image')->with($notification);

        } catch (Exception $e) {
            // Log the error
            Log::error('Error updating user profile: ' . $e->getMessage());

            // Redirect with error message
            return redirect()->back()->withErrors('Something went wrong. Please try again later.');
        }

    }
    public function AllMultiImage(){
        $allMultiImage=MultiImage::all();
        return view('admin.about_page.all_multiimage',['allMultiImage'=>$allMultiImage]);
    }

    public function EditMultiImage($id){
        $multiImage=MultiImage::findOrFail($id);
        return view('admin.about_page.edit_multi_image',['multiImage'=>$multiImage]);
    }

    public function UpdateMultiImage(Request $request){

        $validated = $request->validate([
            'edit_multi_image_button' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
        ],[
            'edit_multi_image_button.image' => 'The file must be an image.', // Generic message if the file isn't an image
            'edit_multi_image_button.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.', // Specific to types
            'edit_multi_image_button.max' => 'The image size must not exceed 2MB.', // Specific to size
        ]);

        $multi_image_id=$request->id;
        //this id from form(where field is hidden)
        $stored_multi_image_data = MultiImage::find($multi_image_id);

        //here database involved that's why if() include otherwise we can start with try{}catch(){}
        if ($stored_multi_image_data) {
            //store data into database/update into databasae
            try {
                // Check image is selected or not
                if ($request->hasFile('edit_multi_image_button')) {

                    // If the old image exists, delete it first
                    if ($stored_multi_image_data->multi_image && file_exists(public_path($stored_multi_image_data->multi_image))) {
                        unlink(public_path($stored_multi_image_data->multi_image));
                    }

                    //if selected than recive the image
                    $recive_file = $request->file('edit_multi_image_button');

                    // create image manager with desired driver
                    $manager = new ImageManager(new Driver());

                    // read image from file system
                    $image = $manager->read($recive_file);

                    // resize image proportionally to 300px width
                    $image->scale(220, 220);


                    //make file name unique
                    //$fileName = time() . '_' . $recive_file->getClientOriginalName();
                    //here Hmsi_microsecond_imageExtention
                    $timestamp = date('YmdHis'); // Get the current date and time (Year, Month, Day, Hour, Minute, Second)
                    $milliseconds = sprintf('%05d', (int)(microtime(true) * 1000) % 1000); // Get the milliseconds
                    $fileName = $timestamp . '_' . $milliseconds . '_' . $recive_file->getClientOriginalName();


                    // Define the destination path for the uploaded file
                    //make destination path where will file storing
                    //$destinationPath = public_path('upload/home_slide');
                    $relativePath = 'upload/multimage';
                    $destinationPath = public_path('upload/multimage');

                    // Create the directory if it doesn't exist
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }


                    // Move the file to the destination path
                    $image->save($destinationPath . DIRECTORY_SEPARATOR . $fileName);

                    //store file name in database
                    $stored_multi_image_data['multi_image'] = $relativePath . '/' . $fileName;

                    //feedback message
                    $notification = array(
                        'message' => 'Image Updated Successfully',
                        'alert-type' => 'success'
                    );
                } else {
                    $notification = array(
                        'message' => 'Updated without Image Successfully',
                        'alert-type' => 'info'
                    );
                }
                //return $store_data;
                $stored_multi_image_data->save();

                //return back()->with($notification);
                return redirect()->route('all.multi.image')->with($notification);

            } catch (Exception $e) {
                // Log the error
                Log::error('Error updating user profile: ' . $e->getMessage());

                // Redirect with error message
                return redirect()->back()->withErrors('Something went wrong. Please try again later.');
            }

        } else {
            return back()->with([
                'message' => 'No Data Found',
                'alert-type' => 'info',
            ]);
        }

    }
    public function DeleteMultiImage($id){
        $multiImageData=MultiImage::find($id);
        if($multiImageData){
            $image_path=$multiImageData->multi_image;
            if($image_path && file_exists(public_path($image_path))){
                unlink(public_path($image_path));
                $multiImageData->delete();
                return redirect()->back()->with(
                    [
                        'message'=>'Delete Image Successfully',
                        'alert-type'=>'success'
                    ]);
            }else{
                $multiImageData->delete();
                return redirect()->back()->with(
                    [
                        'message'=>'Database entry deleted,Image Not Found',
                        'alert-type'=>'info'
                    ]);
            }
        }else{
            return redirect()->back()->withErrors(
                [
                    'message'=>'This Id have no data',
                    'alert-type'=>'error'
                ]);
        }
    }

}
