@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ url('assets/css/plugins/nouislider/nouislider.css') }}">
	<style type="text/css">
		.active-color {
			border: 3px solid #000 !important;
		}
	</style>
@endsection
@section('content')
<main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
                    @if (!empty($getSubCategory))
                        <h1 class="page-title">{{ $getSubCategory->name }}</h1>
                    @else
                        <h1 class="page-title">{{ $getCategory->name }}</h1>
                    @endif
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:;">Shop</a></li>
                        @if (!empty($getSubCategory))
                            <li class="breadcrumb-item active" aria-current="page"> 
                                <a href="{{ url($getCategory->slug) }}"> {{ $getCategory->name }} </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"> 
                                <a href="{{ url($getCategory->slug.'/'.$getSubCategory->slug) }}"> {{ $getSubCategory->name }} </a>
                            </li>
                        @else
                            <li class="breadcrumb-item active" aria-current="page"> 
                                <a href="{{ url($getCategory->slug) }}"> {{ $getCategory->name }} </a> 
                            </li>
                        @endif
                        
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                	<div class="row">
                		<div class="col-lg-9">
                			<div class="toolbox">
                				<div class="toolbox-left">
                					<div class="toolbox-info">
                						Showing <span>9 of 56</span> Products
                					</div><!-- End .toolbox-info -->
                				</div><!-- End .toolbox-left -->

                				<div class="toolbox-right">
                					<div class="toolbox-sort">
                						<label for="sortby">Sort by:</label>
                						<div class="select-custom">
											<select name="sortby" id="sortby" class="form-control ChangeSortBy">
												<option value="" >Select</option>
												<option value="popularity" >Most Popular</option>
												<option value="rating">Most Rated</option>
												<option value="date">Date</option>
											</select>
										</div>
                					</div><!-- End .toolbox-sort -->
                					
                				</div><!-- End .toolbox-right -->
                			</div><!-- End .toolbox -->

							<div id="getProductAjax">
								@include('product._list');
							</div>

                		</div><!-- End .col-lg-9 -->
                		<aside class="col-lg-3 order-lg-first">
							<form id="FilterForm" method="post" action="">
								{{ csrf_field() }}
								<input type="hidden" name="sub_category_id" id="get_sub_category_id">
								<input type="hidden" name="brand_id" id="get_brand_id">
								<input type="hidden" name="color_id" id="get_color_id">
								<input type="hidden" name="sort_by_id" id="get_sort_by_id">
								
							</form>

                			<div class="sidebar sidebar-shop">
                				<div class="widget widget-clean">
                					<label>Filters:</label>
                					<a href="#" class="sidebar-filter-clear">Clean All</a>
                				</div><!-- End .widget widget-clean -->

                				<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
									        Category
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-1">
										<div class="widget-body">
											<div class="filter-items filter-items-count">
												@foreach ($getSubCategoryFilter as $f_category)
													
												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input ChangeCategory" value="{{ $f_category->id }}" id="cat-{{ $f_category->id }}">
														<label class="custom-control-label" for="cat-{{ $f_category->id }}">{{ $f_category->name }}</label>
													</div><!-- End .custom-checkbox -->
													<span class="item-count">{{ $f_category->totalProducts() }}</span>
												</div><!-- End .filter-item -->
												@endforeach
										
											</div><!-- End .filter-items -->
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
        						</div><!-- End .widget -->

        						<!-- <div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-2">
									        Size
									    </a>
									</h3>

									<div class="collapse show" id="widget-2">
										<div class="widget-body">
											<div class="filter-items">
												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="size-1">
														<label class="custom-control-label" for="size-1">XS</label>
													</div>
												</div>

												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="size-2">
														<label class="custom-control-label" for="size-2">S</label>
													</div>
												</div>
											</div>
										</div>
									</div>
        						</div> -->

        						<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true" aria-controls="widget-3">
									        Colour
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-3">
										<div class="widget-body">
											<div class="filter-colors">
												@foreach ($getColor as $f_color)

												<a href="javascript:;" id="{{ $f_color->id }}" class="ChangeColor" data-val="0" style="background: {{ $f_color->code }};"><span class="sr-only">{{ $f_color->name }}</span></a>

												@endforeach
												
											</div><!-- End .filter-colors -->
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
        						</div><!-- End .widget -->

        						<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
									        Brand
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-4">
										<div class="widget-body">
											<div class="filter-items">
												@foreach ($getBrand as $f_brand)
													
												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input ChangeBrand" value="{{ $f_brand->id }}" id="brand-{{ $f_brand->id }}">
														<label class="custom-control-label" for="brand-{{ $f_brand->id }}">{{ $f_brand->name }}</label>
													</div><!-- End .custom-checkbox -->
												</div><!-- End .filter-item -->
												@endforeach

											</div><!-- End .filter-items -->
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
        						</div><!-- End .widget -->

        						<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
									        Price
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-5">
										<div class="widget-body">
                                            <div class="filter-price">
                                                <div class="filter-price-text">
                                                    Price Range:
                                                    <span id="filter-price-range"></span>
                                                </div><!-- End .filter-price-text -->

                                                <div id="price-slider"></div><!-- End #price-slider -->
                                            </div><!-- End .filter-price -->
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
        						</div><!-- End .widget -->
                			</div><!-- End .sidebar sidebar-shop -->
                		</aside><!-- End .col-lg-3 -->
                	</div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
@endsection
@section('scripts')
	<script src="{{ url('assets/js/wNumb.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap-input-spinner.js') }}"></script>
	<script src="{{ url('assets/js/nouislider.min.js') }}"></script>

	<script type="text/javascript">

		$('.ChangeSortBy').change(function() {
			var id = $(this).val();

			$('#get_sort_by_id').val(id);
			FilterForm();
		});

		$('.ChangeCategory').change(function() {
			var ids = '';
			$('.ChangeCategory').each(function() {
				if(this.checked)
				{
					var id = $(this).val();
					ids += id+',';
				}
			});

			$('#get_sub_category_id').val(ids);
			FilterForm();
		});

		$('.ChangeBrand').change(function() {
			var ids = '';
			$('.ChangeBrand').each(function() {
				if(this.checked)
				{
					var id = $(this).val();
					ids += id+',';
				}
			});

			$('#get_brand_id').val(ids);
			FilterForm();
		});
		
		$('.ChangeColor').click(function() {
			var id = $(this).attr('id');
			var status = $(this).attr('data-val');
			if(status == 0)
			{
				$(this).attr('data-val', 1);
				$(this).addClass('active-color');
			}
			else
			{
				$(this).attr('data-val', 0);
				$(this).removeClass('active-color');
			}

			var ids = '';
			$('.ChangeColor').each(function() {
				var status = $(this).attr('data-val');
				if(status == 1)
				{
					var id = $(this).attr('id');
					ids += id+',';
				}
			});

			$('#get_color_id').val(ids);
			FilterForm();
		});

		function FilterForm()
		{
			$.ajax({
				type: "POST",
				url: "{{ url('get_filter_product_ajax') }}",
				data : $('#FilterForm').serialize(),
				dataType: "json",
				success: function(data){
					$('#getProductAjax').html(data.success);
				},
				error: function(data){

				}
				
			});
		}

	</script>
@endsection