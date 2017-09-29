<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Items;
use Illuminate\Http\Request;
use DB;


class ItemsController extends Controller
{


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



}
