<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<!-- JavaScript Libraries -->
<script src="{{asset('/')}}website/lib/wow/wow.min.js"></script>
<script src="{{asset('/')}}website/lib/easing/easing.min.js"></script>
<script src="{{asset('/')}}website/lib/waypoints/waypoints.min.js"></script>
<script src="{{asset('/')}}website/lib/owlcarousel/owl.carousel.min.js"></script>
<!-- Template Javascript -->
<script src="{{asset('/')}}website/js/main.js"></script>

<script>
    $(document).ready(function() {
        let lines = $('.line');
        let currentLine = 0;
        function showNextLine() {
            $(lines[currentLine]).removeClass('active').fadeOut(700, function() {
                currentLine = (currentLine + 1) % lines.length;
                $(lines[currentLine]).addClass('active').fadeIn(700);
            });
        }
        $(lines[currentLine]).addClass('active').fadeIn(700);
        setInterval(showNextLine, 3000);
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

{!! Toastr::message() !!}
<script>
    toastr.options = {
        "progressBar" : true,
        "closeButton" : true,
    }
    @if(Session::has('message'))
    toastr.success("{{ Session::get('message') }}");

    @elseif(Session::has('warning'))
    toastr.warning("{{ Session::get('warning') }}");

    @elseif(Session::has('info'))
    toastr.info("{{ Session::get('info') }}");

    @elseif(Session::has('error'))
    toastr.error("{{ Session::get('error') }}");
    @endif
</script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v16.0"></script>
<script async src="//www.instagram.com/embed.js"></script>

@stack('js')
<script src="{{asset('/')}}owl-carousel/owl.carousel.js"></script>
<script>
    function reloadCaptcha() {
        const captchaImage = document.querySelector('.captcha img');
        captchaImage.src = "{{ \Mews\Captcha\Facades\Captcha::src('math') }}" + "&" + Date.now();
    }
</script>
