jQuery(function($j){

$j.fn.syncroll_b = function(){
    return this.each(function(){
        var o=$j(this);
        var c=o.position();
        var containerPos=o.offsetParent().offset();
        var scroller=$j(window).scroll(function(){
            o.delayEfect(function(){
                return {
                    top:Math.max(scroller.scrollTop()-containerPos.top,c.top),
                    left:Math.max(scroller.scrollLeft()-containerPos.left,c.left)
                }   
            })
        })
    })
}


$j.fn.offsetPosition = function(){
	var o=this;
	var pos=o.offset();
	o.parents().each(function(){
		var el=$j(this);
		if(el.css('position')!='static'){
			pos.top+=el.scrollTop();
			pos.left+=el.scrollLeft();
		}
	})
	return pos;
}


$j.fn.delayEfect = function(paramGetter,cfg){
	var o=this;
	var c=$j.extend((o.data('delayEfectCfg')||{
		delay:100,
		speed:300
	}),cfg);	
	o.data('delayEfectCfg',c);
	if(c.timer)clearTimeout(c.timer);
	c.timer=setTimeout(function(){
		o.queue([]).animate(paramGetter(),c.speed);
	},c.delay)
}
$j.fn.exOffsetParent = function(){
	var op=this.offsetParent();
	return op.attr('tagName')=='BODY'&& op.css('position')=='static'?$j('html'):op;
}


$j(window).load(function(){
	$j('div.follow').syncroll_b()
})
})
