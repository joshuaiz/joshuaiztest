/*
Bones Scripts File
Author: Eddie Machado

This file should contain any js scripts you want to add to the site.
Instead of calling it in the header or throwing it inside wp_head()
this file will be called automatically in the footer so as not to
slow the page load.

*/

// IE8 polyfill for GetComputed Style (for Responsive Script below)
if (!window.getComputedStyle) {
	window.getComputedStyle = function(el, pseudo) {
		this.el = el;
		this.getPropertyValue = function(prop) {
			var re = /(\-([a-z]){1})/g;
			if (prop == 'float') prop = 'styleFloat';
			if (re.test(prop)) {
				prop = prop.replace(re, function () {
					return arguments[2].toUpperCase();
				});
			}
			return el.currentStyle[prop] ? el.currentStyle[prop] : null;
		}
		return this;
	}
}

// as the page loads, call these scripts
jQuery(document).ready(function($) {

	/*
	Responsive jQuery is a tricky thing.
	There's a bunch of different ways to handle
	it, so be sure to research and find the one
	that works for you best.
	*/
	
	/* getting viewport width */
	var responsive_viewport = $(window).width();
	
	/* if is below 481px */
	if (responsive_viewport < 481) {
	
	} /* end smallest screen */
	
	/* if is larger than 481px */
	if (responsive_viewport > 481) {
	
	} /* end larger than 481px */

  /* if is below 481px */
  if (responsive_viewport < 767) {

    $('footer').insertAfter('#content');
  
  } /* end below 767px */
	
	/* if is above or equal to 768px */
	if (responsive_viewport >= 768) {
	
		/* load gravatars */
		$('.comment img[data-gravatar]').each(function(){
			$(this).attr('src',$(this).attr('data-gravatar'));
		});
    // equal height columns
    'use strict';(function($){$.equalHeightColumns={version:2.0};$.equalHeightColumns.defaults={speed:0,height:0,minHeight:0,maxHeight:0};$.equalHeightColumns.defaults.resize=function(){var options=$(this).data('equalHeightColumns.options'),height=+options.height,currentHeight;if(!height){$(this).each(function(){currentHeight=$(this).height();$(this).css('height','auto');if($(this).height()>height){height=$(this).height()}$(this).height(currentHeight)})}height=(options.minHeight&&height<options.minHeight)?options.minHeight:height;height=(+options.maxHeight&&height>+options.maxHeight)?+options.maxHeight:height;$(this).animate({height:height},+options.speed)};$.equalHeightColumns.defaults.actions=function(action,option,value){var options=$(this).data('equalHeightColumns.options'),height;switch(action){case'option':if(options&&typeof options[option]!=='undefined'){if(typeof value!=='undefined'){options[option]=value;$(this).data('equalHeightColumns.options',options)}else{return options[option]}}return false;break;case'destroy':$(this).removeData('equalHeightColumns.options').each(function(){height=$(this).data('equalHeightColumns.originalHeight');if(height){$(this).height(height)}});return false;break;case'refresh':return true;break;default:return false;break}};$.fn.equalHeightColumns=function(options,option,value){var action=typeof options==='string'?options:false,method,resize,height;if(action){options=$.extend({},$.equalHeightColumns.defaults,$(this).data('equalHeightColumns.options'));method=$.proxy(options.actions,this);if(action==='option'&&typeof value==='undefined'){return method(action,option)}else if(method(action,option,value)===false){return $(this)}}options=$.extend({},$.equalHeightColumns.defaults,options);$(this).data('equalHeightColumns.options',options);$(this).each(function(){if(typeof $(this).data('equalHeightColumns.originalHeight')==='undefined'){$(this).data('equalHeightColumns.originalHeight',$(this).height())}});method=$.proxy(options.resize,this);method();return $(this)}})(jQuery);

	}
	
	/* off the bat large screen actions */
	if (responsive_viewport > 1030) {
	
	}
	
	
	// add all your scripts here
	
 
}); /* end of as page load scripts */

// Adds functionality for menu item triangle
// jQuery(document).ready(function($){
// $('#menu-main-menu-1 li:not(.current-menu-item)').on({
//       "mouseover" : function() {
//         $('.current-menu-item > a').addClass('hidden');
//         console.log(this);
//       },
//       "mouseout" : function() {
//         $('.current-menu-item > a').removeClass('hidden');
//       }
//   });
// });

