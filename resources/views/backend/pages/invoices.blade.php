@extends(backendView('layouts.app'))

@section('title', 'Invoices')

@section('content')
<div class="container-xxl">

	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0 py-3 pb-2">Invoices</h3>
			</div>
		</div>
	</div> <!-- Row end  -->

	<div class="row justify-content-center">
		<div class="col-lg-12 col-md-12">
			<div class="tab-content">
				<div class="tab-pane fade show active" id="Invoice-Simple">
					<div class="row justify-content-center">
						<div class="col-lg-8 col-md-12">
							<div class="card p-xl-8 p-lg-8 p-0">
								<div class="card-body">
									<div class="mb-3 pb-3 border-bottom">
										Invoice
										<strong>{{date('d-M-y')}}</strong>
										<span class="float-end"> <strong>transection id:</strong> #{{$data->id}}</span>
									</div>

									<div class="row mb-4">
										<div class="col-sm-6">
											<h6 class="mb-3">From:</h6>
											<div><strong>Rizky Moto Shop</strong></div>
											<div>Jalan Persimpangan Belok Atas</div>
											<div>Email: info@rimo.com</div>
											<div>Phone: +62 81294690918</div>
										</div>

										<div class="col-sm-6">
											<h6 class="mb-3">To:</h6>
											<div><strong>{{$data->user->name}}</strong></div>
											<div>{{$data->user->address}}</div>
											<div>Email: {{$data->user->email}}</div>
											<div>Phone: {{$data->user->phonr}}</div>
										</div>
									</div> <!-- Row end  -->

									<div class="table-responsive-sm">
										<table class="table table-striped">
											<thead>
												<tr>
													<th>Item</th>
													<th>Description</th>
													<th class="text-end">Price</th>
													<th class="text-center">Qty</th>
													<th class="text-end">Total</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>{{$data->product->name}}</td>
													<td>{{$data->product->detail}}</td>
													<td class="text-end">Rp {{number_format($data->product->price,2,',','.')}}</td>
													<td class="text-center">{{$data->qty}}</td>
													<td class="text-end">Rp {{number_format($data->total,2,',','.')}}</td>
												</tr>
											</tbody>
										</table>
									</div>

									<div class="row">
										<div class="col-lg-4 col-sm-5">

										</div>

										<!-- <div class="col-lg-6 col-sm-7 ms-auto"> -->
											<table class="table table-clear">
												<tbody>
													<tr>
														<td><strong>Total</strong></td>
														<td class="text-end"><strong>Rp {{number_format($data->total,2,',','.')}}</strong></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div> <!-- Row end  -->

									<div class="row">
										<div class="col-lg-12">
											<h6>Terms &amp; Condition</h6>
											<p class="text-muted">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over</p>
										</div>
									</div> <!-- Row end  -->
								</div>
							</div>
						</div>
					</div> <!-- Row end  -->
				</div> <!-- tab end  -->
			</div>
		</div>

	</div> <!-- Row end  -->
</div>
@endsection

@push('styles')
@endpush

@push('custom_styles')
@endpush

@push('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		window.location.href = '{{url('dashboard/download/'.$id)}}'
	});
</script>
@endpush

@push('custom_scripts')
@endpush

@push('modals')
@endpush