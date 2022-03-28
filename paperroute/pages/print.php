<?php
	$daily = new Daily();
	$address = new Address();
	if(isset($_GET["action"]) and $_GET["action"]=="deliver") $daily->save($_GET["date"],$_GET["address"],$_GET["newspaper"],$user->getId());
	if(isset($_GET["action"]) and $_GET["action"]=="undeliver") $daily->delete($_GET["id"]);

	if(isset($_GET["action"]) and $_GET["action"]=="deliverAll")
	{
		$results = $address->getAll($user->getId());
		while($results && $result = mysql_fetch_array($results))
		{
			$daily->save($_GET["date"],$result["id"],$_GET["newspaper"],$user->getId());
		}
	}

	if(isset($_GET["action"]) and $_GET["action"]=="undeliverAll") $daily->deleteByDay($_GET["date"],$_GET["newspaper"],$user->getId());
	if(isset($_GET["action"]) and $_GET["action"]=="retire") $address->retire($_GET["address"]);
	if(isset($_GET["action"]) and $_GET["action"]=="activate") $address->activate($_GET["address"]);
?>
<form name="frmEntry" action="" method="post">
<div align="center" style="font-weight: bolder; font-family: verdana; font-size:36px;background-color:#FFF"><?php echo(date("l - F d, Y", strtotime($_GET["date"].' 00:00:00'))) ?><a href="index.php?page=day&date=<?php echo($_GET["date"]) ?>"><img src="images/return.gif" border="0" alt="return to calendar"></a><hr size="1" color="#333333"/></div>
<table align="center" width="1000" bgcolor="#000000" class="data" cellspacing="0" cellpadding="5">
	<tr height="45" valign="bottom">
    	<td>
        </td>
        <td align="right"></td>
        <?php
			$newspaper = new Newspaper();
			$results = $newspaper->getNewspapers();
			while($results && $result = mysql_fetch_array($results))
			{
		?>
    	<td align="center" width="150px">
	    	<span style="font-size:11pt; font-weight:bolder; color:#FFF"><?php print_r($result["name"]); ?></span>
        </td>
        <? } ?>
    </tr>
	<?php
		$count = 0;
        $address = new Address();
        $results = $address->getAddresses($user->getId());
        while($results && $result = mysql_fetch_array($results))
        {
			if($result["status"]== true)
			{
	        	$count += 1;			
    ?>
	<tr height="30" bgcolor=<?php if(!($count & 1)){echo("#CCCCCC");}else{echo("#FFFFFF");} ?>>
    	<td align="right" width="40px">
	    	<strong><?php echo($count) ?>.</strong>
        </td>
    	<td align="right" nowrap="nowrap" width="250px">
	    	<span style="font-weight:bolder; color:<?php if($result["status"] == true){echo("black");}else{echo("gray");} ?>;"><?php print_r($result["number"]." ".$result["street"]." ".$result["apartment"]); ?></span>
        </td>
		<?php
			if($result["status"] == true)
			{
				$total = 0;
				$results2 = $newspaper->getNewspapers();
				while($results2 && $result2 = mysql_fetch_array($results2))
				{
					if($result2["name"] != "Portneuf Valley Trader")
					{
						$today = $daily->find($_GET["date"], $result["id"], $result2["id"], $user->getId());
        ?>
        <td align="center">
            <input type="checkbox" />
        </td>
		<?php 	
					}else{
		?>
        <td></td>
        <?php
					}
				}
        ?>
	</tr>
	<?php 
				}
			}
		}
	?>
    <tr>
		<td>&nbsp;</td>
    	<td align="right">
        </td>
    	<td colspan="<?php echo(mysql_num_rows($newspaper->getNewspapers())) ?>">
        </td>
    </tr>
</table>
</form>
<script language="javascript"> window.print() </script>