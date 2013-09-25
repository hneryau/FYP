<?php
require_once('conn/conn.php');
$sql = "SELECT * FROM LICENSE ORDER BY status, valid_days";
$result  = mysql_query($sql, $conn);
?>
<!DOCTYPE HTML>
<html>
	<head>
	    <meta charset="utf-8">
	</head>

	<body>
		<table class="table table-bordered table-striped">
			<thead >
				<tr class="success">
					<th>License</th>
					<th>Valid days</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
			<?php while ($result1 = mysql_fetch_array($result)){ 
			if ($result1[2]==0) {?>
				<tr class="error">
					<td><?php echo $result1[0]; ?></td>
					<td><?php echo $result1[1]; ?></td>
					<td><?php echo $result1[2]; ?></td>
				</tr>
			<?php } else if ($result1[2]==1) { ?>
				<tr class="success">
					<td><?php echo $result1[0]; ?></td>
					<td><?php echo $result1[1]; ?></td>
					<td><?php echo $result1[2]; ?></td>
				</tr>
				<?php }} ?>
			</tbody>
		</table>
	</body>
</html>