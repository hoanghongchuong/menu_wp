<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menus;
class MenuController extends Controller
{
    public function index()
    {
    	$item = Menus::orderBy('order')->get();
    	$menu = new Menus;
    	$menu = $menu->getHtml($item);
    	// dd($menu);
    	return view('templates.menu.index', compact('item', 'menu'));
    }

    public function create(Request $req)
    {
    	$data = new Menus;
		$data->name  = $req->_name;    	
		$data->slug  = $req->_slug ? $req->_slug : str_slug($req->_name);     
		$data->order = Menus::max('order')+1;	
		$data->save();
		$item        = Menus::orderBy('order')->get();
		$menu        = new Menus;
		$menu        = $menu->getHtml($item);
    	return view('templates.menu.create', compact('menu'));
    }

    public function getEdit(Request $req, $id)
    {
    	// $id = $req->id;
    	$data = Menus::find($id);
    	// dd($data);
    	return view('templates.menu.edit', compact('data'));
    	
    }

    public function postEdit(Request $req)
    {
    	$id = $req->_id;
    	$data = Menus::find($id);
    	$data->name  = $req->_name;    	
		$data->slug  = $req->_slug ? $req->_slug : str_slug($req->_name);
		$data->save();
		$item        = Menus::orderBy('order')->get();
		$menu        = new Menus;
		$menu        = $menu->getHtml($item);
    	return view('templates.menu.postEdit', compact('menu'));
    }

    public function drag(Request $req)
    {
    	$sourceId = $req->sourceId;
    	dd($sourceId);
    }



    public function deleteMenu($id)
    {
    	// $id = $req->_id;
    	$data = Menus::find($id);
    	$data->delete();
    	
    	return redirect()->back();
    }
}
