<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class PortfolioController extends Controller
{
    public function AllPortfolio(){
        //ORDER BY created_at DESC
        $allPortfolio=Portfolio::latest()->get();
        return view('admin.portfolio.protfolio_all',['allPortfolio'=>$allPortfolio]);
    }
    public function AddPortfolio(){
        return view('admin.portfolio.portfolio_add');
    }

/*    public function StorePortfolio(Request $request){
        return $request;
    }*/
    public function StorePortfolio(Request $request){
        //return $request->all();
        // Validation rules
        $validatedData = $request->validate([
            'portfolio_name' => 'required|string|max:255',
            'portfolio_title' => 'required|string|max:255',
            'portfolio_description' => 'required|string',
            'portfolio_image_button' => 'required|image|mimes:jpg,jpeg,png|max:2048', //must be an image
        ]);

        try {
            // Check image is selected or not
            if ($request->hasFile('portfolio_image_button')) {
                //if selected than recive the image
                $recive_file = $request->file('portfolio_image_button');

                // create image manager with desired driver
                $manager = new ImageManager(new Driver());

                // read image from file system
                $image = $manager->read($request->file('portfolio_image_button'));

                // resize image proportionally to 300px width
                $image->scale(1020,519);


                //make file name unique
                //$fileName = time() . '_' . $recive_file->getClientOriginalName();
                //here Hmsi_microsecond_imageExtention
                $timestamp = date('YmdHis'); // Get the current date and time (Year, Month, Day, Hour, Minute, Second)
                $milliseconds = sprintf('%05d', (int)(microtime(true) * 1000) % 1000); // Get the milliseconds
                $fileName = $timestamp . '_' . $milliseconds . '_' . $recive_file->getClientOriginalName();


                // Define the destination path for the uploaded file
                //make destination path where will file storing
                //$destinationPath = public_path('upload/home_slide');
                $relativePath = 'upload/portfolio';
                $destinationPath = public_path('upload/portfolio');

                // Create the directory if it doesn't exist
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }


                // Move the file to the destination path
                $image->save($destinationPath . DIRECTORY_SEPARATOR . $fileName);

                //store file name in database
                //give in later

            } else {
                $notification = array(
                    'message' => 'No Image Selected',
                    'alert-type' => 'error'
                );
                return redirect()->back()->withErrors($notification);
            }

            //return $request->all();
            Portfolio::create([
               'portfolio_name'=>$request->portfolio_name,
               'portfolio_title'=>$request->portfolio_title,
               'portfolio_description'=>$request->portfolio_description,
               'portfolio_image'=>$relativePath.'/'.$fileName,
                'created_at'=>Carbon::now()
            ]);

            $notification = array(
                'message' => 'Portfolio Data Updated Successfully',
                'alert-type' => 'success'
            );


            //return redirect()->back()->with($notification);
            return redirect()->route('all.portfolio')->with($notification);

        } catch (Exception $e) {
            // Log the error
            Log::error('Error updating user profile: ' . $e->getMessage());

            // Redirect with error message
            return redirect()->back()->withErrors('Something went wrong. Please try again later.');
        }
    }
    public function EditPortfolio($id){
        $portfolio_data=Portfolio::find($id);
       // return $portfolio_data;
        if($portfolio_data){
            return view('admin.portfolio.portfolio_edit',['portfolio_data'=>$portfolio_data]);
        }else{
            return redirect()->back()->withErrors('Data Not Available');
        }
    }
    public function UpdatePortfolio(Request $request){
        $validatedData = $request->validate([
            'portfolio_name' => 'required|string|max:255',
            'portfolio_title' => 'required|string|max:255',
            'portfolio_description' => 'required|string',
            'portfolio_image_button' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', //must be an image
        ]);

        $portfolio_retrive_id=$request->id;
        $portfolio_data=Portfolio::find($portfolio_retrive_id);
        if ($portfolio_data) {
            //store data into database/update into databasae
            $portfolio_data->portfolio_name = $request->portfolio_name;
            $portfolio_data->portfolio_title = $request->portfolio_title;
            $portfolio_data->portfolio_description = $request->portfolio_description;

            try {
                // Check image is selected or not
                if ($request->hasFile('portfolio_image_button')) {

                    // If the old image exists, delete it first
                    if ($portfolio_data->portfolio_image && file_exists(public_path($portfolio_data->portfolio_image))) {
                        unlink(public_path($portfolio_data->portfolio_image));
                    }

                    //if selected than recive the image
                    $recive_file = $request->file('portfolio_image_button');

                    // create image manager with desired driver
                    $manager = new ImageManager(new Driver());

                    // read image from file system
                    $image = $manager->read($request->file('portfolio_image_button'));

                    // resize image proportionally to 300px width
                    $image->scale(1020,519);


                    //make file name unique
                    //$fileName = time() . '_' . $recive_file->getClientOriginalName();
                    //here Hmsi_microsecond_imageExtention
                    $timestamp = date('YmdHis'); // Get the current date and time (Year, Month, Day, Hour, Minute, Second)
                    $milliseconds = sprintf('%05d', (int)(microtime(true) * 1000) % 1000); // Get the milliseconds
                    $fileName = $timestamp . '_' . $milliseconds . '_' . $recive_file->getClientOriginalName();


                    // Define the destination path for the uploaded file
                    //make destination path where will file storing
                    //$destinationPath = public_path('upload/home_slide');
                    $relativePath = 'upload/portfolio';
                    $destinationPath = public_path('upload/portfolio');

                    // Create the directory if it doesn't exist
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }


                    // Move the file to the destination path
                    $image->save($destinationPath . DIRECTORY_SEPARATOR . $fileName);

                    //store file name in database
                    $portfolio_data['portfolio_image'] = $relativePath . '/' . $fileName;

                    //feedback message
                    $notification = array(
                        'message' => 'Portfolio Page Updated with Image Successfully',
                        'alert-type' => 'info'
                    );
                } else {
                    $notification = array(
                        'message' => 'Portfolio Page Updated without Image Successfully',
                        'alert-type' => 'info'
                    );
                }
                //return $store_data;
                $portfolio_data->save();

               //return back()->with($notification);
                return redirect()->route('all.portfolio')->with($notification);

            } catch (Exception $e) {
                // Log the error
                Log::error('Error updating Portfolio: ' . $e->getMessage());

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
    public function DeletePortfolio($id){
        $portfolio_data=Portfolio::find($id);
        if($portfolio_data){
            $image_path=$portfolio_data->portfolio_image;
            if($image_path && file_exists(public_path($image_path))){
                unlink(public_path($image_path));
                $portfolio_data->delete();
                $notifications=[
                    'message' => 'Image With Data Deleted Successfully',
                    'alert-type' => 'success',
                ];
            }else{
                $portfolio_data->delete();
                $notifications=[
                    'message' => 'Data Deleted Successfully(Image Not Found)',
                    'alert-type' => 'success',
                ];
            }

            return redirect()->back()->with($notifications);
        }else{
            return redirect()->back()->withErrors(
                [
                    'message'=>'This Id have no data',
                    'alert-type'=>'error'
                ]);
        }
    }
}
