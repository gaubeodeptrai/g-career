//***********************************
// DLPO.js version 2.0
// Author IOIX,Inc. (www.ioix.com)
// Released on Sep 01 2011
//***********************************

var DLPOCookie = {
  name: null,
  domain: null,
  cookies: new Array(),
  _in: function(n, d) {
    this.name = n;
    var cookdom='';
    var reg = /([^.]+\.([^.]{2,3}\.[^.]{2,3}|[^.]+))$/;
    var ar = reg.exec(d);
    if(ar != null){
      cookdom='.'+ar[1];
    }	
    this.domain = (d == ''?'':'; domain='+cookdom);
    this.loadCookies();
  },
  
  isEnable: function() {
    this.setCookie(_dlpoocce, 'true', 60);
    this.loadCookies();
    return this.getCookie(_dlpoocce) == 'true';
  },
  
  setCookie: function(n, v, t) {
    if (typeof n != 'undefined' && typeof v != 'undefined' && typeof t != 'undefined') {
      this.cookies[n] = {name:n,value:escape(v),expireOn:Math.ceil(t + new Date().getTime()/1000)};
      this.saveCookies();
    }
  },
  
  getCookie: function(n) {
    var r = this.cookies[n];
    if (typeof r == 'undefined' || r == null) {
      return null;
    }
    return unescape(r.value);
  },
  
  deleteCookie: function(n) {
    var obj = new Object();
    for (i in this.cookies) {
      if (i != n) {
        obj[i] = this.cookies[i];
      }
    }
    this.cookies = obj;
    this.saveCookies();
  },
  
  getCookieNames: function(n) {
    var res = new Array();
    for (i in this.cookies) {
      if (i.indexOf(n) == 0) {
        res[res.length] = i;
      }
    }
    return res;
  },
  
  loadCookies: function() {
    this.cookies = new Object();
    var n = doc.cookie.indexOf(this.name + "=");
    if (n != -1) {
      var p = doc.cookie.indexOf(";", n);
      if (p == -1) {
        p = doc.cookie.indexOf(",", n);
        if (p == -1) {
          p = doc.cookie.length;
        }
      }
      var c = doc.cookie.substring(n + this.name.length + 1, p).split("|");
      var t = Math.ceil(new Date().getTime() / 1000);
      for (i in c) {
        var num_i = Number(i);
        if (!isNaN(num_i)) {
          var pz = c[num_i].split("#");
          if (t <= pz[2]) {
            this.cookies[pz[0]] = {name:pz[0], value:pz[1], expireOn:pz[2]};
          }
	    }
      }
    }
  },
  
  saveCookies: function() {
    var res = new Array();
    var t = 0;
    for (i in this.cookies) {
      if (this.cookies[i] != null) {
        res[res.length] = this.cookies[i].name + '#' + this.cookies[i].value + '#' + this.cookies[i].expireOn;
        if (t < this.cookies[i].expireOn) {
          t = this.cookies[i].expireOn;
        }
      }
    }
    var dt = new Date(t * 1000);
    doc.cookie = this.name +'='+ res.join('|') +'; expires='+ dt.toGMTString() +'; path=/'+ this.domain;
  }
};

var DLPOPc = {
  cookieName: null,
  expireTime: null,
  id:null,
  _in: function(id, n, exT) {
    this.cookieName = n;
    this.expireTime = exT;
    this.id = DLPOCookie.getCookie(n);
    if (this.id == null || this.id.length == 0) {
      this.id = id;
    }
	DLPOCookie.setCookie(this.cookieName, this.id, this.expireTime);
  },
  
  getId: function() {
    DLPOCookie.setCookie(_dlpopcid, this.id, this.expireTime);
    return this.id;
  },
  
  forceId: function(fId) {
    if (this.id != fId) {
      this.id = fId;
      DLPOCookie.setCookie(this.cookieName, this.id, this.expireTime);
      return true;
    }
    return false;
  }
};

