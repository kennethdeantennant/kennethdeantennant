<?xml version="1.0"?>
<!DOCTYPE overlay SYSTEM "chrome://avg/locale/global.dtd">
<bindings id="bindings_content_avg" xmlns="http://www.mozilla.org/xbl" 
          xmlns:xul="http://www.mozilla.org/keymaster/gatekeeper/there.is.only.xul"
	      xmlns:html="http://www.w3.org/1999/xhtml"
	      xmlns:xbl="http://www.mozilla.org/xbl">
    <binding id="avgButton-SF1" xmlns:xul="http://www.mozilla.org/keymaster/gatekeeper/there.is.only.xul">
  <content>
    <xul:toolbaritem flex="0" align="right">
      <xul:toolbarbutton anonid="avgTB-btn_SF" sid="Site Safety" aid="http://toolbar.avg.com/widgets/sitesafety/verdict/verdict.aspx" tooltiptext="&UI.Toolbar_SiteSafety_Safe_Tooltip;" label="&UI.Toolbar_SiteSafety_Safe_Label; " image="resource://avg/skin/currently-safe18.png" oncommand="InitializeOverlay_avg.SendToolbarEventDetails(this);GenericWin_avg.OpenWin(false, this, 'http://toolbar.avg.com/widgets/sitesafety/verdict/verdict.aspx', '&UI.Toolbar_SiteSafety_Label;', 615, 605, false, 0, 0, true, false, false, null, document.getBindingParent(this).VerdictParams());" />
    </xul:toolbaritem>
  </content>
  <implementation>
    <constructor><![CDATA[SiteSafety_avg.Init();]]></constructor>
    <destructor></destructor>
    <method name="VerdictParams">
      <body><![CDATA[
	            var verdict = gBrowser.selectedBrowser.vc;
	            var encURI = gBrowser.selectedBrowser.vue;
	            return "vc=" + verdict + "&vu=" + encURI + "&ex=true";
	            ]]></body>
    </method>
  </implementation>
</binding><binding id="avgButton-SF0" xmlns:xul="http://www.mozilla.org/keymaster/gatekeeper/there.is.only.xul">
  <content>
    <xul:toolbaritem flex="0" align="right">
      <xul:toolbarbutton anonid="avgTB-btn_SF" sid="Site Safety" aid="http://toolbar.avg.com/widgets/sitesafety/verdict/verdict.aspx" tooltiptext="&UI.Toolbar_SiteSafety_Unknown_Tooltip;" label="&UI.Toolbar_SiteSafety_Unknown_Label; " image="resource://avg/skin/updating18.png" oncommand="InitializeOverlay_avg.SendToolbarEventDetails(this);GenericWin_avg.OpenWin(false, this, 'http://toolbar.avg.com/widgets/sitesafety/verdict/verdict.aspx', '&UI.Toolbar_SiteSafety_Label;', 615, 605, false, 0, 0, true, false, false, null, document.getBindingParent(this).VerdictParams());" />
    </xul:toolbaritem>
  </content>
  <implementation>
    <constructor><![CDATA[SiteSafety_avg.Init();
if(SiteSafety_avg._verdictAction == null){
SiteSafety_avg._verdictAction = {0:{action:false,actionURI:"http://toolbar.avg.com/widgets/sitesafety/interstitial/interstitial.aspx"},1:{action:false,actionURI:"http://toolbar.avg.com/widgets/sitesafety/interstitial/interstitial.aspx"},3:{action:false,actionURI:"http://toolbar.avg.com/widgets/sitesafety/interstitial/interstitial.aspx"},2:{action:false,actionURI:"http://toolbar.avg.com/widgets/sitesafety/interstitial/interstitial.aspx"},4:{action:true,actionURI:"http://toolbar.avg.com/widgets/sitesafety/interstitial/interstitial.aspx"}};
}]]></constructor>
    <destructor></destructor>
    <method name="VerdictParams">
      <body><![CDATA[
	            var verdict = gBrowser.selectedBrowser.vc;
	            var encURI = gBrowser.selectedBrowser.vue;
	            return "vc=" + verdict + "&vu=" + encURI + "&ex=true";
	            ]]></body>
    </method>
  </implementation>
