<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Items;
use Illuminate\Http\Request;
use DB;
use App\Category;


class ItemsController extends Controller
{

		public $accordionArray = [];
		public $msg = '';

function transfromInputFileIntoObject() {
		$file = new \SplFileObject('../../input_data.txt');

		$items = [];
					
		foreach ($file as $content) {

				$eachItem = explode('|', $content);
				$item = [
					'id' => $eachItem[0],
					'parentId' => $eachItem[1],
					'name' => str_replace("\r\n",'', $eachItem[2])];
				$items[] = $item;
			}
			return Items::sortItems($items);
		}

		function addAvailableItemsToDatabase() {
			$availableItems = $this->transfromInputFileIntoObject();
			DB::table('categories')->truncate();
			foreach ($availableItems as $index => $itemsArray) {
					DB::table('categories')->insert(
						[
						'id' => $itemsArray['id'],
						'parent_id' => $itemsArray['parentId'],
						'name' => $itemsArray['name']
						]
					);
			}
		}

		function renderCategories() {
			$categoryItems = Category::where('id', 'parent_id')->get();
			$categories = DB::table('categories')->select();
			$items = Category::all()->toArray();
			$this->buildTree($items);
		}
		
		function buildTree($availableItems, $parentId = 0) {
			$this->msg .= "<ul>";
			foreach($availableItems as $availableItem) {
				if ($availableItem['parent_id'] == $parentId) {
					 $this->msg .= "<li><a href='#'>" . $availableItem['name'];
					 $this->buildTree($availableItems, $availableItem['id']);
					 $this->msg .= "</a></li>";
				}
			}
			$this->msg .= "</ul>";
		}
		public function getTreeView() {
			$this->renderCategories();
			$views = $this->msg;
			return view('index')->with('views', $views);
	}
}
