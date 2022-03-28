<?php
	$daily = new Daily();
	$address = new Address();
	$other = new Other();
	$newspaper = new Newspaper();
	
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
	if(isset($_GET["action"]) and $_GET["action"]=="saveOther") $other->save($_GET["number"],$_GET["newspaper"],$_GET["date"],$user->getId());
	if(isset($_GET["action"]) and $_GET["action"]=="deleteOther") $other->delete($_GET["id"],$user->getId());
?>
<form name="frmEntry" action="" method="post">
<div align="center" style="font-weight: bolder; font-family: verdana; font-size:36px;background-color:#FFF"><?php echo(date("l - F d, Y", strtotime($_GET["date"].' 00:00:00'))) ?><a href="index.php"><img src="images/return.gif" border="0" alt="return to calendar"></a><hr size="1" color="#333333"/></div>
<table align="center" width="1000" bgcolor="#000000" class="data" cellspacing="0" cellpadding="5">
	<tr height="45" valign="bottom">
    	<td align="center">
        	<a href="index.php?page=map" target="_blank" class="smallLink" style="text-transform:uppercase">map</a><br />
        	<a href="javascript:document.frmEntry.action='index.php?page=print&date=<?php echo($_GET["date"]) ?>';frmEntry.submit()" class="smallLink" style="text-transform:uppercase">print</a>
        </td>
