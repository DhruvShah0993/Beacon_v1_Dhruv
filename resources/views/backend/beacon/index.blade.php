@extends('backend.layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Beacons</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Beacons</li>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                           <div class="btn-group pull-right" style="float:right;">
			<a href="{{ url('/admin/beacon/create') }}" class="btn btn-primary pull-right create-event">
			<i class="fa fa-fw fas fa-bold "></i>
				<span class="text">Add Beacon</span>
			</a>
		</div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        @if (Session::get('success'))
                        <div class="alert alert-success alert-block mt-2 ml-2 mr-2">
                            <strong>{{ Session::get('success') }}</strong>
                        </div>
                        @endif
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Major</th>
                                        <th>Minor</th>
                                        <th>UID</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Major</th>
                                        <th>Minor</th>
                                        <th>UID</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div><!-- comment -->
            </div>
        </div><!-- comment -->
    </section>
    <!-- /.content -->
</div>
<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">View Beacon</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              	<div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="email" class="form-control" id="name" disabled>
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Major</label>
                    <input type="email" class="form-control"  id="major" disabled>
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail">Minor</label>
                    <input type="email" class="form-control"  id="minor" disabled>
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail">UID</label>
                    <input type="email" class="form-control" id="uid" disabled>
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail">Description</label>
                    <textarea name="description" class="form-control" id="description" rows="3" disabled></textarea>
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail">Address</label>
                    <textarea name="email" class="form-control" id="address" rows="3" disabled></textarea>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
@endsection
@push('scripts')
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#example2').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url('/admin/beacon') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'major', name: 'major'},
                {data: 'minor', name: 'minor'},
                {data: 'uid', name: 'uid'},
                {data: 'address', name: 'address'},
                {data: 'action', name: 'action', searchable: false, orderable:false},
            ],
            "aoColumnDefs": [
                {"bSortable": false, "aTargets": [3]},
                {"bSearchable": false, "aTargets": [3]}
            ],
            "order": [[0, "desc"]]
        });
        $(document).on("click", "#showUser", function () {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{ url('admin/beacon') }}" + '/' + id,
                method: 'get',
                success: function (result) {
                    console.log(result.data.beacon.description);
                    $("#name").val(result.data.beacon.name);
                    $("#major").val(result.data.beacon.major);
                    $("#minor").val(result.data.beacon.minor);
                    $("#uid").val(result.data.beacon.uid);
                    $("#description").val(result.data.beacon.description);
                    $("#address").val(result.data.beacon.address);
                }
            });
        });

        $(document).on("click", ".delete_card", function () {
            var Id = $(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{url('admin/beacon')}}" + '/' + Id,

                        method: 'DELETE',
                        data: {
                            'id': Id,
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function (result) {
                            Swal.fire(
                                    'Deleted!',
                                    '',
                                    'success'
                                    )
                            $('#example2').DataTable().ajax.reload();
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    /*Swal.fire(
                     'Cancelled',
                     '',
                     'error'
                     )*/
                }
            })
            return false;
        });

        $("document").ready(function(){
            setTimeout(function(){
                $(".alert-block").remove();
            }, 5000 );
        });
    });
</script>
@endpush