// Show/hide our music box on the home page
jQuery(document).ready(function($){
      $('#menu-item-12').mouseenter(function() {
        $(".insert").show();
      });
      $('#menu-item-12').mouseleave(function() {
        $(".insert").hide();
      });
      $('.insert').mouseover(function() {
        $(this).stop(true, true).show();
      });
      $('.insert').mouseleave(function() {
        $(this).stop(true, true).delay(2000).fadeOut(500);
      });
      
});

jQuery(document).ready(function($){
  if($('.insert.music').css('display', 'block') ) {
    $('#menu-item-12 > a').addClass('left-arrow-after');
}
if ($('.insert.music').css('display', 'none') ) {
    $('#menu-item-12 > a').delay(100).removeClass('left-arrow-after');
  }
});

// Click outside the box, hide the box
jQuery(document).ready(function($){
  $(document).mouseup(function (e)
{
    var container = $(".home .insert");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.hide();
    }
});
});

// if our markdown created blockquotes contain "Tip" then style them as tips.
jQuery(document).ready(function($){
  if ($('blockquote > h3:contains("Tip")').length > 0) {
    $("blockquote").addClass("tip");
}
});

// find next matching element in DOM. Why is this not part of jQuery core?
function nextInDOM(_selector, _subject) {
    var next = getNext(_subject);
    while(next.length != 0) {
        var found = searchFor(_selector, next);
        if(found != null) return found;
        next = getNext(next);
    }
    return null;
}
function getNext(_subject) {
    if(_subject.next().length > 0) return _subject.next();
    return getNext(_subject.parent());
}
function searchFor(_selector, _subject) {
    if(_subject.is(_selector)) return _subject;
    else {
        var found = null;
        _subject.children().each(function() {
            found = searchFor(_selector, $(this));
            if(found != null) return false;
        });
        return found;
    }
    return null; // will/should never get here
}

/*! A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
*/
(function(w){
	// This fix addresses an iOS bug, so return early if the UA claims it's something else.
	if( !( /iPhone|iPad|iPod/.test( navigator.platform ) && navigator.userAgent.indexOf( "AppleWebKit" ) > -1 ) ){ return; }
	var doc = w.document;
	if( !doc.querySelector ){ return; }
	var meta = doc.querySelector( "meta[name=viewport]" ),
		initialContent = meta && meta.getAttribute( "content" ),
		disabledZoom = initialContent + ",maximum-scale=1",
		enabledZoom = initialContent + ",maximum-scale=10",
		enabled = true,
		x, y, z, aig;
	if( !meta ){ return; }
	function restoreZoom(){
		meta.setAttribute( "content", enabledZoom );
		enabled = true; }
	function disableZoom(){
		meta.setAttribute( "content", disabledZoom );
		enabled = false; }
	function checkTilt( e ){
		aig = e.accelerationIncludingGravity;
		x = Math.abs( aig.x );
		y = Math.abs( aig.y );
		z = Math.abs( aig.z );
		// If portrait orientation and in one of the danger zones
		if( !w.orientation && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) ) ){
			if( enabled ){ disableZoom(); } }
		else if( !enabled ){ restoreZoom(); } }
	w.addEventListener( "orientationchange", restoreZoom, false );
	w.addEventListener( "devicemotion", checkTilt, false );
})( this );


/*!
 * Retina.js v1.1.0
 *
 * Copyright 2013 Imulus, LLC
 * Released under the MIT license
 *
 * Retina.js is an open source script that makes it easy to serve
 * high-resolution images to devices with retina displays.
 */
 
/*	[added by JM]
	I use this on every site. Just place a 2x resolution image in the same
	directory as your regular resolution image and name it with @2x. Your
	retina image will be served to displays that support it.
	Example: my_awesome_image.png my_awesome_image@2x.png
	More info: http://retinajs.com
*/