var DLPOPlatform = {
  ie: null,
  mac: null,
  supported: null,
  _in: function() {
    this.ie = window.navigator.appVersion.indexOf("MSIE") != -1;
    this.mac = window.navigator.appVersion.indexOf("Mac") != -1;
    var opera = window.navigator.userAgent.indexOf("Opera") != -1;
    var knq = window.navigator.userAgent.indexOf("Konqueror") != -1;
    var ie4 = this.ie && (window.navigator.appVersion.indexOf("MSIE 4.") != -1);
    var ns = (navigator.appName == 'Netscape') && (parseInt(navigator.appVersion) == 4);
    if(opera) opera = !opera;
    this.supported = !(ns || ie4 || opera || knq);
  },
  
  isSupported: function() {
    return this.supported;
  },
  
  supportsReplace: function() {
    return !(this.ie && this.mac);
  }
};

var DLPOSafeOnload = {
  temp: new Array(),
  orderFirst: null,
  orderMiddle: null,
  orderLast: null,
  el: null,
  actionStarted: false,
  ev: null,
  _in: function(el) {
    this.orderFirst = 0;
    this.orderMiddle = 500;
    this.orderLast = 1000;
    this.el = el;
    if (typeof _Functions == "undefined") {
      _Functions = new Array();
    }
    var offset = _Functions.length;
    _Functions[offset] = this;
    this.ev = new Function('event','_Functions['+offset+'].action(event);');
    this.setup();
  },
  
  add: function(v) {
    this.sortedAdd(v, this.orderMiddle);
  },
  
  sortedAdd: function(a,o) {
    var res = new Array();
    res.order = o;
    res.action = a;
    this.temp[this.temp.length] = res;
  },
  
  setup: function() {
    if (this.el.onload != this.ev) {
      if (this.el.onload) {
        this.add(this.el.onload);
      }
      this.el.onload = this.ev;
    }
  },
  
  action: function(v) {
    if (this.actionStarted == true) {
      return;
    }
    this.actionStarted = true;
    this.temp.sort(this.orderSort);
    for (var i = 0; i < this.temp.length; i++) {
      this.el.onload = this.temp[i].action;
      this.el.onload(v);
    }
    this.el.onload = this.ev;
  },
  
  orderSort: function(a1, a2) {
    return a1.order - a2.order;
  }
};

var _oE = {
  platform: null,
  safe: null,
  status: true,
  _in: function(param) {
	this.platform = DLPOPlatform;
    this.platform._in();
    this.status = this.platform.isSupported();
    if (DLPOUser.getPageParameter(param) != null) {
      this.status = false;
    }
    if (!DLPOCookie.isEnable()) {
      this.status = false;
    }
    if (DLPOCookie.getCookie(_dlpoodc) == 'true') {
      this.status = false;
    }
    if (this.isAdmin()) {
      this.enable();
    }
  },
  
  isEnabled: function() {
    return this.status;
  },
  
  getDLPOSafeOnload: function() {
    if (this.safe == null) {
      this.safe = DLPOSafeOnload;
      this.safe._in(window);
    }
    return this.safe;
  },
  
  disable: function(duration) {
    if (typeof duration == 'undefined') {
      duration = 60 * 10;
    }
    if (!this.isAdmin()) {
      this.status = false;
      DLPOCookie.setCookie(_dlpoodc, 'true', duration);
    }
  },
  
  enable: function() {
    this.status = true;
    DLPOCookie.deleteCookie(_dlpoodc);
  },
  
  isAdmin: function() {
    return doc.location.href.indexOf(_dlpooea) != -1;
  },
  
  limitTraffic: function(level, duration) {
    if (typeof level == 'undefined') {
      return;
    }
    var tCookie = DLPOCookie.getCookie(_dlpootsc);
    if (this.isAdmin()) {
      tCookie = true;
      DLPOCookie.setCookie(_dlpootlc, level, duration);
      DLPOCookie.setCookie(_dlpootsc, tCookie, duration);
    }else if (tCookie == null || DLPOCookie.getCookie(_dlpootlc) != level) {
      tCookie = (Math.random() * 100) <= level;
      DLPOCookie.setCookie(_dlpootlc, level, duration);
      DLPOCookie.setCookie(_dlpootsc, tCookie, duration);
    }
    if (tCookie) {
      this.enable();
    }else {
      this.disable();
    }
  }
};

