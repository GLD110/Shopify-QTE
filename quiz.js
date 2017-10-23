var loadScript = function(url, callback){

  /* JavaScript that will load the jQuery library on Google's CDN.
     We recommend this code: http://snipplr.com/view/18756/loadscript/.
     Once the jQuery library is loaded, the function passed as argument,
     callback, will be executed. */

};

var myAppJavaScript = function($){
  /* Your app's JavaScript here.
     $ in this scope references the jQuery object we'll use.
     Don't use 'jQuery', or 'jQuery191', here. Use the dollar sign
     that was passed as argument.*/
	 var check;
				var getPage = __st.p;
				if(getPage == 'home') {
					getPage == 'home';
				} else {
					getPage = __st.rid;
				}
				$('script').each(function(){
					var scripts = jQuery(this).attr('src');
					if(scripts != undefined) {
						scripts = scripts.search('bootstrap');
						if(scripts > 0) {
							check = scripts;
							return false;
						} 
						else {
							check = 0;
							return false;
						}
					}
				}); 
				if(check <= 0) {
					var script = '<link rel=stylesheet href=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css><script src=https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js></script><script src=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js></script>';
					$('head').append(script);
				} 
				var page = jQuery('body').attr('class');
				var storeName= window.location.hostname; 
				$.ajax({
					url: '//freegeoip.net/json/',
					type: 'GET',
					dataType: 'jsonp',
					success: function(location) {
						$.ajax({
							type:'GET',
							url:'https://quiz.farhaoui.me/PopUpAjax.php',
							data:'storeName='+storeName+'&page='+getPage+'&ip='+location.ip,
							success:function(data){
								console.log('data');
								console.log(data);
								$('body').append(data);
							}
						});
					}
				});
};

if ((typeof jQuery === 'undefined') || (parseFloat(jQuery.fn.jquery) < 1.7)) {
  loadScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', function(){
    jQuery191 = jQuery.noConflict(true);
    myAppJavaScript(jQuery191);
  });
} else {
  myAppJavaScript(jQuery);
}