@extends(backendView('layouts.app'))

@section('title', 'Forms Example')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Form Produtcs</h3>
			</div>
		</div>
	</div>
	<div class="col-12">
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
	</div>
	<div class="row align-item-center">
		<div class="col-md-12">
			<div class="card mb-3">
				<div class="card-body">
					<form method="post" action="{{ URL('products/storeProducts') }}" enctype="multipart/form-data"> @csrf
						<div class="row g-3 align-items-center">
							<div class="col-md-6">
								<label for="Name" class="form-label">Name</label>
								<input type="text" class="form-control" name="name" value="{{@$data->name}}" id="name" required>
							</div>
							<div class="col-md-6">
								<label for="Price" class="form-label">Price</label>
								<input class="input-currency form-control" name="price" type="text" type-currency="IDR" value="{{@$data->price}}" placeholder="Rp" required>
							</div>
							<div class="col-md-6">
								<label for="Detail" class="form-label">Detail</label>
								<input type="text" class="form-control" value="{{@$data->detail}}" name="detail" id="detail" required>
							</div>
							<div class="col-md-6">
								<label for="Stok" class="form-label">Stok</label>
								<input type="number" class="form-control" name="stok" value="{{@$data->stock}}" id="stok" required>
							</div>
							<div class="col-md-12">
								<label for="formFileMultiple" class="form-label">File Upload</label>
								<input class="form-control" name="pictures" type="file" id="formFileMultiple" multiple accept=".png, .jpg, .jpeg" required>
							</div>
						</div>
						<input type="hidden" name="id" value="{{$id}}">
						<button type="submit" class="btn btn-primary mt-4">Save</button>
					</form>
				</div>
			</div>
		</div>
	</div>

</div>
@endsection

@push('styles')
<!-- plugin css file  -->
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/parsleyjs/css/parsley.css') !!}">
@endpush

@push('custom_styles')
@endpush

@push('scripts')
<!-- Plugin Js-->
<script src="{!! backendAssets('dist/assets/plugin/parsleyjs/js/parsley.js') !!}"></script>
@endpush

@push('custom_scripts')
<script>
	$(function() {
		// initialize after multiselect
		$('#basic-form').parsley();
	});

	document.querySelectorAll('input[type-currency="IDR"]').forEach((element) => {
	  element.addEventListener('keyup', function(e) {
	  let cursorPostion = this.selectionStart;
	    let value = parseInt(this.value.replace(/[^,\d]/g, ''));
	    let originalLenght = this.value.length;
	    if (isNaN(value)) {
	      this.value = "";
	    }else{    
	      cursorPostion = this.value.length - originalLenght + cursorPostion;
	      this.setSelectionRange(cursorPostion, cursorPostion);
	    }
	  });
	});
</script>
@endpush

@push('modals')
@endpush 