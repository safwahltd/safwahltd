@extends('admin.layout.app')
@section('title','Gallery')
@section('body')
    <style>
        .image-preview-container {
            position: relative;
            display: inline-block;
            margin: 10px;
        }
        .image-preview-container img {
            width: 100px;
            height: 100px;
            border-radius: 5px;
            object-fit: cover;
            display: block;
        }
        .cancel-button {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 14px;
            text-align: center;
            line-height: 18px;
            cursor: pointer;
        }
        /* Hidden image info (initially hidden) */
        .info-box {
            display: none;
            position: absolute;
            /*bottom: 100%;
            left: 50%;*/
            transform: translateX(-50%);
            background-color: #333;
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-size: 14px;
            white-space: nowrap;
        }

        /* Show the info box when hovering over the Info button */
        .info-button:hover + .info-box {
            display: block;
        }
    </style>
    <div class="row mt-1 row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="border-bottom m-3">
                    <div class="row">
                        <div class="card-header border-bottom justify-content-between">
                            <h3 class="card-title">Gallery</h3>
                            @if(auth()->user()->hasPermission('admin gallery store'))
                                <a class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#addGallery" href="">
                                    ADD <i class="fa fa-plus"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($images as $key => $image)
                        <div class="col-xl-3 col-md-6 col-sm-6 my-1">
                            <div class="card m-0 p-0 border">
                                <div class="d-flex align-items-center px-3 pt-3">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="example-checkbox2" value="option2">
                                        <span class="custom-control-label"></span>
                                    </label>
                                    <div class="float-end ms-auto">
                                        <a href="#" class="option-dots" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                                        <div class="dropdown-menu dropdown-menu-start">
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editConcern{{$key}}" ><i class="fe fe-edit me-2"></i> Edit</a>
                                            <a class="dropdown-item" href="{{ route('admin.gallery.download',$image->id) }}"><i class="fe fe-download me-2"></i> Download</a>
                                            <a class="dropdown-item info-button" href="#"><i class="fe fe-info me-2"></i> Info</a>
                                            <div class="info-box bg-dark">
                                                <!-- Display the image details dynamically from the backend -->
                                                <span>Title : {{ $image->title }}</span>
                                                <br>
                                                <span>Resolution : {{ $image->resolution }} px </span><br>
                                                <span>Size: {{ number_format($image->size / 1024, 2) }} KB </span><br>
                                                <span>Last Update : {{ $image->user->name }} {{ \Illuminate\Support\Carbon::parse($image->updated_at)->format('D m,Y h:i:s') }}</span>

                                            </div>
                                            <a class="dropdown-item" href="#" onclick="return confirm('are you sure to delete ?') ? document.getElementById('myForm{{$key}}').submit() : '' ">
                                                <i class="fe fe-trash me-2"></i>
                                                Delete
                                            </a>
                                            <form action="{{route('admin.gallery.destroy',$image->id)}}" method="post" id="myForm{{$key}}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0 text-center">
                                    <div class="">
                                        <a href="#" class="image-link" data-image="{{asset($image->image)}}" data-title="{{ $image->title }}">
                                            <img src="{{asset($image->image)}}" class="img-fluid" style="height: 120px" alt="{{$image->alt}}">
                                        </a>
                                    </div>
                                    <span class="text-muted">{{ number_format($image->size / 1024, 2) }} KB</span>
                                    <br>
                                    <br>
                                    <span class="text-muted p-1 my-2 rounded-2 {{ $image->status == 1 ? 'bg-success':'bg-danger'  }}  ">{{ $image->status == 1 ? 'Active':'Inactive'  }}</span>
                                </div>
                            </div>
                        </div>
                            <div class="modal fade" id="editConcern{{$key}}">
                                <div class="modal-dialog modal-dialog-centered task-view-modal" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header p-5">
                                            <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card">
                                                <div class="card-header border-bottom justify-content-between">
                                                    <h3 class="card-title"> Edit Concern</h3>
                                                </div>
                                                <div class="card-body">
                                                    <form class="form-horizontal" action="{{route('admin.gallery.update',$image->id )}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        @php($rand = rand(0,10))
                                                        <div class="row mb-4">
                                                            <div class="col-md-3 form-label">
                                                                <label class="" for="b{{$rand}}">Images</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input class="form-control image-input" value="{{ asset($image->image) }}" id="b{{$rand}}" name="image" type="file">
                                                                <img class="img-fluid img-responsive my-2" id="imagePreview-b{{$rand}}" src="{{ asset($image->image) }}"
                                                                     alt="Your Image" style="width: 150px; height: auto;" />
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-md-3 form-label">
                                                                <label class="" for="captionEdit{{$key}}">Caption</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <textarea class="form-control" name="caption" id="captionEdit{{$key}}" cols="30" rows="4">{{ $image->caption }}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-4 d-flex form-group">
                                                            <div class="col-md-3 form-label">
                                                                <label class="" for="statusAdd">Status</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <select class="form-control select2 form-select" id="statusAdd" name="status" data-placeholder="Choose one">
                                                                    <option class="form-control" label="Choose one" disabled selected></option>
                                                                    <option  {{$image->status == 1 ? 'selected':''}} value="1">Active</option>
                                                                    <option  {{$image->status == 0 ? 'selected':''}} value="0">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-primary float-end" type="submit">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addGallery">
        <div class="modal-dialog modal-dialog-centered task-view-modal" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header p-5">
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('admin.gallery.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4">
                                    <div class="col-md-3 form-label">
                                        <label class="" for="imageInput">Images</label>
                                    </div>
                                    <div class="col-md-9">
                                        <!-- File input for selecting multiple images -->
                                        <input type="file" class="imageInput form-control " id="imageInput" name="images[]" multiple accept="image/*" />
                                        <div class="imagePreview" id="imagePreview"></div>
                                    </div>

                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3 form-label">
                                        <label class="" for="captionAdd">Caption</label>
                                    </div>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="caption" id="captionAdd" cols="30" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-4 d-flex form-group">
                                    <div class="col-md-3 form-label">
                                        <label class="" for="statusAdd">Status</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-control select2 form-select" id="statusAdd" name="status" data-placeholder="Choose one">
                                            <option class="form-control" label="Choose one" disabled selected></option>
                                            <option selected value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-primary float-end" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="lightboxModal" tabindex="-1" aria-labelledby="lightboxModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lightboxModalLabel">Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="lightboxImage" src="" class="img-fluid" alt="">
                    <p id="lightboxTitle" class="mt-2"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="prevImage" class="btn btn-primary">Previous</button>
                    <button type="button" id="nextImage" class="btn btn-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        let currentIndex = 0;
        const images = [];

        $(document).ready(function() {
            $('.image-link').on('click', function(e) {
                e.preventDefault();

                const imageUrl = $(this).data('image');
                const title = $(this).data('title');
                console.log('click',imageUrl,title);
                // Update modal content
                $('#lightboxImage').attr('src', imageUrl);
                $('#lightboxTitle').text(title);

                // Save images for navigation
                images.length = 0; // Clear the array
                $('.image-link').each(function(index) {
                    images.push({
                        url: $(this).data('image'),
                        title: $(this).data('title')
                    });
                });
                currentIndex = $(this).parent().index(); // Set the current index

                $('#lightboxModal').modal('show');
            });

            $('#prevImage').on('click', function() {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateLightboxImage();
                }
            });

            $('#nextImage').on('click', function() {
                if (currentIndex < images.length - 1) {
                    currentIndex++;
                    updateLightboxImage();
                }
            });

            function updateLightboxImage() {
                $('#lightboxImage').attr('src', images[currentIndex].url);
                $('#lightboxTitle').text(images[currentIndex].title);
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            const $imageInput = $('.imageInput');
            const $imagePreview = $('.imagePreview');

            // Handle file input change event
            $imageInput.on('change', function(event) {
                let files = event.target.files;
                $imagePreview.empty(); // Clear previous previews
                previewImages(files);
            });

            // Preview selected images with cancel button
            function previewImages(files) {
                Array.from(files).forEach((file) => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            const previewContainer = $('<div class="image-preview-container"></div>');
                            const imgElement = $('<img src="' + event.target.result + '">');
                            const cancelButton = $('<button class="cancel-button">&times;</button>');

                            // Cancel button removes the image from preview
                            cancelButton.on('click', function() {
                                previewContainer.remove();
                                removeFile(file);
                            });

                            previewContainer.append(imgElement).append(cancelButton);
                            $imagePreview.append(previewContainer);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Remove a file from the input
            function removeFile(fileToRemove) {
                const dt = new DataTransfer();
                const files = $imageInput[0].files;

                Array.from(files).forEach((file) => {
                    if (file !== fileToRemove) {
                        dt.items.add(file); // Add all files except the removed one
                    }
                });

                $imageInput[0].files = dt.files; // Update file input
            }
        });
    </script>
@endpush
