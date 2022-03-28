var iconPath = "http://www.multiplexsolutions.com/images/page_assets/house_icon.gif";
var iconHeight = 24;
var iconWidth = 24;
var winHeight = 130;
var leftMargin = 4;
var titlea = new Array();var texta = new Array();var linka = new Array();var trgfrma = new Array();var heightarr = new Array();var cyposarr = new Array();
cyposarr[0]=0;cyposarr[1]=1;cyposarr[2]=2;cyposarr[3]=3;cyposarr[4]=4;cyposarr[5]=5;cyposarr[6]=6;
titlea[0] = "Real Estate Broker <img src=../js//""+iconPath+"/" width="+iconWidth+" height="+iconHeight+"></img>";
texta[0] = "MultiPlex is a fully licensed real estate brokerage specializing in multifamily real estate. We handle multifamily investments from listing to the signing.";
linka[0] = "http://www.multiplexsolutions.com/account_login.cfm";
trgfrma[0] = "_parent";
titlea[1] = "Multifamily <img src=../js//""+iconPath+"/" width="+iconWidth+" height="+iconHeight+"></img>";
texta[1] = "At Last!  An all-inclusive 'one-stop shop' for the multi-family property investor!  Please take a moment to browse through our feature-rich and comprehensive website!";
linka[1] = "http://www.multiplexsolutions.com/account_login.cfm";
trgfrma[1] = "_parent";
titlea[2] = "Oregon Coverage! <img src=../js//""+iconPath+"/" width="+iconWidth+" height="+iconHeight+"></img>";
texta[2] = "MultiPlex currently offers services to all of Washington.  We are opening a branch in Oregon soon and will soon follow suit in California.";
linka[2] = "http://www.multiplexsolutions.com/";
trgfrma[2] = "_parent";
titlea[3] = "Investor Seminars! <img src=../js//""+iconPath+"/" width="+iconWidth+" height="+iconHeight+"></img>";
texta[3] = "Provides an overview of the many important real estate investment concepts that will assist the multi-family investor in achieving financial independence by investing in real estate.";
linka[3] = "http://www.multiplexsolutions.com/investment_info.cfm";
trgfrma[3] = "_parent";
titlea[4] = "New Resources! <img src=../js//""+iconPath+"/" width="+iconWidth+" height="+iconHeight+"></img>";
texta[4] = "Check out our new resources and industry links sections.  We have many resources useful to the multifamily property investor including mortgage calculators and more!";
linka[4] = "http://www.multiplexsolutions.com/gen_info.cfm?action=resources";
trgfrma[4] = "_parent";
titlea[5] = "Sell Your Property! <img src=../js//""+iconPath+"/" width="+iconWidth+" height="+iconHeight+"></img>";
texta[5] = "Listing your property through our MPLS will expose your real estate to potential buyers in the worldwide marketplace 24/7 and for less than the cost of a newspaper ad campaign!";
linka[5] = "http://www.multiplexsolutions.com/gen_info.cfm?action=mpls";
trgfrma[5] = "_parent";
titlea[6] = "Career Opportunity! <img src=../js//""+iconPath+"/" width="+iconWidth+" height="+iconHeight+"></img>";
texta[6] = "Becoming an Investor Representative with the most unique and innovative real estate company in the industry may be your next great career opportunity!";
linka[6] = "http://www.multiplexsolutions.com/careers.cfm";
trgfrma[6] = "_parent";
var mc=7;

var inoout=false;

var spage;
var cvar=0,say=0,tpos=0,enson=0,hidsay=0,hidson=0;
var tmpv;
tmpv=190-8-8-(2*1);


