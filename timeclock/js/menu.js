<!-- // START MENU CODE

// NOTE: If you use a ' add a slash before it like this \'


StartMenu()


// MENU OPTIONS - you will find more options in the corporatestyle.css

MFL		= 0; 					// MENU DISTANCE FROM EDGE
MFT		= 186; 					// MENU DISTANCE FROM TOP
ALIGN		= "left"				// MENU LEFT OR RIGHT
TMH		= 22;					// TOP MENU HEIGHT
TMFS		= "8";					// TOP MENU FONT SIZE
TMFW		= "bold";				// TOP MENU FONT WEIGHT bold/normal
TMFF		= " arial, verdana, helvetica, sans";	// TOP MENU FONT FACE
TMC		= "CFCFE0";				// TOP MENU OFF FONT COLOR
TMBC		= "242440";				// TOP MENU OFF BACKGROUND COLOR
TMBI		= "picts/menu.gif";			// TOP MENU OFF BACKGROUND IMAGE
TMHC		= "000000";				// TOP MENU HOVER TEXT COLOR
TMHBC		= "C0C0C0";				// TOP MENU HOVER BACKGROUND COLOR
TMHBI		= "picts/menuon.gif";			// TOP MENU HOVER BACKGROUND IMAGE
MO		= TMH-2;				// Y MENU OVERLAP CHANGE NUMBER VALUE
SUBshift	= 0;					// SHIFT SUBMENU RIGHT



// START SUBMENU OPTIONS - you will find more options in the corporatestyle.css


SMH		= 20;					// SUB MENU HEIGHT
SMFS		= "8";					// SUB MENU FONT SIZE
SMFW		= "normal";				// SUB MENU FONT WEIGHT bold/normal
SMFF		= "arial,MS Sans Serif,sans-serif";	// SUB MENU FONT FACE
SMC		= "333333";				// SUB MENU OFF FONT COLOR
SMBC		= "FFFFFF";				// SUB MENU OFF BACKGROUND COLOR
SMHC		= "FFFFFF";				// SUB MENU HOVER TEXT COLOR
SMHBC		= "999999";				// SUB MENU HOVER BACKGROUND COLOR


SubMenu()



// START MENU NUMBER 1 COPY AND PASTE A GROUP TO ADD A NEW TOP LEVEL SEE NOTE BELOW

hp='http://www.threecapital.com';

Top_Width[0]=110; Sub_Menu_Width[0]=110;
m[0]='Company';n[0]=hp+'/index.html';st[0]="";s[0]=""
+l+hp+"/index.html"+r+" Home "+c
+l+hp+"/founders.htm"+r+" Founders "+c
+l+hp+"/careers.htm"+r+" Career Opportunities "+c
+l+hp+"/philanthropy.htm"+r+" Philanthropy "+c


Top_Width[1]=110; Sub_Menu_Width[1]=110;
m[1]='Services';n[1]=hp+'/service.htm';st[1]="";s[1]=""
+l+hp+"/service.htm"+r+" Financial Services "+c
+l+hp+"/managed_account.htm"+r+" Managed Accounts "+c
+l+hp+"/subscription_service.htm"+r+" Subscription Services "+c
+l+hp+"/subscription_service_detailed.htm"+r+" Detailed Subscription Services "+c
+l+hp+"/us_strategy.htm"+r+" U.S. Investment Program "+c
+l+hp+"/qqqq_strategy.htm"+r+" QQQQ Investment Program "+c


Top_Width[2]=110; Sub_Menu_Width[2]=110;
m[2]='Resources';n[2]=hp+'/managed_account_forms.htm';st[2]="";s[2]=""
+l+hp+"/managed_account_forms.htm"+r+" Managed Account Forms "+c



