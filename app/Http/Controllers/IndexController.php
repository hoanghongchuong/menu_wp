<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Products;
use App\ProductCate;
use App\NewsLetter;
use App\Recruitment;
use DB,Cache,Mail;
use Cart;
use App\Campaign;
use App\Bill;
use App\CampaignCard;
use App\District;
use App\ChiNhanh;
class IndexController extends Controller {
	protected $setting = NULL;

	public $sortType = [
		'price-ascending' => [
			'text' => 'Giá: Tăng dần',
			'order' => ['price', 'ASC']
		],
		'price-descending' => [
			'text' => 'Giá: Giảm dần',
			'order' => ['price', 'DESC']
		],
		// 'title-ascending' => [
		// 	'text' => 'Tên: A-Z',
		// 	'order' => ['name', 'ASC']
		// ],
		// 'title-descending' => [
		// 	'text' => 'Tên: Z-A',
		// 	'order' => ['name', 'DESC']
		// ],
		// 'created-ascending' => [
		// 	'text' => 'Cũ nhất',
		// 	'order' => ['created_at', 'ASC']
		// ],
		// 'created-descending' => [
		// 	'text' => 'Mới nhất',
		// 	'order' => ['created_at', 'DESC']
		// ],
		// 'best-selling' => [
		// 	'text' => 'Bán chạy nhất',
		// 	'order' => ['noibat', 'ASC']
		// ]
	];
	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		
    	$setting = DB::table('setting')->select()->where('id',1)->get()->first();
    	$menu_top = DB::table('menu')->select()->where('com','menu-top')->where('status',1)->orderBy('stt','asc')->get();
    	$dichvu = DB::table('news')->select()->where('status',1)->where('com','dich-vu')->orderBy('stt','asc')->get();
    	$cateProducts = DB::table('product_categories')->where('parent_id',0)->get();
    	$about = DB::table('about')->where('com','gioi-thieu')->get();
    	Cache::forever('setting', $setting);
        Cache::forever('menu_top', $menu_top);
        Cache::forever('dichvu', $dichvu);
        Cache::forever('cateProducts', $cateProducts);
        Cache::forever('about', $about);
        if(Auth::check())
        {
        	View::share('nguoidung',Auth::user());
        }
        // Cache::forever('chinhanh', $chinhanh);
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$banner_danhmuc = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','index')->get()->first();
		$banner_sidebar = DB::table('banner_content')->where('position',5)->get();
		$tintuc_moinhat = DB::table('news')->select()->where('status',1)->where('com','tin-tuc')->orderBy('id','desc')->take(8)->get();
		$com='index';
		$hot_news = DB::table('news')->where('status',1)->where('noibat',1)->orderBy('created_at','desc')->take(8)->get();
		$cate_pro = DB::table('product_categories')->where('status',1)->where('parent_id',0)->orderby('id','asc')->get();
		$news_product = DB::table('products')->select()->where('status',1)->orderBy('id','desc')->take(8)->get();
		$hot_product  = DB::table('products')->where('status',1)->where('noibat',1)->orderBy('created_at','desc')->take(8)->get();
		$about = DB::table('about')->first();
		$lienkets = DB::table('lienket')->where('com','chuyen-muc')->first();
		$cateHots = DB::table('product_categories')->where('noibat',1)->get();
		$partners = DB::table('partner')->where('status',1)->orderBy('id','desc')->get();
		$slogans = DB::table('slogan')->get();
		$video = DB::table('video')->first();
		// Cấu hình SEO
		$setting = Cache::get('setting');
		$slider = DB::table('slider')->get();
		$title = $setting->title;
		$keyword = $setting->keyword;
		$description = $setting->description;
		// End cấu hình SEO
		$img_share = asset('upload/hinhanh/'.$setting->photo);

