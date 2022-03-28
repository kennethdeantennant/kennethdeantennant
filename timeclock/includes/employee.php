<?php
	include("../../frzrtime/includes/classes/Timesheet.php");
	$timesheet = new Timesheet();
	$employees = $user->getEmployees();
?>
<script language="javascript">
	function NewSearch()
	{
		var id;
		var date;
		
		id = document.getElementById("user").value;
		date = document.getElementById("date").value;
		document.frmDaily.action='index.php?page=employees&id='+id+'&date='+date;
		document.frmDaily.submit();
	}
</script>
<script type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function YY_checkform() { //v4.66
//copyright (c)1998,2002 Yaromat.com
  var args = YY_checkform.arguments; var myDot=true; var myV=''; var myErr='';var addErr=false;var myReq;
  for (var i=1; i<args.length;i=i+4){
    if (args[i+1].charAt(0)=='#'){myReq=true; args[i+1]=args[i+1].substring(1);}else{myReq=false}
    var myObj = MM_findObj(args[i].replace(/\[\d+\]/ig,""));
    myV=myObj.value;
    if (myObj.type=='text'||myObj.type=='password'||myObj.type=='hidden'){
      if (myReq&&myObj.value.length==0){addErr=true}
      if ((myV.length>0)&&(args[i+2]==1)){ //fromto
        var myMa=args[i+1].split('_');if(isNaN(myV)||myV<myMa[0]/1||myV > myMa[1]/1){addErr=true}
      } else if ((myV.length>0)&&(args[i+2]==2)){
          var rx=new RegExp("^[\\w\.=-]+@[\\w\\.-]+\\.[a-z]{2,4}$");if(!rx.test(myV))addErr=true;
      } else if ((myV.length>0)&&(args[i+2]==3)){ // date
        var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);
        if(myAt){
          var myD=(myAt[myMa[1]])?myAt[myMa[1]]:1; var myM=myAt[myMa[2]]-1; var myY=myAt[myMa[3]];
          var myDate=new Date(myY,myM,myD);
          if(myDate.getFullYear()!=myY||myDate.getDate()!=myD||myDate.getMonth()!=myM){addErr=true};
        }else{addErr=true}
      } else if ((myV.length>0)&&(args[i+2]==4)){ // time
        var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);if(!myAt){addErr=true}
      } else if (myV.length>0&&args[i+2]==5){ // check this 2
            var myObj1 = MM_findObj(args[i+1].replace(/\[\d+\]/ig,""));
            if(myObj1.length)myObj1=myObj1[args[i+1].replace(/(.*\[)|(\].*)/ig,"")];
            if(!myObj1.checked){addErr=true}
      } else if (myV.length>0&&args[i+2]==6){ // the same
            var myObj1 = MM_findObj(args[i+1]);
            if(myV!=myObj1.value){addErr=true}
      }
    } else
    if (!myObj.type&&myObj.length>0&&myObj[0].type=='radio'){
          var myTest = args[i].match(/(.*)\[(\d+)\].*/i);
          var myObj1=(myObj.length>1)?myObj[myTest[2]]:myObj;
      if (args[i+2]==1&&myObj1&&myObj1.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
      if (args[i+2]==2){
        var myDot=false;
        for(var j=0;j<myObj.length;j++){myDot=myDot||myObj[j].checked}
        if(!myDot){myErr+='* ' +args[i+3]+'\n'}
      }
    } else if (myObj.type=='checkbox'){
      if(args[i+2]==1&&myObj.checked==false){addErr=true}
      if(args[i+2]==2&&myObj.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
    } else if (myObj.type=='select-one'||myObj.type=='select-multiple'){
      if(args[i+2]==1&&myObj.selectedIndex/1==0){addErr=true}
    }else if (myObj.type=='textarea'){
      if(myV.length<args[i+1]){addErr=true}
    }
    if (addErr){myErr+='* '+args[i+3]+'\n'; addErr=false}
  }
  if (myErr!=''){alert('The required information is incomplete or contains errors:\t\t\t\t\t\n\n'+myErr)}
  document.MM_returnValue = (myErr=='');
}
//-->
</script>

