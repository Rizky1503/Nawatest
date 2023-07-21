@extends(backendView('layouts.auth'))

@section('title', 'Signup')

@section('content')
<div class="container-xxl">

	<div class="row g-0">
		<div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">
			<div style="max-width: 25rem;">
				<div class="text-center mb-5">
					<i class="bi bi-bag-check-fill  text-primary" style="font-size: 90px;"></i>
				</div>
				<div class="mb-5">
					<h2 class="color-900 text-center">A few clicks is all it takes.</h2>
				</div>
				<!-- Image block -->
				<div class="">
					<img src="{!! backendAssets('dist/assets/images/login-img.svg') !!}" alt="login-img">
				</div>
			</div>
		</div>


		<div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
			<div class="w-100 p-3 p-md-5 card border-0 shadow-sm" style="max-width: 32rem;">
				<!-- Form -->                        
				<form class="row g-1 p-3 p-md-4" method="post" action="register"> @csrf
					<div class="col-12 text-center mb-5">
						<h1>Create your account</h1>
						<span>Free access to our dashboard.</span>
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
					<div class="col-12">
						<div class="mb-12">
							<label class="form-label">Full name</label>
							<input type="text" name="name" required class="form-control form-control-lg" placeholder="John">
						</div>
					</div>
					<div class="col-12">
						<div class="mb-2">
							<label class="form-label">Email address</label>
							<input type="email" name="email" required class="form-control form-control-lg" placeholder="name@example.com">
						</div>
					</div>
					<div class="col-12">
						<div class="mb-2">
							<label class="form-label">Password</label>
							<input type="password" name="password" required class="form-control form-control-lg" placeholder="8+ characters required">
						</div>
					</div>
					<div class="col-12 text-center mt-4">
						<button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase">SIGN UP</button>	
					</div>
					<div class="col-12 text-center mt-4">
						<span>Already have an account? <a href="{{url('/')}}" title="Sign in" class="text-secondary">Sign in here</a></span>
					</div>
				</form>
				<!-- End Form -->

			</div>
		</div>
	</div> <!-- End Row -->

</div>
@endsection

@push('styles')
@endpush

@push('custom_styles')
@endpush

@push('scripts')
@endpush

@push('custom_scripts')
@endpush

@push('modals')
@endpush