Top_Width[3]=115; Sub_Menu_Width[3]=115;
m[3]='Disclaimer';n[3]=hp+'/risk_disclosure.htm';st[3]="";s[3]=""
+l+hp+"/risk_disclosure.htm"+r+" Risk Disclosure "+c
+l+hp+"/terms_and_conditions.htm"+r+" Terms and Conditions "+c
+l+hp+"/privacy.htm"+r+" Privacy Policy "+c


Top_Width[4]=110;Sub_Menu_Width[4]=110;
m[4]='Help & Support';n[4]=hp+'/contact.htm';st[4]="";s[4]=""
+l+hp+"/contact.htm"+r+" Contact Us "+c
+l+hp+"/sitemap.htm"+r+" Sitemap "+c
+l+hp+"/faqs.htm"+r+" FAQ's "+c


Top_Width[5]=110;Sub_Menu_Width[5]=110;
m[5]='Subscription';n[5]=hp+'/subscription_plans.htm';st[5]="";s[5]=""
+l+hp+"/subscription_plans.htm"+r+" Subscription Plans "+c
+l+"https://www1024.ssldomain.com/threecapital/register.cfm"+r+" Subscribe "+c


// IF YOU ADD ANOTHER TOP LEVEL MENU YOU MUST ADD TO THE BOTTOM OF THIS LIST


ADJ[0]=MFL;
ADJ[1]=(Top_Width[0])+MFL;
ADJ[2]=(Top_Width[0]+Top_Width[1])+MFL;
ADJ[3]=(Top_Width[0]+Top_Width[1]+Top_Width[2])+MFL;
ADJ[4]=(Top_Width[0]+Top_Width[1]+Top_Width[2]+Top_Width[3])+MFL;
ADJ[5]=(Top_Width[0]+Top_Width[1]+Top_Width[2]+Top_Width[3]+Top_Width[4])+MFL;
document.write("<div style='position:absolute;"+ALIGN+":665;top:"+MFT+";width:110'>")
document.write("<a class='menu_TOP' style='height:"+TMH+"; color:#"+TMC+"; background-image: url("+TMBI+"); background-color:#"+TMBC+"; font-size:"+TMFS+"pt; font-weight:"+TMFW+"; font-family: "+TMFF+"; "+spn+"' onmouseover=\"this.style.backgroundColor='#"+TMHBC+"';this.style.color='"+TMHC+"';this.style.backgroundImage='URL("+TMHBI+")'\"  onmouseout=\"this.style.backgroundColor='#"+TMBC+"';this.style.color='"+TMC+"';this.style.backgroundImage='URL("+TMBI+")'\" href=http://www.threecapital.com/secure/ >Login</a></div>")
// ----------------------------------------------------------------
// YOU DO NOT NEED TO EDIT BELOW THIS LINE 2003 Allwebco Design
// ----------------------------------------------------------------





MENU=m.length

for (i=0; i < MENU; i++){


// START WRITING TOP LEVEL MENUS


document.write("<div style='position:absolute;"+ALIGN+":"+ADJ[i]+";top:"+MFT+";width:"+Top_Width[i]+"' onmouseover='o["+i+"].ShowMenu()' onmouseout='o["+i+"].HideMenu()'>")

document.write("<a class='menu_TOP' style='height:"+TMH+"; color:#"+TMC+"; background-image: url("+TMBI+"); background-color:#"+TMBC+"; font-size:"+TMFS+"pt; font-weight:"+TMFW+"; font-family: "+TMFF+"; "+spn+"' onmouseover=\"this.style.backgroundColor='#"+TMHBC+"';this.style.color='"+TMHC+"';this.style.backgroundImage='URL("+TMHBI+")'\"  onmouseout=\"this.style.backgroundColor='#"+TMBC+"';this.style.color='"+TMC+"';this.style.backgroundImage='URL("+TMBI+")'\" href='"+n[i]+"'>"+m[i]+"</a></div>")

}


