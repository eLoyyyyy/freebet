/*
External J World Start
*/
/**
* Detect Element Resize Plugin for jQuery
*
* https://github.com/sdecima/javascript-detect-element-resize
* Sebastian Decima
*
* version: 0.5.3
**/

(function ( $ ) {
	var attachEvent = document.attachEvent,
		stylesCreated = false;
	
	var jQuery_resize = $.fn.resize;
	
	$.fn.resize = function(callback) {
		return this.each(function() {
			if(this == window)
				jQuery_resize.call(jQuery(this), callback);
			else
				addResizeListener(this, callback);
		});
	}

	$.fn.removeResize = function(callback) {
		return this.each(function() {
			removeResizeListener(this, callback);
		});
	}
	
	if (!attachEvent) {
		var requestFrame = (function(){
			var raf = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame ||
								function(fn){ return window.setTimeout(fn, 20); };
			return function(fn){ return raf(fn); };
		})();
		
		var cancelFrame = (function(){
			var cancel = window.cancelAnimationFrame || window.mozCancelAnimationFrame || window.webkitCancelAnimationFrame ||
								   window.clearTimeout;
		  return function(id){ return cancel(id); };
		})();

		function resetTriggers(element){
			var triggers = element.__resizeTriggers__,
				expand = triggers.firstElementChild,
				contract = triggers.lastElementChild,
				expandChild = expand.firstElementChild;
			contract.scrollLeft = contract.scrollWidth;
			contract.scrollTop = contract.scrollHeight;
			expandChild.style.width = expand.offsetWidth + 1 + 'px';
			expandChild.style.height = expand.offsetHeight + 1 + 'px';
			expand.scrollLeft = expand.scrollWidth;
			expand.scrollTop = expand.scrollHeight;
		};

		function checkTriggers(element){
			return element.offsetWidth != element.__resizeLast__.width ||
						 element.offsetHeight != element.__resizeLast__.height;
		}
		
		function scrollListener(e){
			var element = this;
			resetTriggers(this);
			if (this.__resizeRAF__) cancelFrame(this.__resizeRAF__);
			this.__resizeRAF__ = requestFrame(function(){
				if (checkTriggers(element)) {
					element.__resizeLast__.width = element.offsetWidth;
					element.__resizeLast__.height = element.offsetHeight;
					element.__resizeListeners__.forEach(function(fn){
						fn.call(element, e);
					});
				}
			});
		};
		
		/* Detect CSS Animations support to detect element display/re-attach */
		var animation = false,
			animationstring = 'animation',
			keyframeprefix = '',
			animationstartevent = 'animationstart',
			domPrefixes = 'Webkit Moz O ms'.split(' '),
			startEvents = 'webkitAnimationStart animationstart oAnimationStart MSAnimationStart'.split(' '),
			pfx  = '';
		{
			var elm = document.createElement('fakeelement');
			if( elm.style.animationName !== undefined ) { animation = true; }    
			
			if( animation === false ) {
				for( var i = 0; i < domPrefixes.length; i++ ) {
					if( elm.style[ domPrefixes[i] + 'AnimationName' ] !== undefined ) {
						pfx = domPrefixes[ i ];
						animationstring = pfx + 'Animation';
						keyframeprefix = '-' + pfx.toLowerCase() + '-';
						animationstartevent = startEvents[ i ];
						animation = true;
						break;
					}
				}
			}
		}
		
		var animationName = 'resizeanim';
		var animationKeyframes = '@' + keyframeprefix + 'keyframes ' + animationName + ' { from { opacity: 0; } to { opacity: 0; } } ';
		var animationStyle = keyframeprefix + 'animation: 1ms ' + animationName + '; ';
	}
	
	function createStyles() {
		if (!stylesCreated) {
			//opacity:0 works around a chrome bug https://code.google.com/p/chromium/issues/detail?id=286360
			var css = (animationKeyframes ? animationKeyframes : '') +
					'.resize-triggers { ' + (animationStyle ? animationStyle : '') + 'visibility: hidden; opacity: 0; } ' +
					'.resize-triggers, .resize-triggers > div, .contract-trigger:before { content: \" \"; display: block; position: absolute; top: 0; left: 0; height: 100%; width: 100%; overflow: hidden; } .resize-triggers > div { background: #eee; overflow: auto; } .contract-trigger:before { width: 200%; height: 200%; }',
				head = document.head || document.getElementsByTagName('head')[0],
				style = document.createElement('style');
			
			style.type = 'text/css';
			if (style.styleSheet) {
				style.styleSheet.cssText = css;
			} else {
				style.appendChild(document.createTextNode(css));
			}

			head.appendChild(style);
			stylesCreated = true;
		}
	}
	
	window.addResizeListener = function(element, fn){
		if (attachEvent) element.attachEvent('onresize', fn);
		else {
			if (!element.__resizeTriggers__) {
				if (getComputedStyle(element).position == 'static') element.style.position = 'relative';
				createStyles();
				element.__resizeLast__ = {};
				element.__resizeListeners__ = [];
				(element.__resizeTriggers__ = document.createElement('div')).className = 'resize-triggers';
				element.__resizeTriggers__.innerHTML = '<div class="expand-trigger"><div></div></div>' +
																						'<div class="contract-trigger"></div>';
				element.appendChild(element.__resizeTriggers__);
				resetTriggers(element);
				element.addEventListener('scroll', scrollListener, true);
				
				/* Listen for a css animation to detect element display/re-attach */
				animationstartevent && element.__resizeTriggers__.addEventListener(animationstartevent, function(e) {
					if(e.animationName == animationName)
						resetTriggers(element);
				});
			}
			element.__resizeListeners__.push(fn);
		}
	};
	
	window.removeResizeListener = function(element, fn){
		if (attachEvent) element.detachEvent('onresize', fn);
		else {
			element.__resizeListeners__.splice(element.__resizeListeners__.indexOf(fn), 1);
			if (!element.__resizeListeners__.length) {
					element.removeEventListener('scroll', scrollListener);
					element.__resizeTriggers__ = !element.removeChild(element.__resizeTriggers__);
			}
		}
	}
}( jQuery ));


