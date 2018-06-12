<?php 
namespace App\Http\Controllers;
use App\Contact;
use Illuminate\Http\Request;
use DB,Cache,Mail;
class ContactController extends Controller {
	protected $setting = NULL;

	public function __construct()
	{
		
    	$setting = DB::table('setting')->select()->where('id',1)->get()->first();
        Cache::forever('setting', $setting);
	}

	public function getContact()
    {
        // Cấu hình SEO
		$title = "Liên hệ";
		$keyword = "Liên hệ";
		$description = "Liên hệ";
		$img_share = '';
		$com='lien-he';
		$chinhanhx = DB::table('chinhanh')->select()->get();
		$about_lienhe = DB::table('about')->select()->where('com','lien-he')->get()->first();
		$banner_danhmuc = DB::table('lienket')->select()->where('status',1)->where('com','chuyen-muc')->where('link','lien-he')->get()->first();
		// $chinhanh = DB::table('lienket')->select()->where('status',1)->where('com','chi-nhanh')->orderBy('stt','asc')->get();
		// End cấu hình SEO
        return view('templates.contact_tpl', compact('banner_danhmuc','lien-he','chinhanh','about_lienhe','keyword','description','title','img_share','com','chinhanhx'));
    }

    /**
     * post contact action
     * @param  Request $request
     * @return redirect
     */
    public function postContact(Request $request)
	{
		$data = new Contact();
		$data->name = $request->name;
		// $data->phone = $request->phone;
		// $data->address = $request->adress;
		$data->email = $request->email;
		$data->content = $request->content;
		$data->save();
		// Contact::insert([
		// 	'name' => $request->txtName,
		// 	'phone' => $request->txtPhone,
		// 	'email' => $request->txtEmail,
		// 	'content' => $request->txtContent,
		// 	'created_at' => date('Y-m-d H:i:s'),
		// 	'updated_at' => date('Y-m-d H:i:s'),
		// ]);
		echo "<script type='text/javascript'>
			alert('Cảm ơn bạn đã gửi yêu cầu. Chúng tôi sẽ liên hệ lại với bạn sớm nhất !');
			window.location = '".url('/')."' </script>";


		// $setting = Cache::get('setting');
		// $data = [
		// 	'hoten' 	=> Request::input('hoten_contact'),   
		// 	'email' 	=> Request::input('email_contact'),
		// 	'dienthoai' 	=> Request::input('dienthoai_contact'),
		// 	'diachi' 	=> Request::input('diachi_contact'),
		// 	'noidung' 	=> Request::input('noidung_contact')
		// ];

		// Mail::send('templates.layout.blanks', $data, function($msg){
		// 	$setting = Cache::get('setting');
		// 	$msg->from(Request::input('email_contact'), Request::input('hoten_contact'));
		// 	$msg->to($setting->email, 'Author sendmail')->subject('Liên hệ từ website');
		// });
		
	}

}