<td align="right"><a href="javascript:document.frmEntry.action='index.php?page=media&date=<?php echo($_GET["date"]) ?>';frmEntry.submit()" class="smallLink" style="text-transform:uppercase">add paper</a><br /><a href="javascript:document.frmEntry.action='index.php?page=address&date=<?php echo($_GET["date"]) ?>';frmEntry.submit()" class="smallLink" style="text-transform:uppercase">add address</a></td>
        <?php
			$results = $newspaper->getNewspapers();
			while($results && $result = mysql_fetch_array($results))
			{
		?>
    	<td align="center" width="150px">
	    	<span style="font-size:11pt; font-weight:bolder; color:#FFF"><?php print_r($result["name"]); ?></span>
        </td>
        <? } ?>
    	<td align="center" width="100">
        	<span style="font-size:11pt; font-weight:bolder; color:#FFF">Amount Per Paper</span>
        </td>
    </tr>
    <tr bgcolor="#CCCCCC">
    	<td colspan="2"></td>
        <?php
			$results = $newspaper->getNewspapers();
			while($results && $result = mysql_fetch_array($results))
			{
				if($result["name"] != "Portneuf Valley Trader")
				{
	    ?>
        <td align="center">
            <a href="javascript:document.frmEntry.action='index.php?page=day&date=<?php echo($_GET["date"]) ?>&action=deliverAll&newspaper=<?php echo($result["id"]) ?>';frmEntry.submit()"><img src="images/open.png" title="Deliver All" alt="Deliver All" border="0" align="absmiddle"></a>
            <a href="javascript:document.frmEntry.action='index.php?page=day&date=<?php echo($_GET["date"]) ?>&action=undeliverAll&newspaper=<?php echo($result["id"]) ?>';frmEntry.submit()"><img src="images/close.png" title="Undeliver All" alt="Undeliver All" border="0" align="absmiddle"></a>
        </td>
        <?php }else{ ?>
        <td>
        </td>
		<?php }	} ?>
    	<td></td>
    </tr>
	<?php
		$count = 0;
        $results = $address->getAddresses($user->getId());
        while($results && $result = mysql_fetch_array($results))
        {
          $count += 1;			
    ?>
	<tr height="30" bgcolor=<?php if(!($count & 1)){echo("#CCCCCC");}else{echo("#FFFFFF");} ?>>
    	<td align="right" width="40px">
	    	<strong><?php echo($count) ?>.</strong>
        </td>
    	<td align="right" nowrap="nowrap" width="250px">
	    	<span style="font-weight:bolder; color:<?php if($result["status"] == true){echo("black");}else{echo("gray");} ?>;"><?php print_r($result["number"]." ".$result["street"]." ".$result["apartment"]); ?></span>&nbsp;<a href="javascript:document.frmEntry.action='index.php?page=day&date=<?php echo($_GET["date"]) ?>&action=<?php if($result["status"] == true){echo("retire");}else{echo("activate");} ?>&address=<?php echo($result["id"]) ?>';frmEntry.submit()"><img src="images/update.png" title="<?php if($result["status"] == true){echo("Retire Address");}else{echo("Activate Address");} ?>" alt="<?php if($result["status"] == true){echo("Retire Address");}else{echo("Activate Address");} ?>" border="0" align="right"></a>
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
						if($today == null)
						{
        ?>
        <td align="center">
            <a href="javascript:document.frmEntry.action='index.php?page=day&date=<?php echo($_GET["date"]) ?>&action=deliver&address=<?php print_r($result["id"]) ?>&newspaper=<?php print_r($result2["id"]) ?>';frmEntry.submit()"><img src="images/close.png" title="Undelivered" alt="Undelivered" border="0"></a>
        </td>
		<?php 
						}else{
							$newspaper->load($today["nidFK"]);
							$total += $newspaper->getRate();
        ?>
        <td align="center">
        	<a href="javascript:document.frmEntry.action='index.php?page=day&date=<?php echo($_GET["date"]) ?>&action=undeliver&id=<?php print_r($today["id"]); ?>';frmEntry.submit()"><img src="images/open.png" title="Delivered" alt="Delivered" border="0"></a>
        </td>
		<?php 	
						}
					}else{
		?>
        <td>
        </td>
        <?php
					}
			   }
        ?>
        <td align="center">
        	<strong><?php 
				$final += $total;
				echo("$".number_format($total,4,'.',''));
			?></strong>
        </td>
	</tr>
	<?php 
			} 
		}
		$count +=1;
	?>
    <tr bgcolor=<?php if(!($count & 1)){echo("#CCCCCC");}else{echo("#FFFFFF");} ?>>
        <td align="right" colspan="2">
        	<strong>Other</strong>
        </td>
        <?php
			$results = $newspaper->getNewspapers();
			$total = 0;
			while($results && $result = mysql_fetch_array($results))
			{
				$today = $other->find($_GET["date"], $result["id"], $user->getId());
				if($today == null)
				{
        ?>
        <td align="center">
           <input type="text" id="all<?php echo($result["id"]) ?>" size="3" maxlength="3" onblur="javascript:SaveOther(<?php echo($result["id"]) ?>,this.value, this.id)" style="background-color:#FF0"/>
        </td>
		<?php 
				}else{
					$newspaper->load($today["nidFK"]);
					$total += $newspaper->getRate() * $today["number"];
        ?>
        <td align="center">
        	<a href="javascript:document.frmEntry.action='index.php?page=day&date=<?php echo($_GET["date"]) ?>&action=deleteOther&id=<?php print_r($today["id"]); ?>';frmEntry.submit()"><img src="images/open.png" title="Delivered" alt="Delivered" border="0"></a>
        </td>
        <? 
				}
			}
			$final += $total;
		?>
    	<td align="center" width="150px">
	    	<?php echo("$".number_format($total,4,'.','')); ?>
        </td>
    </tr>
    <tr>
		<td>&nbsp;</td>
    	<td align="right">
        	<a href="javascript:document.frmEntry.action='index.php?page=address&date=<?php echo($_GET["date"]) ?>';frmEntry.submit()" class="smallLink" style="text-transform:uppercase">add an address</a>
        </td>
    	<td colspan="<?php echo(mysql_num_rows($newspaper->getNewspapers())) ?>">
        </td>
        <td align="center" style="color: white;">
        	<strong><?php echo("$".number_format($final,4,'.','')); ?></strong>
        </td>
    </tr>
</table>
</form>
<script language="javascript">
function SaveOther(id, number, obj)
{
	var id, number;
	if (isNaN(document.getElementById(obj).value)==false && document.getElementById(obj).value != "")
	{
		frmEntry.action='index.php?page=day&date=<?php echo($_GET["date"]); ?>&action=saveOther&newspaper='+id+'&number='+number;
		frmEntry.submit();
	}else{
		document.getElementById(obj).value=""
		document.getElementById(obj).focus()
	}
}
</script>