(function() {

  var root = (typeof exports == 'undefined' ? window : exports);

  var config = {
  check_mime_type: true,
  retinaImgTagSelector: 'img',
  retinaImgFilterFunc: undefined
};

  root.Retina = Retina;

  function Retina() {}

  Retina.configure = function(options) {
    if (options == null) options = {};
    for (var prop in options) config[prop] = options[prop];
  };

  Retina.init = function(context) {
  if (context == null) context = root;

  var existing_onload = context.onload || new Function;

  context.onload = function() {
    // uses new query selector
    var images = document.querySelectorAll(config.retinaImgTagSelector), 
        retinaImages = [], i, image, filter;

    // if there is a filter, check each image
    if (typeof config.retinaImgFilterFunc === 'function') {
      filter = config.retinaImgFilterFunc;
      for (i = 0; i < images.length; i++) {
        image = images[i];
        if (filter(image)) {
          retinaImages.push(new RetinaImage(image));
        }
      }
    } else {
      for (i = 0; i < images.length; i++) {
        image = images[i];
        retinaImages.push(new RetinaImage(image));
      }
    }
    existing_onload();
  }
};

  Retina.isRetina = function(){
    var mediaQuery = "(-webkit-min-device-pixel-ratio: 1.5),\
                      (min--moz-device-pixel-ratio: 1.5),\
                      (-o-min-device-pixel-ratio: 3/2),\
                      (min-resolution: 1.5dppx)";

    if (root.devicePixelRatio > 1)
      return true;

    if (root.matchMedia && root.matchMedia(mediaQuery).matches)
      return true;

    return false;
  };


  root.RetinaImagePath = RetinaImagePath;

  function RetinaImagePath(path, at_2x_path) {
    this.path = path;
    if (typeof at_2x_path !== "undefined" && at_2x_path !== null) {
      this.at_2x_path = at_2x_path;
      this.perform_check = false;
    } else {
      this.at_2x_path = path.replace(/\.\w+$/, function(match) { return "@2x" + match; });
      this.perform_check = true;
    }
  }

  RetinaImagePath.confirmed_paths = [];

  RetinaImagePath.prototype.is_external = function() {
    return !!(this.path.match(/^https?\:/i) && !this.path.match('//' + document.domain) )
  }

  RetinaImagePath.prototype.check_2x_variant = function(callback) {
    var http, that = this;
    if (this.is_external()) {
      return callback(false);
    } else if (!this.perform_check && typeof this.at_2x_path !== "undefined" && this.at_2x_path !== null) {
      return callback(true);
    } else if (this.at_2x_path in RetinaImagePath.confirmed_paths) {
      return callback(true);
    } else {
      http = new XMLHttpRequest;
      http.open('HEAD', this.at_2x_path);
      http.onreadystatechange = function() {
        if (http.readyState != 4) {
          return callback(false);
        }

        if (http.status >= 200 && http.status <= 399) {
          if (config.check_mime_type) {
            var type = http.getResponseHeader('Content-Type');
            if (type == null || !type.match(/^image/i)) {
              return callback(false);
            }
          }

          RetinaImagePath.confirmed_paths.push(that.at_2x_path);
          return callback(true);
        } else {
          return callback(false);
        }
      }
      http.send();
    }
  }



  function RetinaImage(el) {
    this.el = el;
    this.path = new RetinaImagePath(this.el.getAttribute('src'), this.el.getAttribute('data-at2x'));
    var that = this;
    this.path.check_2x_variant(function(hasVariant) {
      if (hasVariant) that.swap();
    });
  }

  root.RetinaImage = RetinaImage;

  RetinaImage.prototype.swap = function(path) {
    if (typeof path == 'undefined') path = this.path.at_2x_path;

    var that = this;
    function load() {
      if (! that.el.complete) {
        setTimeout(load, 5);
      } else {
        that.el.setAttribute('width', that.el.offsetWidth);
        that.el.setAttribute('height', that.el.offsetHeight);
        that.el.setAttribute('src', path);
      }
    }
    load();
  }




  if (Retina.isRetina()) {
    Retina.init(root);
  }

})();

