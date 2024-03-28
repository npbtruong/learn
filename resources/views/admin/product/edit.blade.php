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

          @include('admin.layouts._message')

          <!-- general form elements -->
          <div class="card card-primary">
            <form action="" method="post" enctype="multipart/form-data">
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
                      <select class="form-control" id="ChangeCategory" name="category_id" required>
                        <option value="">Select</option>
                        @foreach ($getCategory as $category)
                        <option {{ ($product->category_id == $category->id) ? 'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Sub Category <span style="color: red;">*</span> </label>
                      <select class="form-control" id="getSubCategory" name="sub_category_id" required>
                        <option value="">Select</option>
                        @foreach ($getSubCategory as $subCategory)
                        <option {{ ($product->sub_category_id == $subCategory->id) ? 'selected':'' }} value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Brand <span style="color: red;">*</span> </label>
                      <select class="form-control" name="brand_id">
                        <option value="">Select</option>
                        @foreach ($getBrand as $brand)
                        <option {{ ($product->brand_id == $brand->id) ? 'selected':'' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
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
                            @php
                              $checked = '';
                            @endphp
                        @foreach ($product->getColor as $pcolor )
                          @if ($pcolor->color_id == $color->id)
                            @php
                              $checked = 'checked';
                            @endphp
                          @endif
                        @endforeach
                        <div>
                          <label><input {{ $checked }} type="checkbox" name="color_id[]" value="{{ $color->id }}"> {{ $color->name }}</label>
                        </div>
                      @endforeach
                      
                    </div>
                  </div>
                </div>

                <hr>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Price 💵<span style="color: red;">*</span> </label>
                      <input name="price" type="text" class="form-control" placeholder="Price" value="{{ !empty($product->price) ? $product->price : '' }}" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Old Price 💵<span style="color: red;">*</span> </label>
                      <input name="old_price" type="text" class="form-control" placeholder="Old Price" value="{{ !empty($product->old_price) ? $product->old_price : '' }}" required>
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
                          <tbody id="AppendSize">
                            @php
                              $i_s = 1;
                            @endphp
                            @foreach ($product->getSize as $size)
                              <tr id="RemoveSize{{ $i_s }}">
                                <td>
                                  <input type="text" value="{{ $size->name }}" name="size[{{$i_s}}][name]"  placeholder="Name" class="form-control">
                                </td>
                                <td>
                                  <input type="text" value="{{ $size->price }}" name="size[{{$i_s}}][price]"  placeholder="Price" class="form-control">
                                </td>
                                <td style="width: 200px;">
                                  <button type="button" id="{{$i_s}}" class="btn btn-danger RemoveSize">Remove</button>
                                </td>
                              </tr>
                            @endforeach
                            @php
                              $i_s++;
                            @endphp

                            <tr>
                              <td>
                                <input type="text" name="size[100][name]"  placeholder="Name" class="form-control">
                              </td>
                              <td>
                                <input type="text" name="size[100][price]"  placeholder="Price" class="form-control">
                              </td>
                              <td style="width: 200px;">
                                <button type="button" class="btn btn-primary AddSize">Add</button>
                              </td>
                            </tr>

                            
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <hr>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Image <span style="color: red;">*</span> </label>
                      <input type="file" name="image[]" class="form-control" style="padding:5px;" multiple accept="image/*">
                    </div>
                  </div>
                </div>

                @if (!empty($product->getImage->count()))
                  <div class="row">

                    @foreach ($product->getImage as $image )

                      @if (!empty($image->getLogo()))
                        <div class="col-md-1" style="text-align: center;">
                           <img src="{{ $image->getLogo() }}" alt="" style="width: 40%;">
                           <a onclick="return confirm('Are you sure you want to delete?');" href="{{ url('admin/product/image_delete/'.$image->id) }}" class="btn btn-danger btn-sm" style="margin-top: 10px;">Delete</a>
                        </div> 
                      @endif
                         
                    @endforeach
                    
                  </div>
                @endif

                <hr>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Short Description <span style="color: red;">*</span> </label>
                      <textarea name="short_description" class="form-control" placeholder="Short Description">{{ $product->short_description }}</textarea>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label> Description <span style="color: red;">*</span> </label>
                      <textarea name="description" class="form-control" placeholder="Description">{{ $product->description }}</textarea>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Additional Information <span style="color: red;">*</span> </label>
                      <textarea name="additional_information" class="form-control" placeholder="Additional Information">{{ $product->old_price }}</textarea>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Shipping Returns <span style="color: red;">*</span> </label>
                      <textarea name="shipping_returns" class="form-control" placeholder="Shipping Returns">{{ $product->shipping_returns }}</textarea>
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
                <button type="submit" class="btn btn-primary">Update</button>
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
  var i = 101;
  $('body').delegate('.AddSize', 'click', function() {
    var html = '<tr id="RemoveSize'+i+'">';
    html += '<td><input type="text" name="size['+i+'][name]" placeholder="Name" value="'+i+'" class="form-control"></td>';
    html += '<td><input type="text" name="size['+i+'][price]" placeholder="Price" class="form-control"></td>';
    html += '<td><button type="button" id="'+i+'" class="btn btn-danger RemoveSize">Remove</button></td>';
    html += '</tr>';
    i++;
    $('#AppendSize').append(html);
  });
  $('body').delegate('.RemoveSize', 'click', function() {
    var id = $(this).attr('id');
    $('#RemoveSize'+id).remove();
  });

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