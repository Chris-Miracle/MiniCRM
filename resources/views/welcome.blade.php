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
                                    <li class="breadcrumb-item active" aria-current="page"><span>Add Company</span></li>
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
                                    <h5 class="">Add Company</h5>   
                                </div>
                                @if(session()->has('message'))
                                <div class="alert alert-success" role="alert">
                                <strong>Success!</strong> {{ session()->get('message') }}
                                </div>
                                @endif
                            <div class="widget-content">
                            {{-- <form action="{{route('craft.add')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('post')
                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-12">
                                            <label for="name">Name</label>
                                        <input type="text" class="form-control" placeholder="Name of Craft" name="name" value="{{old('name')}}">
                                            <div class="text-danger">{{$errors->first('name')}}</div>
                                        </div>
                                    </div>

                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-12">
                                            <label for="description">Description</label>
                                        <input type="text" class="form-control" placeholder="Description" name="description" value="{{old('description')}}">
                                            <div class="text-danger">{{$errors->first('description')}}</div>
                                        </div>
                                    </div>

                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-12">
                                            <label for="price">Price</label>
                                        <input type="text" class="form-control" placeholder="Price" name="price" value="{{old('price')}}">
                                            <div class="text-danger">{{$errors->first('price')}}</div>
                                        </div>
                                    </div>

                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-12">
                                            <label for="image">Add image</label>
                                        <input type="file" class="form-control-file" name="image" value="{{old('image')}}">
                                            <div class="text-danger">{{$errors->first('image')}}</div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-3">Add New Craft </button>
                                </form>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>


@include('layouts.admin_layouts.footer')