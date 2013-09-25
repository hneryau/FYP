<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
session_destroy();
echo '<table align="center">
		<tr><td>
			<fieldset>
				<legend>Process</legend>
				<table align="center">
					<tr><td><b>Logging out...</b></td></tr>
				</table>
			</fieldset>
		</td></tr>
	</table>';
echo '<meta http-equiv=REFRESH CONTENT=1;url=index.html>';
?>