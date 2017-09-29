<?php 

class Item {
	public $id;
	public $parentId;
	public $name;
}

function transfromInputFileIntoObject() {
	$file = new SplFileObject('input_data.txt');

	$items = [];
	
	foreach ($file as $content) {

		$eachItem = explode('|', $content);
		$item = new Item();
		$item->id = $eachItem[0];
		$item->parentId = $eachItem[1];
		$item->name = str_replace("\r\n",'', $eachItem[2]);
		$items[] = $item;
	}
	
	return $items;
}


function sortItems($availableItems) {
	usort($availableItems, function($a, $b) {
		return $a->id <=> $b->id;
	});
	return $availableItems;
}


function createPadding($paddingCount) {
	$padding = '';
	for ($i=0; $i < $paddingCount; $i++) { 
		$padding = $padding . '-';
	}
	return $padding;
}

function findMinimalAvailableItem($availableItems) {
	$minimalParentIdValue = null;
	foreach ($availableItems as $availableItem) {
		if ($minimalParentIdValue == null || $availableItem->parentId < $minimalParentIdValue) {
			$minimalParentIdValue = $availableItem->parentId;
		}
	}
	return $minimalParentIdValue;
}


function printItems($availableItem, $availableItems, $paddingCount) {
	print createPadding($paddingCount) . $availableItem->name . "<br>" . PHP_EOL;
	$arrayForJson = [];
	foreach ($availableItems as $currentItem) {
		if ($currentItem->id == $availableItem->id) {
			continue;
		} else if ($currentItem->parentId == $availableItem->id) {
			printItems($currentItem, $availableItems, ($paddingCount + 1));
		}
	}
}

function main() {
	$availableItems = transfromInputFileIntoObject();
	$sortedAvailableItems = sortItems($availableItems);
	foreach ($sortedAvailableItems as $sortedAvailableItem) {
		if ($sortedAvailableItem->parentId == findMinimalAvailableItem($sortedAvailableItems)) {
			printItems($sortedAvailableItem, $sortedAvailableItems, 0);
		}
	}
}


main();


 ?>