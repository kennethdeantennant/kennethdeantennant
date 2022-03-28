<?php
	if(isset($_POST["txtName"]) and isset($_POST["txtRate"]))
	{
		$newspaper = new Newspaper();
		if($newspaper->save($_POST["txtName"],$_POST["txtRate"],$_POST["daily"],$user->getId())) $message = "Newspaper saved as ".$_POST["txtName"]." : ".$_POST["txtRate"];
	}
?>
<script type="text/javascript">
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
<form name="frmEntry" action="index.php?page=media" method="post">
<div align="center" style="font-weight: bolder; font-family: verdana; font-size:36px;background-color:#FFF">New Media<a href="index.php?page=day&date=<?php echo($_GET["date"]) ?>"><img src="images/return.gif" border="0" alt="return to calendar"></a></div><div align="center" style="font-family: verdana; font-size:18px;background-color:#FFF">Enter a name and rate for the new media item below.<hr size="1" color="#333333"/></div>
<table align="center" bgcolor="#FFFFFF" class="page" width="30%">
<?php if(isset($message)) echo("<tr><td class='error' colspan='2' align='center'>".$message)."</td></tr>"?>
	<tr height="35">
    	<td align="right" width="40%">
        	Name:
	    </td>
    	<td>
	    	<input type="text" name="txtName" id="txtName" />
      </td>
    </tr>
	<tr height="35">
    	<td align="right">
        	Rate:
        </td>
    	<td>
	    	<input name="txtRate" type="text" id="txtRate" />
        </td>
    </tr>
	<tr height="35">
    	<td align="right">
        	Daily:
        </td>
    	<td>
	    	<select name="daily">
            	<option value="0" selected="selected">No</option>
            	<option value="1">Yes</option>
            </select>
        </td>
    </tr>
    <tr>
    	<td>
        </td>
        <td>
        	<input type="submit" value="save" onclick="YY_checkform('frmEntry','txtName','#q','0','Field \'txtName\' is not valid.','txtRate','#0.01_0.99','1','Rate not valid. Enter a number from 0.01 to 0.99');return document.MM_returnValue" />
        </td>
    </tr>
</table>
</form>