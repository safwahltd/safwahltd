<style>
    /* Styling for the lines */
    .line {
        left: 0;
        right: 0;
        top: 50%;
        opacity: 0;
        display: none; /* Hide initially */
    }

    /* Show the active line with opacity animation */
    .line.active {
        display: block;
        opacity: 1;
        transition: opacity 0.7s ease-in-out;
    }

    /* Fading out the previous line */
    .line.previous {
        opacity: 0;
        transition: opacity 0.7s ease-in-out;
    }
</style>
<div class="container-fluid py-2" style="background-color: {{$cms->top_bar_bg_color}}">
    <div class="container">
        <div class="justify-content-between">
            <div class="text-center">
                @foreach($topBars as $top)
                    <a class="line" style="color: {{$cms->top_bar_text_color}}" target="_blank" href="{{$top->url}}"><small class="">{{$top->title}}</small></a>
                @endforeach
            </div>
        </div>
    </div>
</div>
