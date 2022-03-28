<?php
	if(isset($_POST["txtNumber"]) and isset($_POST["txtStreet"]))
	{
		$address = new Address();
		if($address->save($_POST["txtNumber"],$_POST["txtStreet"],$_POST["txtApartment"],$_POST["txtCity"],$_POST["txtState"],$_POST["txtZip"],$user->getId())) $message = "Address saved...";
	}
?>

<form name="frmEntry" action="index.php?page=address" method="post">
<div align="center" style="font-weight: bolder; font-family: verdana; font-size:36px;background-color:#FFF">New Address<a href="index.php?page=day&date=<?php echo($_GET["date"]) ?>"><img src="images/return.gif" border="0" alt="return to calendar"></a></div><div align="center" style="font-family: verdana; font-size:18px;background-color:#FFF">Enter information below for the new address below.<hr size="1" color="#333333"/></div>
<table align="center" bgcolor="#FFFFFF" class="page" width="50%">
<?php if(isset($message)) echo("<tr><td class='error' colspan='2' align='center'>".$message)."</td></tr>"?>
	<tr height="35">
    	<td align="right" width="40%">
        	House Number:
    </td>
    	<td>
	    	<input name="txtNumber" type="text" id="txtNumber" />
      </td>
    </tr>
	<tr height="35">
    	<td align="right">
        	Street Name:
    </td>
    	<td>
	    	<input name="txtStreet" type="text" id="txtStreet" />
        </td>
    </tr>
	<tr height="35">
    	<td align="right">
        	Apartment:
    </td>
    	<td>
	    	<input name="txtApartment" type="text" id="txtApartment" />
        </td>
    </tr>
	<tr height="35">
    	<td align="right">
        	City:
        </td>
    	<td>
	    	<input name="txtCity" type="text" id="txtCity" />
        </td>
    </tr>
	<tr height="35">
    	<td align="right">
        	State:
        </td>
    	<td>
	    	<input name="txtState" type="text" id="txtState" />
        </td>
    </tr>
	<tr height="35">
    	<td align="right">
        	Zip Code:
        </td>
    	<td>
	    	<input name="txtZip" type="text" id="txtZip" />
        </td>
    </tr>
    <tr>
    	<td>
        </td>
        <td>
        	<input type="submit" value="save" />
        </td>
    </tr>
</table>
</form>