@extends('admin.layout.app')
@section('title','Gallery')
@section('body')
    <style>
        .image-drop-area {
            border: 2px dashed #ccc;
            border-radius: 5px;
            width: 100%;
            padding: 20px;
            text-align: center;
            font-size: 16px;
            color: #999;
            margin: 20px 0;
        }
        .image-drop-area.dragover {
            border-color: #000;
            background-color: #f0f0f0;
        }
        .image-preview {
            display: flex;
            flex-wrap: wrap;
            margin-top: 10px;
        }
        .image-preview .image-container {
            position: relative;
            margin: 5px;
        }
        .image-preview img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 1px solid #ccc;
        }
        .cancel-button {
            position: absolute;
            top: -10px;
            right: -10px;
            background: red;
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            width: 20px;
            height: 20px;
            text-align: center;
            line-height: 16px;
            font-size: 16px;
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
                                            <a class="dropdown-item" href="#"><i class="fe fe-edit me-2"></i> Edit</a>
                                            <a class="dropdown-item" href="#"><i class="fe fe-share me-2"></i> Share</a>
                                            <a class="dropdown-item" href="#"><i class="fe fe-download me-2"></i> Download</a>
                                            <a class="dropdown-item" href="#"><i class="fe fe-info me-3"></i> Info</a>
                                            <a class="dropdown-item" href="#"><i class="fe fe-trash me-2"></i> Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0 text-center">
                                    <div class="">
                                        <a href="#" class="image-link" data-image="https://picsum.photos/id/177/480/320.webp" data-title="https://picsum.photos/id/110/1200/800.webp">
                                            <img src="https://picsum.photos/id/177/480/320.webp" class="img-fluid" alt="https://picsum.photos/id/110/1200/800.webp">
                                        </a>
                                    </div>
                                    <h6 class="mb-1 font-weight-semibold">Received</h6>
                                    <span class="text-muted">1.23gb</span>
                                </div>
                            </div>
                        </div>
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
                                            <a class="dropdown-item" href="#"><i class="fe fe-edit me-2"></i> Edit</a>
                                            <a class="dropdown-item" href="#"><i class="fe fe-share me-2"></i> Share</a>
                                            <a class="dropdown-item" href="#"><i class="fe fe-download me-2"></i> Download</a>
                                            <a class="dropdown-item" href="#"><i class="fe fe-info me-3"></i> Info</a>
                                            <a class="dropdown-item" href="#"><i class="fe fe-trash me-2"></i> Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0 text-center">
                                    <div class="">
                                        <a href="#" class="image-link" data-image="https://picsum.photos/id/110/1200/800.webp" data-title="https://picsum.photos/id/110/1200/800.webp">
                                            <img src="https://picsum.photos/id/110/1200/800.webp" class="img-fluid" alt="https://picsum.photos/id/110/1200/800.webp">
                                        </a>
                                    </div>
                                    <h6 class="mb-1 font-weight-semibold">Download</h6>
                                    <span class="text-muted">1.23gb</span>
                                </div>
                            </div>
                        </div>
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
                        <div class="card-header border-bottom justify-content-between">
                            <h3 class="card-title"> Create New</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('admin.gallery.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4">
                                    <label for="titleAdd" class="col-md-3 form-label">Title</label>
                                    <div class="col-md-9">
                                        <input class="form-control" required value="{{old('title')}}" id="titleAdd" name="title" placeholder="Enter Title" type="text">
                                        <span class="text-danger">{{$errors->has('title') ? $errors->first('title'):''}}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    {{--<label for="bannerAdd" class="col-md-3 form-label">Images</label>
                                    <div class="col-md-9">
                                        <input class="form-control dropify" multiple value="{{old('banner')}}" id="bannerAdd" name="banner" type="file">
                                        <span class="text-danger">{{$errors->has('banner') ? $errors->first('banner'):''}}</span>
                                    </div>--}}
                                    <div id="imageDropArea" class="image-drop-area">
                                        Drag & Drop images here or click to upload
                                    </div>
                                    <input type="file" id="imageInput" name="image" multiple accept="image/*" style="display: none;" />
                                    <div id="imagePreview" class="image-preview"></div>

                                </div>
                                <div class="row mb-4">
                                    <label for="serialAdd" class="col-md-3 form-label">Serial <span class="text-danger">(optional)</span></label>
                                    <div class="col-md-9">
                                        <input class="form-control" value="{{old('serial')}}" id="serialAdd" name="serial" placeholder="Enter Serial No" type="number">
                                        <span class="text-danger">{{$errors->has('serial') ? $errors->first('serial'):''}}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="urlShow" class="col-md-3 form-label">Url</label>
                                    <div class="col-md-9">
                                        <input class="form-control bg-transparent" value="{{ old('url') }}" id="urlShow" name="url" placeholder="Enter Url" type="url">
                                        <span class="text-danger">{{$errors->has('url') ? $errors->first('url'):''}}</span>
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
            const $imageDropArea = $('#imageDropArea');
            const $imageInput = $('#imageInput');
            const $imagePreview = $('#imagePreview');

            // Handle dragover and dragleave events
            $imageDropArea.on('dragover', function(event) {
                event.preventDefault();
                event.stopPropagation();
                $(this).addClass('dragover');
            });

            $imageDropArea.on('dragleave', function(event) {
                event.preventDefault();
                event.stopPropagation();
                $(this).removeClass('dragover');
            });

            // Handle drop event
            $imageDropArea.on('drop', function(event) {
                event.preventDefault();
                event.stopPropagation();
                $(this).removeClass('dragover');
                const files = event.originalEvent.dataTransfer.files;
                handleImages(files);
            });

            // Handle click event to open the file input
            $imageDropArea.on('click', function() {
                $imageInput.click();
            });

            // Handle file input change event
            $imageInput.on('change', function() {
                const files = this.files;
                handleImages(files);
            });

            // Function to process and preview images
            function handleImages(files) {
                $.each(files, function(index, file) {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            const $imageContainer = $('<div class="image-container"></div>');
                            const $img = $('<img>').attr('src', event.target.result);
                            const $cancelButton = $('<button class="cancel-button">&times;</button>');

                            // Add click event to cancel button to remove image container
                            $cancelButton.on('click', function() {
                                $imageContainer.remove();
                            });

                            $imageContainer.append($img).append($cancelButton);
                            $imagePreview.append($imageContainer);
                        };
                        reader.readAsDataURL(file);
                    } else {
                        alert(file.name + " is not an image file.");
                    }
                });
            }
        });
    </script>
@endpush
