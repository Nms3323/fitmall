@extends('main')
@section('content')
@toastr_css
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Toolbar-->
	<div class="toolbar" id="kt_toolbar">
		<!--begin::Container-->
		<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
			<!--begin::Page title-->
			<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
				<!--begin::Title-->
				<h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">City Details</h1>
				<!--end::Title-->
				<!--begin::Separator-->
				<span class="h-20px border-gray-200 border-start mx-4"></span>
				<!--end::Separator-->
				<!--begin::Breadcrumb-->
				<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">
						<a href="index.html" class="text-muted text-hover-primary">Home</a>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item">
						<span class="bullet bg-gray-200 w-5px h-2px"></span>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">City Details</li>
					<!--end::Item-->
				</ul>
				<!--end::Breadcrumb-->
			</div>
			<!--end::Page title-->
			<!--begin::Actions-->
			<div class="d-flex align-items-center py-1">
				<!--begin::Wrapper-->

				<!--end::Wrapper-->
				<!--begin::Button-->
				<a href="#" class="btn btn-sm btn-primary" id="kt_toolbar_primary_button" data-bs-toggle="modal" data-bs-target="#create_city">Create</a>
				<!--end::Button-->
			</div>
			<!--end::Actions-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Toolbar-->
	<!--begin::Post-->
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container">
			<!--begin::Layout-->
			<div class="d-flex flex-column flex-xl-row">

				<!--begin::Content-->
				<div class="flex-lg-row-fluid ms-lg-0">
					<div class="table-responsive">
						<!--begin::Table-->
						<table class="table align-middle table-row-dashed fs-6 gy-5 data-table dataTableNew" id="kt_subscriptions_table user_list">
							<!--begin::Table head-->
							<thead>
								<!--begin::Table row-->
								<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
									<th style="width: 50px">No.</th>
									<th>Country Name</th>
									<th>State Name</th>
									<th>City Name</th>
									<th>Activate Status</th>
									<th style="width: 150px">Actions</th>
								</tr>
								<!--end::Table row-->
							</thead>
							<!--end::Table head-->
							<!--begin::Table body-->
							<tbody class="text-gray-600 fw-bold">
								@if(!empty($data))
								<?php $count = 1; ?>
								@foreach($data as $dt)
								<tr>
									<td>{{ $count++ }}</td>
									<td>{{ ucfirst($dt->country_name) }}</td>
									<td>{{ ucfirst($dt->state_name) }}</td>
									<td>{{ ucfirst($dt->city_name) }}</td>
									<td>
										<label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
											<input class="form-check-input" type="checkbox" value="1" @if($dt->active == 1) checked @endif onchange="status('{{ $dt->id }}')" name=""/>
										</label>
									</td>
									<td>
										<a class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" data-bs-toggle="modal" data-bs-target="#edit_city" onclick="edit('{{ $dt->id }}')" style="background: #968cbd;">
											<i class="la la-edit" style="color: white !important;"></i>
										</a>
										<input type="hidden" value="{{ $dt->id }}" name="delete_city_id" id="delete_city_id">
										<button class="btn btn-sm btn-clean btn-icon btn-icon-md" id="delete_city" style="background-color: red;" data-toggle="tooltip" title="Delete">
											<i class="la la-trash" style="color: #ffffff"></i>
										</button>
									</td>
								</tr>
								@endforeach
								@endif
							</tbody>
							<!--end::Table body-->
						</table>
						<!--end::Table-->
					</div>
				</div>
				<!--end::Content-->
			</div>
			<!--end::Layout-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Post-->
</div>
<!--end::Content-->

