<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
<title>Blog Chat</title>
<link rel="icon" type="image/x-icon" href="{{asset('admins/assets/img/favicon.ico')}}"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
<link href="{{asset('admins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('admins/assets/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="{{asset('admins/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css">
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<link rel="stylesheet" href="{{asset('admins/plugins/font-icons/fontawesome/css/regular.css')}}">
<link rel="stylesheet" href="{{asset('admins/plugins/font-icons/fontawesome/css/fontawesome.css')}}">
<!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
<link rel="stylesheet" type="text/css" href="{{asset('admins/plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admins/plugins/table/datatable/custom_dt_html5.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admins/plugins/table/datatable/dt-global_style.css')}}">
<!-- END PAGE LEVEL CUSTOM STYLES -->
<link href="{{asset('admins/plugins/sweetalerts/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('admins/plugins/sweetalerts/sweetalert.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('admins/assets/css/components/custom-sweetalert.css')}}" rel="stylesheet" type="text/css"/>

<link href="{{asset('admins/plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('admins/plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('admins/assets/css/components/custom-carousel.css')}}" rel="stylesheet" type="text/css" />

<link href="{{asset('admins/assets/css/components/tabs-accordian/custom-tabs.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('admins/assets/css/components/cards/card.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('admins/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="{{asset('admins/assets/css/forms/switches.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admins/plugins/bootstrap-select/bootstrap-select.min.css')}}">
<link href="{{asset('admins/assets/css/apps/mailing-chat.css')}}" rel="stylesheet" type="text/css"/>


<style>
    /*
        The below code is for DEMO purpose --- Use it if you are using this demo otherwise Remove it
    */
    /*.navbar .navbar-item.navbar-dropdown {
        margin-left: auto;
    }*/
    .layout-px-spacing {
        min-height: calc(100vh - 184px) !important;
    }

    .btn-delete {
        background-color: transparent;
        border: none;
    }

    .feather-icon .icon-section {
        padding: 30px;
    }

    .feather-icon .icon-section h4 {
        color: #3b3f5c;
        font-size: 17px;
        font-weight: 600;
        margin: 0;
        margin-bottom: 16px;
    }

    .feather-icon .icon-content-container {
        padding: 0 16px;
        width: 86%;
        margin: 0 auto;
        border: 1px solid #bfc9d4;
        border-radius: 6px;
    }

    .feather-icon .icon-section p.fs-text {
        padding-bottom: 30px;
        margin-bottom: 30px;
    }

    .feather-icon .icon-container {
        cursor: pointer;
    }

    .feather-icon .icon-container svg {
        color: #3b3f5c;
        margin-right: 6px;
        vertical-align: middle;
        width: 20px;
        height: 20px;
        fill: rgba(0, 23, 55, 0.08);
    }

    .feather-icon .icon-container:hover svg {
        color: #1b55e2;
        fill: rgba(27, 85, 226, 0.23921568627450981);
    }

    .feather-icon .icon-container span {
        display: none;
    }

    .feather-icon .icon-container:hover span {
        color: #1b55e2;
    }

    .feather-icon .icon-link {
        color: #1b55e2;
        font-weight: 600;
        font-size: 14px;
    }


</style>

<script>
    function logout() {
        $('#logout-form').submit();
    }
</script>
<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