</binding><binding id="avgButton-SF3" xmlns:xul="http://www.mozilla.org/keymaster/gatekeeper/there.is.only.xul">
  <content>
    <xul:toolbaritem flex="0" align="right">
      <xul:toolbarbutton anonid="avgTB-btn_SF" sid="Site Safety" aid="http://toolbar.avg.com/widgets/sitesafety/verdict/verdict.aspx" tooltiptext="&UI.Toolbar_SiteSafety_Med_Tooltip;" label="&UI.Toolbar_SiteSafety_Med_Label; " image="resource://avg/skin/surf-with-caution18.png" oncommand="InitializeOverlay_avg.SendToolbarEventDetails(this);GenericWin_avg.OpenWin(false, this, 'http://toolbar.avg.com/widgets/sitesafety/verdict/verdict.aspx', '&UI.Toolbar_SiteSafety_Label;', 615, 605, false, 0, 0, true, false, false, null, document.getBindingParent(this).VerdictParams());" />
    </xul:toolbaritem>
  </content>
  <implementation>
    <constructor><![CDATA[SiteSafety_avg.Init();]]></constructor>
    <destructor></destructor>
    <method name="VerdictParams">
      <body><![CDATA[
	            var verdict = gBrowser.selectedBrowser.vc;
	            var encURI = gBrowser.selectedBrowser.vue;
	            return "vc=" + verdict + "&vu=" + encURI + "&ex=true";
	            ]]></body>
    </method>
  </implementation>
</binding><binding id="avgButton-SF2" xmlns:xul="http://www.mozilla.org/keymaster/gatekeeper/there.is.only.xul">
  <content>
    <xul:toolbaritem flex="0" align="right">
      <xul:toolbarbutton anonid="avgTB-btn_SF" sid="Site Safety" aid="http://toolbar.avg.com/widgets/sitesafety/verdict/verdict.aspx" tooltiptext="&UI.Toolbar_SiteSafety_MediumHigh_Tooltip;" label="&UI.Toolbar_SiteSafety_MediumHigh_Label; " image="resource://avg/skin/active-threats18.png" oncommand="InitializeOverlay_avg.SendToolbarEventDetails(this);GenericWin_avg.OpenWin(false, this, 'http://toolbar.avg.com/widgets/sitesafety/verdict/verdict.aspx', '&UI.Toolbar_SiteSafety_Label;', 615, 605, false, 0, 0, true, false, false, null, document.getBindingParent(this).VerdictParams());" />
    </xul:toolbaritem>
  </content>
  <implementation>
    <constructor><![CDATA[SiteSafety_avg.Init();]]></constructor>
    <destructor></destructor>
    <method name="VerdictParams">
      <body><![CDATA[
	            var verdict = gBrowser.selectedBrowser.vc;
	            var encURI = gBrowser.selectedBrowser.vue;
	            return "vc=" + verdict + "&vu=" + encURI + "&ex=true";
	            ]]></body>
    </method>
  </implementation>
</binding><binding id="avgButton-SF4" xmlns:xul="http://www.mozilla.org/keymaster/gatekeeper/there.is.only.xul">
  <content>
    <xul:toolbaritem flex="0" align="right">
      <xul:toolbarbutton anonid="avgTB-btn_SF" sid="Site Safety" aid="http://toolbar.avg.com/widgets/sitesafety/verdict/verdict.aspx" tooltiptext="&UI.Toolbar_SiteSafety_High_Tooltip;" label="&UI.Toolbar_SiteSafety_High_Label; " image="resource://avg/skin/active-threats18.png" oncommand="InitializeOverlay_avg.SendToolbarEventDetails(this);GenericWin_avg.OpenWin(false, this, 'http://toolbar.avg.com/widgets/sitesafety/verdict/verdict.aspx', '&UI.Toolbar_SiteSafety_Label;', 615, 605, false, 0, 0, true, false, false, null, document.getBindingParent(this).VerdictParams());" />
    </xul:toolbaritem>
  </content>
  <implementation>
    <constructor><![CDATA[SiteSafety_avg.Init();]]></constructor>
    <destructor></destructor>
    <method name="VerdictParams">
      <body><![CDATA[
	            var verdict = gBrowser.selectedBrowser.vc;
	            var encURI = gBrowser.selectedBrowser.vue;
	            return "vc=" + verdict + "&vu=" + encURI + "&ex=true";
	            ]]></body>
    </method>
  </implementation>