divtextb ="<div id=d";
divtev1=" onmouseover=\"mdivmo(";
divtev2=")\" onmouseout =\"restime(";
divtev3=")\" onclick=\"butclick(";
divtev4=")\"";
divtexts = " style=\"position:absolute;visibility:hidden;width:"+tmpv+"; background:#FFFFFF; COLOR: 000000; left:0; top:0; FONT-FAMILY: MS Sans Serif,arial,helvetica; FONT-SIZE: 8pt; FONT-STYLE: normal; FONT-WEIGHT: normal; TEXT-DECORATION: none; margin:0px; overflow-x:hidden; LINE-HEIGHT: 12pt; text-align:left;padding:0px; cursor:'default';\">";
ns6span= " style=\"position:relative;background: #FFFFFF; COLOR: 414A76; width:"+tmpv+"; FONT-FAMILY: verdana,arial,helvetica; FONT-SIZE: 9pt; FONT-STYLE: normal; FONT-WEIGHT: bold; TEXT-DECORATION: none; LINE-HEIGHT: 14pt; text-align:left;padding:0px;\"";

uzun="<div id=\"enuzun\" style=\"position:absolute;background: #FFFFFF;left:0;top:0;\">";
var uzunobj=null;
var uzuntop=0;
var toplay=0;

function mdivmo(gnum)
{
	inoout=true;

	if((linka[gnum].length)>2)
	{
		objd=document.getElementById('d'+gnum);
		objd2=document.getElementById('hgd'+gnum);

		objd.style.color="#8E0606";
		objd2.style.color="#B90000";

		objd.style.cursor='pointer';
		objd2.style.cursor='pointer';
		window.status=""+linka[gnum];
	}
}

function restime(gnum2)
{
	inoout=false;
	
	objd=document.getElementById('d'+gnum2);
	objd2=document.getElementById('hgd'+gnum2);

	objd.style.color="#000000";
	objd2.style.color="#414A76";

	window.status="";
}

function butclick(gnum3)
{
if(linka[gnum3].substring(0,11)=="javascript:"){eval(""+linka[gnum3]);}else{if((linka[gnum3].length)>3){
if((trgfrma[gnum3].indexOf("_parent")>-1)){eval("parent.window.location='"+linka[gnum3]+"'");}else if((trgfrma[gnum3].indexOf("_top")>-1)){eval("top.window.location='"+linka[gnum3]+"'");}else{window.open(''+linka[gnum3],''+trgfrma[gnum3]);}}}

}

function dotrans()
{
	if(inoout==false)
	{


		dahayok=false;
		uzuntop--;
		for(i=0;i<mc;i++)
		{
			objd=document.getElementById('d'+i);
			objd.style.top=""+(uzuntop+(i*winHeight))+"px";
			if((uzuntop+(i*winHeight))==4){dahayok=true;}
		}
		if(uzuntop<(-1*(mc-1)*winHeight))
		{
			objd=document.getElementById('d'+0);
			objd.style.top=""+(uzuntop+(mc*winHeight))+"px";
			if((uzuntop+(i*winHeight))==4){dahayok=true;}		
		}
		if(uzuntop<(-1*(mc)*winHeight))
		{
			uzuntop=0;
		}







	}

	if(dahayok==true)
	{
		setTimeout('dotrans()',3000);
	}
	else
	{
		setTimeout('dotrans()',35);
	}


}


function initte2()
{
	toplay=4;
	for(i=0;i<mc;i++)
	{
		objd=document.getElementById('d'+i);
		objd.style.visibility="visible";
		objd.style.top=""+(toplay+(winHeight*i))+"px";
		objd.style.left=""+leftMargin+"px";


	}

	uzunobj=document.getElementById('enuzun');
	uzuntop=winHeight;
	dotrans();


}

function initte()
{
	i=0;
	innertxt="";

	for(i=0;i<mc;i++)
	{
		innertxt=innertxt+""+divtextb+""+i+""+divtev1+i+divtev2+i+divtev3+i+divtev4+divtexts+"<div id=\"hgd"+i+"\""+ns6span+">"+titlea[i]+"<br></div>"+texta[i]+"</div>";
	}

	spage=document.getElementById('spagens');
	spage.innerHTML=""+innertxt;

	setTimeout('initte2()',500);
}


window.onload=initte;