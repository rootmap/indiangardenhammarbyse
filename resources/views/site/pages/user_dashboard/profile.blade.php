@extends('site.layout.master')
@section('title','Update User Info')
@section('content')
<div id="contentWrapper" style="min-height: 135px;">

	<div class="sectionWrapper img-pattern">
		<div class="container">
			<div class="row">
				@include('site.pages.user_dashboard.include.sidemenu')
				<div class="col-md-7">
					<form action="{{ url('user/profile') }}" method="POST">
						{{ csrf_field() }}
						<table>
							<thead>
								<tr>
									<th colspan="2" style="text-align: center;" ><h3 class="heading">Update Your Profile Information</h3></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>First Name </td>
									<td>
										<div class="input-box">
											<input style="width: 100%;" type="text" name="fullname" class="txt-box" value="{{ $userInfo->name }}">
										</div>
									</td>
								</tr>
								<tr>
									<td>Email</td>
									<td>

										<div class="input-box">
											<input style="width: 100%;" type="email" name="email" class="txt-box" readonly="readonly" value="{{ $userInfo->email_address }}">
										</div>
									</td>
								</tr>
								<tr>
									<td>Date of Birth</td>
									<td>

										<div class="input-box">
											<input style="width: 100%;" type="text" name="date_of_birth" id="date_of_birth" class="txt-box" value="{{ $userInfo->date_of_birth }}">
										</div>
									</td>
								</tr>
								<tr>
									<td>Gender</td>
									<td>

										<div class="input-box">
											<select name="gander" class="form-control">
												<option value="">Select Gender</option>
												<option {{ $userInfo->gander=='Male'?'selected="selected"':'' }} value="Male">Male</option>
												<option {{ $userInfo->gander=='Female'?'selected="selected"':'' }} value="Female">Female</option>
											</select>
										</div>
									</td>
								</tr>


							</tbody>
							<tfoot>
								<tr>
									<th colspan="2" align="right">
										<button type="submit" class="btn btn-success pull-right" style="padding: 10px; width: 33%">Update </button> 
									</th>
								</tr>
							</tfoot>
						</table>
					</form>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

</div>
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{ url('site/dashboard/css/style.css') }}">
<style type="text/css">
	.table-style2 th {
		border-right-color: #fff;
		border-bottom-color: #5c5c5c;
	}
	table {
		width: 100%;
		border: 1px solid #e2e2e2!important;
		border-spacing: 0;
		border-collapse: collapse;
	}
	th, td, caption {
		padding: 10px;
	}
	td, caption {
		border-right: 1px solid #e2e2e2;
		border-bottom: 1px solid #e2e2e2;
	}
	tfoot {
		background: #e9e9e9;
		font-weight: bold;
	}
	th {
		text-transform: uppercase;
		border-right: 1px solid #e2e2e2;
		background: #f5f5f5;
		border-bottom: 2px #777 solid;
	}
	tr:nth-child(even) {
		background: #f3f3f3;
	}
	input, .btn {
		padding: 5px;
		border: 1px solid #ddd;
		border-radius: none;
	}
</style>
@endsection
@section('js')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript">
		$(function() {
	    	$("#date_of_birth").datepicker();
	  	});
	</script>
@endsection