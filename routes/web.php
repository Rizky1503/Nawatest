<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('signin', [AuthController::class, 'signin']);

Route::get('signup', [AuthController::class, 'signUp'])->name('auth.signup');
Route::post('register', [AuthController::class, 'register']);

Route::get('verify/{email}', [AuthController::class, 'verify'])->name('verify');
Route::post('verifyAction', [AuthController::class, 'verifyAction']);

Route::get('logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
	Route::group(['prefix' => 'dashboard'], function(){
		Route::get('home', [BackendController::class, 'index'])->name('dashboard.home');
		Route::get('order/{id}', [BackendController::class, 'order']);
		Route::get('download/{id}', [BackendController::class, 'download'])->name('dashboard.download');
		Route::get('invoices/{id}', [BackendController::class, 'invoices'])->name('dashboard.invoices');
		Route::get('list', [BackendController::class, 'listOrder'])->name('dashboard.list');
		Route::get('cancel/{id}',[BackendController::class,'cancelOrder'])->name('dashboard.cancel');

	});

	Route::group(['prefix' => 'profile'], function(){
		Route::get('views', [BackendController::class, 'profile'])->name('profile.views');
		Route::post('store', [BackendController::class, 'storeProfile']);
	});

	Route::group(['prefix' => 'products'], function(){
		Route::get('list', [BackendController::class, 'listProducts'])->name('products.list');
		Route::get('form/{id}', [BackendController::class, 'formProducts'])->name('products.form');
		Route::post('storeProducts',[BackendController::class,'storeProducts']);
		Route::get('delete/{id}',[BackendController::class,'deleteProducts'])->name('products.delete');
	});	
});


// Route::prefix('backend')->group(function () {
// 	Route::get('home', [BackendController::class, 'index'])->name('backend.home');
// 	Route::get('login', [BackendController::class, 'authSignin'])->name('backend.auth-signin');


// 	// Products
// 	Route::prefix('')->group(function () {
// 		Route::get('product-grid', [BackendController::class, 'productGrid'])->name('backend.product-grid');
// 		Route::get('product-list', [BackendController::class, 'productList'])->name('backend.product-list');
// 		Route::get('product-edit', [BackendController::class, 'productEdit'])->name('backend.product-edit');
// 		Route::get('product-detail', [BackendController::class, 'productDetail'])->name('backend.product-detail');
// 		Route::get('product-add', [BackendController::class, 'productAdd'])->name('backend.product-add');
// 		Route::get('product-cart', [BackendController::class, 'productCart'])->name('backend.product-cart');
// 		Route::get('checkout', [BackendController::class, 'checkout'])->name('backend.checkout');
// 	});

// 	// Category
// 	Route::prefix('')->group(function () {
// 		Route::get('categories-list', [BackendController::class, 'categoryList'])->name('backend.categories-list');
// 		Route::get('categories-edit', [BackendController::class, 'categoryEdit'])->name('backend.categories-edit');
// 		Route::get('categories-add', [BackendController::class, 'categoryAdd'])->name('backend.categories-add');
// 	});

// 	// Order
// 	Route::prefix('')->group(function () {
// 		Route::get('order-list', [BackendController::class, 'orderList'])->name('backend.order-list');
// 		Route::get('order-details', [BackendController::class, 'orderDetails'])->name('backend.order-details');
// 		Route::get('order-invoices', [BackendController::class, 'orderInvoices'])->name('backend.order-invoices');
// 	});

// 	// Customer
// 	Route::prefix('')->group(function () {
// 		Route::get('customers', [BackendController::class, 'customers'])->name('backend.customers');
// 		Route::get('customer-detail', [BackendController::class, 'customerDetails'])->name('backend.customer-detail');
// 	});

// 	// Coupons
// 	Route::prefix('')->group(function () {
// 		Route::get('coupon-list', [BackendController::class, 'couponList'])->name('backend.coupon-list');
// 		Route::get('coupon-edit', [BackendController::class, 'couponEdit'])->name('backend.coupon-edit');
// 		Route::get('coupon-add', [BackendController::class, 'couponAdd'])->name('backend.coupon-add');
// 	});

// 	// Inventory
// 	Route::prefix('')->group(function () {
// 		Route::get('inventory-info', [BackendController::class, 'inventoryInfo'])->name('backend.inventory-info');
// 		Route::get('purchase', [BackendController::class, 'purchase'])->name('backend.purchase');
// 		Route::get('supplier', [BackendController::class, 'supplier'])->name('backend.supplier');
// 		Route::get('returns', [BackendController::class, 'returns'])->name('backend.returns');
// 		Route::get('department', [BackendController::class, 'department'])->name('backend.department');
// 	});

