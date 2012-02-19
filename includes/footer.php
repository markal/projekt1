<footer>
	<p style="color: rgba(255,255,255,0.25); font-size: 11px; margin-top: 80px;">
		&copy; Copyright by Marijan 2000 - <?php echo date("Y");?>
	</p>
</footer>

</body>
</html>
<?php 
	//5. close connection
	if (isset($connection)) {
		mysql_close($connection);
	}
 ?>