<?php 

function transfromInputFileIntoObject() {
	$file = new SplFileObject('input_data.txt');
	$items = [];
	
	foreach ($file as $content) {
		$eachItem = explode('|', $content);
		$item['id'] = $eachItem[0];
		$item['parentId'] = $eachItem[1];
		$item['name'] = str_replace("\r\n",'', $eachItem[2]);
		$items[] = $item;
	}
	return $items;
}

function sortItems($availableItems) {
	usort($availableItems, function($a, $b) {
		return $a['id'] <=> $b['id'];
	});
	return $availableItems;
}

$sortedItems = sortItems(transfromInputFileIntoObject());

function buildTree($availableItems, $parentId = 0) {
	echo "<ul>";
	foreach ($availableItems as $availableItem) {
		if ($availableItem['parentId'] == $parentId) {
			echo "<li><a href='#'>" . $availableItem['name'];
			buildTree($availableItems, $availableItem['id']);
			echo "</a></li>";
		}
	}
	echo "</ul>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Document</title>
	<style>
	/* Main Styles */
	body {
		height: 100%;
	}

	#collapseMenu {
		margin: 0 auto;
		margin-top:50px;
		position: relative;
		text-align: left;
		top: 50%;
		width: 20%;
	}

	#collapseMenu,
	#collapseMenu ul,
	#collapseMenu li,
	#collapseMenu a {
		text-decoration: none;
		list-style-type: none;
		color: #676767;
		padding: 0;
		border: 0;
		position: relative;
		font-size: 1em;
		font-family: 'Open Sans', sans-serif;
	}

	#collapseMenu a {
		line-height: 1.2;
	}

	#collapseMenu ul li a {
		transition: 200ms ease-in;
	}

	#collapseMenu > ul > li:first-child > a {
		padding: 10px 10px;
		border: none;
		border-top: 1px solid #818176;
	}

	#collapseMenu > ul > li {
		border-bottom: 1px solid black;
	}

	#collapseMenu > ul > li > a {
		padding: 10px 10px;
		display: block;
	}

	#collapseMenu > ul > li.active {
		border-bottom: none;
	}

	#collapseMenu ul ul {
		display: none;
		background: #fff;
		padding-left: 5px;
	}

	#collapseMenu ul ul li {
		padding-top: 5px;
		padding-bottom: 5px;
	}

	#collapseMenu ul ul a {
		padding-bottom: 5px;
		padding-left: 5px;
		display: block;
		color: #676767;
		transition: 200ms ease-in;
	}

	#collapseMenu ul ul a:hover {
		color: black;
	}

	#collapseMenu ul li a:hover {
		color: black;
	}

</style>
</head>
<body>
	<nav id="collapseMenu">
		<?php buildtree($sortedItems); ?>
	</nav>
	<script>
		$('#collapseMenu  li > a').click(function() {
			var link = $(this);

			link.next().toggle("slow");
			link.toggleClass("active");
		});

		$('#collapseMenu a').each(function(index, el) {
			if ($(el).is(":empty")) {
				$(el).remove();
			}
		});

	</script>
</body>
</html>
