(function($){"use strict";var CUSTOMIZER={init:function(){this.postMessage()},postMessage:function(){var api=wp.customize;_.each(jsvars,function(jsVars,setting){var css="",cssArray={};api(setting,function(value){var oldval=value();value.bind(function(newval){if(undefined!==jsVars&&0<jsVars.length){_.each(jsVars,function(jsVar){var val=newval;var oval=oldval;if(undefined===jsVar.element){jsVar.element=""}if(undefined===jsVar.property){jsVar.property=""}if(undefined===jsVar.prefix){jsVar.prefix=""}if(undefined===jsVar.suffix){jsVar.suffix=""}if(undefined===jsVar.units){jsVar.units=""}if(undefined===jsVar["function"]){jsVar["function"]="css"}if(undefined===jsVar.value_pattern){jsVar.value_pattern="$"}_.each(jsVars,function(args,i){if("string"===typeof newval){if(typeof args.value_pattern==="string"){val=args.value_pattern.replace(/\$/g,args.prefix+newval+args.units+args.suffix);oval=args.value_pattern.replace(/\$/g,args.prefix+oldval+args.units+args.suffix)}else{val=args.prefix+newval+args.units+args.suffix;oval=args.prefix+oldval+args.units+args.suffix}if("background-image"===args.property){if(0>val.indexOf("url(")){val='url("'+val+'")'}}if("html"===args["function"]){if("undefined"!==typeof args.attr&&undefined!==args.attr){jQuery(args.element).attr(args.attr,val)}else{jQuery(args.element).html(val)}}else if("class"===args["function"]){jQuery(args.element).removeClass(oval).addClass(val)}else{if(""!==val){cssArray[i]=args.element+"{"+args.property+":"+val+";}"}else{cssArray[i]=""}}}else if("object"===typeof newval){cssArray[i]="";_.each(newval,function(subValueValue,subValueKey){if(undefined!==args.choice){if(args.choice===subValueKey){cssArray[i]+=args.element+"{"+args.property+":"+args.prefix+subValueValue+args.units+args.suffix+";}"}}else{if(_.contains(["top","bottom","left","right"],subValueKey)){cssArray[i]+=args.element+"{"+args.property+"-"+subValueKey+":"+args.prefix+subValueValue+args.units+args.suffix+";}"}else{cssArray[i]+=args.element+"{"+subValueKey+":"+args.prefix+subValueValue+args.units+args.suffix+";}"}}})}})});_.each(cssArray,function(singleCSS){css="";setTimeout(function(){if(""!==singleCSS){css+=singleCSS}if(""!==css){if(!jQuery("#xirki-customizer-postmessage"+setting.replace(/\[/g,"-").replace(/\]/g,"")).size()){jQuery("head").append('<style id="xirki-customizer-postmessage'+setting.replace(/\[/g,"-").replace(/\]/g,"")+'"></style>')}jQuery("#xirki-customizer-postmessage"+setting.replace(/\[/g,"-").replace(/\]/g,"")).text(css)}},100)})}oldval=newval})})})}};$(document).ready(function(){CUSTOMIZER.init()})})(jQuery);