// SoundCloud custom player
(function(){var e=/msie/i.test(navigator.userAgent)&&!/opera/i.test(navigator.userAgent),t=window.soundcloud={version:"0.1",debug:!1,_listeners:[],_redispatch:function(e,t,n){var r,i=this._listeners[e]||[],s="soundcloud:"+e;try{r=this.getPlayer(t)}catch(o){this.debug&&window.console&&console.error("unable to dispatch widget event "+e+" for the widget id "+t,n,o);return}window.jQuery?jQuery(r).trigger(s,[n]):window.Prototype&&$(r).fire(s,n);for(var u=0,a=i.length;u<a;u+=1)i[u].apply(r,[r,n]);this.debug&&window.console&&console.log(s,e,t,n)},addEventListener:function(e,t){this._listeners[e]||(this._listeners[e]=[]);this._listeners[e].push(t)},removeEventListener:function(e,t){var n=this._listeners[e]||[];for(var r=0,i=n.length;r<i;r+=1)n[r]===t&&n.splice(r,1)},getPlayer:function(t){var n;try{if(!t)throw"The SoundCloud Widget DOM object needs an id atribute, please refer to SoundCloud Widget API documentation.";n=e?window[t]:document[t];if(n){if(n.api_getFlashId)return n;throw"The SoundCloud Widget External Interface is not accessible. Check that allowscriptaccess is set to 'always' in embed code";}throw"The SoundCloud Widget with an id "+t+" couldn't be found";}catch(r){console&&console.error&&console.error(r);throw r;}},onPlayerReady:function(e,t){this._redispatch("onPlayerReady",e,t)},onMediaStart:function(e,t){this._redispatch("onMediaStart",e,t)},onMediaEnd:function(e,t){this._redispatch("onMediaEnd",e,t)},onMediaPlay:function(e,t){this._redispatch("onMediaPlay",e,t)},onMediaPause:function(e,t){this._redispatch("onMediaPause",e,t)},onMediaBuffering:function(e,t){this._redispatch("onMediaBuffering",e,t)},onMediaSeek:function(e,t){this._redispatch("onMediaSeek",e,t)},onMediaDoneBuffering:function(e,t){this._redispatch("onMediaDoneBuffering",e,t)},onPlayerError:function(e,t){this._redispatch("onPlayerError",e,t)}}})();(function(e){var t=function(e){var t=function(e){return{h:Math.floor(e/36e5),m:Math.floor(e/6e4%60),s:Math.floor(e/1e3%60)}}(e),n=[];t.h>0&&n.push(t.h);n.push(t.m<10&&t.h>0?"0"+t.m:t.m);n.push(t.s<10?"0"+t.s:t.s);return n.join(".")},n=function(e){e.sort(function(){return 1-Math.floor(Math.random()*3)});return e},r=!0,i=!1,s=e(document),o=function(e){try{r&&window.console&&window.console.log&&window.console.log.apply(window.console,arguments)}catch(t){}},u=i?"sandbox-soundcloud.com":"soundcloud.com",a=document.location.protocol==="https:",f=function(e,t){var n=(a||/^https/i.test(e)?"https":"http")+"://api."+u+"/resolve?url=",r="format=json&consumer_key="+t+"&callback=?";a&&(e=e.replace(/^http:/,"https:"));return/api\./.test(e)?e+"?"+r:n+e+"&"+r},l=function(){var t=function(){var e=!1;try{var t=new Audio;e=t.canPlayType&&/maybe|probably/.test(t.canPlayType("audio/mpeg"))}catch(n){}return e}(),n={onReady:function(){s.trigger("scPlayer:onAudioReady")},onPlay:function(){s.trigger("scPlayer:onMediaPlay")},onPause:function(){s.trigger("scPlayer:onMediaPause")},onEnd:function(){s.trigger("scPlayer:onMediaEnd")},onBuffer:function(e){s.trigger({type:"scPlayer:onMediaBuffering",percent:e})}},r=function(){var t=new Audio,r=function(e){var t=e.target,r=(t.buffered.length&&t.buffered.end(0))/t.duration*100;n.onBuffer(r);t.currentTime===t.duration&&n.onEnd()},i=function(e){var t=e.target,r=(t.buffered.length&&t.buffered.end(0))/t.duration*100;n.onBuffer(r)};e('<div class="sc-player-engine-container"></div>').appendTo(document.body).append(t);t.addEventListener("play",n.onPlay,!1);t.addEventListener("pause",n.onPause,!1);t.addEventListener("timeupdate",r,!1);t.addEventListener("progress",i,!1);return{load:function(e,n){t.pause();t.src=e.stream_url+(/\?/.test(e.stream_url)?"&":"?")+"consumer_key="+n;t.load();t.play()},play:function(){t.play()},pause:function(){t.pause()},stop:function(){if(t.currentTime){t.currentTime=0;t.pause()}},seek:function(e){t.currentTime=t.duration*e;t.play()},getDuration:function(){return t.duration*1e3},getPosition:function(){return t.currentTime*1e3},setVolume:function(e){t.volume=e/100}}},i=function(){var t="scPlayerEngine",r,i=function(n){var r=(a?"https":"http")+"://player."+u+"/player.swf?url="+n+"&amp;enable_api=true&amp;player_type=engine&amp;object_id="+t;return e.browser.msie?'<object height="100%" width="100%" id="'+t+'" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" data="'+r+'">'+'<param name="movie" value="'+r+'" />'+'<param name="allowscriptaccess" value="always" />'+"</object>":'<object height="100%" width="100%" id="'+t+'">'+'<embed allowscriptaccess="always" height="100%" width="100%" src="'+r+'" type="application/x-shockwave-flash" name="'+t+'" />'+"</object>"};soundcloud.addEventListener("onPlayerReady",function(e,i){r=soundcloud.getPlayer(t);n.onReady()});soundcloud.addEventListener("onMediaEnd",n.onEnd);soundcloud.addEventListener("onMediaBuffering",function(e,t){n.onBuffer(t.percent)});soundcloud.addEventListener("onMediaPlay",n.onPlay);soundcloud.addEventListener("onMediaPause",n.onPause);return{load:function(t){var n=t.uri;r?r.api_load(n):e('<div class="sc-player-engine-container"></div>').appendTo(document.body).html(i(n))},play:function(){r&&r.api_play()},pause:function(){r&&r.api_pause()},stop:function(){r&&r.api_stop()},seek:function(e){r&&r.api_seekTo(r.api_getTrackDuration()*e)},getDuration:function(){return r&&r.api_getTrackDuration&&r.api_getTrackDuration()*1e3},getPosition:function(){return r&&r.api_getTrackPosition&&r.api_getTrackPosition()*1e3},setVolume:function(e){r&&r.api_setVolume&&r.api_setVolume(e)}}};return t?r():i()}(),c,h=!1,p=[],d={},v,m=function(t,n,r){var i=0,s={node:t,tracks:[]},o=function(t){var r=f(t.url,c);e.getJSON(r,function(u){i+=1;if(u.tracks)s.tracks=s.tracks.concat(u.tracks);else if(u.duration){u.permalink_url=t.url;s.tracks.push(u)}else u.creator?n.push({url:u.uri+"/tracks"}):u.username?/favorites/.test(t.url)?n.push({url:u.uri+"/favorites"}):n.push({url:u.uri+"/tracks"}):e.isArray(u)&&(s.tracks=s.tracks.concat(u));n[i]?o(n[i]):s.node.trigger({type:"onTrackDataLoaded",playerObj:s,url:r})})};c=r;p.push(s);o(n[i])},g=function(e,t){return t?'<div class="sc-loading-artwork">Loading Artwork</div>':e.artwork_url?'<img src="'+e.artwork_url.replace("-large","-t300x300")+'"/>':'<div class="sc-no-artwork">No Artwork</div>'},y=function(n,r){e(".sc-info",n).each(function(t){e("h3",this).html('<a href="'+r.permalink_url+'">'+r.title+"</a>");e("h4",this).html('by <a href="'+r.user.permalink_url+'">'+r.user.username+"</a>");e("p",this).html(r.description||"no Description")});e(".sc-artwork-list li",n).each(function(t){var n=e(this),i=n.data("sc-track");i===r?n.addClass("active").find(".sc-loading-artwork").each(function(t){e(this).removeClass("sc-loading-artwork").html(g(r,!1))}):n.removeClass("active")});e(".sc-duration",n).html(t(r.duration));e(".sc-waveform-container",n).html('<img src="'+r.waveform_url+'" />');n.trigger("onPlayerTrackSwitch.scPlayer",[r])},b=function(e){var t=e.permalink_url;if(v===t)l.play();else{v=t;l.load(e,c)}},w=function(t){return p[e(t).data("sc-player").id]},E=function(t,n){n&&e("div.sc-player.playing").removeClass("playing");e(t).toggleClass("playing",n).trigger(n?"onPlayerPlay":"onPlayerPause")},S=function(t,n){var r=w(t).tracks[n||0];y(t,r);d={$buffer:e(".sc-buffer",t),$played:e(".sc-played",t),position:e(".sc-position",t)[0]};E(t,!0);b(r)},x=function(e){E(e,!1);l.pause()},T=function(){var e=d.$played.closest(".sc-player"),n;d.$played.css("width","0%");d.position.innerHTML=t(0);E(e,!1);l.stop();e.trigger("onPlayerTrackFinish")},N=function(t,n){l.seek(n);e(t).trigger("onPlayerSeek")},C=function(t){var n=e(t);o("track finished get the next one");$nextItem=e(".sc-trackslist li.active",n).next("li");$nextItem.length||($nextItem=n.nextAll("div.sc-player:first").find(".sc-trackslist li.active"));$nextItem.click()},k=function(){var e=80,t=document.cookie.split(";"),n=new RegExp("scPlayer_volume=(\\d+)");for(var r in t)if(n.test(t[r])){e=parseInt(t[r].match(n)[1],10);break}return e}(),L=function(e){var t=Math.floor(e),n=new Date;n.setTime(n.getTime()+31536e6);k=t;document.cookie=["scPlayer_volume=",t,"; expires=",n.toUTCString(),'; path="/"'].join("");l.setVolume(k)},A;s.bind("scPlayer:onAudioReady",function(e){o("onPlayerReady: audio engine is ready");l.play();L(k)}).bind("scPlayer:onMediaPlay",function(e){clearInterval(A);A=setInterval(function(){var e=l.getDuration(),n=l.getPosition(),r=n/e;d.$played.css("width",100*r+"%");d.position.innerHTML=t(n);s.trigger({type:"onMediaTimeUpdate.scPlayer",duration:e,position:n,relative:r})},500)}).bind("scPlayer:onMediaPause",function(e){clearInterval(A);A=null}).bind("scPlayer:onVolumeChange",function(e){L(e.volume)}).bind("scPlayer:onMediaEnd",function(e){T()}).bind("scPlayer:onMediaBuffering",function(e){d.$buffer.css("width",e.percent+"%")});e.scPlayer=function(r,i){var s=e.extend({},e.scPlayer.defaults,r),o=p.length,u=i&&e(i),a=u[0].className.replace("sc-player",""),f=s.links||e.map(e("a",u).add(u.filter("a")),function(e){return{url:e.href,title:e.innerHTML}}),l=e('<div class="sc-player loading"></div>').data("sc-player",{id:o}),c=e('<ol class="sc-artwork-list"></ol>').appendTo(l),d=e('<div class="sc-info"><h3></h3><h4></h4><p></p><a href="#" class="sc-info-close">X</a></div>').appendTo(l),v=e('<div class="sc-controls"></div>').appendTo(l),b=e('<ol class="sc-trackslist"></ol>').appendTo(l);(a||s.customClass)&&l.addClass(a).addClass(s.customClass);l.find(".sc-controls").append('<a href="#play" class="sc-play">Play</a> <a href="#pause" class="sc-pause hidden">Pause</a>').end().append('<a href="#info" class="sc-info-toggle">Info</a>').append('<div class="sc-scrubber"></div>').find(".sc-scrubber").append('<div class="sc-volume-slider"><span class="sc-volume-status" style="width:'+k+'%"></span></div>').append('<div class="sc-time-span"><div class="sc-waveform-container"></div><div class="sc-buffer"></div><div class="sc-played"></div></div>').append('<div class="sc-time-indicators"><span class="sc-position"></span> | <span class="sc-duration"></span></div>');m(l,f,s.apiKey);l.bind("onTrackDataLoaded.scPlayer",function(r){var i=r.playerObj.tracks;s.randomize&&(i=n(i));e.each(i,function(n,r){var i=n===0;e('<li><a href="'+r.permalink_url+'">'+r.title+'</a><span class="sc-track-duration">'+t(r.duration)+"</span></li>").data("sc-track",{id:n}).toggleClass("active",i).appendTo(b);e("<li></li>").append(g(r,n>=s.loadArtworks)).appendTo(c).toggleClass("active",i).data("sc-track",r)});l.each(function(){e.isFunction(s.beforeRender)&&s.beforeRender.call(this,i)});e(".sc-duration",l)[0].innerHTML=t(i[0].duration);e(".sc-position",l)[0].innerHTML=t(0);y(l,i[0]);s.continuePlayback&&l.bind("onPlayerTrackFinish",function(e){C(l)});l.removeClass("loading").trigger("onPlayerInit");if(s.autoPlay&&!h){S(l);h=!0}});u.each(function(t){e(this).replaceWith(l)});return l};e.scPlayer.stopAll=function(){e(".sc-player.playing a.sc-pause").click()};e.scPlayer.destroy=function(){e(".sc-player, .sc-player-engine-container").remove()};e.fn.scPlayer=function(t){h=!1;this.each(function(){e.scPlayer(t,this)});return this};e.scPlayer.defaults=e.fn.scPlayer.defaults={customClass:null,beforeRender:function(t){var n=e(this)},onDomReady:function(){e("a.sc-player, div.sc-player").scPlayer()},autoPlay:!1,continuePlayback:!0,randomize:!1,loadArtworks:5,apiKey:"htuiRd1JP11Ww0X72T1C3g"};e(document).on("click","a.sc-play, a.sc-pause",function(t){var n=e(this).closest(".sc-player").find("ol.sc-trackslist");n.find("li.active").click();return!1});e(document).on("click","a.sc-info-toggle, a.sc-info-close",function(t){var n=e(this);n.closest(".sc-player").find(".sc-info").toggleClass("active").end().find("a.sc-info-toggle").toggleClass("active");return!1});e(document).on("click",".sc-trackslist li",function(t){var n=e(this),r=n.closest(".sc-player"),i=n.data("sc-track").id,s=r.is(":not(.playing)")||n.is(":not(.active)");s?S(r,i):x(r);n.addClass("active").siblings("li").removeClass("active");e(".artworks li",r).each(function(t){e(this).toggleClass("active",t===i)});return!1});var O=function(t,n){var r=e(t).closest(".sc-time-span"),i=r.find(".sc-buffer"),s=r.find(".sc-waveform-container img"),o=r.closest(".sc-player"),u=Math.min(i.width(),n-s.offset().left)/s.width();N(o,u)},M=function(e){if(e.targetTouches.length===1){O(e.target,e.targetTouches&&e.targetTouches.length&&e.targetTouches[0].clientX);e.preventDefault()}};e(document).on("click",".sc-time-span",function(e){O(this,e.pageX);return!1}).on("touchstart",".sc-time-span",function(e){this.addEventListener("touchmove",M,!1);e.originalEvent.preventDefault()}).on("touchend",".sc-time-span",function(e){this.removeEventListener("touchmove",M,!1);e.originalEvent.preventDefault()});var _=function(t,n){var r=e(t),i=r.offset().left,o=r.width(),u=function(e){return Math.floor((e-i)/o*100)},a=function(e){s.trigger({type:"scPlayer:onVolumeChange",volume:u(e.pageX)})};r.bind("mousemove.sc-player",a);a(n)},D=function(t,n){e(t).unbind("mousemove.sc-player")};e(document).on("mousedown",".sc-volume-slider",function(e){_(this,e)}).on("mouseup",".sc-volume-slider",function(e){D(this,e)});s.bind("scPlayer:onVolumeChange",function(t){e("span.sc-volume-status").css({width:t.volume+"%"})});e(function(){e.isFunction(e.scPlayer.defaults.onDomReady)&&e.scPlayer.defaults.onDomReady()})})(jQuery);