// VERSION: 2.3 LAST UPDATE: 11.07.2013
/* 
 * Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
 * 
 * Made by Wilq32, wilq32@gmail.com, Wroclaw, Poland, 01.2009
 * Website: http://code.google.com/p/jqueryrotate/ 
 */

(function($) {
    var supportedCSS,supportedCSSOrigin, styles=document.getElementsByTagName("head")[0].style,toCheck="transformProperty WebkitTransform OTransform msTransform MozTransform".split(" ");
    for (var a = 0; a < toCheck.length; a++) if (styles[toCheck[a]] !== undefined) { supportedCSS = toCheck[a]; }
    if (supportedCSS) {
      supportedCSSOrigin = supportedCSS.replace(/[tT]ransform/,"TransformOrigin");
      if (supportedCSSOrigin[0] == "T") supportedCSSOrigin[0] = "t";
    }

    // Bad eval to preven google closure to remove it from code o_O
    eval('IE = "v"=="\v"');

    jQuery.fn.extend({
        rotate:function(parameters)
        {
          if (this.length===0||typeof parameters=="undefined") return;
          if (typeof parameters=="number") parameters={angle:parameters};
          var returned=[];
          for (var i=0,i0=this.length;i<i0;i++)
          {
            var element=this.get(i);	
            if (!element.Wilq32 || !element.Wilq32.PhotoEffect) {

              var paramClone = $.extend(true, {}, parameters); 
              var newRotObject = new Wilq32.PhotoEffect(element,paramClone)._rootObj;

              returned.push($(newRotObject));
            }
            else {
              element.Wilq32.PhotoEffect._handleRotation(parameters);
            }
          }
          return returned;
        },
        getRotateAngle: function(){
          var ret = [];
          for (var i=0,i0=this.length;i<i0;i++)
          {
            var element=this.get(i);	
            if (element.Wilq32 && element.Wilq32.PhotoEffect) {
              ret[i] = element.Wilq32.PhotoEffect._angle;
            }
          }
          return ret;
        },
        stopRotate: function(){
          for (var i=0,i0=this.length;i<i0;i++)
          {
            var element=this.get(i);	
            if (element.Wilq32 && element.Wilq32.PhotoEffect) {
              clearTimeout(element.Wilq32.PhotoEffect._timer);
            }
          }
        }
    });

    // Library agnostic interface

    Wilq32=window.Wilq32||{};
    Wilq32.PhotoEffect=(function(){

      if (supportedCSS) {
        return function(img,parameters){
          img.Wilq32 = {
            PhotoEffect: this
          };

          this._img = this._rootObj = this._eventObj = img;
          this._handleRotation(parameters);
        }
      } else {
        return function(img,parameters) {
          this._img = img;
          this._onLoadDelegate = [parameters];

          this._rootObj=document.createElement('span');
          this._rootObj.style.display="inline-block";
          this._rootObj.Wilq32 = 
            {
              PhotoEffect: this
            };
          img.parentNode.insertBefore(this._rootObj,img);

          if (img.complete) {
            this._Loader();
          } else {
            var self=this;
            // TODO: Remove jQuery dependency
            jQuery(this._img).bind("load", function(){ self._Loader(); });
          }
        }
      }
    })();

    Wilq32.PhotoEffect.prototype = {
      _setupParameters : function (parameters){
        this._parameters = this._parameters || {};
        if (typeof this._angle !== "number") { this._angle = 0 ; }
        if (typeof parameters.angle==="number") { this._angle = parameters.angle; }
        this._parameters.animateTo = (typeof parameters.animateTo === "number") ? (parameters.animateTo) : (this._angle); 

        this._parameters.step = parameters.step || this._parameters.step || null;
        this._parameters.easing = parameters.easing || this._parameters.easing || this._defaultEasing;
        this._parameters.duration = parameters.duration || this._parameters.duration || 1000;
        this._parameters.callback = parameters.callback || this._parameters.callback || this._emptyFunction;
        this._parameters.center = parameters.center || this._parameters.center || ["50%","50%"];
        if (typeof this._parameters.center[0] == "string") {
          this._rotationCenterX = (parseInt(this._parameters.center[0],10) / 100) * this._imgWidth * this._aspectW;
        } else {
          this._rotationCenterX = this._parameters.center[0];
        }
        if (typeof this._parameters.center[1] == "string") {
          this._rotationCenterY = (parseInt(this._parameters.center[1],10) / 100) * this._imgHeight * this._aspectH;
        } else {
          this._rotationCenterY = this._parameters.center[1];
        }

        if (parameters.bind && parameters.bind != this._parameters.bind) { this._BindEvents(parameters.bind); }
      },
      _emptyFunction: function(){},
      _defaultEasing: function (x, t, b, c, d) { return -c * ((t=t/d-1)*t*t*t - 1) + b }, 
      _handleRotation : function(parameters, dontcheck){
        if (!supportedCSS && !this._img.complete && !dontcheck) {
          this._onLoadDelegate.push(parameters);
          return;
        }
        this._setupParameters(parameters);
        if (this._angle==this._parameters.animateTo) {
          this._rotate(this._angle);
        }
        else { 
          this._animateStart();          
        }
      },

      _BindEvents:function(events){
        if (events && this._eventObj) 
        {
          // Unbinding previous Events
          if (this._parameters.bind){
            var oldEvents = this._parameters.bind;
            for (var a in oldEvents) if (oldEvents.hasOwnProperty(a)) 
              // TODO: Remove jQuery dependency
              jQuery(this._eventObj).unbind(a,oldEvents[a]);
          }

        this._parameters.bind = events;
        for (var a in events) if (events.hasOwnProperty(a)) 
          // TODO: Remove jQuery dependency
          jQuery(this._eventObj).bind(a,events[a]);
        }
      },

      _Loader:(function()
      {
        if (IE)
          return function() {
            var width=this._img.width;
            var height=this._img.height;
            this._imgWidth = width;
            this._imgHeight = height; 
            this._img.parentNode.removeChild(this._img);

            this._vimage = this.createVMLNode('image');
            this._vimage.src=this._img.src;
            this._vimage.style.height=height+"px";
            this._vimage.style.width=width+"px";
            this._vimage.style.position="absolute"; // FIXES IE PROBLEM - its only rendered if its on absolute position!
            this._vimage.style.top = "0px";
            this._vimage.style.left = "0px";
            this._aspectW = this._aspectH = 1;

            /* Group minifying a small 1px precision problem when rotating object */
            this._container = this.createVMLNode('group');
            this._container.style.width=width;
            this._container.style.height=height;
            this._container.style.position="absolute";
            this._container.style.top="0px";
            this._container.style.left="0px";
            this._container.setAttribute('coordsize',width-1+','+(height-1)); // This -1, -1 trying to fix ugly problem with small displacement on IE
            this._container.appendChild(this._vimage);

            this._rootObj.appendChild(this._container);
            this._rootObj.style.position="relative"; // FIXES IE PROBLEM
            this._rootObj.style.width=width+"px";
            this._rootObj.style.height=height+"px";
            this._rootObj.setAttribute('id',this._img.getAttribute('id'));
            this._rootObj.className=this._img.className;			
            this._eventObj = this._rootObj;	
            var parameters;
            while (parameters = this._onLoadDelegate.shift()) {
              this._handleRotation(parameters, true);	
            }
          }
          else return function () {
            this._rootObj.setAttribute('id',this._img.getAttribute('id'));
            this._rootObj.className=this._img.className;

            this._imgWidth=this._img.naturalWidth;
            this._imgHeight=this._img.naturalHeight;
            var _widthMax=Math.sqrt((this._imgHeight)*(this._imgHeight) + (this._imgWidth) * (this._imgWidth));
            this._width = _widthMax * 3;
            this._height = _widthMax * 3;

            this._aspectW = this._img.offsetWidth/this._img.naturalWidth;
            this._aspectH = this._img.offsetHeight/this._img.naturalHeight;

            this._img.parentNode.removeChild(this._img);	


            this._canvas=document.createElement('canvas');
            this._canvas.setAttribute('width',this._width);
            this._canvas.style.position="relative";
            this._canvas.style.left = -this._img.height * this._aspectW + "px";
            this._canvas.style.top = -this._img.width * this._aspectH + "px";
            this._canvas.Wilq32 = this._rootObj.Wilq32;

            this._rootObj.appendChild(this._canvas);
            this._rootObj.style.width=this._img.width*this._aspectW+"px";
            this._rootObj.style.height=this._img.height*this._aspectH+"px";
            this._eventObj = this._canvas;

            this._cnv=this._canvas.getContext('2d');
            var parameters;
            while (parameters = this._onLoadDelegate.shift()) {
              this._handleRotation(parameters, true);	
            }
          }
      })(),

      _animateStart:function()
      {	
        if (this._timer) {
          clearTimeout(this._timer);
        }
        this._animateStartTime = +new Date;
        this._animateStartAngle = this._angle;
        this._animate();
      },
      _animate:function()
      {
        var actualTime = +new Date;
        var checkEnd = actualTime - this._animateStartTime > this._parameters.duration;

        // TODO: Bug for animatedGif for static rotation ? (to test)
        if (checkEnd && !this._parameters.animatedGif) 
        {
          clearTimeout(this._timer);
        }
        else 
        {
          if (this._canvas||this._vimage||this._img) {
            var angle = this._parameters.easing(0, actualTime - this._animateStartTime, this._animateStartAngle, this._parameters.animateTo - this._animateStartAngle, this._parameters.duration);
            this._rotate((~~(angle*10))/10);
          }
          if (this._parameters.step) {
            this._parameters.step(this._angle);
          }
          var self = this;
          this._timer = setTimeout(function()
          {
            self._animate.call(self);
          }, 10);
        }

      // To fix Bug that prevents using recursive function in callback I moved this function to back
      if (this._parameters.callback && checkEnd){
        this._angle = this._parameters.animateTo;
        this._rotate(this._angle);
        this._parameters.callback.call(this._rootObj);
      }
      },

      _rotate : (function()
      {
        var rad = Math.PI/180;
        if (IE)
          return function(angle)
        {
          this._angle = angle;
          this._container.style.rotation=(angle%360)+"deg";
          this._vimage.style.top = -(this._rotationCenterY - this._imgHeight/2) + "px";
          this._vimage.style.left = -(this._rotationCenterX - this._imgWidth/2) + "px";
          this._container.style.top = this._rotationCenterY - this._imgHeight/2 + "px";
          this._container.style.left = this._rotationCenterX - this._imgWidth/2 + "px";

        }
          else if (supportedCSS)
          return function(angle){
            this._angle = angle;
            this._img.style[supportedCSS]="rotate("+(angle%360)+"deg)";
            this._img.style[supportedCSSOrigin]=this._parameters.center.join(" ");
          }
          else 
            return function(angle)
          {
            this._angle = angle;
            angle=(angle%360)* rad;
            // clear canvas	
            this._canvas.width = this._width;//+this._widthAdd;
            this._canvas.height = this._height;//+this._heightAdd;

            // REMEMBER: all drawings are read from backwards.. so first function is translate, then rotate, then translate, translate..
            this._cnv.translate(this._imgWidth*this._aspectW,this._imgHeight*this._aspectH);	// at least center image on screen
            this._cnv.translate(this._rotationCenterX,this._rotationCenterY);			// we move image back to its orginal 
            this._cnv.rotate(angle);										// rotate image
            this._cnv.translate(-this._rotationCenterX,-this._rotationCenterY);		// move image to its center, so we can rotate around its center
            this._cnv.scale(this._aspectW,this._aspectH); // SCALE - if needed ;)
            this._cnv.drawImage(this._img, 0, 0);							// First - we draw image
          }

      })()
      }

      if (IE)
      {
        Wilq32.PhotoEffect.prototype.createVMLNode=(function(){
          document.createStyleSheet().addRule(".rvml", "behavior:url(#default#VML)");
          try {
            !document.namespaces.rvml && document.namespaces.add("rvml", "urn:schemas-microsoft-com:vml");
            return function (tagName) {
              return document.createElement('<rvml:' + tagName + ' class="rvml">');
            };
          } catch (e) {
            return function (tagName) {
              return document.createElement('<' + tagName + ' xmlns="urn:schemas-microsoft.com:vml" class="rvml">');
            };
          }		
        })();
      }

})(jQuery);
/*
External J World End
*/
var jq = $.noConflict();

