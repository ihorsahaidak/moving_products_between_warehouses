<?php
	$file = 'data.json';

	$current_data = json_decode(file_get_contents($file));
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>thesagaydak@gmail.com</title>
</head>
<body>
	<h1>thesagaydak@gmail.com</h1>
	<pre>
	#
	# 			The rules
	# The name of products will be everything you want (A-Za-z0-9)
	# wh1  -whe name of 1st warehouse where wh => warehouse, 1 => number of warehouse
	# The quantity will be integer number 
	#
	# Author Igor Sagaydak thesagaydak@gmail.com
	#
	</pre>
	<br>
	The example of <b>.csv</b> file you can download here - <a download="example.csv" href="example.csv">example.csv</a>
	<br>
	<hr>
	<table border="1">
		<thead>
			<td>Product name</td>
			<td>Quantity</td>
			<td>Warehouses</td>
		</thead>
		<tbody>
		<?php foreach($current_data as $key => $value): ?>
		<tr>
			<td><?= $value[0] ?></td>
			<td><?= $value[1] ?></td>
			<td><?= $value[2] ?></td>
		</tr>
	<?php endforeach; ?> 
	</tbody>
	</table>
	<hr>
	<form action="handler.php" method="post" enctype="multipart/form-data">
		<span>Upload <b>.csv</b> file here - </span>
		<input type="file" name="csv" value="" />
		<span> and press the button to apply changes</span>
		<input type="submit" name="submit" value="Save" /></form>
	</form>
</body>
</html>