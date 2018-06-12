<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $table = 'menus';
    public function buildMenu($menu, $parentid = 0) 
	{ 
	  $result = null;

	 foreach ($menu as $item) 
	    if ($item->parent_id == $parentid) { 
	      $result .= "<li class='dd-item nested-list-item' data-order='{$item->order}' data-id='{$item->id}'>
	      <div class='dd-handle nested-list-handle'>
	        <span class='glyphicon glyphicon-move'></span> {$item->name}
	      </div>
	      <div class='nested-list-content'>{$item->name}
	        <div class='pull-right'>
	          <a href='#myModalEdit' class='edit_menu' data-toggle='modal' onclick='getEditMenu({$item->id})' >Edit</a> |
	          <a href='".url("menu/delete/{$item->id}")."' class='delete_toggle delete_menu' rel='{$item->id}'>Delete</a>
	        </div>
	      </div>".$this->buildMenu($menu, $item->id) . "</li>"; 
	    }  
	  return $result ?  "\n<ol class=\"dd-list\">\n$result</ol>\n" : null; 
	} 



	


	// Getter for the HTML menu builder
	public function getHTML($items)
	{
		return $this->buildMenu($items);
	}
}
