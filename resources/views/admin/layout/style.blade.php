<!-- FAVICON -->
<link rel="shortcut icon" type="image/x-icon" href="{{asset($company->favicon)}}" />

<!-- BOOTSTRAP CSS -->
<link id="style" href="{{asset('/')}}admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

<!-- STYLE CSS -->
<link href="{{asset('/')}}admin/assets/css/style.css" rel="stylesheet" />
<link href="{{asset('/')}}admin/assets/css/skin-modes.css" rel="stylesheet" />

<!--- FONT-ICONS CSS -->
<link href="{{asset('/')}}admin/assets/plugins/icons/icons.css" rel="stylesheet" />

<!-- INTERNAL Switcher css -->
<link href="{{asset('/')}}admin/assets/switcher/css/switcher.css" rel="stylesheet">
<link href="{{asset('/')}}admin/assets/switcher/demo.css" rel="stylesheet">

<!-- SELECT2 JS -->
<script src="{{asset('/')}}admin/assets/plugins/select2/select2.full.min.js"></script>

{{-- notify  css--}}
@notifyCss

<style>
    #laravel-notify div{
        z-index: 100!important;
    }
</style>

<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
