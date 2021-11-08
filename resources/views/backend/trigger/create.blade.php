@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{isset($trigger)?'Edit':'Add'}} Triggers</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/trigger')}}"> Triggers</a></li>
                        <li class="breadcrumb-item active">{{isset($trigger)?'Edit':'Add'}}</li>

                        
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
                        <form id="quickForm" novalidate="novalidate" method="post" action="{{ route('trigger.store') }}">
                        
                        
                            {!! csrf_field() !!}
                            <div class="card-body">
                                <div class="form-group">
                                <input type="hidden" id="id" name="id" value="{{isset($trigger)?$trigger->id:''}}">        
                                    <label for="exampleInputEmail1">Beacon Name</label>
                                    <select id="beacon_id" name="beacon_id" class="form-control">
                                      <option value="" selected><---Select Beacon Name---></option>
                                      @foreach($beacons as $beacon)
                                        <option value="{{$beacon->id}}"  @if(isset($trigger->beacon_id)) @if($trigger->beacon_id=="$beacon->id") selected @endif @endif > {{ $beacon->name }}  </option> 
                                      @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Title</label>
                                    <input type="text" name="title" class="form-control" id="title"  minlength="4" maxlength="15" placeholder="Enter title" value="{{isset($trigger)?$trigger->title:''}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Body</label>
                                    <textarea name="body" class="form-control" id="body" placeholder="Enter body" row="3" value="{{isset($trigger)?$trigger->body:''}}">{{isset($trigger)?$trigger->body:''}}</textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{route('trigger.index')}}" class="btn btn-default">Back</a>
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
  $('#quickForm').validate({
    rules: {
      title: {
        required: true,
      },
      body: {
        required: true
      },
      beacon_id: {
        required: true,
      },
      
    },
    messages: {
      title: {
        required: "Please enter a title",
      },
      body: {
        required: "Please enter a body",
      },
      beacon_id: {
        required: "Please select a beacon name",
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