/*
 * jQuery WidowFix Plugin
 * http://matthewlein.com/widowfix/
 * Copyright (c) 2010 Matthew Lein
 * Version: 1.3.2 (7/23/2011)
 * Dual licensed under the MIT and GPL licenses
 * Requires: jQuery v1.4 or later
 */

(function(a){jQuery.fn.widowFix=function(d){var c={letterLimit:null,prevLimit:null,linkFix:false,dashes:false};var b=a.extend(c,d);if(this.length){return this.each(function(){var i=a(this);var n;if(b.linkFix){var h=i.find("a:last");h.wrap("<var>");var e=a("var").html();n=h.contents()[0];h.contents().unwrap()}var f=a(this).html().split(" "),m=f.pop();if(f.length<=1){return}function k(){if(m===""){m=f.pop();k()}}k();if(b.dashes){var j=["-","–","—"];a.each(j,function(o,p){if(m.indexOf(p)>0){m='<span style="white-space:nowrap;">'+m+"</span>";return false}})}var l=f[f.length-1];if(b.linkFix){if(b.letterLimit!==null&&n.length>=b.letterLimit){i.find("var").each(function(){a(this).contents().replaceWith(e);a(this).contents().unwrap()});return}else{if(b.prevLimit!==null&&l.length>=b.prevLimit){i.find("var").each(function(){a(this).contents().replaceWith(e);a(this).contents().unwrap()});return}}}else{if(b.letterLimit!==null&&m.length>=b.letterLimit){return}else{if(b.prevLimit!==null&&l.length>=b.prevLimit){return}}}var g=f.join(" ")+"&nbsp;"+m;i.html(g);if(b.linkFix){i.find("var").each(function(){a(this).contents().replaceWith(e);a(this).contents().unwrap()})}})}}})(jQuery);


