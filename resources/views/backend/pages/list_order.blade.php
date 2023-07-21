@extends(backendView('layouts.app'))

@section('title', 'List Order')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">List Order</h3>
				<div class="btn-group group-link btn-set-task w-sm-100">
					<a href="{!! route('products.form', ['id'=>0]) !!}" class="btn active d-inline-flex align-items-center" aria-current="page"><i class="icofont-ui-add px-2 fs-5"></i>Tambah Data</a>
				</div>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row g-3 mb-3">
		<div class="col-md-12">
			@if(session()->has('message'))
	            <div class="alert alert-success">
	                {{ session()->get('message') }}
	            </div>
	        @endif

	        @if ($errors->any())
	            <div class="alert alert-danger">
	                <ul>
	                    @foreach ($errors->all() as $error)
	                        <li>{{ $error }}</li>
	                    @endforeach
	                </ul>
	            </div>
	        @endif
			<div class="card">
				<div class="card-body">
					<table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
						<thead>
							<tr>
								<th>Id</th>
								<th>Qty</th>
								<th>Price</th>
								<th>Total</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('styles')
<!-- plugin css file  -->
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/responsive.dataTables.min.css') !!}">
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/dataTables.bootstrap5.min.css') !!}">
@endpush

@push('custom_styles')
@endpush

@push('scripts')
<!-- Plugin Js -->
<script src="{!! backendAssets('dist/assets/bundles/dataTables.bundle.js') !!}"></script>
@endpush

@push('scripts')
<script type="text/javascript">
$(document).ready(function () {
   $('#myDataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url()->current() }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'qty', name: 'qty' },
            { data: 'price', name: 'price' },
            { data: 'total', name: 'total' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action' },
        ]
    });
 });
</script>
@endpush

@push('modals')
@endpush