@extends('admin.layout.app')
@section('title','CMS Settings')
@section('body')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">CMS Module</h1>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-6 col-md-3 col-lg-3">
            <div class="card border" style="background: linear-gradient(to bottom, silver 0%, black 80%)">
                <div class="card-header border">
                    <h6 class="text-center text-white fw-bold">Loading Image</h6>
                    <label class="colorinput mx-2">
                        <input name="loading_image_status" type="checkbox" {{$cms->loading_image_status == 1 ? 'checked':''}}  class="colorinput-input" />
                        <span class="colorinput-color bg-azure"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 col-lg-3">
            <div class="card border" style="background: linear-gradient(to bottom, silver 0%, black 80%)">
                <div class="card-header border">
                    <h6 class="text-center text-white fw-bold">Slider</h6>
                    <label class="colorinput mx-2">
                        <input name="slider" type="checkbox" {{$cms->slider == 1 ? 'checked':''}}   class="colorinput-input"/>
                        <span class="colorinput-color bg-azure"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 col-lg-3">
            <div class="card border" style="background: linear-gradient(to bottom, silver 0%, black 80%)">
                <div class="card-header border">
                    <h6 class="text-center text-white fw-bold">Company Logo Header</h6>
                    <label class="colorinput mx-2">
                        <input name="company_logo_header" type="checkbox" {{$cms->company_logo_header == 1 ? 'checked':''}}  onchange="this.form.submit()" class="colorinput-input" />
                        <span class="colorinput-color bg-azure"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 col-lg-3">
            <div class="card border" style="background: linear-gradient(to bottom, silver 0%, black 80%)">
                <div class="card-header border">
                    <h6 class="text-center text-white fw-bold">Company Logo Footer</h6>
                    <label class="colorinput mx-2">
                        <input name="company_logo_footer" type="checkbox" {{$cms->company_logo_footer == 1 ? 'checked':''}}  onchange="this.form.submit()" class="colorinput-input" />
                        <span class="colorinput-color bg-azure"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 col-lg-3">
            <div class="card border" style="background: linear-gradient(to bottom, silver 0%, black 80%)">
                <div class="card-header border">
                    <h6 class="text-center text-white fw-bold">Footer Social Link</h6>
                    <label class="colorinput mx-2">
                        <input name="footer_social_link" type="checkbox" {{$cms->footer_social_link == 1 ? 'checked':''}}  onchange="this.form.submit()" class="colorinput-input" />
                        <span class="colorinput-color bg-azure"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 col-lg-3">
            <div class="card border" style="background: linear-gradient(to bottom, silver 0%, black 80%)">
                <div class="card-header border">
                    <h6 class="text-center text-white fw-bold">Google Map</h6>
                    <label class="colorinput mx-2">
                        <input name="google_map" type="checkbox" {{$cms->google_map == 1 ? 'checked':''}}   onchange="this.form.submit()" class="colorinput-input" />
                        <span class="colorinput-color bg-azure"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <form class="form-horizontal" action="{{route('admin.cms.value.update',$cms->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-md-6 mx-0" style="gap: 0">
                    <div class="row input-group mb-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text text-white  col-4 bg-dark-gradient" id="website_title">Website Title</span>
                            <input type="text" name="website_title" class="form-control" value="{{$cms->website_title}}" placeholder="company name" aria-label="company name" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row input-group mb-4">

                        <div class="input-group mb-3">
                            <span class="input-group-text text-white col-4 bg-dark-gradient" id="top_bar_bg_color">Top Bar Bg Color</span>
                            <input type="text" name="top_bar_bg_color" class="form-control" value="{{$cms->top_bar_bg_color}}" placeholder="Top Bar Bg Color" aria-label="company title" aria-describedby="basic-addon1"><br>
                        </div>
                        <span class="text-danger text-muted">Example : black or #32eds or rgb(255, 0, 0)</span>
                    </div>
                    <div class="row input-group mb-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text text-white col-4 bg-dark-gradient" id="top_bar_text_color">Top Bar Text Color</span>
                            <input type="text" name="top_bar_text_color" class="form-control" value="{{$cms->top_bar_text_color}}" placeholder="Top Bar Text Color" aria-label="Top Bar Text Color" aria-describedby="basic-addon1"><br>
                        </div>
                        <span class="text-danger text-muted">Example : black or #32eds or rgb(255, 0, 0)</span>
                    </div>
                    <div class="row input-group mb-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text text-white col-4 bg-dark-gradient" id="header_bg_color">Header Bg Color</span>
                            <input type="text" name="header_bg_color" class="form-control" value="{{$cms->header_bg_color}}" placeholder="Header Bg Color" aria-label="Header Bg Color" aria-describedby="basic-addon1"><br>
                        </div>
                        <span class="text-danger text-muted">Example : black or #32eds or rgb(255, 0, 0)</span>
                    </div>
                    <div class="row input-group mb-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text text-white col-4 bg-dark-gradient" id="home_section_bg_color">Home Section Bg Color</span>
                            <input type="text" name="home_section_bg_color" class="form-control" value="{{$cms->home_section_bg_color}}" placeholder="Home Section Bg Color" aria-label="Home Section Bg Color" aria-describedby="basic-addon1"><br>
                        </div>
                        <span class="text-danger text-muted">Example : black or #32eds or rgb(255, 0, 0)</span>
                    </div>
                    <div class="row input-group mb-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text text-white col-4 bg-dark-gradient" id="footer_section_bg_color">Footer Section Bg Color</span>
                            <input type="text" name="footer_section_bg_color" class="form-control" value="{{$cms->footer_section_bg_color}}" placeholder="Footer Section Bg Color" aria-label="Footer Section Bg Color" aria-describedby="basic-addon1"><br>
                        </div>
                        <span class="text-danger text-muted">Example : black or #32eds or rgb(255, 0, 0)</span>
                    </div>
                </div>
                <div class="col-md-6 mx-0">
                    <div class="row input-group mb-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text text-white col-4 bg-dark-gradient" id="contact_form_color">Contact Form Color</span>
                            <input type="text" name="contact_form_color" class="form-control" value="{{$cms->contact_form_color}}" placeholder="Contact Form Color" aria-label="Contact Form Color" aria-describedby="basic-addon1"><br>
                        </div>
                        <span class="text-danger text-muted">Example : black or #32eds or rgb(255, 0, 0)</span>
                    </div>
                    <div class="row input-group mb-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text text-white col-4 bg-dark-gradient" id="bulk_order_form_color">Bulk Order Form Color</span>
                            <input type="text" name="bulk_order_form_color" class="form-control" value="{{$cms->bulk_order_form_color}}" placeholder="Bulk Order Form Color" aria-label="Bulk Order Form Color" aria-describedby="basic-addon1"><br>
                        </div>
                        <span class="text-danger text-muted">Example : black or #32eds or rgb(255, 0, 0)</span>
                    </div>
                    <div class="row input-group mb-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text text-white col-4 bg-dark-gradient" id="wholesaler_form_color">Wholesaler Form Color</span>
                            <input type="text" name="wholesaler_form_color" class="form-control" value="{{$cms->wholesaler_form_color}}" placeholder="Wholesaler Form Color" aria-label="Wholesaler Form Color" aria-describedby="basic-addon1"><br>
                        </div>
                        <span class="text-danger text-muted">Example : black or #32eds or rgb(255, 0, 0)</span>
                    </div>
                    <div class="row input-group mb-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text text-white col-4 bg-dark-gradient" id="loading_image">Loading Image</span>
                            <input type="file" name="loading_image" class="form-control col-5 image-input" value="" id="banner" placeholder="Loading Image" aria-label="Loading Image" aria-describedby="basic-addon1">
                            <img class="img-fluid img-responsive mx-1" id="imagePreview-banner" src="{{asset($cms->loading_image)}}"
                                 alt="Your Image" style="width: 100px; height: auto;" />
                        </div>
                    </div>
                </div>
            </div>
            @if(auth()->user()->hasPermission('admin cms update'))
            <button class="btn btn-primary" type="submit">update</button>
            @endif
        </form>

    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('.colorinput-input').on('change', function() {

                var name = $(this).attr('name');

                $.ajax({
                    url: '{{ route('admin.cms.update') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name,
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            // alert(response.message);
                        } else {
                            toastr.error(response.message);
                            // alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred while updating the setting.');
                    }
                });
            });
        });
    </script>
@endpush
