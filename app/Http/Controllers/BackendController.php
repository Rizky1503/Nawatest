<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use App\Models\Products;
use App\Models\Cart;
use Yajra\DataTables\Facades\DataTables;
use App\Jobs\OrderEmailJobs;
use File;
use Session;

class BackendController extends Controller {

	// home
	public function index() {
		$products = Products::where('stock','>','0')->get();
		return view('backend.pages.products',[
			'products' => $products
		]);
	}

	public function order($id){
		$product = Products::whereId($id)->first();

		$price = $product->price;

		$products = Products::updateOrCreate(
            ['id' => $id],
            [
                'stock' => $product->stock - 1,
            ]
        );

		$cart = Cart::updateOrCreate(
            ['id' => $id],
            [
                'id_user' => Auth::user()->id ,
                'id_product' => $id,
                'qty' => 1,
                'price' => $product->price,
                'total' => $product->price * 1,
                'status' => 'ordered'
            ]
        );

		$final = Cart::with('product','user')->first();
        dispatch(new OrderEmailJobs($final));

        return redirect()->route('dashboard.invoices',['id' => $final->id])->with('message', 'Please check email to get verification');    
        	
	}

	public function download($id){
		$final = Cart::with('product','user')->whereId($id)->first();

        $data = json_encode($final);
  		$path = 'dist/assets/api';
        $fileName = time() . '_datafile.json';
        $fileStorePath = public_path($path.$fileName);
  
        File::put($fileStorePath, $data);

        return response()->download($fileStorePath);
	}

	public function invoices($id){
		$data = Cart::with('product','user')->whereId($id)->first();

		return view('backend.pages.invoices', [
        	'id' => $id,
        	'data' => $data
        ]);
	}

	public function listOrder(){
		if (request()->ajax()) {
		    $order = Cart::with('product','user')->get();
		    if(@$order){
		    	return DataTables::of($order)
			    	->addIndexColumn()
		            ->addColumn('action', function($row){
		                $btn = '<a href="'.route('dashboard.invoices', ['id'=>$row->id]).'" class="btn btn-primary">invoices</a>';
		   				
		   				if($row->status == 'ordered'){
		   					$btn = $btn.' <a href="'.route('dashboard.cancel', ['id'=>$row->id]).'" onclick="return confirm(`Yakin ingin cancel order?`)" class="btn btn-danger">canceled</a>';
		   				}
		                
		                return $btn;
		            })
		            ->rawColumns(['action'])
		    	->make();
			}
		}

		return view('backend.pages.list_order');
	}

	public function cancelOrder($id){
		$cart = Cart::updateOrCreate(
            ['id' => $id],
            [
                'status' => 'canceled'
            ]
        );

        $final = Cart::with('product','user')->first();
        dispatch(new OrderEmailJobs($final));

		return redirect()->back()->with('message', 'Cancel Order');
	}

	// profile
	public function profile(){
		$user = Auth::user();

		return view('backend.pages.form_profile', [
        	'user' => $user
        ]);
	}

	public function storeProfile(Request $request){
		$path = 'dist/assets/images';
        if(!is_dir(public_path($path))) mkdir(public_path($path), 0775);

        if($request->profile){
            $file = $request->file('profile');
            $profile = time().'-'.str_replace(' ', '-', strtolower($file->getClientOriginalName()));
            $file->move(public_path($path), $profile);
            $nameProfile = $path.'/'.$profile;
        }
        
        $check = User::whereEmail($request->email)->first();

        $user = User::updateOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name ?? $check->name ,
                'password' => bcrypt($request->password) ?? $check->password,
                'phone' => $request->phone ?? $check->phone,
                'address' => $request->address ?? $check->address,
                'postcode' => $request->postcode ?? $check->postcode,
                'profile' => $nameProfile ?? $check->profile,
            ]
        );

        return redirect()->back()->with('message', 'Data Telah Tersimpan');
	}


	//produk
	public function listProducts(){
		if (request()->ajax()) {
		    $product = Products::query();
		    if(@$product){
		    	return DataTables::of($product)
			    	->addIndexColumn()
		            ->addColumn('action', function($row){
		                $btn = '<a href="'.route('products.form', ['id'=>$row->id]).'" class="btn btn-primary">Edit</a>';
		   
		                $btn = $btn.' <a href="'.route('products.delete', ['id'=>$row->id]).'" onclick="return confirm(`Yakin ingin menghapus?`)" class="btn btn-danger">Hapus</a>';

		                return $btn;
		            })
		            ->rawColumns(['action'])
		    	->make();
			}
		}

		return view('backend.pages.list_produk');	
	}

	public function formProducts($id){
		$product = Products::whereId($id)->first();
		return view('backend.pages.form_products',[
			'id' => $id,
			'data' => $product
		]);	
		
	}

	public function storeProducts(Request $request){
		 \Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'stok' => 'required',
            'detail' => 'required',
            'pictures' => ['required', 'image', function($attr, $file, $fail){
                $file_ = @getimagesize($file);
                if($file->getClientMimeType() != $file_['mime']){
                    $fail('Mime Type untuk file logo tidak valid');
                }

            }],
        ], [
            'required' => ':attribute harus diisi',
            'image' => 'Format file foto tidak valid. File harus berupa gambar'
        ])->validate();

		if($request->id == 0){
			$request->id = null;
		}else{
			$request->id = $request->id;
		}

		$path = 'dist/assets/images/product';
        if(!is_dir(public_path($path))) mkdir(public_path($path), 0775);

		if($request->pictures){
            $file = $request->file('pictures');
            $pictures = time().'-'.str_replace(' ', '-', strtolower($file->getClientOriginalName()));
            $file->move(public_path($path), $pictures);
            $namePictures = $path.'/'.$pictures;
        }

		$product = Products::updateOrCreate(
            ['id' => $request->id],
            [
                'name' => $request->name,
                'price' => $request->price,
                'detail' => $request->detail,
                'stock' => $request->stok,
                'pictures' => $namePictures,
            ]
        );

        return redirect()->back()->with('message', 'Produk Telah Tersimpan');
	}

	public function deleteProducts($id){
		$produk = Products::find(1); 
		$produk->delete();

		return redirect()->back()->with('message', 'Produk Berhasil Terhapus');
	}


}
