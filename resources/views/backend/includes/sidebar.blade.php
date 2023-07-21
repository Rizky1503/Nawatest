<!-- sidebar -->
<div class="sidebar px-4 py-4 py-md-4 me-0">
	<div class="d-flex flex-column h-100">
		<a href="{!! backendRoutePut('home') !!}" class="mb-0 brand-icon">
			<span class="logo-icon">
				<i class="icofont-tiger-face fs-1"></i>
			</span>
			<span class="logo-text">Rizky Moto Shop</span>
		</a>
		<!-- Menu: main ul -->
		<ul class="menu-list flex-grow-1 mt-3">

			<li><a class="m-link {!! routeIsActive(backendRoute('home')) !!}" href="{!! route('dashboard.home') !!}"><i class="icofont-home fs-5"></i> <span>Dashboard</span></a></li>

			<li><a class="m-link" href="{!! route('products.list') !!}"><i class="icofont-motor-bike fs-5"></i> <span>Produk</span></a></li>

			<li><a class="m-link" href="{!! route('dashboard.list') !!}"><i class="icofont-notepad fs-5"></i> <span>List Order</span></a></li>

		</ul>

		<!-- Menu: menu collepce btn -->
		<button type="button" class="btn btn-link sidebar-mini-btn text-light">
			<span class="ms-2"><i class="icofont-bubble-right"></i></span>
		</button>
	</div>
</div>