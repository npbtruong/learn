@extends('admin.layouts.app')

@section('style')
@endsection

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Brand List</h1>
          </div>
          <div class="col-sm-6">
            <a href="{{ url('admin/color/add') }}" class="btn btn-primary">Add New Color</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        
          <!-- /.col -->
          <div class="col-md-12">
          
          @include('admin.layouts._message')

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Color List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th >#</th>
                      <th>Name</th>
                      <th>Code</th>
                      
                      <th>Created By</th>
                      <th>Status</th>
                      <th>Created Date</th>
                      <th>Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($getRecord as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->code }}</td>

                            <td>{{ $value->created_by_name }}</td>
                            <td>{{ ( $value->status == 0 )? 'Active':'Inactive' }}</td>
                            <td>{{ date('d-M-Y', strtotime($value->created_at)) }}</td>

                            <td>
                            <a href="{{ url('admin/color/edit/'.$value->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ url('admin/color/delete/'.$value->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>    
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection

@section('script')
@endsection