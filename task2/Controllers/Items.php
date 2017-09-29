<?php 
namespace App\Http\Controllers;

class Items extends Controller {
	public $id;
	public $parentId;
	public $name;

	static function sortItems($availableItems) {
		usort($availableItems, function($a, $b) {
			return $a["id"] <=> $b["id"];
		});

		return $availableItems;
	}
}




 ?>