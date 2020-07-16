@extends('site.layout.master')
@section('title','Paid Order')
@section('content')
<div id="contentWrapper" style="min-height: 135px;">

	<div class="sectionWrapper img-pattern">
		<div class="container">
			<div class="row">
				@include('site.pages.user_dashboard.include.sidemenu')
				<div class="col-md-9">
					<h3 class="widget-head">
						{{-- <span style="color: #09f; font-weight: bolder;">
							Paid Order [ 0 ]
						</span> --}}
					</h3>
					<div class="table-responsive" style="background: #fff;">
						<table class="table-style2">
							<thead>
								<tr>
									<th>SL</th>
									<th>Order ID</th>
									<th>Invoice Date</th>
									<th>Order Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="5">No Record Found</td>
								</tr>
								{{-- <tr>
									<td>1</td>
									<td>1000</td>
									<td>02/23/2020</td>
									<td>Paid</td>
									<td>02/23/2020</td>
								</tr> --}}
							</tbody>
						</table>
					</div>
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