var DLPOSetup = {
  _in: function(arg) {
	if (!DLPOPlatform.isSupported()) {
      return;
    }
    _dlpooe.safe.setup();
    var res = new Array();
	var traffic = false;
	var area_id = '';
	var area_param = '';
    
    for (var i = 1; i < arguments.length; i++) {
      if (arguments[i].indexOf(_dlpottag+'=') > -1) {
	    traffic = true;
	  }
	  res[i] = arguments[i];
    }
	
	if (traffic == true) {
	  if (arg.length == 0) {
	  	dlpo_name_temp = _dlpopgdt;
	  } else {
	  	dlpo_name_temp = arg;
	  }
	  area_id = dlpo_name_temp + dlpo_ctprm;
	  area_param = _dlpopage + '=' + dlpo_name_temp;
	} else {
	  dlpo_name_temp = arg;
	  area_id = dlpo_name_temp + dlpo_ctprm;
	  area_param = _dlpoarea + '=' + dlpo_name_temp;
	}
	
	res[0] = area_param;
	
	var obj = new ORB();
    obj._in(area_id, res);
	obj.put();
    dlpo_ctprm++;
  },
  
  defaultDisplayNone: function () {
    doc.write('<style>.' + _dlpodflt + ' { visibility:hidden; }</style>');
  }
};

var DLPOUser = {
  _ogi: function() {
    return (new Date()).getTime() + "-" + Math.floor(Math.random() * 999999);
  },
  
  getPageParameter: function(name) {
    var temp = null;
    var reg = new RegExp(name + '=([^\&]*)');
    var res = reg.exec(document.location);
    if (res != null && res.length >=2) {
      temp = res[1];
    }
    return temp;
  }
};


var doc = document;
var dlpo_ctprm=1;
var _dlpoatid = 216;
var _dlpoarct = 1;
var _dlposurl = 'http://trck.dlpo.jp/lpo/core.js';
if (typeof _dlpouiet == 'undefined') {
  var _dlpouiet = 7776000;
}
if (typeof _dlpoot == 'undefined') {
  var _dlpoot = 5000;
}
if (typeof _dlpootlp == 'undefined') {
  var _dlpootlp;
}
if (typeof _dlpootd == 'undefined') {
  var _dlpootd = 3 * 30 * 24 * 60 * 60;
}
if (typeof _dlpockdm == 'undefined') {
  var _dlpockdm = '';
  var _dlpodre = /[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}/;
  if (!_dlpodre.exec(doc.location.host)) {
    _dlpockdm = doc.location.hostname;
  }
}

var _dlpopcid = 'PC';
var _dlpockna = 'DLPO';
var _dlpoocce = 'check';

var _dlpomdnm = 'mode';
var _dlpomdvl = 'LPP';
var _dlpomdvc = 'CPP';
var _dlpomdvi = 'ILP';
var _dlpomdvt = 'TCP';
var _dlpomdvp = 'PVP';
var _dlpoacnt = 'account';
var _dlpouqid = 'uid';
var _dlpohost = 'host';
var _dlpourl  = 'url';
var _dlporefr = 'referer';
var _dlpoarea = 'area';
var _dlpottag = 'dtTag';
var _dlpopage = 'dtPage';
var _dlpoarct = 'count';
var _dlpochar = 'charset';
var _dlpowdth = 'width';
var _dlpohght = 'height';
var _dlpousag = 'ua';
var _dlpotpc  = 'tpc';
var _dlporqtm = 'reqt';

var dlpoarcnt = 0;
var DLPOs     = new Object();
var _dlpoimpt = 'DLPOImported-';
var _dlpomakr = 'DLPOMarker-';
var _dlpodflt = 'DLPODefault';
var _dlpopgdt = 'DefaultPageID';
var _dlpoodc  = 'disable';
var _dlpotpcs = 'enable';
var _dlpootlc = 'level';
var _dlpootsc = 'traffic';
var _dlpooea  = 'envId';

DLPOCookie._in(_dlpockna, _dlpockdm);

var _dlpouniq = DLPOUser._ogi();

var _dlpoopid = DLPOPc;
_dlpoopid._in(_dlpouniq, _dlpopcid, _dlpouiet);

var _dlpooe = _oE;
_dlpooe._in('ORBDisable');

if (_dlpooe.platform.isSupported()) {
  if(_dlpooe.safe == null) {
    _dlpooe.getDLPOSafeOnload();
  }
  _dlpooe.safe.add(_dlpoocA);
  _dlpooe.limitTraffic(_dlpootlp, _dlpootd);
  if (_dlpooe.isEnabled()) {
      DLPOSetup.defaultDisplayNone();
  }else {
  }
}


