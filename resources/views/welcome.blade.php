<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>MiniCRM Admin </title>
    @include('layouts.admin_layouts.header')
</head>


<body>

    @include('layouts.admin_layouts.topnav')
    
    <div id="app">
        <!--  BEGIN NAVBAR  -->
        <div class="sub-header-container">
            <header class="header navbar navbar-expand-sm">
                <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>
    
                <ul class="navbar-nav flex-row">
                    <li>
                        <div class="page-header">
    
                            <nav class="breadcrumb-one" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><span>Add Company Or Employee</span></li>
                                </ol>
                            </nav>
    
                        </div>
                    </li>
                </ul>
              
            </header>
        </div>
    <!--  BEGIN MAIN CONTAINER  -->
        <div class="main-container" id="container">
    
            <div class="overlay"></div>
            <div class="search-overlay"></div>
    
            {{-- sidebar --}}
            @include('layouts.admin_layouts.sidebar')
            {{-- sidebar --}}

            {{-- Main Content --}}
            <div id="content" class="main-content">
                <div class="layout-px-spacing">
                    <div class="row layout-top-spacing">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-activity-two">
                                <div class="widget-heading">
                                    <h5 class="">Add Company Or Employee</h5>   
                                </div>
                                @if(session()->has('message'))
                                <div class="alert alert-success" role="alert">
                                <strong>Success!</strong> {{ session()->get('message') }}
                                </div>
                                @endif
                            <div class="widget-content">
                                <company-component></company-component>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@include('layouts.admin_layouts.footer')