<!--begin::Modal - New Address-->
<div class="modal fade" id="create_city" tabindex="-1" aria-hidden="true">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-dialog-centered mw-650px">
		<!--begin::Modal content-->
		<div class="modal-content">
			<!--begin::Form-->
			<form class="form add__form" action="{{ route('city.store') }}" method="post" id="kt_modal_new_address_form">
				@csrf
				<!--begin::Modal header-->
				<div class="modal-header" id="kt_modal_new_address_header">
					<!--begin::Modal title-->
					<h2>Add City</h2>
					<!--end::Modal title-->
					<!--begin::Close-->
					<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
						<!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
						<span class="svg-icon svg-icon-1">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
									<rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
									<rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1" />
								</g>
							</svg>
						</span>
						<!--end::Svg Icon-->
					</div>
					<!--end::Close-->
				</div>
				<!--end::Modal header-->
				<!--begin::Modal body-->
				<div class="modal-body py-10 px-lg-17">
					<!--begin::Scroll-->
					<div class="scroll-y me-n7 pe-7" id="kt_modal_new_address_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_new_address_header" data-kt-scroll-wrappers="#kt_modal_new_address_scroll" data-kt-scroll-offset="300px">
						
						<!--begin::Input group-->
						<div class="d-flex flex-column mb-5 fv-row">
							<!--begin::Label-->
							<label class="required fs-5 fw-bold mb-2">Country</label>
							<!--end::Label-->
							<!--begin::Input-->
							<select name="country_id" class="form-control form-control-solid" id="country_id">
								<option value="">--Select Country--</option>
								@if(!empty($country))
								@foreach($country as $country_dt)
								<option value="{{ $country_dt->id }}">{{ $country_dt->country_name }}</option>
								@endforeach
								@endif
							</select>
							<!--end::Input-->
						</div>
						<div class="d-flex flex-column mb-5 fv-row">
							<!--begin::Label-->
							<label class="required fs-5 fw-bold mb-2">State</label>
							<!--end::Label-->
							<!--begin::Input-->
							<select name="state_id" class="form-control form-control-solid" id="state_id">
								<option value="">--Select State--</option>
							</select>
							<!--end::Input-->
						</div>
						<div class="d-flex flex-column mb-5 fv-row">
							<!--begin::Label-->
							<label class="required fs-5 fw-bold mb-2">City</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input class="form-control form-control-solid" placeholder="Enter City Name" name="city_name" id="city_name" required="required" />
							<!--end::Input-->
						</div>
						<!--end::Input group-->
						
					</div>
					<!--end::Modal body-->
					<!--begin::Modal footer-->
					<div class="modal-footer flex-center">
						<!--begin::Button-->
						<button type="submit" id="kt_modal_new_address_submit" class="btn btn-success">
							<span class="indicator-label">Submit</span>
							<span class="indicator-progress">Please wait...
								<span class="spinner-border spinner-border-sm align-middle ms-2">
								</span>
							</span>
						</button>
						<!--end::Button-->
						<!--begin::Button-->
						<button type="reset" id="kt_modal_new_address_cancel" class="btn btn-danger me-3">Cancle</button>
						<!--end::Button-->
					</div>
					<!--end::Modal footer-->
				</div>
			</form>
			<!--end::Form-->
		</div>
	</div>
</div>
<!--end::Modal - New Address-->

<!--begin::Modal - New Address-->
<div class="modal fade" id="edit_city" tabindex="-1" aria-hidden="true">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-dialog-centered mw-650px">
		<!--begin::Modal content-->
		<div class="modal-content">
			<!--begin::Form-->
			<form class="form edit__form" action="" method="post" id="kt_modal_new_address_form">
				{{ method_field('PATCH') }}
				@csrf
				<!--begin::Modal header-->
				<div class="modal-header" id="kt_modal_new_address_header">
					<!--begin::Modal title-->
					<h2>Edit State</h2>
					<!--end::Modal title-->
					<!--begin::Close-->
					<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
						<!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
						<span class="svg-icon svg-icon-1">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
									<rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
									<rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1" />
								</g>
							</svg>
						</span>
						<!--end::Svg Icon-->
					</div>
					<!--end::Close-->
				</div>
				<!--end::Modal header-->
				<!--begin::Modal body-->
				<div class="modal-body py-10 px-lg-17">
					<!--begin::Scroll-->
					<div class="scroll-y me-n7 pe-7" id="kt_modal_new_address_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_new_address_header" data-kt-scroll-wrappers="#kt_modal_new_address_scroll" data-kt-scroll-offset="300px">
						<input type="hidden" name="state_hidden_id" value="" id="hidden_id">
						
						<!--begin::Input group-->
						<div class="d-flex flex-column mb-5 fv-row">
							<!--begin::Label-->
							<label class="required fs-5 fw-bold mb-2">Country</label>
							<!--end::Label-->
							<!--begin::Input-->
							<select name="country_id" class="form-control form-control-solid" id="edit_country_id">
								<option value="">--Select Country--</option>
								@if(!empty($country))
								@foreach($country as $country_dt)
								<option value="{{ $country_dt->id }}">{{ $country_dt->country_name }}</option>
								@endforeach
								@endif
							</select>
							<!--end::Input-->
						</div>
						<div class="d-flex flex-column mb-5 fv-row">
							<!--begin::Label-->
							<label class="required fs-5 fw-bold mb-2">State</label>
							<!--end::Label-->
							<!--begin::Input-->
							<select name="state_id" class="form-control form-control-solid" id="edit_state_id">
								<option value="">--Select State--</option>
								@if(!empty($state))
								@foreach($state as $state_dt)
								<option value="{{ $state_dt->id }}">{{ $state_dt->state_name }}</option>
								@endforeach
								@endif
							</select>
							<!--end::Input-->
						</div>
						<div class="d-flex flex-column mb-5 fv-row">
							<!--begin::Label-->
							<label class="required fs-5 fw-bold mb-2">City Name</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input class="form-control form-control-solid" placeholder="Enter City Name" name="city_name" id="edit_city_name" required="required" />
							<!--end::Input-->
						</div>
						<!--end::Input group-->
						
					</div>
					<!--end::Modal body-->
					<!--begin::Modal footer-->
					<div class="modal-footer flex-center">
						<!--begin::Button-->
						<button type="submit" id="kt_modal_new_address_submit" class="btn btn-success">
							<span class="indicator-label">Update</span>
							<span class="indicator-progress">Please wait...
								<span class="spinner-border spinner-border-sm align-middle ms-2">
								</span>
							</span>
						</button>
						<!--end::Button-->
						<!--begin::Button-->
						<button type="reset" id="kt_modal_new_address_cancel" class="btn btn-danger me-3">Cancle</button>
						<!--end::Button-->
					</div>
					<!--end::Modal footer-->
				</div>
			</form>
			<!--end::Form-->
		</div>
	</div>