for (i=0; i < MENU; i++){

// START WRITING SUB MENUS

document.write("<div id='SUB"+i+"' class='menu_DIV' style='position: absolute; "+ALIGN+":"+(ADJ[i]+SUBshift)+";top:"+(MFT+MO)+";width:"+Sub_Menu_Width[i]+";background-color:#"+SMBC+";' onmouseover='o["+i+"].ShowMenu()' onmouseout='o["+i+"].HideMenu()'>"+s[i]+"</div>")

}



function StartMenu()
{

var D6=window,Y7=document;
function DETECT()
{
this.ver=navigator.appVersion;this.agent=navigator.userAgent;this.dom=Y7.getElementById?1:0;this.opera5=this.agent.indexOf("Opera 5")>-1;this.ie5=(this.ver.indexOf("MSIE 5")>-1 && this.dom && !this.opera5)?1:0;this.ie6=(this.ver.indexOf("MSIE 6")>-1 && this.dom && !this.opera5)?1:0;this.ie4=(Y7.all && !this.dom && !this.opera5)?1:0;this.ie=this.ie4||this.ie5||this.ie6;this.mac=this.agent.indexOf("Mac")>-1;this.ns6=(this.dom && parseInt(this.ver)>=5)?1:0;this.ns4=(Y7.layers && !this.dom)?1:0;this.BWD=(this.ie6||this.ie5||this.ie4||this.ns4||this.ns6||this.opera5);return this
}
BWD=new DETECT();z=0;b=0;
spn="";
if(BWD.opera5||BWD.ns6)
{
b=2
};
if(BWD.ie)
{
spn=" width: 100%"
}else{
z=6
}

} 


function SubMenu()
{

document.write("<TABLE cellpadding='0' cellspacing='0' border='0' width='100%' BGCOLOR='#242440'><tr><td>");
document.write("<img src='picts/spacer.gif' width='100%' height='"+TMH+"'><br>");
document.write("</td></tr></table>");

document.write("<div width='100%' style='height:"+TMH+";position:absolute;top:"+MFT+";width:100%;background-image: url("+TMBI+"); background-color:#"+TMBC+";z-level:-2'></div>")

l="<a class='menu_SUB' style='height:"+SMH+"; color:#"+SMC+"; background-color:#"+SMBC+"; font-size:"+SMFS+"pt; font-weight:"+SMFW+"; font-family: "+SMFF+";"+spn+"' onmouseover=\"this.style.backgroundColor='#"+SMHBC+"';this.style.color='"+SMHC+"'\"  onmouseout=\"this.style.backgroundColor='#"+SMBC+"';this.style.color='"+SMC+"'\" href='";
r="'>";
c="</a>";


m=new Array();n=new Array();s=new Array();Sub_Menu_Width=new Array();su=new Array();st=new Array();Top_Width=new Array();ADJ=new Array()

}


function lib_obj(obj,nest){nest=(!nest) ? "":'document.'+nest+'.';this.evnt=BWD.dom? document.getElementById(obj):BWD.ie4?document.all[obj]:BWD.ns4?eval(nest+"document.layers." +obj):0;this.css=BWD.dom||BWD.ie4?this.evnt.style:this.evnt;this.ref=BWD.dom||BWD.ie4?document:this.css.document;this.x=parseInt(this.css.top)||this.css.pixeltop||this.evnt.offsettop||0;this.y=parseInt(this.css.left)||this.css.pixelleft||this.evnt.offsetleft||0;return this}
function lib_doc_size(){this.x=0;this.x2=BWD.ie && document.body.offsetWidth-20||innerWidth||0;this.y=0;this.y2=BWD.ie && document.body.offsetHeight-5||innerHeight||0;this.x50=this.x2/2;this.y50=this.y2/2;return this;}
lib_obj.prototype.ShowMenu = function(){this.css.visibility="visible"}
lib_obj.prototype.HideMenu = function(){this.css.visibility="hidden"}
function libinit(){page=new lib_doc_size();o=new Array();for (i=0; i < MENU; i++){o[i]=new lib_obj('SUB'+i);o[i].HideMenu()}}
libinit()


// END MENU CODE -->


