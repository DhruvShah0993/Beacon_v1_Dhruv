@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{isset($beacon)?'Edit':'Add'}} Beacon</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/beacon')}}">Beacons</a></li>
                        <li class="breadcrumb-item active">{{isset($beacon)?'Edit':'Add'}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <!--              <div class="card-header">
                                        <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3>
                                      </div>-->
                        <!-- /.card-header -->
                        <!-- form start -->
                                @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                                @endif
                                @if (!empty($errors->toarray()))
                                <div class="alert alert-danger">
                                    <span></span>
                                </div>
                                @endif
                        <form id="quickForm" novalidate="novalidate" method="post" action="{{ route('beacon.store') }}">
                            <input type="hidden" id="beacon_id" name="beacon_id" value="{{ isset($beacon)?be64($beacon->id):'' }}">
                            {!! csrf_field() !!}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" minlength="4" maxlength="10" placeholder="Enter name" value="{{isset($beacon)?$beacon->name:''}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Major</label>
                                    <input type="text" name="major" class="form-control" id="major" minlength="4" maxlength="15" placeholder="Enter major" value="{{isset($beacon)?$beacon->major:''}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Minor</label>
                                    <input type="text" name="minor" class="form-control" id="minor" minlength="4" maxlength="15" placeholder="Enter minor" value="{{isset($beacon)?$beacon->minor:''}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">UID</label>
                                    <input type="text" name="uid" class="form-control" id="uid" placeholder="Enter uid" value="{{isset($beacon)?$beacon->uid:''}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Desc</label>
                                    <textarea name="desc" class="form-control" id="desc" placeholder="Enter desc" row="3" value="{{isset($beacon)?$beacon->desc:''}}">{{isset($beacon)?$beacon->desc:''}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Address</label>
                                    <textarea name="address" class="form-control" id="address" placeholder="Enter address" row="3" value="{{isset($beacon)?$beacon->address:''}}">{{isset($beacon)?$beacon->address:''}}</textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{route('beacon.index')}}" class="btn btn-default">Back</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                
            </div>
        </div><!-- comment -->
    </section>
    <!-- /.content -->
</div>
@endsection
@push('scripts')
<script>
$(function () {
    console.log('wgew');
  $('#quickForm').validate({
    rules: {
      name: {
        required: true,
      },
      uid: {
        required: true
      },
      major: {
        required: true,
      },
      minor: {
        required: true
      }, 
      desc: {
        required: true
      }, 
      address: {
        required: true
      },
    },
    messages: {
      name: {
        required: "Please enter a name",
      },
      uid: {
        required: "Please enter a UID",
      },
      major: {
        required: "Please enter a major",
      },
      minor: {
        required: "Please enter a minor",
      },
      desc: {
        required: "Please enter a desc",
      },
      address: {
        required: "Please enter a address",
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
@endpush