</div>
<!--end::Modal - New Address-->
@toastr_js
@toastr_render
<script type="text/javascript">

	$(document).ready(function() {
		$('.data-table').DataTable();
	});

	$('#country_id').on('change', function() {
		$.ajax({
			type: "POST",
			url: "{{ route('get.stateList') }}",
			data: {
				'_token': $('input[name="_token"]').val(),
				'country_id': this.value
			},
			cache: false,
			success: function (data)
			{
				$("#state_id").empty();
				$("#state_id").append(data);
			}
		});
	});

	$(".add__form").validate({
		rules:
		{
			country_id:{required:true},
			state_id:{required:true},
			city_name:{
				required: true,
				remote: {
					url: "{{ route('check.cityName') }}",
					type: "post",
					dataType: 'json',
					data: {
						'_token': $('input[name="_token"]').val(),
						country_id: function() {
							return $( "#country_id").val();
						},
						state_id: function() {
							return $( "#state_id").val();
						},
						city_name: function() {
							return $( "#city_name").val();
						}
					}
				}
			}
		},
		messages:
		{
			country_id:{required:"Please Select Country"},
			state_id:{required:"Please Select state"},
			city_name:{
				required:"Please enter city name",
				remote:"This city is already exist"
			}
		}
	});

	$(".edit__form").validate({
		rules:
		{
			country_id:{required:true},
			state_id:{required:true},
			city_name:{
				required: true,
				remote: {
					url: "{{ route('check.stateName') }}",
					type: "post",
					dataType: 'json',
					data: {
						'_token': $('input[name="_token"]').val(),
						id: function() {
							return $("#hidden_id").val();
						},
						country_id: function() {
							return $("#edit_country_id").val();
						},
						state_id: function() {
							return $( "#edit_state_id").val();
						},
						name: function() {
							return $("#edit_city_name").val();
						}
					}
				}
			}
		},
		messages:
		{
			country_id:{required:"Please Select Country"},
			state_id:{required:"Please Select state"},
			city_name:{
				required:"Please enter city name",
				remote:"This city is already exist"
			}
		}
	});

	function edit(id){
		var edit_url = '{{route("city.edit",":id")}}';
		edit_url = edit_url.replace(':id', id);

		$.ajax({
			type: "GET",
			url: edit_url,
			data: {
				'_token': $('input[name="_token"]').val(),
				'id': id
			},
			cache: false,
			success: function (data)
			{
				var update_url = '{{route("city.update",":id")}}';
				update_url = update_url.replace(':id', id);
				$(".edit__form").attr('action', update_url);
				$('#hidden_id').val(data.state_data['id']);
				$('#edit_country_id').val(data.state_data['country_id']);
				$('#edit_state_id').val(data.state_data['state_id']);
				$('#edit_city_name').val(data.state_data['city_name']);
			}
		});
	}

	$(document).ready(function() {

		$(document).on('click', '#delete_city', function ()
		{
			var obj = $(this);
			var id = $(this).closest('td').find("#delete_city_id").val();
			var delete_url = "{{route('city.destroy', ':id') }}";
			delete_url = delete_url.replace(':id', id);

			swal({
				title: "Are you sure?",
				text: "You will not be able recover this record",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes delete it!",
				closeOnConfirm: false
			},
			function () {
				$.ajax({
					type: "DELETE",
					url: delete_url,
					data: {
						'_token': $('input[name="_token"]').val(),
						'id': id
					},
					cache: false,
					success: function (data)
					{
						location.reload();
					}
				});
			});
		});
	});

	function status(id) {
		$.ajax({
			type:'POST',
			url:"{{route('city.status')}}",
			data:{
				'_token' : $('input[name="_token"]').val(),
				'id':id
			},
			success:function(data){
				if (data.status === 'status_changed') 
				{
					toastr.options.timeOut = 1500;
					toastr.options.fadeOut = 1500;
					toastr.options.progressBar = true;
					toastr.options.onHidden = function(){
					};
					toastr["success"]("Status Changed", "Success");
				}else{
					toastr.options.timeOut = 1500;
					toastr.options.fadeOut = 1500;
					toastr.options.progressBar = true;
					toastr.options.onHidden = function(){
					};
					toastr["warning"]("Status Changed", "warning");
				}
			}
		});
	}
	
</script>

@stop