// 	// Accounts
// 	Route::prefix('')->group(function () {
// 		Route::get('invoices', [BackendController::class, 'invoices'])->name('backend.invoices');
// 		Route::get('expenses', [BackendController::class, 'expenses'])->name('backend.expenses');
// 		Route::get('salaryslip', [BackendController::class, 'salaryslip'])->name('backend.salaryslip');
// 	});

// 	// App
// 	Route::prefix('')->group(function () {
// 		Route::get('calendar', [BackendController::class, 'calendar'])->name('backend.calendar');
// 		Route::get('chat', [BackendController::class, 'chat'])->name('backend.chat');
// 	});

// 	Route::get('store-locator', [BackendController::class, 'storeLocator'])->name('backend.store-locator');

// 	// Auth
// 	Route::prefix('')->group(function () {
// 		Route::get('auth-signin', [BackendController::class, 'authSignin'])->name('backend.auth-signin');
// 		Route::get('auth-signup', [BackendController::class, 'authSignup'])->name('backend.auth-signup');
// 		Route::get('auth-password-reset', [BackendController::class, 'authPasswordReset'])->name('backend.auth-password-reset');
// 		Route::get('auth-two-step', [BackendController::class, 'authTwoStep'])->name('backend.auth-two-step');
// 		Route::get('auth-404', [BackendController::class, 'auth404'])->name('backend.auth-404');
// 	});

// 	Route::get('stater-page', [BackendController::class, 'staterPage'])->name('backend.stater-page');

// 	// UI Components
// 	Route::prefix('')->group(function () {
// 		Route::get('ui-alerts', [BackendController::class, 'uiAlerts'])->name('backend.ui-alerts');
// 		Route::get('ui-badge', [BackendController::class, 'uiBadge'])->name('backend.ui-badge');
// 		Route::get('ui-breadcrumb', [BackendController::class, 'uiBreadcrumb'])->name('backend.ui-breadcrumb');
// 		Route::get('ui-buttons', [BackendController::class, 'uiButtons'])->name('backend.ui-buttons');
// 		Route::get('ui-card', [BackendController::class, 'uiCard'])->name('backend.ui-card');
// 		Route::get('ui-carousel', [BackendController::class, 'uiCarousel'])->name('backend.ui-carousel');
// 		Route::get('ui-collapse', [BackendController::class, 'uiCollapse'])->name('backend.ui-collapse');
// 		Route::get('ui-dropdowns', [BackendController::class, 'uiDropdowns'])->name('backend.ui-dropdowns');
// 		Route::get('ui-listgroup', [BackendController::class, 'uiListgroup'])->name('backend.ui-listgroup');
// 		Route::get('ui-modal', [BackendController::class, 'uiModal'])->name('backend.ui-modal');
// 		Route::get('ui-navs', [BackendController::class, 'uiNavs'])->name('backend.ui-navs');
// 		Route::get('ui-navbar', [BackendController::class, 'uiNavbar'])->name('backend.ui-navbar');
// 		Route::get('ui-pagination', [BackendController::class, 'uiPagination'])->name('backend.ui-pagination');
// 		Route::get('ui-popovers', [BackendController::class, 'uiPopovers'])->name('backend.ui-popovers');
// 		Route::get('ui-progress', [BackendController::class, 'uiProgress'])->name('backend.ui-progress');
// 		Route::get('ui-scrollspy', [BackendController::class, 'uiScrollspy'])->name('backend.ui-scrollspy');
// 		Route::get('ui-spinners', [BackendController::class, 'uiSpinners'])->name('backend.ui-spinners');
// 		Route::get('ui-toasts', [BackendController::class, 'uiToasts'])->name('backend.ui-toasts');
// 		Route::get('ui-tooltips', [BackendController::class, 'uiTooltips'])->name('backend.ui-tooltips');
// 	});

// 	// Other Pages
// 	Route::prefix('')->group(function () {
// 		Route::get('admin-profile', [BackendController::class, 'adminProfile'])->name('backend.admin-profile');
// 		Route::get('purchase-plan', [BackendController::class, 'purchasePlan'])->name('backend.purchase-plan');
// 		Route::get('charts', [BackendController::class, 'charts'])->name('backend.charts');
// 		Route::get('table', [BackendController::class, 'table'])->name('backend.table');
// 		Route::get('forms', [BackendController::class, 'forms'])->name('backend.forms');
// 		Route::get('icon', [BackendController::class, 'icon'])->name('backend.icon');
// 		Route::get('contact', [BackendController::class, 'contact'])->name('backend.contact');
// 		Route::get('todo-list', [BackendController::class, 'todoList'])->name('backend.todo-list');
// 	});

// 	Route::get('help', [BackendController::class, 'help'])->name('backend.help');

// 	Route::get('documentation', [BackendController::class, 'documentation'])->name('backend.documentation');
// 	Route::get('changelog', [BackendController::class, 'changelog'])->name('backend.changelog');

	
	
// });