</binding><binding id="avgButton-dnt" xmlns:xul="http://www.mozilla.org/keymaster/gatekeeper/there.is.only.xul">
  <content>
    <xul:toolbaritem flex="0" align="right">
      <xul:toolbarbutton anonid="avgTB-btn-dnt" sid="Do Not Track" aid="http://toolbar.avg.com/Widgets/DoNotTrack/DoNotTrack.aspx" tooltiptext="Do Not Track" label="Do Not Track " oncommand="InitializeOverlay_avg.SendToolbarEventDetails(this);GenericWin_avg.OpenWin(false, this, 'http://toolbar.avg.com/Widgets/DoNotTrack/DoNotTrack.aspx', 'Do Not Track', 273, 550, false, 0, 0, true, false, false, null, null);" />
    </xul:toolbaritem>
  </content>
  <implementation>
    <constructor><![CDATA[
        var dntDisabled = adapter_avgdnt.DNTGetState();
	    var dntdbO = adapter_avgdnt.DNTDBState;
	    if(dntDisabled || !dntdbO){
	      this.SetIconTrackers(adapter_avgdnt_verdicts.verdicts.Disabled, 0, 0);
	    }
	    adapter_avgdnt.UI_Elements.DNT = this.dnt_item_id;
        var dntID = gBrowser.selectedBrowser.dntID;
	    var browserURIProtocol = gBrowser.selectedBrowser.contentWindow.location.protocol;
	    if(typeof dntID == "undefined"){
	      this.TabBrowserTrackers(-1, browserURIProtocol);
	    }
      ]]></constructor>
    <destructor></destructor>
    <field name="dnt_item_id"><![CDATA["avgTI-DNT"]]></field>
    <field name="dnt_btn_id"><![CDATA["avgTB-btn-dnt"]]></field>
    <method name="TabBrowserTrackers">
      <parameter name="dntID" />
      <parameter name="Protocol" />
      <body><![CDATA[
	        var browser = gBrowser.selectedBrowser;
            if(dntID === "undefined"){
                this.SetIconTrackers(adapter_avgdnt_verdicts.verdicts.None, 0, 0);
                return;
            }
            if(dntID == "-1"){
	            dntID = browser.dntID;
	        }
	        if(browser.dntID != dntID){
	          return;
	        }
            var dntDisabled = adapter_avgdnt.DNTGetState();
	        var dntdbO = adapter_avgdnt.DNTDBState;
	        if(dntDisabled || !dntdbO){
	          this.SetIconTrackers(adapter_avgdnt_verdicts.verdicts.Disabled, 0, 0);
	          return;
	        }
	        if(/^http/.test(Protocol)){
		        var dntVerdict = adapter_avgdnt.GetDNTVerdictForTab(dntID);
		        //DumpErr_avg("DNT Verdict: " + dntVerdict["verdict"] + " DNT tFound: " + dntVerdict["trackersFound"] + " DNT tBlocked: " + dntVerdict["trackersBlocked"]);
		        this.SetIconTrackers(dntVerdict["verdict"], dntVerdict["trackersFound"], dntVerdict["trackersBlocked"]);
	        }else{
                if(!/^http/.test(browser.contentWindow.location.href)){
		            this.SetIconTrackers(adapter_avgdnt_verdicts.verdicts.None, 0, 0);
                }
	        }
	      ]]></body>
    </method>
    <method name="SetIconTrackers">
      <parameter name="verdict" />
      <parameter name="foundTrackers" />
      <parameter name="blockedTrackers" />
      <body><![CDATA[
            const maxFound = 99;
	        const maxBlocked = 99;
            const imgW = 18;
	        const imgH = 18;
            
	        foundTrackers = parseInt(foundTrackers);
	        blockedTrackers = parseInt(blockedTrackers);
	        foundTrackers = foundTrackers > maxFound ? maxFound : foundTrackers;
	        blockedTrackers = blockedTrackers > maxBlocked ? maxBlocked : blockedTrackers;
            var foundTrackersForUI = foundTrackers;
            
            if(foundTrackersForUI >= 10 && foundTrackersForUI < 15){
	            foundTrackersForUI = 10;
	        }else if(foundTrackersForUI >= 15 && foundTrackersForUI < 20){
	            foundTrackersForUI = 11
	        }else if(foundTrackersForUI >= 20 && foundTrackersForUI < 30){
	            foundTrackersForUI = 12
	        }else if(foundTrackersForUI >= 30 && foundTrackersForUI < 50){
	            foundTrackersForUI = 13
	        }else if(foundTrackersForUI >= 50 && foundTrackersForUI < 99){
	            foundTrackersForUI = 14
	        }else if(foundTrackersForUI >= 99){
	            foundTrackersForUI = 15
	        }else{
	            foundTrackersForUI = foundTrackersForUI;
	        }
	  
	        var dntButtonID = this.dnt_btn_id;
	        var dntButton = document.getAnonymousElementByAttribute(this, "anonid", dntButtonID);
            
	        var t = 0;
	        var r = imgW;
	        var b = imgH
	        var l = 0;
	        if(verdict == adapter_avgdnt_verdicts.verdicts.Disabled){
	            dntButton.setAttribute("style", "-moz-image-region: rect(" + t + "px, " + r + "px, " + b + "px, " + l + "px);")
	        }else if(verdict == adapter_avgdnt_verdicts.verdicts.None || (foundTrackersForUI == 0 && foundTrackers == 0)){
	            t = imgH;
	            r = imgW;
	            b = t + imgH;
	            l = r - imgW;
	            dntButton.setAttribute("style", "-moz-image-region: rect(" + t + "px, " + r + "px, " + b + "px, " + l + "px);")
	        }else{
	            var row;
	            switch (verdict){
	                case adapter_avgdnt_verdicts.verdicts.Green:
		                row = 1;
		                break;
	                case adapter_avgdnt_verdicts.verdicts.Yellow:
		                row = 2;
		                break;
	                case adapter_avgdnt_verdicts.verdicts.Red:
		                row = 3;
		                break;
	                default:
		                row = 0;
		                break;
	            }
	            t = (row * imgH);
	            r = foundTrackersForUI == 0 ? imgW : ((foundTrackersForUI  * imgW) + imgW);
	            b = t + imgH;
	            l = foundTrackersForUI == 0 ? 0 : (r - imgW);
	            dntButton.setAttribute("style", "-moz-image-region: rect(" + t + "px, " + r + "px, " + b + "px, " + l + "px);")
	        }
	      ]]></body>
    </method>
  </implementation>