/**
 * Copyright (c) 2007-2014 Ariel Flesler - aflesler<a>gmail<d>com | http://flesler.blogspot.com
 * Licensed under MIT
 * @author Ariel Flesler
 * @version 1.4.11
 */
;(function(a){if(typeof define==='function'&&define.amd){define(['jquery'],a)}else{a(jQuery)}}(function($){var j=$.scrollTo=function(a,b,c){return $(window).scrollTo(a,b,c)};j.defaults={axis:'xy',duration:parseFloat($.fn.jquery)>=1.3?0:1,limit:true};j.window=function(a){return $(window)._scrollable()};$.fn._scrollable=function(){return this.map(function(){var a=this,isWin=!a.nodeName||$.inArray(a.nodeName.toLowerCase(),['iframe','#document','html','body'])!=-1;if(!isWin)return a;var b=(a.contentWindow||a).document||a.ownerDocument||a;return/webkit/i.test(navigator.userAgent)||b.compatMode=='BackCompat'?b.body:b.documentElement})};$.fn.scrollTo=function(f,g,h){if(typeof g=='object'){h=g;g=0}if(typeof h=='function')h={onAfter:h};if(f=='max')f=9e9;h=$.extend({},j.defaults,h);g=g||h.duration;h.queue=h.queue&&h.axis.length>1;if(h.queue)g/=2;h.offset=both(h.offset);h.over=both(h.over);return this._scrollable().each(function(){if(f==null)return;var d=this,$elem=$(d),targ=f,toff,attr={},win=$elem.is('html,body');switch(typeof targ){case'number':case'string':if(/^([+-]=?)?\d+(\.\d+)?(px|%)?$/.test(targ)){targ=both(targ);break}targ=$(targ,this);if(!targ.length)return;case'object':if(targ.is||targ.style)toff=(targ=$(targ)).offset()}var e=$.isFunction(h.offset)&&h.offset(d,targ)||h.offset;$.each(h.axis.split(''),function(i,a){var b=a=='x'?'Left':'Top',pos=b.toLowerCase(),key='scroll'+b,old=d[key],max=j.max(d,a);if(toff){attr[key]=toff[pos]+(win?0:old-$elem.offset()[pos]);if(h.margin){attr[key]-=parseInt(targ.css('margin'+b))||0;attr[key]-=parseInt(targ.css('border'+b+'Width'))||0}attr[key]+=e[pos]||0;if(h.over[pos])attr[key]+=targ[a=='x'?'width':'height']()*h.over[pos]}else{var c=targ[pos];attr[key]=c.slice&&c.slice(-1)=='%'?parseFloat(c)/100*max:c}if(h.limit&&/^\d+$/.test(attr[key]))attr[key]=attr[key]<=0?0:Math.min(attr[key],max);if(!i&&h.queue){if(old!=attr[key])animate(h.onAfterFirst);delete attr[key]}});animate(h.onAfter);function animate(a){$elem.animate(attr,g,h.easing,a&&function(){a.call(this,targ,h)})}}).end()};j.max=function(a,b){var c=b=='x'?'Width':'Height',scroll='scroll'+c;if(!$(a).is('html,body'))return a[scroll]-$(a)[c.toLowerCase()]();var d='client'+c,html=a.ownerDocument.documentElement,body=a.ownerDocument.body;return Math.max(html[scroll],body[scroll])-Math.min(html[d],body[d])};function both(a){return $.isFunction(a)||typeof a=='object'?a:{top:a,left:a}};return j}));