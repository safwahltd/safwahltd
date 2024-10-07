@extends('website.layout.app')
@section('title','Article Details')
@section('body')
    <div class="container-fluid blog py-5" style="background-color: #2a2c2a">
        <div class="container mt-5">
            <h1>Gallery</h1>
            <div class="row">
{{--                @foreach($images as $image)--}}
                    <div class="col-md-4 mb-4">
                        <a href="#" class="image-link" data-image="https://picsum.photos/id/110/1200/800.webp" data-title="https://picsum.photos/id/110/1200/800.webp">
                            <img src="https://picsum.photos/id/110/1200/800.webp" class="img-fluid" alt="https://picsum.photos/id/110/1200/800.webp">
                        </a>
                    </div>
                    <div class="col-md-4 mb-4">
                            <a href="#" class="image-link" data-image="https://picsum.photos/id/177/480/320.webp" data-title="https://picsum.photos/id/110/1200/800.webp">
                                <img src="https://picsum.photos/id/177/480/320.webp" class="img-fluid" alt="https://picsum.photos/id/110/1200/800.webp">
                            </a>
                        </div>

{{--                @endforeach--}}
            </div>
        </div>
        <!-- Lightbox Modal -->
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