function _(el)
{
	return document.getElementById(el);
}

function encode_url(text)
{
	if(typeof text === 'string' || typeof text === 'number')
	{
		if(text.length>0)
		{
			text = text.replace(/(\r\n|\n|\r)/gm,"");
			text = encodeURIComponent(text).replace(/%20/g,'+');
		}
	}
	return text;
}

function is_element_exists(id)
{
	if( _(id)!=null)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function removeElement(id) {
  var element = document.getElementById(id);
  element.parentNode.removeChild(element);
}

function press_enter(e,id){
	if(e.keyCode === 13){
		_(id).click();
	}
	return false;
}

function focus(id)
{
	_(id).focus();
}

function ignore_tags(text)
{
	if(typeof text === 'string' || typeof text === 'number')
	{
		if(text.length>0)
		{
			text = text.replace(/</g,"&lt;");
			text = text.replace(/>/g,"&gt;");
			text = text.replace(/=/g,"&equals;");
			text = text.replace(/'/g,"&apos;");
			text = text.replace(/"/g,"&quot;");
			text = text.replace(/\\/g,"&bsol;");
		}
	}
	return text;
}

function remove_body_overflow()
{
	if(loading_status == 0 && form_status == 0)
	{
		jq("body").removeClass( "body_overflow" );
	}
	setTimeout(function(){
	resize();
	},200);
}

loading_status = 0;
form_status = 0;
/*
	Jquery Show Message
*/
function messageShow(message)
{
	var meetMessage = '';
	var appendElem = '';
	if(message.length>0){
		meetMessage += message;
	}
	else{
		meetMessage += 'Loading';
	}
	appendElem += '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
	appendElem += '<i class="fa fa-refresh fa-spin fa-2x"></i>';
	appendElem += '<div id="messageText">' + meetMessage + '</div>';
	jq('body #messageContainer').show().html(appendElem);
	loading_status = 1;
	jq('body').last().addClass('body_overflow');
}

function messageHide()
{
	jq('#messageContainer').hide();
	loading_status = 0;
	remove_body_overflow();
}

function remove_body_overflow()
{
	if(loading_status ==0 && form_status==0)
	{
		jq("body").removeClass( "body_overflow" );
	}
}

function formShow(message)
{
	form_status = 1;
	jq('#formShowContainer').show().addClass('showThis').append(message);
	jq('body').last().addClass('body_overflow');
}
function formShow2(message)
{
	form_status = 1;
	jq('#formShowContainer_2').show().addClass('showThis').append(message);
	jq('body').last().addClass('body_overflow');
}

function formHide()
{
	form_status = 0;
	jq('#formShowContainer').hide();
	jq('#formShowContainer .popContanier').remove();
	remove_body_overflow();
}
function formHide2()
{
	form_status = 0;
	jq('#formShowContainer_2').hide();
	jq('#formShowContainer_2 .popContanier').remove();
	remove_body_overflow();
}
/*
Notification Start
*/
sysNotificationStatus = 0;
jq(document).ready(function(){
	function sysNotification(notification_id,functionName){
		this.functionName = functionName;
		this.style = function(){
			notificationCss = '<style type="text/css">';
				notificationCss += '.notification-container';
				notificationCss += '{';
					notificationCss += 'font-weight: bold;';
					notificationCss += 'background-color: #F5F5F5;';
					notificationCss += 'border: 1px solid #CCCCCC;';
					notificationCss += '-webkit-border-radius: 2px;';
					notificationCss += '-moz-border-radius: 2px;';
					notificationCss += 'border-radius: 2px;';
					notificationCss += 'white-space: nowrap;';
					notificationCss += 'margin: 5px 5px 5px 5px;';
					notificationCss += 'padding: 12px 12px 12px 12px;';
					notificationCss += 'opacity:0;';
					notificationCss += 'float:left;';
					notificationCss += 'margin-left:-100%;';
					notificationCss += 'cursor:pointer;';
				notificationCss += '}';
				notificationCss += '.notification-container:hover';
				notificationCss += '{';
					notificationCss += 'box-shadow: inset 0px 0px 3px rgba(51, 51, 51, 0.30);';
				notificationCss += '}';
				notificationCss += '.error-notify';
				notificationCss += '{';
					notificationCss += 'background-color: #c9302c;';
					notificationCss += 'border: 1px solid #ac2925;';
					notificationCss += 'color: #fff;';
					notificationCss += 'text-shadow: 0 1px 0 rgba(37, 37, 37, 0.5);';
				notificationCss += '}';
				notificationCss += '.success-notify';
				notificationCss += '{';
					notificationCss += 'background-color: #5cb85c;';
					notificationCss += 'border: 1px solid #3E903E;';
					notificationCss += 'color: #fff;';
					notificationCss += 'text-shadow: 0 1px 0 rgba(37, 37, 37, 0.5);';
				notificationCss += '}';
				notificationCss += '.warning-notify';
				notificationCss += '{';
					notificationCss += 'background-color: #fcf8e3;';
					notificationCss += 'border: 1px solid #faebcc;';
					notificationCss += 'color: #8a6d3b;';
					notificationCss += 'text-shadow: 0 1px 0 rgba(37, 37, 37, 0.1);';
				notificationCss += '}';
			notificationCss += '</style>';
			jq("head").append(notificationCss);
		}
		this.style();
		this.notification_id = notification_id;
		this.currentIndex = 0;
		this.className = "notify-item-" + this.currentIndex;
		jq("body").append('<div id="' + this.notification_id + '" style="z-index: 10000;position: fixed;bottom: 15px;"></div>');
	}
	sysNotification.prototype.autoHide = function(index,functionName){
		setTimeout(function(){
			eval(functionName + ".destroy(" + index + ")");
		},5000);
		
	}
	sysNotification.prototype.destroy = function(index){
		if(jq('.notify-item-' + index).length>0)
		{
			jq('.notify-item-' + index).animate({
				opacity: 0,
				height: "0px"
			},500, function(){
				jq('.notify-item-' + index).remove();
				jq('.notify-clear-item-' + index).remove();
			});
		}
	}
	sysNotification.prototype.notifyAddIndex = function(){
		this.currentIndex++;
	}
	sysNotification.prototype.notify = function(message,messageType,autohide){
		
		messageType = messageType.toLowerCase();
		if(messageType == "1")
		{
			messageType = "success";
		}
		else if(messageType == "2" || messageType == "4")
		{
			messageType = "error";
		}
		else if(messageType == "3")
		{
			messageType = "warning";
		}
		else
		{
			messageType = "default";
		}
		if(messageType == "error" || messageType == "success")
		{
			className = ' ' + messageType + '-notify';
		}
		else
		{
			className = ' ' + messageType + '-notify';
		}
		this.notifyAddIndex();
		messageContainer = '<div style="clear:both;" class="notify-clear-item-' + this.currentIndex + '"></div><div class="notification-container notify-item-' + this.currentIndex + '' + className + '" data-value="' + this.currentIndex + '">';
			messageContainer += message;
		messageContainer += '</div>';
		jq("#" + this.notification_id).prepend(messageContainer);
		
		_this = this;
		if(autohide == true)
		{
			new this.autoHide(_this.currentIndex,_this.functionName)
		}
		jq(".notify-item-" + this.currentIndex).animate({
			opacity: 1,
			marginLeft: "5px"
		});
		
		notifyFunction();
	}
	
	sysNotificationStatus = 1;
	newNotification = new sysNotification("noty","newNotification");
});

function systemNotify(message,type,autohide)
{
	if(sysNotificationStatus == 1)
	{
		newNotification.notify(message,type,autohide);
	}else
	{
		/* Retry */
		setTimeout(function(){
			systemNotify(message,type,autohide);
		},1000);
	}
}
function notifyFunction(){
	jq('.notification-container').click(function(){
		index = jq(this).data("value");
		
		jq('.notify-item-' + index).animate({
			opacity: 0.5,
			marginLeft: "-100%",
			height: "0px"
		},
		500,
		function(){
			jq('.notify-item-' + index).remove();
			jq('.notify-clear-item-' + index).remove();
		});
	});
}
/*
Notification End
*/


/*STRENGTH VALIDATION*/
function checkStrength(password_id,repassword,ElemInput){
	/*Set a variables*/
	//alert alert-success 
	//Must Contains 5 Characters
	weakPass = /(?=.{5,}).*/;
	//Must contain lower case letters and at least one digit.
	MediumPass = /^(?=\S*?[a-z])(?=\S*?[0-9])\S{5,}$/;
	//Must contain at least one upper case letter, one lower case letter and one digit.
	StrongPass = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])\S{5,}$/; 
	//Must contain at least one upper case letter, one lower case letter and one digit.
	VryStrongPass = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=\S*?[^\w\*])\S{5,}$/;
	
	jq(password_id).on('change keyup',function(e){
		if(password_id.val().trim().length>0){
			if(password_id.val().match(VryStrongPass))
			{
				ElemInput.removeClass().addClass('alert alert-success signup-group w-icon').html('Very Strong Password');
			}
			else if(password_id.val().match(StrongPass))
			{
				ElemInput.removeClass().addClass('alert alert-success signup-group w-icon').html('Strong Password');
			}
			else if(password_id.val().match(MediumPass))
			{
				ElemInput.removeClass().addClass('alert alert-warning signup-group w-icon').html('Good Password');
			}
			else if(password_id.val().match(weakPass))
			{
				ElemInput.removeClass().addClass('alert alert-danger signup-group w-icon').html('Weak Password');
			}
			else 
			{
				ElemInput.removeClass().addClass('alert alert-danger signup-group w-icon').html('Short');
			}
		}
		else
		{
			ElemInput.removeClass().addClass('alert alert-danger signup-group w-icon').html('Password can\'t leave empty');
		}
	});
	jq(repassword).on('change keyup',function(e){
		if(repassword.val().trim().length>0){
			if(password_id.val() !== repassword.val())
			{
				ElemInput.removeClass().addClass('alert alert-danger signup-group w-icon').html('Passwords do not match!');
			}
			else
			{
				ElemInput.removeClass().addClass('alert alert-success signup-group w-icon').html('Passwords match!');
			}
			
			if(password_id.val() == repassword.val())
			{
				setTimeout(function(){
					ElemInput.removeClass().html('');
				},5000);
			}
		}
		else
		{
			ElemInput.removeClass().addClass('alert alert-danger signup-group w-icon').html('Re type Password can\'t leave empty');
		}
	});
}

function err_internet(){
	systemNotify('Unable to Connect to the Internet',3,true);
}