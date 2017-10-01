<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Catalogue</title>
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('css/tree.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
	@yield('content')
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