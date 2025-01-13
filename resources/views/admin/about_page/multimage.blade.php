@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            {{--<div class="row justify-content-center">--}}
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Multi Image</h4><br><br>
                            <!-- multipart/form-data is necessary when your form includes file inputs.
                            It ensures that the file data and other form fields are sent as separate parts in the HTTP request.-->
                            <form METHOD="POST" action="{{route('store.multi.image')}}" enctype="multipart/form-data">
                                @csrf

                                {{-- Image button --}}
                                <div class="row mb-3">
                                    <label for="about_multi_image_button" class="col-sm-3 col-form-label">About Multi Image</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="file" id="about_multi_image_button"
                                               name="about_multi_image_button[]" multiple>

                                        @error('about_multi_image_button')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror

                                       {{-- @error('about_multi_image_button')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror--}}
                                        {{-- Display errors for each file --}}{{--
                                        @foreach ($errors->get('about_multi_image_button.*') as $fileErrors)
                                            @foreach ($fileErrors as $error)
                                                <div class="text-danger mt-2">{{ $error }}</div>
                                            @endforeach
                                        @endforeach--}}
                                    </div>
                                </div>

                                {{-- Image preview container --}}
                                <div class="row mb-3">
                                    <label for="about_multi_image" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <div id="about_multi_image" class="d-flex flex-wrap gap-2">
                                            {{-- Previewed images will be appended here --}}
                                        </div>
                                    </div>
                                </div>



                                <!-- Input using : 1. You need a simple submit button.
                                           2. No additional styling or complex content is required.-->
                                {{-- <input type="submit" class="mt-4 btn btn-info btn-rounded waves-effect waves-light" value="Update Profile">--}}

                                <!-- button using : You need more flexibility (e.g., including icons, images, or other content inside the button). -->

                                <div class="mb-2 mt-4 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light"><i
                                            class="fas fa-edit"></i> Add Images
                                    </button>
                                </div>


                                <!-- end row -->

                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>

    <!-- For Showing Image When Select Choose Button -->
    <script>
        $(document).ready(function () {
            // Temporary array to keep track of selected files
            let fileList = [];

            // When the file input changes (i.e., the user selects files)
            $('#about_multi_image_button').on('change', function (e) {
                // Convert the FileList object to an array and get the selected files
                const files = Array.from(e.target.files);

                // Add the new selected files to the fileList array
                fileList = fileList.concat(files);

                // Clear the existing previews to render the updated ones
                $('#about_multi_image').html('');

                // Call function to render the image previews
                renderPreview();
            });

            // Function to render the image previews based on the current fileList
            function renderPreview() {
                // Clear the preview container before rendering the new previews
                $('#about_multi_image').html('');

                // Loop through the files in the fileList array
                fileList.forEach((file, index) => {
                    // Only proceed if the file is an image
                    if (file.type.startsWith('image/')) {
                        // Create a new FileReader to read the selected image file
                        const reader = new FileReader();

                        reader.onload = function (e) {
                            // Create a wrapper div for the image and the close button
                            const wrapper = $('<div>')
                                .addClass('position-relative')
                                .css({
                                    display: 'inline-block',
                                    margin: '5px',
                                    width: '100px',
                                    height: '100px',
                                    border: '1px solid #ddd',
                                    borderRadius: '8px',
                                    overflow: 'hidden',
                                    position: 'relative',
                                });

                            // Create an <img> tag to display the selected image
                            const img = $('<img>')
                                .attr('src', e.target.result)
                                .css({
                                    width: '100%', // Ensures the image fills the wrapper
                                    height: '100%', // Ensures the image fills the wrapper
                                    objectFit: 'cover', // Keeps aspect ratio intact and fills the box
                                });

                            // Create a close button to remove the image
                            const closeBtn = $('<button>')
                                .html('&times;') // HTML for the close symbol (×)
                                .addClass('btn btn-sm btn-danger') // Styling for the close button
                                .css({
                                    position: 'absolute', // Position the button on top-right corner
                                    top: '5px', // 5px from the top
                                    right: '5px', // 5px from the right
                                    borderRadius: '50%', // Make the button circular
                                    lineHeight: '10px', // Center the "×" symbol
                                    width: '20px', // Size of the close button
                                    height: '20px', // Size of the close button
                                    padding: 0, // Remove padding
                                    textAlign: 'center', // Center align the text
                                })
                                .on('click', function () {
                                    // Remove the image from the fileList array
                                    fileList.splice(index, 1);

                                    // Re-render the previews and update the file input
                                    renderPreview();
                                    updateFileInput();
                                });

                            // Append the image and close button to the wrapper
                            wrapper.append(img).append(closeBtn);

                            // Append the wrapper to the preview container
                            $('#about_multi_image').append(wrapper);
                        };

                        // Read the image file as a data URL to display it
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Function to update the file input based on the current fileList
            function updateFileInput() {
                // Create a new DataTransfer object, which can be used to manipulate files
                const dataTransfer = new DataTransfer();

                // Add the remaining files from fileList to the DataTransfer object
                fileList.forEach(file => dataTransfer.items.add(file));

                // Update the file input element with the new file list
                $('#about_multi_image_button')[0].files = dataTransfer.files;

                // Optional: Log the updated file count for debugging purposes
                console.log('Updated file count:', dataTransfer.files.length);
            }
        });
    </script>





@endsection