		return view('templates.index_tpl', compact('banner_danhmuc','com','khonggian_list','about','tintuc_moinhat','keyword','description','title','img_share','hot_news','news_product','hot_product','slider','banner_sidebar','cateHots','video','cate_pro','partners','slogans','lienkets'));
	}
	public function getProduct(Request $req)
	{
		$cate_pro = DB::table('product_categories')->where('status',1)->where('parent_id',0)->orderby('id','asc')->get();
		$productSale = DB::table('products')->select()->where('status',1)->where('spbc',1)->orderBy('id','desc')->take(6)->get();
		$products = DB::table('products')->select()->where('status', 1);
		$appends = [];
		$selected = $req->sort;
		if ($req->sort) {
			if (isset($this->sortType[$req->sort])) {
				$appends['sort'] = $req->sort;
				$products = $products->orderBy($this->sortType[$req->sort]['order'][0], $this->sortType[$req->sort]['order'][1]);
			}
		}
		$products = $products->paginate(9);
		if (count($appends)) {
			$products = $products->appends($appends);
		}
		$tintucs = DB::table('news')->where('com','tin-tuc')->orderBy('id','desc')->take(3)->get();
		$setting = Cache::get('setting');
		$com='san-pham';
		
		$title = "Sản phẩm";
		$keyword = "Sản phẩm";
		$description = "Sản phẩm";
		// $img_share = asset('upload/hinhanh/'.$banner_danhmuc->photo);
		
		// return view('templates.product_tpl', compact('product','banner_danhmuc','doitac','camnhan_khachhang','keyword','description','title','img_share'));
		view()->share(['sortType' => $this->sortType]);
		return view('templates.product_tpl', compact('title','keyword','description','products', 'com','cate_pro','tintucs','selected','productSale'));
	}

	public function getProductList($id, Request $req)
	{
		//Tìm article thông qua mã id tương ứng
		$cate_pro = DB::table('product_categories')->where('status',1)->orderby('id','asc')->get();
		$com='d';
		$productSale = DB::table('products')->select()->where('status',1)->where('spbc',1)->orderBy('id','desc')->take(6)->get();
		$product_cate = DB::table('product_categories')->select()->where('status',1)->where('alias',$id)->get()->first();
		if(!empty($product_cate)){
			// $products = DB::table('products')->select()->where('status',1)->where('cate_id',$product_cate->id)->orderBy('stt','asc')->paginate(20);
			$products = DB::table('products')->select()->where('status', 1)->where('cate_id',$product_cate->id);
			$appends = [];
			$selected = $req->sort;
			if ($req->sort) {
				if (isset($this->sortType[$req->sort])) {
					$appends['sort'] = $req->sort;
					$products = $products->orderBy($this->sortType[$req->sort]['order'][0], $this->sortType[$req->sort]['order'][1]);
				}
			}
			$products = $products->paginate(9);
			if (count($appends)) {
				$products = $products->appends($appends);
			}
			$banner_danhmuc = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','san-pham')->get()->first();
			$doitac = DB::table('lienket')->select()->where('status',1)->where('com','doi-tac')->orderby('stt','asc')->get();
			$tintucs = DB::table('news')->orderBy('id','desc')->take(3)->get();
			$cateChilds = DB::table('product_categories')->where('parent_id',$product_cate->id)->get();
			$setting = Cache::get('setting');
			if(!empty($product_cate->title)){
				$title = $product_cate->title;
			}else{
				$title = $product_cate->name;
			}
			$keyword = $product_cate->keyword;
			$description = $product_cate->description;
			$img_share = asset('upload/product/'.$product_cate->photo);
			view()->share(['sortType' => $this->sortType]);
			return view('templates.productlist_tpl', compact('products','product_cate','banner_danhmuc','doitac','keyword','description','title','img_share','cate_pro','tintucs','cateChilds','com','productSale','selected'));
		}else{
			return redirect()->route('getErrorNotFount');
		}
	}

	public function getProductChild($alias){
		$cate = DB::table('product_categories')->where('alias',$alias)->first();
		$products = DB::table('products')->select()->where('status',1)->where('cate_id',$cate->id)->orderBy('id','desc')->paginate(20);
		$tintucs = DB::table('news')->orderBy('id','desc')->take(3)->get();
		return view('templates.productlist_level2', compact('tintucs','products'));
	}
	
	public function getProductDetail($id)
	{
        
        $cate_pro = DB::table('product_categories')->where('status',1)->orderby('id','asc')->get();
		$product_detail = DB::table('products')->select()->where('status',1)->where('alias',$id)->get()->first();
		if(!empty($product_detail)){
			$banner_danhmuc = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','san-pham')->get()->first();
			// $product_khac = DB::table('products')->select()->where('status',1)->where('alias','<>',$id)->orderby('stt','desc')->take(8)->get();
			$album_hinh = DB::table('images')->select()->where('product_id',$product_detail->id)->orderby('id','asc')->get();
			
			$cateProduct = DB::table('product_categories')->select('name','alias')->where('id',$product_detail->cate_id)->first();
			$productSameCate = DB::table('products')->select()->where('status',1)->where('alias','<>',$id)->where('cate_id',$product_detail->cate_id)->orderby('stt','desc')->take(8)->get();
			// dd($productSameCate);
			$setting = Cache::get('setting');
			$productSale = DB::table('products')->select()->where('status',1)->where('spbc',1)->orderBy('id','desc')->take(6)->get();
			$tintucs = DB::table('news')->orderBy('id','desc')->take(3)->get();
			// Cấu hình SEO
			if(!empty($product_detail->title)){
				$title = $product_detail->title;
			}else{
				$title = $product_detail->name;
			}
			$keyword = $product_detail->keyword;
			$description = $product_detail->description;
			$img_share = asset('upload/product/'.$product_detail->photo);

			// End cấu hình SEO
			return view('templates.product_detail_tpl', compact('product_detail','banner_danhmuc','keyword','description','title','img_share','product_khac','album_hinh','cateProduct','productSameCate','tintucs','cate_pro','productSale'));
		}else{
			return redirect()->route('getErrorNotFount');
		}
	}
	public function getAbout()
	{
		$about = DB::table('about')->select()->get()->first();
        $com = 'gioi-thieu';
		
		 //Cấu hình SEO
		if(!empty($about->title)){
			$title = $about->title;
		}else{
			$title = $about->name;
		}
		$keyword = $about->keyword;
		$description = $about->description;
		// End cấu hình SEO

		return view('templates.about_tpl', compact('about','slider_about','banner_danhmuc','keyword','description','title','img_share','com'));
	}
	public function search(Request $request)
	{
		$search = $request->txtSearch;
		$cate_pro = DB::table('product_categories')->where('status',1)->orderby('id','asc')->get();
		// Cấu hình SEO
		$title = "Tìm kiếm: ".$search;
		$keyword = "Tìm kiếm: ".$search;
		$description = "Tìm kiếm: ".$search;
		$img_share = '';
		// End cấu hình SEO
		
		$products = DB::table('products')->select()->where('name', 'LIKE', '%' . $search . '%')->orderBy('id','DESC')->get();
		// dd($product);
		return view('templates.search_tpl', compact('products','banner_danhmuc','keyword','description','title','img_share','search','cate_pro'));
	}

	public function getNews()
	{
		$cateNews = DB::table('news_categories')->where('com','tin-tuc')->get();
		$cate_pro = DB::table('product_categories')->where('status',1)->where('parent_id',0)->orderby('id','asc')->get();
		$brands = DB::table('partner')->orderBy('id','desc')->get();
		$tintuc = DB::table('news')->select()->where('status',1)->where('com','tin-tuc')->orderby('id','desc')->paginate(6);
		$banner_danhmuc = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','tin-tuc')->get()->first();
		$tintuc_noibat = DB::table('news')->select()->where('status',1)->where('noibat','>',0)->where('com','tin-tuc')->take(3)->get();
		// $camnhan_khachhang = DB::table('lienket')->select()->where('status',1)->where('com','cam-nhan')->orderby('stt','asc')->get();
		$com='tin-tuc';
		// Cấu hình SEO
		$title = "Tin tức";
		$keyword = "Tin tức";
		$description = "Tin tức";
		$img_share = '';
		// End cấu hình SEO
		return view('templates.news_tpl', compact('tintuc','banner_danhmuc','tintuc_noibat','camnhan_khachhang','keyword','description','title','img_share','com','cateNews','cate_pro','brands'));
	}
	public function getListNews($id)
	{
		//Tìm article thông qua mã id tương ứng
		$tintuc_cate = DB::table('news_categories')->select()->where('status',1)->where('com','tin-tuc')->where('alias',$id)->get()->first();
		if(!empty($tintuc_cate)){
			$tintuc = DB::table('news')->select()->where('status',1)->where('cate_id',$tintuc_cate->id)->orderBy('id','desc')->paginate(5);
			$tintuc_moinhat_detail = DB::table('news')->select()->where('status',1)->where('com','tin-tuc')->orderby('created_at','desc')->take(6)->get();
			$hot_news = DB::table('news')->where('status',1)->where('noibat',1)->orderBy('created_at','desc')->take(5)->get();
			$setting = Cache::get('setting');

			if(!empty($tintuc_cate->title)){
				$title = $tintuc_cate->title;
			}else{
				$title = $tintuc_cate->name;
			}
			
			$keyword = $tintuc_cate->keyword;
			$description = $tintuc_cate->description;
			$img_share = asset('upload/news/'.$tintuc_cate->photo);

			// End cấu hình SEO
			return view('templates.news_list', compact('tintuc','tintuc_cate','banner_danhmuc','keyword','description','title','img_share','tintuc_moinhat_detail','hot_news'));
		}else{
			return redirect()->route('getErrorNotFount');
		}
	}
	public function getDichvu()
	{
		$tintuc = DB::table('news')->select()->where('status',1)->where('com','dich-vu')->orderby('stt','asc')->get();
		
		$cate_service = DB::table('news_categories')->where('status',1)->where('com','dich-vu')->orderBy('id','asc')->get();
		$product_news = DB::table('news')->select('news.name as nname','news.photo as nphoto','news.alias as nalias')->join('news_categories','news.cate_id','=','news_categories.id')->where('news_categories.status',0)->get();

		$banner_danhmuc = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','dich-vu')->get()->first();
		$tintuc_noibat = DB::table('news')->select()->where('status',1)->where('noibat','>',0)->where('com','dich-vu')->take(12)->get();
		$camnhan_khachhang = DB::table('lienket')->select()->where('status',1)->where('com','cam-nhan')->orderby('stt','asc')->get();
		$com='dich-vu';
		// Cấu hình SEO
		$title = "Dịch vụ";
		$keyword = "Dịch vụ";
		$description = "Dịch vụ";
		$img_share = '';
		// End cấu hình SEO
		return view('templates.dichvu_tpl', compact('tintuc','com','banner_danhmuc','tintuc_noibat','camnhan_khachhang','keyword','description','title','img_share', 'cate_service','product_news'));
	}

	public function getCateService(){
		$cate_service = DB::table('news_categories')->where('status',1)->where('com','dich-vu')->orderBy('id','asc')->get();
		return view('templates.cateservice_tpl', compact('cate_service'));
	}

	public function getHoivien()
	{
		$about_hoivien = DB::table('about')->select()->where('com','hoi-vien')->get()->first();
		$about_chiase = DB::table('about')->select()->where('com','chia-se')->get()->first();
		$camnhan_khachhang = DB::table('lienket')->select()->where('status',1)->where('com','cam-nhan')->orderby('stt','asc')->get();
		$tieuchi_hoivien = DB::table('lienket')->select()->where('status',1)->where('com','tieu-chi')->orderby('stt','asc')->get();
		$banner_danhmuc = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','hoi-vien')->get()->first();
		$com='hoi-vien';
		// Cấu hình SEO
		$title = "Hội viên";
		$keyword = "Hội viên";
		$description = "Hội viên";
		$img_share = '';
		// End cấu hình SEO
		return view('templates.hoivien_tpl', compact('about_hoivien','com','about_chiase','banner_danhmuc','tieuchi_hoivien','camnhan_khachhang','keyword','description','title','img_share'));
	}
	public function getThuvienanh()
	{
		$thuvienanh = DB::table('slider')->select()->where('com','thu-vien-anh')->orderBy('stt','asc')->paginate(6);
		$camnhan_khachhang = DB::table('lienket')->select()->where('status',1)->where('com','cam-nhan')->orderby('stt','asc')->get();
		$com='thu-vien-anh';
		// Cấu hình SEO
		$title = "Thư viện ảnh";
		$keyword = "Thư viện ảnh";
		$description = "Thư viện ảnh";
		$img_share = '';
		// End cấu hình SEO
		return view('templates.thuvienanh_tpl', compact('thuvienanh','com','camnhan_khachhang','keyword','description','title','img_share'));
	}
	public function getDichVuList($id)
	{
		//Tìm article thông qua mã id tương ứng
		$tintuc_cate = DB::table('news_categories')->select()->where('status',1)->where('com','dich-vu')->where('alias',$id)->get()->first();
		if(!empty($tintuc_cate)){
			$tintuc = DB::table('news')->select()->where('status',1)->where('cate_id',$tintuc_cate->id)->orderBy('stt','asc')->paginate(12);
			$banner_danhmuc = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','dich-vu')->get()->first();
			$tintuc_moinhat_detail = DB::table('news')->select()->where('status',1)->where('com','tin-tuc')->orderby('created_at','desc')->take(6)->get();
			$hot_news = DB::table('news')->where('status',1)->where('noibat',1)->orderBy('created_at','desc')->take(5)->get();
			$setting = Cache::get('setting');

			if(!empty($tintuc_cate->title)){
				$title = $tintuc_cate->title;
			}else{
				$title = $tintuc_cate->name;
			}
			
			$keyword = $tintuc_cate->keyword;
			$description = $tintuc_cate->description;
			$img_share = asset('upload/product/'.$tintuc_cate->photo);

			// End cấu hình SEO
			return view('templates.dichvulist_tpl', compact('tintuc','tintuc_cate','banner_danhmuc','keyword','description','title','img_share','tintuc_moinhat_detail','hot_news'));
		}else{
			return redirect()->route('getErrorNotFount');
		}
	}
	public function getDichVuDetail($id)
	{
		$news_detail = DB::table('news')->select()->where('status',1)->where('alias',$id)->where('com','dich-vu')->get()->first();

		if(!empty($news_detail)){

			//$cate_baiviet = DB::table('news_categories')->select()->where('status',1)->where('com','bai-viet')->where('id',$news_detail->cate_id)->get()->first();
			$baiviet_khac = DB::table('news')->select()->where('status',1)->where('alias','<>',$id)->where('com','dich-vu')->orderby('created_at','desc')->take(2)->get();
			$tintuc_moinhat_detail = DB::table('news')->select()->where('status',1)->where('com','tin-tuc')->orderby('created_at','desc')->take(6)->get();
			$banner_danhmuc = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','dich-vu')->get()->first();
			$quangcao = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','quang-cao')->get();
			$hot_news = DB::table('news')->where('status',1)->where('noibat',1)->orderBy('created_at','desc')->take(5)->get();
			$com='dich-vu';
			$setting = Cache::get('setting');
			// Cấu hình SEO
			if(!empty($news_detail->title)){
				$title = $news_detail->title;
			}else{
				$title = $news_detail->name;
			}
			$keyword = $news_detail->keyword;
			$description = $news_detail->description;
			$img_share = asset('upload/news/'.$news_detail->photo);

			return view('templates.dichvu_detail_tpl', compact('news_detail','com','quangcao','tintuc_moinhat_detail','camnhan_khachhang','banner_danhmuc','baiviet_khac','keyword','description','title','img_share','hot_news'));
		}else{
			return redirect()->route('getErrorNotFount');
		}
		
	}
	public function getBaiVietDetail($id)
	{
		$news_detail = DB::table('news')->select()->where('status',1)->where('alias',$id)->where('com','bai-viet')->get()->first();

		if(!empty($news_detail)){
			$tintuc_noibat = DB::table('news')->select()->where('status',1)->where('noibat','>',0)->where('com','tin-tuc')->take(5)->get();
			$cate_baiviet = DB::table('news_categories')->select()->where('status',1)->where('com','bai-viet')->where('id',$news_detail->cate_id)->get()->first();
			$baiviet_khac = DB::table('news')->select()->where('status',1)->where('alias','<>',$id)->where('com','bai-viet')->orderby('created_at','desc')->take(4)->get();
			$camnhan_khachhang = DB::table('lienket')->select()->where('status',1)->where('com','cam-nhan')->get();
			$banner_danhmuc = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','bai-viet')->get()->first();

			$setting = Cache::get('setting');
			// Cấu hình SEO
			if(!empty($news_detail->title)){
				$title = $news_detail->title;
			}else{
				$title = $news_detail->name;
			}
			$keyword = $news_detail->keyword;
			$description = $news_detail->description;
			$img_share = asset('upload/news/'.$news_detail->photo);

			return view('templates.baiviet_detail_tpl', compact('news_detail','camnhan_khachhang','banner_danhmuc','cate_baiviet','tintuc_noibat','baiviet_khac','keyword','description','title','img_share'));
		}else{
			return redirect()->route('getErrorNotFount');
		}
		
	}
	public function getNewsDetail($id)
	{
		$news_detail = DB::table('news')->select()->where('status',1)->where('com','tin-tuc')->where('alias',$id)->get()->first();
		if(!empty($news_detail)){
			$camnhan_khachhang = DB::table('lienket')->select()->where('status',1)->where('com','cam-nhan')->get();
			$banner_danhmuc = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','bai-viet')->get()->first();
			$quangcao_tintuc = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','quang-cao')->get();
			$tintuc_moinhat_detail = DB::table('news')->select()->where('status',1)->where('com','tin-tuc')->orderby('created_at','desc')->take(5)->get();
			$tinkhac = DB::table('news')->where('status',1)->where('id','<>',$id)->take(7)->get();
			$hot_news = DB::table('news')->where('status',1)->where('noibat',1)->orderBy('created_at','desc')->take(5)->get();
			$cate_pro = DB::table('product_categories')->where('status',1)->where('parent_id',0)->orderby('id','asc')->get();
			$baiviet_khac = DB::table('news')->select()->where('status',1)->where('cate_id','=',$news_detail->cate_id)->where('id','<>', $news_detail->id)->where('com','tin-tuc')->orderby('created_at','desc')->take(6)->get();
			$com='tin-tuc';
			$setting = Cache::get('setting');
			// Cấu hình SEO
			if(!empty($news_detail->title)){
				$title = $news_detail->title;
			}else{
				$title = $news_detail->name;
			}
			$keyword = $news_detail->keyword;
			$description = $news_detail->description;
			$img_share = asset('upload/news/'.$news_detail->photo);

			return view('templates.news_detail_tpl', compact('news_detail','com','tintuc_moinhat_detail','camnhan_khachhang','banner_danhmuc','baiviet_khac','quangcao_tintuc','keyword','description','title','img_share','hot_news','tinkhac','cate_pro'));
		}else{
			return redirect()->route('getErrorNotFount');
		}
		
	}
	public function getNewsTuyenDungDetail($id){
		$news_detail = DB::table('news')->select()->where('status',1)->where('com','tuyen-dung')->where('alias',$id)->get()->first();
		if(!empty($news_detail)){
			$camnhan_khachhang = DB::table('lienket')->select()->where('status',1)->where('com','cam-nhan')->get();
			$banner_danhmuc = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','bai-viet')->get()->first();
			$quangcao_tintuc = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','quang-cao')->get();
			$tintuc_moinhat_detail = DB::table('news')->select()->where('status',1)->where('com','tin-tuc')->orderby('created_at','desc')->take(6)->get();
			$tinkhac = DB::table('news')->where('status',1)->where('id','<>',$id)->take(7)->get();
			$hot_news = DB::table('news')->where('status',1)->where('noibat',1)->orderBy('created_at','desc')->take(5)->get();
			$baiviet_khac = DB::table('news')->select()->where('status',1)->where('cate_id','=',$news_detail->cate_id)->where('com','tin-tuc')->orderby('created_at','desc')->get();
			$com='tin-tuc';
			$setting = Cache::get('setting');
			// Cấu hình SEO
			if(!empty($news_detail->title)){
				$title = $news_detail->title;
			}else{
				$title = $news_detail->name;
			}
			$keyword = $news_detail->keyword;
			$description = $news_detail->description;
			$img_share = asset('upload/news/'.$news_detail->photo);

			return view('templates.news_detail_tpl', compact('news_detail','com','tintuc_moinhat_detail','camnhan_khachhang','banner_danhmuc','baiviet_khac','quangcao_tintuc','keyword','description','title','img_share','hot_news','tinkhac'));
		}else{
			return redirect()->route('getErrorNotFount');
		}
	}
	public function getMauThietKeDetail($id)
	{
		$news_detail = DB::table('news')->select()->where('status',1)->where('com','mau-thiet-ke')->where('alias',$id)->get()->first();
		if(!empty($news_detail)){
			$banner_danhmuc = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','bai-viet')->get()->first();
			$baiviet_khac = DB::table('news')->select()->where('status',1)->where('alias','<>',$id)->where('com','mau-thiet-ke')->orderby('created_at','desc')->take(4)->get();
			$setting = Cache::get('setting');
			// Cấu hình SEO
			if(!empty($news_detail->title)){
				$title = $news_detail->title;
			}else{
				$title = $news_detail->name;
			}
			$keyword = $news_detail->keyword;
			$description = $news_detail->description;
			$img_share = asset('upload/news/'.$news_detail->photo);

			return view('templates.mauthietke_detail_tpl', compact('news_detail','tintuc_noibat','banner_danhmuc','baiviet_khac','keyword','description','title','img_share'));
		}else{
			return redirect()->route('getErrorNotFount');
		}
		
	}

	public function postGuidonhang(Request $request)
	{
		$setting = Cache::get('setting');
		$data = [
			'hoten' 		=> $request->get('hoten'), 
			'diachi' 	=> $request->get('diachi'),
			'dienthoai' 	=> $request->get('dienthoai'),
			'email' 	=> $request->get('email'),
			'noidung' 	=> $request->get('noidung')
		];
		Mail::send('templates.guidonhang_tpl', $data, function($msg){
			$msg->from($request->get('email'), $request->get('hoten'));
			$msg->to('emailserver.send@gmail.com', 'Author sendmail')->subject('Liên hệ từ website');
		});

		echo "<script type='text/javascript'>
			alert('Thanks for contacting us !');
			window.location = '".url('/')."' </script>";
	}
	public function postNewsLetter(Request $request)
	{
		$this->validate($request,
            ["txtEmail" => "required"],
            ["txtEmail.required" => "Bạn chưa nhập email"]
        );
        $kiemtra_mail = DB::table('newsletter')->select()->where('status',1)->where('com','newsletter')->where('email',$request->txtEmail)->get()->first();
        if(empty($kiemtra_mail)){
			$data = new NewsLetter();
			$data->name = $request->txtName;
			$data->email = $request->txtEmail;
			$data->phone = $request->txtPhone;
			$data->content = $request->txtContent;
			$data->status = 1;
			$data->com = 'newsletter';
			$data->save();

			echo "<script type='text/javascript'>
				alert('Bạn đã đăng kí nhận tin tức thành công !');
				window.location = '".url('/')."' </script>";
		}else{
			echo "<script type='text/javascript'>
				alert('Email này đã đăng ký !');
				window.location = '".url('/')."' </script>";
		}
	}
	public function getErrorNotFount(){
		$banner_danhmuc = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','san-pham')->get()->first();
		return view('templates.404_tpl',compact('banner_danhmuc'));
	}

	public function getTuyenDung(){
		$com='tuyen-dung';
		$tintuc = DB::table('news')->select()->where('status',1)->where('com','tuyen-dung')->orderby('id','desc')->paginate(6);
		$tintuc_noibat = DB::table('news')->select()->where('status',1)->where('noibat','>',0)->where('com','tin-tuc')->take(12)->get();
		return view('templates.tuyendung_tpl', compact('com','tintuc','tintuc_noibat'));
	}
	public function postTuyenDung(Request $request){
		$data = new Recruitment;
		$data->name = $request->txtName;
		$data->phone = $request->txtPhone;
		$data->email = $request->txtEmail;
		$data->address = $request->txtAddress;
		$data->save();
		return redirect()->back()->with('mess','Cảm ơn bạn đã gửi yêu cầu. Chúng tôi sẽ liên hệ lại với bạn sớm nhất !');
	}

	
	

	public function getCart()
	{
		$product_cart= Cart::content();
		// dd($product_cart);
		$bank = DB::table('bank_account')->get();
		$total = $this->getTotalPrice();
		$province = DB::table('province')->get();
		// $district = DB::table('district')->get();
		$product_noibat = DB::table('products')->select()->where('status',1)->where('noibat','>',0)->orderBy('created_at','desc')->take(8)->get();
		$setting = Cache::get('setting');
		// Cấu hình SEO
		$title = "Giỏ hàng";
		$keyword = "Giỏ hàng";
		$description = "Giỏ hàng";
		$img_share = '';
		// End cấu hình SEO
		return view('templates.giohang_tpl', compact('doitac','product_cart','district','product_noibat','province','keyword','description','title','img_share','total', 'bank'));
	}

	public function addCart(Request $req)
	{
		$data = $req->only('product_id','product_numb');
		$product = DB::table('products')->select()->where('status',1)->where('id',$data['product_id'])->first();
		if (!$product) {
			die('product not found');
		}
		Cart::add(array(
				'id'=>$product->id,
				'name'=>$product->name,
				'qty'=>$data['product_numb'],
				'price'=>$product->price,
				'options'=>array('photo'=>$product->photo,'code'=>$product->code)));
		return redirect(route('getCart'));
	}
	public function addCartAjax(Request $req)
    {
        // $data = $req->only('product_id');
        try {
            $product = DB::table('products')->select()->where('status', 1)->where('id', $req->id)->first();
            if (!$product) {
                die('product not found');
            }
            Cart::add(array(
                'id' => $product->id,
                'name' => $product->name,
                'qty' => 1,
                'price' => $product->price,
                'options' => array('photo' => $product->photo, 'code' => $product->code, 'alias' => $product->alias)
            ));
            echo count(Cart::Content());
        } catch (\Exception $e) {
            return 0;
        }
        // return redirect(route('getCart'));
    }
	public function updateCart(Request $req){
		$data = $req->numb;
		// dd($data);
		if($data>0){
			foreach($data as $key=>$item){
				Cart::update($key, $item);
			}
		}		
		return redirect(route('getCart'));
	}
	public function deleteCart($id){
        Cart::remove($id);
        return redirect('gio-hang');
    }

    public function checkCard(Request $req) {
    	$card = (new CampaignCard)
    		->join('campaigns', 'campaign_cards.campaign_id', '=', 'campaigns.id')
    		->select('campaigns.campaign_value', 'campaigns.campaign_type')
    		->where([
    			'campaign_cards.card_code' => $req->card_code,
    			'campaign_cards.del_flg' => 0,
    			'campaign_cards.is_active' => 0,
    			'campaigns.del_flg' => 0
    		])
    		->where('campaigns.campaign_expired', '>=', date('Y-m-d'))
    		->first();
    	if ($card) {
	    	$total = $this->getTotalPrice();
    		if ($card->campaign_type == 1) {
    			$total = $total - $card->campaign_value;
    		}
    		if ($card->campaign_type == 2) {
    			$total = $total * (100 - $card->campaign_value) / 100;
    		}

    		// return ($total);
    		return number_format($total);
    	}
    	return response()->json(false);
    }

    protected function getTotalPrice() 
    {
    	$cart = Cart::content();
    	$total = 0;
    	foreach ($cart as $key) {
    		$total += $key->price * $key->qty;
    	}
    	return $total;
    }

    public function postOrder(Request $req){
    	$cart = Cart::content();
    	$bill = new Bill;
    	$bill->full_name = $req->full_name;
    	$bill->email = $req->email;
    	$bill->phone = $req->phone;
    	$bill->note = $req->note;
    	$bill->address = $req->address;
    	$bill->payment = (int)($req->payment_method);
    	$bill->province = $req->province;
    	// $bill->district = $req->district;
    	$total = $this->getTotalPrice();
    	$bill->total = $total;
    	// $order['price'] = $this->getTotalPrice();
    	// if ($req->card_code) {
    	// 	$price = $this->checkCard($req);
	    // 	if (!$price) {
	    // 		return redirect()->back()->with('Mã giảm giá không đúng');
	    // 	}
	    // 	$bill->card_code = $req->card_code;
	    // 	$tongtien = $this->checkCard($req);
	    // 	$bill->total = ((Int)str_replace(',', '', $tongtien)); 	
    	// }
    	$detail = [];
    	foreach ($cart as $key) {
    		$detail[] = [
    			'product_name' => $key->name,
    			'product_numb' => $key->qty,
    			'product_price' => $key->price,
    			'product_img' => $key->options->photo,
    			'product_code' => $key->options->code
    		];
    	}
    	    	
    	$bill->detail = json_encode($detail);
    	if($total > 0){
    		$bill->save();
    	}
    	else{
    		echo "<script type='text/javascript'>
				alert('Giỏ hàng của bạn rỗng!');
				window.location = '".url('/')."' 
			</script>";
    	}
    	
    	Cart::destroy();

    	echo "<script type='text/javascript'>
				alert('Cảm ơn bạn đã đặt hàng, chúng tôi sẽ liên hệ với bạn sớm nhất!');
				window.location = '".url('/')."' 
			</script>";
    }

    public function deleteAllCart(){
    	Cart::destroy();
    	return redirect()->back()->with('mess','Đã xóa giỏ hàng');
    }

    public function thanhtoan(){
    	$bank = DB::table('bank_account')->get();
    	$product_cart= Cart::content();
    	$total = $this->getTotalPrice();
		return view('templates.thanhtoan_tpl',compact('bank','product_cart','total'));
	}
    public function loadDistrictByProvince($id){
    	$district = District::where('province_id',$id)->get();
    	// dd($district);
    	foreach($district as $item){
    		echo "<option value='".$item->id."'>".$item->district_name."</option>";
    	}
    }
    public function getProductByThuongHieu($alias){
    	$cate_pro = DB::table('product_categories')->where('status',1)->orderby('id','asc')->get();
    	$thuonghieus = DB::table('thuonghieu')->get();
    	$thuonghieu = DB::table('thuonghieu')->select()->where('alias',$alias)->get()->first();
    	$products = DB::table('products')->where('thuonghieu_id',$thuonghieu->id)->paginate(12);
    	return view('templates.thuonghieu_tpl', compact('products','cate_pro','thuonghieus','thuonghieu'));
    }
    public function SapXep(Request $request){
    	$result = DB::table('products')
    			->join('product_categories','products.cate_id','=','product_categories.id')
    			->select('products.id', 'products.name as productName','products.alias as productAlias','products.photo as productPhoto','products.price as productPrice');

    	if ($request->cate) {
    		$result = $result->where('products.cate_id', $request->cate);
    	}
    	if ($request->price) {
    		$result = $result->whereBetween('products.price', array(0, $request->price));
    	}

    	$result = $result->orderBy('products.id', $request->sort ? $request->sort : 'asc')->paginate(12);
    	return response()->json([
    		'paginator'  => (String) $result->render(),
    		'data'		 => json_decode(json_encode($result))->data,
    	]);
    }

    public function getProductByCate($alias){
    	$cate_pro = DB::table('product_categories')->where('status',1)->where('parent_id',0)->orderby('id','asc')->get();
    	$categoryDetail = ProductCate::select('name','alias','id','parent_id')->where('alias', $alias)->first();
    	$products = $categoryDetail->products;

    	return view('templates.cateproduct_tpl', compact('categoryDetail','cate_pro','products'));
    }
    public function filter(Request $requset){
    	$price = explode(' - ', $requset->price_filter);
    	dd($price);
    }
}
