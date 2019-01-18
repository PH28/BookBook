@extends('admin.layouts.master')

@section('function')
	<li class="nav-item nav-drawer-header">Chức năng</li>

	<li class="nav-item nav-item-has-subnav">
	    <!-- <a href=""><i class="ion-ios-search"></i>Tìm kiếm</a> -->
	    <!-- <ul class="nav nav-subnav">
	        <li>
	            <a href="base_ui_buttons.html">Buttons</a>
	        </li>
	        <li>
	            <a href="base_ui_cards.html">Cards</a>
	        </li>
	    </ul> -->
	</li>
@endsection

@section('breadcrumb')
	Danh mục
@endsection

@section('content')

	<main class="app-layout-content">

	    <!-- Page Content -->
	    <div class="container-fluid p-y-md">
	    	<div class="row" style="margin-bottom: 20px;">
	    		<div class="col-md-12">
	    			<div class="pull-left">
			    		<a href="{{ route('admin.dashboard') }}" class="btn btn-app-light"><i class="ion-ios-arrow-back"></i> Bảng điều khiển</a>
			    	</div>
			    	<div class="pull-right">
			    		<a href="{{ route('admin.categories.create') }}" class="btn btn-pill btn-app-green">Thêm danh mục</a>
			    	</div>
	    		</div>
	    	</div>
	    	<div class="clearfix"></div>
	    	<div class="row">
	    		<div class="col-md-4">
	    			<div class="card">
			    		<div class="card-header bg-cyan bg-inverse">
			                <!-- <h4>Danh mục</h4> -->
			            </div>
			            <div class="card-block">
			            	<div class="table-responsive">
			            		<table class="table table-hover">
	                                <thead>
	                                    <tr>
	                                        <th class="text-center" style="width: 50px;">ID</th>
	                                        <th>Tên</th>
	                                        <th class="text-center">Thêm</th>
	                                    </tr>
	                                </thead>
	                                <tbody>
	                                	@foreach ($categories as $category)
	                                		<tr style="cursor: pointer;" class="category">
	                            				<td class="text-center" id="category_id">{{ $category->id }}</td>
		                                        <td>
		                                        	<input type="text" class="my-input" id="category_name" value="{{ $category->name }}" spellcheck="false">
		                                        </td>
		                                        <td class="text-center">
	                                                <div class="btn-group">
	                                                    <button class="btn btn-xs btn-default hide" id="btn-category-update" data-toggle="tooltip" title="" data-original-title="Cập nhật" disabled><i class="ion-edit"></i></button>
			                                            <form method="POST" action="{{ route('admin.categories.delete', $category->id) }}" id="category-form-delete" style="display: inline;">
			                                            	@method('DELETE')
			                                            	@csrf
			                                            	
			                                            </form>
			                                            <button class="btn btn-xs btn-default" id="btn-category-delete" data-toggle="tooltip" title="" data-original-title="Xóa"><i class="ion-close"></i></button>
	                                                </div>
	                                            </td>
		                                    </tr>
	                                    @endforeach
	                                </tbody>
	                            </table>
			            	</div>
			            </div>
			    	</div>
	    		</div>
	    		<div class="col-md-4">
	    			<div class="card">
			    		<div class="card-header bg-cyan bg-inverse">
			                <!-- <h4>Danh mục phụ</h4> -->
			            </div>
			            <div class="card-block">
			            	<div class="table-responsive">
			            		<table class="table table-hover">
	                                <thead>
	                                    <tr>
	                                        <th class="text-center" style="width: 50px;">ID</th>
	                                        <th>Tên</th>
	                                        <th class="text-center">Thêm</th>
	                                    </tr>
	                                </thead>
	                                <tbody id="subcategory_content">
	                                    {{-- @foreach ($subcategories as $subcategory)
	                                		<tr style="cursor: pointer;" class="subcategory">
		                                        <td class="text-center" id="subcategory_id">{{ $subcategory->id }}</td>
		                                        <td>
		                                        	<input type="text" class="my-input" id="subcategory_name" value="{{ $subcategory->name }}" spellcheck="false">
		                                        </td>
		                                        <td class="text-center">
	                                                <div class="btn-group">
	                                                    <button class="btn btn-xs btn-default hide" id="btn-category-update" data-toggle="tooltip" title="" data-original-title="Cập nhật" disabled><i class="ion-edit"></i></button>
			                                            <form method="POST" action="{{ route('admin.categories.delete') }}" style="display: inline;">
			                                            	@method('DELETE')
			                                            	@csrf
			                                            	<button class="btn btn-xs btn-default" data-toggle="tooltip" title="" data-original-title="Xóa"><i class="ion-close"></i></button>
			                                            </form>
	                                                </div>
	                                            </td>
		                                    </tr>
	                                    @endforeach --}}
	                                </tbody>
	                            </table>
			            	</div>
			            </div>
			    	</div>
	    		</div>
	    		<div class="col-md-4">
	    			<div class="card">
			    		<div class="card-header bg-cyan bg-inverse">
			                <!-- <h4>Danh mục con</h4> -->
			            </div>
			            <div class="card-block">
			            	<div class="table-responsive">
			            		<table class="table table-hover">
	                                <thead>
	                                    <tr>
	                                        <th class="text-center" style="width: 50px;">ID</th>
	                                        <th>Tên</th>
	                                        <th class="text-center">Thêm</th>
	                                    </tr>
	                                </thead>
	                                <tbody id="child_content">
	                                    {{-- @foreach ($childs as $child)
	                                		<tr style="cursor: pointer;" class="child">
		                                        <td class="text-center" id="subcategory_id">{{ $child->id }}</td>
		                                        <td>
		                                        	<input type="text" class="my-input" id="subcategory_name" value="{{ $child->name }}" spellcheck="false">
		                                        </td>
		                                        <td class="text-center">
	                                                <div class="btn-group">
	                                                    <button class="btn btn-xs btn-default hide" id="btn-category-update" data-toggle="tooltip" title="" data-original-title="Cập nhật" disabled><i class="ion-edit"></i></button>
			                                            <form method="POST" action="{{ route('admin.categories.delete') }}" style="display: inline;">
			                                            	@method('DELETE')
			                                            	@csrf
			                                            </form>
			                                            <button class="btn btn-xs btn-default" data-toggle="tooltip" title="" data-original-title="Xóa"><i class="ion-close"></i></button>
	                                                </div>
	                                            </td>
		                                    </tr>
	                                    @endforeach --}}
	                                </tbody>
	                            </table>
			            	</div>
			            </div>
			    	</div>
	    		</div>
	    	</div>
	    	<!-- End row -->
	    </div>
	    <!-- End Page Content -->

	    @if (session('type'))
			<div id="message" type="{{ session('type') }}" message="{{ session('message') }}"></div>
		@endif

	</main>

