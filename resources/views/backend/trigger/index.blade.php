@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Triggers</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Triggers</li>
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
			<a href="{{ url('/admin/trigger/create') }}" class="btn btn-primary pull-right create-event">
            <i class="fab fa-fw fa-lg fab fa-tumblr"></i>				
                <span class="text">Add Trigger</span>
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
                                        <th>Beacon Name</th>
                                        <th>Title</th>
                                        <th>Body</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Beacon Name</th>
                                        <th>Title</th>
                                        <th>Body</th>
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
              <h4 class="modal-title">View Trigger</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              	
                <div class="form-group">
                    <label for="exampleInputEmail1">Beacon Name</label>
                    <input type="text" class="form-control"  id="beacon_id" disabled>
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" class="form-control"  id="title" disabled>
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail">Body</label>
                    <input type="body" class="form-control"  id="body" disabled>
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
            ajax: '{{ url('/admin/trigger') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'beacon_id', name: 'beacon_id'},
                {data: 'title', name: 'title'},
                {data: 'body', name: 'body'},
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
                url: "{{ url('admin/trigger') }}" + '/' + id,
                method: 'get',
                success: function (result) {
                    console.log(result.data.trigger[0].name);
                     $("#beacon_id").val(result.data.trigger[0].name);
                     $("#title").val(result.data.trigger[0].title);
                     $("#body").val(result.data.trigger[0].body);
                }
            });
        });

        $(document).on("click", ".delete_card", function () {
            var id = $(this).attr('data-id');
            // console.log(id);
            $.ajax({
                url: "{{url('admin/trigger')}}" + '/' + id,

                method: 'DELETE',
                data: {
                    'id': id,
                    '_token': '{{ csrf_token() }}',
                },
                success: function (result) {
                   
                    $('#example2').DataTable().ajax.reload();
                }
            });
        });

        $("document").ready(function(){
            setTimeout(function(){
                $(".alert-block").remove();
            }, 5000 );
        });
    });
</script>
@endpush