function DLPOCreate(arg) {
  var argum = new Array();
  for(var i=0; i < arguments.length; i++) {
    argum[i] = 'arguments['+i+']';
  }
  eval('DLPOSetup._in('+argum.join(',')+');');
}

function _dlpoocA() {
  for (var i in DLPOs) {
    DLPOs[i].finalize();
  }
}

function _dlpooctbi(id) {
  DLPOs[id].activate();
  if (!DLPOs[id].isActivated()) {
    _dlpooe.disable();
	DLPOs[id].finalize();
  }
}

function DLPODisableTpc(){
  _dlpotpcs = 'disable';
  _dlpomdvl = 'LPPS';
  _dlpomdvc = 'CPPS';
  _dlpomdvi = 'ILPS';
  _dlpomdvt = 'TCPS';
  _dlpomdvp = 'PVPS';
}

function DLPOSetCount(count){
  dlpoarcnt = count;
  dlpo_ctprm = count+1;
}

function ORB() {
}

ORB.prototype = {
  id: null,
  url: null,
  timeout: null,
  activated: 0,
  defaultDiv: null,
  offer: null,
  time: new Array(),
  activateCount: 0,
  error: null,
  _in: function(id, url) {
	url[url.length] = _dlpoarct + '=' + ++dlpoarcnt;
    this.id = id;
	this.url = this.buildUrl(url);
	this.offer = DLPOOfferContent;
	if (DLPOs[id]) {
	  //this.error = 'Multiple ORB with the id "' + id + '" exist on this page';
      this.put = this.putNothing;
      this.activateAction = this.hide;
    }
    DLPOs[id] = this;
  },
  
  put: function() {
    var status = false;
    var url = doc.URL;
    
    if (_dlpooe.isEnabled() || status) {
      doc.write('<div id="' + this.markerName() + '" style="visibility:hidden;display:none">');
      DLPOs[this.id].startTimeout(_dlpoot);
      doc.write('<script type="text/javascript" src="' + this.url + '"><'+ '\/script></div>');
    }else {
	  doc.write('<div id="' + this.markerName() + '"></div>');
    }
  },
  
  putNothing: function() {
    doc.write('<div id="' + this.markerName() + '"></div>');
  },
  
  hide: function() {
    var el = doc.getElementById(this.markerName());
    if (el != null) {
      el.style.visibility = 'hidden';
      el.style.display = 'none';
    }
    var el = this.getDefaultDiv();
    if (el != null) {
      el.style.visibility = 'visible';
      el.style.display = '';
      return 1;
    }
    return 0;
  },
  
  show: function() {
    var result = this.offer.show(this);
	return result;
  },
  
  activateAction: function() {
    return this.show();
  },
  
  showContent: function(obj) {
	if (obj == null) {
      return 0;
    }
    var el = this.getDefaultDiv();
    if (_dlpooe.platform.supportsReplace()) {
      if (el != null) {
        el.parentNode.replaceChild(obj, el);
      }else {
        var div = doc.getElementById(this.markerName());
        if (div == null) {
          return 0;
        }
        this.visible(div);
      }
    }else {
      var div = doc.getElementById(this.markerName());
      if (div == null) {
        return 0;
      }
      if (el != null) {
        this.invisible(el);
      }
      this.visible(div);
    }
    this.visible(obj);
    return 1;
  },
  
  invisible: function(el) {
    el.style.visibility = 'hidden';
    el.style.display = 'none';
  },
  
  visible: function(el) {
    el.style.visibility = 'visible';
    el.style.display = '';
  },
  
  startTimeout: function(time) {
	this.timeout = window.setTimeout('_dlpooctbi("' + this.id + '")', time);
  },
  
  cancelTimeout: function() {
    if (this.timeout != null) {
      window.clearTimeout(this.timeout);
      this.timeout=null;
    }
  },
  
  getDefaultDiv: function() {
    if (this.defaultDiv != null) {
      return this.defaultDiv;
    }
    var node = doc.getElementById(this.markerName());
    while (node != null) {
      if ((node.nodeType == 1) && (node.nodeName == 'DIV')) {
        if (node.className.indexOf(_dlpomakr) > 0) {
          return null;
        } else if (node.className == _dlpodflt) {
          this.defaultDiv = node;
          return node;
        }
      }
      node = node.previousSibling;
    }
    return null;
  },
  
  activate: function() {
	if (this.activated) {
      return this.activated;
    }
	if (this.activateAction()) {
      this.cancelTimeout();
      this.activated = 1;
    }
    return this.activated;
  },
  
  isActivated: function() {
    return this.activated;
  },
  
  markerName: function() {
    return _dlpomakr + this.id;
  },
  
  importName: function() {
    return _dlpoimpt + this.id;
  },
  
  importDiv: function() {
    return doc.getElementById(this.importName());
  },
  
  finalize: function() {
	this.cancelTimeout();
    if (!this.activate()) {
	  this.hide();
    }
  },
  
  parameters: function() {
    var url = this.url;
    var position = url.indexOf('?');
    if (position == -1 || position == (url.length - 1)) {
      return new Array();
    }
    var queryString = url.substring(position + 1);
    var pairs = queryString.split('&');
    var queryArray = new Array();
    for (var i = 0; i < pairs.length; i++) {
      var pair = pairs[i].split('=');
      if (pair.length < 2 || pair[0] == '' || pair[1] == '') {
        continue;
      } else {
        queryArray[pair[0]] = pair[1];
      }
    }
    return queryArray;
  },
  
  setActivateAction: function(ac) {
    this.activateAction = ac;
  },
  
  setOffer: function(off) {
    this.offer = off;
  },
  
  getAttribute : function () {
  	
	var att='';
	
	att += '&' + _dlpowdth + '=' + window.screen.width;
	att += '&' + _dlpohght + '=' + window.screen.height;
	if (_dlpotpcs == 'disable') {
	  att += '&' + _dlpousag + '=' + escape(navigator.userAgent);
	  att += '&' + _dlpotpc + '=' + _dlpotpcs;
	}
	return att;
  },
  
  buildUrl: function(param) {
    var sUrl = _dlposurl;
	var conv = false;
	var click = false;
	var traffic = false;
	var preview = false;
	var url = doc.URL;
    if (doc.location.protocol == 'https:') {
      sUrl = sUrl.replace('http:', 'https:')
    }
    sUrl += '?' + _dlpoacnt + '=' + _dlpoatid;
    sUrl += '&' + _dlpohost + '=' + doc.location.hostname;
    
    for (var i = 0; i < param.length; i++) {
	  if (param[i] == 'conversion=yes') {
	  	conv = true;
	  } else if (param[i] == 'click=yes') {
	  	click = true;
	  } else if (param[i].indexOf(_dlpottag+'=') > -1) {
	  	traffic = true;
	  }
      sUrl += '&' + param[i];
    }
	if(url.indexOf('DLPOPreview') > -1) {
      preview = true;
    }
	
	if (preview == true) {
		sUrl += '&' + _dlpomdnm + '=' + _dlpomdvp;
	} else if (traffic == true) {
		sUrl += '&' + _dlpomdnm + '=' + _dlpomdvt;
	} else if (conv == true) {
		sUrl += '&' + _dlpomdnm + '=' + _dlpomdvc;
	} else if (click == true) {
		sUrl += '&' + _dlpomdnm + '=' + _dlpomdvi;
	} else {
		sUrl += '&' + _dlpomdnm + '=' + _dlpomdvl;
	}
	
	sUrl += this.getAttribute();
	
    var _ora_real = escape(doc.referrer);
    var _oua_real = escape(doc.location);
    
    var _dt = new Date();
    var _reqt = _dt.getTime();
	
    return sUrl + '&' + _dlpouqid + '=' + _dlpoopid.getId()
        + '&' + _dlpourl + '=' + _oua_real
        + '&' + _dlporefr + '=' + _ora_real + '&' + _dlporqtm + '=' + _reqt
  }
  
}

var DLPOOfferContent = {
  show: function(obj) {
	if(obj.importDiv()){
	  var div = obj.importDiv();
      var inner = div.innerHTML;
      var cook_ = '';
      var aCookie = document.cookie.split("; ");
      for (var i=0; i < aCookie.length; i++){
        var aCrumb = aCookie[i].split("=");
        if ("DLPO" == aCrumb[0]){
          cook_ =escape(aCrumb[1]);
          break;
        }
      }
    }else {
	  var div = obj.importDiv();
    }
    return obj.showContent(div);
  }
}
