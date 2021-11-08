@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Start Container -->
    <div class="container"> 
        <div class="row d-flex justify-content-between">
            <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4 text-center">
                <div class="card bg-primary">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6 mt-2">
                            <i class="fas fa-bold fa-4x mb-2"></i>              
                        </div>  
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6 mt-2">  
                            <h4>Beacons</h4>
                            <h2>{{ $beacons }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4 text-center">
                <div class="card bg-danger">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6 mt-2">
                            <i class="fas fa-fire fa-4x mb-2"></i>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6 mt-2">
                            <h4>Triggers</h4>
                            <h2>{{ $triggers }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4 text-center">
                <div class="card bg-dark">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6 mt-2 text-white">
                            <i class="fa fa-history fa-4x mb-2"></i>
                        </div>    
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6 mt-2 text-white">
                            <h4>Logs</h4>
                            <h2>{{ $logs }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4 text-center">
                <div class="card bg-success">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6 mt-2">
                            <i class="fas fa-laptop-code fa-4x mb-2"> </i>
                        </div>    
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6 mt-2">
                            <h4>Devices</h4>
                            <h2>{{ $devices }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection