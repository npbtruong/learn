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
          <h1>Edit Product</h1>
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

                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Title <span style="color: red;">*</span> </label>
                      <input name="title" type="text" class="form-control" placeholder="Title" value="{{ old('title',$product->title) }}" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>SKU <span style="color: red;">*</span> </label>
                      <input name="sku" type="text" class="form-control" placeholder="SKU" value="{{ old('sku',$product->sku) }}" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Category <span style="color: red;">*</span> </label>
                      <select class="form-control" id="ChangeCategory" name="category_id">
                        <option value="">Select</option>
                        @foreach ($getCategory as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Sub Category <span style="color: red;">*</span> </label>
                      <select class="form-control" id="getSubCategory" name="sub_category_id">
                        <option value="">Select</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Brand <span style="color: red;">*</span> </label>
                      <select class="form-control" name="brand_id">
                        <option value="">Select</option>
                        @foreach ($getBrand as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Color <span style="color: red;">*</span> </label>
                      @foreach ($getColor as $color)
                        <div>
                          <label><input type="checkbox" name="color_id[]" value="{{ $color->id }}"> {{ $color->name }}</label>
                        </div>
                      @endforeach
                      
                    </div>
                  </div>
                </div>

                <hr>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Price <span style="color: red;">*</span> </label>
                      <input name="price" type="text" class="form-control" placeholder="Price" value="" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Old Price <span style="color: red;">*</span> </label>
                      <input name="old_price" type="text" class="form-control" placeholder="Old Price" value="" required>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Size <span style="color: red;">*</span> </label>
                      <div>
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Price</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                <input type="text" name="" class="form-control">
                              </td>
                              <td>
                                <input type="text" name="" class="form-control">
                              </td>
                              <td>
                                <button type="button" class="btn btn-primary">Add</button>
                                <button type="button" class="btn btn-danger">Delete</button>
                              </td>
                            </tr>

                            <tr>
                              <td>
                                <input type="text" name="" class="form-control">
                              </td>
                              <td>
                                <input type="text" name="" class="form-control">
                              </td>
                              <td>

                                <button type="button" class="btn btn-danger">Delete</button>
                              </td>
                            </tr>

                            <tr>
                              <td>
                                <input type="text" name="" class="form-control">
                              </td>
                              <td>
                                <input type="text" name="" class="form-control">
                              </td>
                              <td>

                                <button type="button" class="btn btn-danger">Delete</button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                </hr>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Short Description <span style="color: red;">*</span> </label>
                      <textarea name="short_description" class="form-control" placeholder="Short Description"></textarea>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label> Description <span style="color: red;">*</span> </label>
                      <textarea name="description" class="form-control" placeholder="Description"></textarea>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Additional Information <span style="color: red;">*</span> </label>
                      <textarea name="additional_information" class="form-control" placeholder="Additional Information"></textarea>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Shipping Returns <span style="color: red;">*</span> </label>
                      <textarea name="shipping_returns" class="form-control" placeholder="Shipping Returns"></textarea>
                    </div>
                  </div>
                </div>
                <hr />
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Status <span style="color: red;">*</span> </label>
                      <select name="status" class="form-control" required>
                        <option {{ (old('status') == 0) ? 'selected':'' }} value="0">Active</option>
                        <option {{ (old('status') == 1) ? 'selected':'' }} value="1">InActive</option>
                      </select>
                    </div>
                  </div>
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
<script type="text/javascript">
  $('body').delegate('#ChangeCategory', 'change', function(e) {
        var id = $(this).val();
        $.ajax({
          type: "POST",
          url: "{{ url('admin/get_sub_category') }}",
          data: {
            "id": id,
            "_token": "{{ csrf_token() }}"
          },
          dataType: "json",
          success: function(data) {
              $('#getSubCategory').html(data.html);
          },
          error: function(data) {

          }
        });

  });
</script>
@endsection