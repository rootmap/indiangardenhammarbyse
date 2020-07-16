@extends('site.layout.master')
@section('title','User Password Change')
@section('content')
<div id="contentWrapper" style="min-height: 135px;">

	<div class="sectionWrapper img-pattern">
		<div class="container">
			<div class="row">
				@include('site.pages.user_dashboard.include.sidemenu')
				<div class="col-md-7">
					<form action="{{ url('user/change-password') }}" method="POST">
						{{ csrf_field() }}
						<table>
							<thead>
								<tr>
									<th colspan="2" style="text-align: center;" >Update Your Password</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Old Password </td>
									<td>
										<div class="input-box">
											<input style="width: 100%;" type="password" name="old_password" class="txt-box">
										</div>
									</td>
								</tr>
								<tr class="even">
									<td>New Password</td>
									<td>
										<div class="input-box">
											<input style="width: 100%;" type="password" name="password" class="txt-box">
										</div>
									</td>
								</tr>
								<tr>
									<td>Re-Type Password</td>
									<td>

										<div class="input-box">
											<input style="width: 100%;" type="password" name="retype_password" class="txt-box">
										</div>
									</td>
								</tr>


							</tbody>
							<tfoot>
								<tr>
									<th colspan="2">
										<button type="submit" class="btn btn-success" style="padding: 10px; width: 33%">Update Password</button> 
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