</binding>
</bindings>
                                                                                                                                                                                                                                                                                                                                                                                                                                       e = this.vendorCSS(box, 'animation-name').cssText;
      } catch (_error) {
        animationName = getComputedStyle(box).getPropertyValue('animation-name');
      }
      if (animationName === 'none') {
        return '';
      } else {
        return animationName;
      }
    };

    WOW.prototype.cacheAnimationName = function(box) {
      return this.animationNameCache.set(box, this.animationName(box));
    };

    WOW.prototype.cachedAnimationName = function(box) {
      return this.animationNameCache.get(box);
    };

    WOW.prototype.scrollHandler = function() {
      return this.scrolled = true;
    };

    WOW.prototype.scrollCallback = function() {
      var box;
      if (this.scrolled) {
        this.scrolled = false;
        this.boxes = (function() {
          var j, len, ref, results;
          ref = this.boxes;
          results = [];
          for (j = 0, len = ref.length; j < len; j++) {
            box = ref[j];
            if (!(box)) {
              continue;
            }
            if (this.isVisible(box)) {
              this.show(box);
              continue;
            }
            results.push(box);
          }
          return results;
        }).call(this);
        if (!(this.boxes.length || this.config.live)) {
          return this.stop();
        }
      }
    };

    WOW.prototype.offsetTop = function(element) {
      var top;
      while (element.offsetTop === void 0) {
        element = element.parentNode;
      }
      top = element.offsetTop;
      while (element = element.offsetParent) {
        top += element.offsetTop;
      }
      return top;
    };

    WOW.prototype.isVisible = function(box) {
      var bottom, offset, top, viewBottom, viewTop;
      offset = box.getAttribute('data-wow-offset') || this.config.offset;
      viewTop = window.pageYOffset;
      viewBottom = viewTop + Math.min(this.element.clientHeight, this.util().innerHeight()) - offset;
      top = this.offsetTop(box);
      bottom = top + box.clientHeight;
      return top <= viewBottom && bottom >= viewTop;
    };

    WOW.prototype.util = function() {
      return this._util != null ? this._util : this._util = new Util();
    };

    WOW.prototype.disabled = function() {
      return !this.config.mobile && this.util().isMobile(navigator.userAgent);
    };

    return WOW;

  })();

}).call(this);