@endsection

@section('javascript')

	<!-- AppUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock and App.js -->
	<script src="{{ asset('admin/js/core/jquery.min.js') }}"></script>
	<script src="{{ asset('admin/js/core/bootstrap.min.js') }}"></script>
	<script src="{{ asset('admin/js/core/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset('admin/js/core/jquery.scrollLock.min.js') }}"></script>
	<script src="{{ asset('admin/js/core/jquery.placeholder.min.js') }}"></script>
	<script src="{{ asset('admin/js/app.js') }}"></script>
	<script src="{{ asset('admin/js/app-custom.js') }}"></script>

	<!-- Page JS Plugins -->
	<script src="{{ asset('admin/js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

	<!-- Page JS Code -->
	<script>

	    $(document).ready(function () {
	    	csrf_token = $('meta[name="csrf-token"]').attr('content');

	    	if ($('#message').length) {
				type = $('#message').attr('type');
				message = $('#message').attr('message');

				console.log(type);
				console.log(message);

				$.notify({
					title: '<strong>' + message + '</strong>',
					message: ''
				}, {
					element: 'body',
					type: type
    			});
			}

	    	$(document).on('click', '.category', function () {
	    		id = $(this).children('td:first-child').text();

	    		$.ajax({
	    			url: '../api/v1/categories/' + id + '/child',
	    			type: 'GET',
	    			success: function(response) {
	    				html = "";
	    				$.each(response, function(index, value) {
	    					html = html +
		    					"<tr style='cursor: pointer;' class='subcategory'>" +
			                    	"<td class='text-center' id='category_id'>" + value['id'] + "</td>" +
			                    	"<td>" +
			                    		"<input type='text' class='my-input' id='category_name' value='" + value['name'] + "' spellcheck='false'>" +
			                    	"</td>" +
			                    	"<td class='text-center'>" +
			                    		"<div class='btn-group'>" +
				                    		"<button class='btn btn-xs btn-default hide' id='btn-category-update' data-toggle='tooltip' title='' data-original-title='Chỉnh sửa' disabled><i class='ion-edit'></i></button>" +
		                                    "<form method='POST' action='http://bookbook.com/admin/categories/" + value['id'] + "' id='category-form-delete' style='display: inline;'>" +
		                                    	"<input type='hidden' name='_method' value='DELETE'>" +
		                                    	"<input type='hidden' name='_token' value='" + csrf_token + "'>" +
		                                    "</form>" +
		                                    "<button class='btn btn-xs btn-default' id='btn-category-delete' data-toggle='tooltip' title='' data-original-title='Xóa'><i class='ion-close'></i></button>" +
		                                "</div>" +
	                                "</td>" +
			                    "</tr>";
	    				});
	    				$('#subcategory_content').html("");
	    				$('#subcategory_content').html(html);
	    			}
	    		});

	    	});

	    	$(document).on('click', '.subcategory', function () {
	    		id = $(this).children('td:first-child').text();

	    		$.ajax({
	    			url: '../api/v1/categories/' + id + '/child',
	    			type: 'GET',
	    			success: function(response) {
	    				html = "";
	    				$.each(response, function(index, value) {
	    					html = html +
		    					"<tr style='cursor: pointer;' class='child'>" +
			                    	"<td class='text-center' id='category_id'>" + value['id'] + "</td>" +
			                    	"<td>" +
			                    		"<input type='text' class='my-input' id='category_name' value='" + value['name'] + "' spellcheck='false'>" +
			                    	"</td>" +
			                    	"<td class='text-center'>" +
			                    		"<div class='btn-group'>" +
				                    		"<button class='btn btn-xs btn-default hide' id='btn-category-update' data-toggle='tooltip' title='' data-original-title='Chỉnh sửa' disabled><i class='ion-edit'></i></button>" +
		                                    "<form method='POST' action='http://bookbook.com/admin/categories/" + value['id'] + "' id='category-form-delete' style='display: inline;'>" +
		                                    	"<input type='hidden' name='_method' value='DELETE'>" +
		                                    	"<input type='hidden' name='_token' value='" + csrf_token + "'>" +
		                                    "</form>" +
		                                    "<button class='btn btn-xs btn-default' id='btn-category-delete' data-toggle='tooltip' title='' data-original-title='Xóa'><i class='ion-close'></i></button>" +
		                                "</div>" +
	                                "</td>" +
			                    "</tr>";
	    				});
	    				$('#child_content').html("");
	    				$('#child_content').html(html);
	    			}
	    		});
	    	});

	    	$(document).on('input', 'input', function(event) {
	    		event.preventDefault();
	    		button = $(this).parent().parent().children().children('div').children('button#btn-category-update');
	    		button.removeAttr('disabled');
	    		button.attr({
	    			class: 'btn btn-xs btn-default'
	    		});
	    	});

	    	//update category
	    	$(document).on('click', '#btn-category-update', function(event) {
	    		event.preventDefault();
	    		current_element = $(this);

	    		id = $(this).parent().parent().parent().children('#category_id').text();
	    		name = $(this).parent().parent().parent().children().children('#category_name').val();

	    		$.ajaxSetup({
				  	headers: {
				  		'X-CSRF-TOKEN': csrf_token
				  	}
				});

	    		$.ajax({
	    			url: '../api/v1/categories/' + id,
	    			type: 'PUT',
	    			data: {
	    				'name': name
	    			},
	    			success: function(response) {
	    				button.attr({
			    			class: 'btn btn-xs btn-default hide'
			    		});
	    				current_element.attr('disabled');

		    			$.notify({
							title: '<strong>Đã cập nhật!</strong>',
							message: ''
						}, {
							element: 'body',
							type: 'success'
		    			});
	    			},
	    			error: function(xhr, status, error) {
	    				$.notify({
							title: '<strong>Cập nhật thất bại!</strong>',
							message: xhr.status
						}, {
							element: 'body',
							type: 'danger'
		    			});
	    			}
	    		});
	    	});

	    	// confirm after delete
	    	$(document).on('click', '#btn-category-delete', function(event) {
	    		event.preventDefault();

	    		if (confirm("Nếu bạn xóa DANH MỤC này, tất cả DANH MỤC CON(nếu có) và dữ liệu liên quan đến SẢN PHẨM của danh mục này cũng bị xóa.\n\nBạn vẫn muốn xóa?")) {
	    			$(this).parent().children('#category-form-delete').submit();
	    		}
	    	});
	    });

	</script>

@endsection
