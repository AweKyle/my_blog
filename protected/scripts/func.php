<?php
function alert($result)
{
	if($result == "success")
	{
?>
	<script type="text/javascript">
		window.alert("Successfully");
		window.location.href = "index.php";
	</script>
<?php
	}
	elseif ($result == "err") 
	{
?>
	<script type="text/javascript">
		window.alert("error");
		window.location.href = document.referrer;
	</script>
<?php		
	}
	else 
	{
		if($_SERVER['PHP_SELF'] != "/rating-system/index.php")
		{
	?>
		<script type="text/javascript">
			window.alert("<?php echo $result ?>");
			window.location.href = document.referrer;
		</script>
<?php
		}
	}	
}
?>