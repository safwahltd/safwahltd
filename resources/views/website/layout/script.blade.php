<!-- JavaScript Libraries -->
<script src="{{asset('/')}}website/ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="{{asset('/')}}website/cdn.jsdelivr.net/npm/bootstrap%405.0.0/dist/js/bootstrap.bundle.min.js"></script>
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
            // Fade out current line
            $(lines[currentLine]).removeClass('active').fadeOut(700, function() {
                // Move to the next line (or loop back to the first one)
                currentLine = (currentLine + 1) % lines.length;

                // Fade in the next line
                $(lines[currentLine]).addClass('active').fadeIn(700);
            });
        }

        // Initial display of the first line
        $(lines[currentLine]).addClass('active').fadeIn(700);

        // Change line every 3 seconds (3000 milliseconds)
        setInterval(showNextLine, 3000);
    });
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

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
