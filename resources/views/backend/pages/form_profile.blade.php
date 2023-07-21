@extends(backendView('layouts.app'))

@section('title', 'Forms Example')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Profile</h3>
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
				<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
					<h6 class="mb-0 fw-bold ">Lengkapi Data Diri</h6>
				</div>
				<div class="card-body">
					<form method="post" action="store" enctype="multipart/form-data">@csrf
						<div class="row g-3 align-items-center">
							<div class="col-md-6">
								<label for="Name" class="form-label">Name</label>
								<input type="text" class="form-control" name="name" value="{{$user->name}}" id="name">
							</div>
							<div class="col-md-6">
								<label for="Email" class="form-label">Email</label>
								<input type="email" class="form-control" name="email" value="{{$user->email}}" id="email">
							</div>
							<div class="col-md-6">
								<label for="Password" class="form-label">Password</label>
								<input type="password" class="form-control" name="password" id="password">
								<p style="color:red">*kosongkan jika tidak ingin merubah</p>
							</div>
							<div class="col-md-6">
								<label for="Phone" class="form-label">Phone</label>
								<input type="number" class="form-control" name="phone" value="{{$user->phone}}" id="phone">
								<p style="visibility:hidden">sads</p>
							</div>
							<div class="col-md-6">
								<label for="Address" class="form-label">Address</label>
								<input type="text" class="form-control" name="address" id="address" value="{{$user->address}}">
							</div>
							<div class="col-md-6">
								<label for="Postcode" class="form-label">Postcode</label>
								<input type="text" class="form-control" name="postcode" id="postcode" value="{{$user->postcode}}">
							</div>
							<div class="col-md-12">
								<label for="formFileMultiple" class="form-label"> File Upload</label>
								<input class="form-control" name="profile" type="file" id="formFileMultiple" multiple accept=".png, .jpg, .jpeg">
								@if($user->profile)
									<p>{{$user->profile}}</p>
								@else
									<p>Anda Belum Mengupload Foto Profile</p>
								@endif
							</div>
						</div>
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
</script>
@endpush

@push('modals')
@endpush