<form name="frmDaily" method="post" action="../../frzrtime/includes/index.php?page=employee&amp;action=save">
<table width="100%" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td colspan="2" bgcolor="#FFFFFF" background="../../frzrtime/includes/images/filler.JPG">
			<img src="../../frzrtime/includes/images/logo.jpg" />
		</td>
		<td background="../../frzrtime/includes/images/filler.JPG">
			<strong><?php echo(date("l, F jS, Y")); ?></strong>
		</td>
	</tr>
	<tr>
	<td colspan="4">
		<table width="100%" align="center" cellpadding="3" cellspacing="0" bgcolor="white">
			<tr>
				<td class="row">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td width="33%" nowrap="nowrap" valign="top">&nbsp;
								
							</td>
							<td width="34%" align="center" nowrap="nowrap">&nbsp;
								
							</td>
							<td width="33%" align="right" valign="top" nowrap="nowrap">
								<a href="javascript: window.close();">Close Window</a>
							</td>
						</tr>
					</table>
					<br />
					<table align="center" cellspacing="0" width="700">
						<tr>
							<td align="right">
								Username:
							</td>
							<td>
								<input name="username" id="username"  />
							</td>
							<td align="right">
								Full Name:
							</td>
							<td>
								<input name="fullname" id="fullname"  />
							</td>
						</tr>
						<tr>
							<td align="right">
								Password:
							</td>
							<td>
								<input name="password" id="password"  />
							</td>
							<td align="right">
								Re-enter Password:
							</td>
							<td>
								<input name="repassword" id="repassword"  />
							</td>
						</tr>
						<tr>
							<td align="right">
								Basic User:
							</td>
							<td>
								<input name="rdoBasic" id="rdoBasic" type="radio" checked="checked" value=" " />
								Yes
								<input name="rdoBasic" id="rdoBasic" type="radio" value="m" />
								No
							</td>
							<td>&nbsp;
								
							</td>
							<td>
								<input type="submit" onclick="YY_checkform('frmDaily','username','#q','0','Field \'username\' is not valid.','fullname','#q','0','Field \'fullname\' is not valid.','password','#q','0','Field \'password\' is not valid.','repassword','#password','6','Field \'repassword\' is not valid.');return document.MM_returnValue" value="Save User Profile" />
							</td>
						</tr>
					</table>
					<p /><p />
				</td>
			</tr>
			<tr>
				<td>
					<br />
					<table width="90%" align="center" cellspacing="0">
					<tr>
						<td colspan="4">
							<?php
								// Save a new user
								if($_GET["page"] == "employee" && isset($_GET["action"]) && $_GET["action"]=="save"){
									if($user->save($_POST["username"],$_POST["fullname"],$_POST["password"],$_POST["rdoBasic"],$user->getId())){
										echo("<span class='notification'>Record saved . . .</span>");
									}
								}
								
								// Record deleted
								if($_GET["page"] == "employee" && isset($_GET["action"]) && $_GET["action"]=="remove"){
									if($user->remove($_GET["id"])){
										echo("<span class='notification'>Record removed . . .</span>");
									}
								}
								
								// Update a full name
								if($_GET["page"] == "employee" && (isset($_POST["hdnDescription"]) && $_POST["hdnDescription"]<>"") && isset($_GET["property"])){
									switch($_GET["property"])
									{
										case "fullname":
											$user->setFullname($_POST["hdnDescription"]);
											if($user->update($_GET["id"], $_GET["property"], $user->getId())){
												echo("<span class='notification'>Record updated for Full Name . . .</span>");
											}
											break;
										case "username":
											$user->setName($_POST["hdnDescription"]);
											if($user->update($_GET["id"], $_GET["property"], $user->getId())){
												echo("<span class='notification'>Record updated for Username . . .</span>");
											}
											break;
										case "password":
											$user->setPassword($_POST["hdnDescription"]);
											if($user->update($_GET["id"], $_GET["property"], $user->getId())){
												echo("<span class='notification'>Record updated for Password . . .</span>");
											}
											break;
									}
								}

							?>
						</td>
					</tr>
					<tr class="secondaryHeader">
						<td width="35" align="center">
							RMV						</td>
						<td width="39%">
							Full Name						</td>
						<td width="30%">
							User Name						</td>
						<td width="27%">
							Password						</td>
						<td>
							Created On - By
						</td>
					</tr>
					<?php
						$employees = $user->getEmployees();
						while($employees && $employee = mysql_fetch_array($employees))
						{
					?>
					<tr>
						<td align="center">
							<a href="../../frzrtime/includes/index.php?page=employee&amp;action=remove&amp;id=<?php echo($employee["id"]); ?>"><img src="../../frzrtime/includes/images/delete.gif" border /></a>						</td>
						<td>
							<a href="javascript: update(<?php echo($employee["id"]); ?>, 'fullname')"><?php echo($employee["fullname"]); ?></a>
						</td>
						<td>
							<a href="javascript: update(<?php echo($employee["id"]); ?>, 'username')"><?php echo($employee["username"]); ?></a>
						</td>
						<td>
							<a href="javascript: update(<?php echo($employee["id"]); ?>, 'password')"><?php echo($employee["password"]); ?></a>
						</td>
						<td nowrap="nowrap">
							<?php 
								$createBy = new User();
								$createBy->reload($employee["uid_fk"]);
								echo(date("m/d/Y",strtotime($employee["pdate"]))." - ".$createBy->getFullname()); 	
							?>
						</td>
					</tr>
					<?php
						}
					?>
				  </table>
					<br /><br />
				</td>
			</tr>
	  </table>
	</td>
  </tr>
</table>
<input type="hidden" name="hdnDescription" id="hdnDescription" value="" />
</form>
<script language="javascript">
function update(id, type){
	var id, type, description, password;
	
	description = prompt("Enter a new value for '"+type+"'.","");
	if(description != "" && description != null){
		if(type == "password"){
			while(description != password){
				password = prompt("Enter a matching value for '"+type+"'.","");
			}
		}

		if((type == "password" && description == password) || type != "password"){
			document.getElementById("hdnDescription").value = description;
			document.frmDaily.action="index.php?page=employee&property="+type+"&id="+id;
 			document.frmDaily.submit();
		}
	}
}
</script>