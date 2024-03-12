@extends('admin.layouts.app')

@section('style')
@endsection

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Add New Color</h1>
          </div>  
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <form action="" method="post">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Brand Name <span style="color: red;">*</span> </label>
                    <input name="name" type="text" class="form-control" placeholder="Color Name" value="{{ old('name') }}" required>
                  </div>

                  <div class="form-group">
                    <label>Code <span style="color: red;">*</span> </label>
                    <input name="code" type="color" class="form-control" placeholder="Code" value="{{ old('code') }}" required>
                  </div>

                  
                  <div class="form-group">
                    <label>Status <span style="color: red;">*</span> </label>
                    <select name="status" class="form-control" required>
                      <option {{ (old('status') == 0) ? 'selected':'' }} value="0">Active</option>
                      <option {{ (old('status') == 1) ? 'selected':'' }} value="1">InActive</option>
                    </select>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>    
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection

@section('script')
@endsection