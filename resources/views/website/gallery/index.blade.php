@extends('website.layout.app')
@section('title','Article Details')
@section('body')
    <div class="container-fluid blog py-2" style="background-color: #2a2c2a">
        <div class="container mt-3">
            <div class="row">
                @foreach($images as $image)
                    <div class="col-md-4 mb-4"  style="object-fit: cover">
                        <a href="#" class="image-link" data-image="{{asset($image->image)}}" data-title="{{$image->caption}}">
                            <img src="{{asset($image->image)}}" style="width: 100%; height: 100%" class="img-fluid"  alt="{{$image->alt}}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Lightbox Modal -->
        <div class="modal fade" id="lightboxModal" tabindex="-1" aria-labelledby="lightboxModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="lightboxImage" src="" class="img-fluid" alt="">
                        <p id="lightboxTitle" class="mt-2 fw-bold text-black"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="prevImage" class="btn btn-primary">Previous</button>
                        <button type="button" id="nextImage" class="btn btn-primary">Next</button>
                    </div>
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
@endpush
