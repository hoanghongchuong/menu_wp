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

    	$sourceId = $req->drag_data;
        // $order = $req->order;
        // $rootOrder = $req->rootOrder;
        $a = json_decode($sourceId);        
    	foreach($a as $k=>$item)
        {
            if(isset($item->children))
            {
                foreach($item->children as $h=>$children)
                {
                    if(isset($children->children))
                    {
                        foreach($children->children as $h3=>$children3)
                        {
                            $data3 = Menus::find($children3->id);
                            $data3->parent_id = $children->id;
                            $data3->order = $h+$k+$h3+3;
                            $data3->save();
                        }                
                    }
                    $data = Menus::find($children->id);
                    $data->parent_id = $item->id;
                    $data->order = $h+$k+2;
                    $data->save();
                }                
            }
            $data = Menus::find($item->id);
            $data->parent_id = 0;
            $data->order = $k + 1;                
            $data->save();
        }
        return 1;
    }

    public function deleteMenu($id)
    {
    	// $id = $req->_id;
    	$data = Menus::find($id);
        $children = Menus::where('parent_id', $data->id)->get();
        if(count($children) > 0){
            foreach($children as $item){
                $childrens = Menus::where('parent_id', $item->id)->get();
                if(count($children) > 0){
                    foreach($childrens as $items){
                        $items->delete();
                    }
                }
                $item->delete();

            }
        }
        
    	$data->delete();
    	
    	return redirect()->back();
    }
}
