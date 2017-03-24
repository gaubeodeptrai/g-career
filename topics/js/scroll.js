function HScroll() {
    this.name =" HScroll";
    this.item = new Array();
    this.itemcount = 0;
    this.currentspeed = 0;
    this.scrollspeed = 50;
    this.pausedelay = 1000;
    this.pausemouseover = false;
    this.stop = false;
    this.type = 1;
    this.height = 15;
    this.width = 150;
    this.stopHeight=0;

    this.add =function () {
	var text = arguments[0];
	this.item[this.itemcount] = text;
	this.itemcount = this.itemcount + 1;
    };

    this.start = function () {
	this.display();
	this.currentspeed = this.scrollspeed;
	setTimeout(this.name+'.scroll()',this.currentspeed);
    };

    this.display =function () {
	document.write('<div id="'+this.name+'" style="height:'+this.height+'px;width:'+this.width+'px;position:relative;overflow:hidden;" OnMouseOver="'+this.name+'.onmouseover();" OnMouseOut="'+this.name+'.onmouseout();">');
	for(var i = 0; i < this.itemcount; i++) {
            if ( this.type == 1) {
		document.write('<div id="'+this.name+'item'+i+'"style="left:0px;width:'+this.width+'px;position:absolute;top:'+(this.height*i+1)+'px;">');
                document.write(this.item[i]);
                document.write('</div>');
            } else if ( this.type == 2 ) {
                document.write('<div id="'+this.name+'item'+i+'"style="left:'+(this.width*i+1)+'px;width:'+this.width+'px;position:absolute;top:0px;">');
                document.write(this.item[i]);
                document.write('</div>');
            }
	}
	document.write('</div>');
    };

    this.scroll = function () {
	this.currentspeed = this.scrollspeed;
	if ( !this.stop ) {
            for (i = 0; i < this.itemcount; i++) {
                obj = document.getElementById(this.name+'item'+i).style;
                if ( this.type == 1 ) {
                    var t = obj.top.replace(/p[tx]$/, '') - 1;
                    obj.top = t + 'px';
                    if (t <= this.height*(-1) ) 
                        obj.top = (this.height * (this.itemcount-1)) + 'px';
                    if ( t == 0 || ( this.stopHeight > 0 && this.stopHeight - t == 0 )) 
                        this.currentspeed = this.pausedelay;
                } else if ( this.type == 2 ) {
                    var l = obj.left.replace(/p[tx]$/, '') - 1;
                    obj.left = l + 'px';
                    if (l <= this.left*(-1) ) 
                        obj.left = (l* (this.itemcount-1)) + 'px';
                    if (l == 0 ) 
                        this.currentspeed = this.pausedelay;
                }
            }
	}
	window.setTimeout(this.name+".scroll()",this.currentspeed);
    };

    this.onmouseover = function () {
	if ( this.pausemouseover ) {
            this.stop = true;
	}
    };

    this.onmouseout = function () {
	if ( this.pausemouseover ) {
            this.stop = false;
	}
    };

}
