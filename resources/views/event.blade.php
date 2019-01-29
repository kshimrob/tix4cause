@extends('layout')
@section('content')
<?php
include(app_path().'/Includes/tnwsConstants.php');
include(app_path().'/Includes/genericLib.php')
?>
<style>

/*
#map-list-holder{
	height:100% !Important;
}
#list{
	height: 100% !Important;
}
.sea-map-inner{
	height:100% !Important;
}
*/
#social-share{
	float:left;
	width:100%;
	margin-top:15px;
}
header .top-nav .top-nav-right a{
	color:black;
}
.heart-overlay{
	display:none;
	    position: absolute;
    top: 0%;
    width: 70%;
    left: 12.5%;
}
.event-info-guarantee{
	background: #fff;
    border-radius: 4px;
    display: none;
    font-size: 12px;
    left: 4.5vw;
    top: 25%;
    padding: 20px;
    position: absolute;
    width: 90vw;
    z-index: 9999;
    -webkit-box-shadow: 0 1px 2px 0 rgba(53,65,74,.3);
    box-shadow: 0 1px 2px 0 rgba(53,65,74,.3);
    border: 1px solid black;
}
.blue-bar #open-guarantee{
	text-decoration:underline;
	cursor:pointer;
}
footer a{
	color:#212121;
}
@media (max-width:992px){
	header{display:none !important;}
	.event-container{
		margin-top:0 !Important;
	}
	#tn-maps{top:0 !Important;}
	#event-info-area{top:0 !important;display:block !Important;}
	#list-ctn{top:116px !important;}
	#venue-map{top:66px !Important;}
	body{overflow-y:hidden;}
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/postscribe/2.0.8/postscribe.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-serialize-object/2.5.0/jquery.serialize-object.min.js"></script>
<script id="tixWidget"></script>
<script>
	//var postscribe = require('postscribe');
	/*$(document).ready(function(){
	function getUrlVars(){
		var vars = {};
		var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
	}
	var eventId = getUrlVars()["eventID"];
	var script = document.createElement('script');
	script.type = 'text/javascript';
	script.src = "https://mapwidget3-sandbox.seatics.com/js?eventId=" + eventId + "&websiteConfigId=12563";
	document.body.appendChild(script);
});
*/

function showDiv(){
	$('#open-div').click(function(){
		$('#cause-div').show();
	});
	$.fn.serializeObject = function()
              {
               var o = {};
               var a = this.serializeArray();
               $.each(a, function() {
                   if (o[this.name]) {
                       if (!o[this.name].push) {
                           o[this.name] = [o[this.name]];
                       }
                       o[this.name].push(this.value || '');
                   } else {
                       o[this.name] = this.value || '';
                   }
               });
               return o;
              };
	var $form = $('#cause-email-form'),
    url = 'https://script.google.com/macros/s/AKfycbzI7fHSRgotfVRm3uur-BpvT2K9yjwPuMvMRcGPWewRaWOkF1o1/exec'

$('#submit-form').on('click', function(e) {
  e.preventDefault();
  var activeCause = $('.choose-cause.active-cause').text();
  $('#cause-name-input').val(activeCause);
  var jqxhr = $.ajax({
    url: url,
    method: "GET",
    dataType: "json",
    data: $form.serializeObject()
  }).success(
    function(){$('#pre-checkout-price-cta').click();}
  );
})
$('#close-overlay').click(function(){
	$('#cause-div').hide();
})

}
function getUrlParameter(sParam) {
 var sPageURL = window.location.search.substring(1);
 var sURLVariables = sPageURL.split('&');
 for (var i = 0; i < sURLVariables.length; i++) {
 var sParameterName = sURLVariables[i].split('=');
 if (sParameterName[0] == sParam) {
 return sParameterName[1];
 }
 }
 }
 function loadScript(){
 var evtid = getUrlParameter('eventID');
 var scriptUrl = '<script src="https://mapwidget3.seatics.com/js?eventId=' + evtid + '&websiteConfigId=12563"><\/script>';
/* var script = document.createElement('script');
	script.type = 'text/javascript';
	script.src = "https://mapwidget3-sandbox.seatics.com/js?eventId=" + evtid + "&websiteConfigId=12563";
*/
	$(function(){
		postscribe('#map-container', scriptUrl, {
			done: function() {
				Seatics.config.mapFinishedRenderingHandler = function(){
				$('#pre-checkout-price-ctn').prepend('<a id="open-div" class="red-btn">Go to secure checkout</a>');
				showDiv();
			}
			}
		});
		
	});
	

}
window.onload = loadScript;
</script>
<script>
	
	
</script>
<div id="container" class="event-container">
	<div id="event-detail-section">
	<?php 
	$eventID = $_GET['eventID'];
	getSingleEvent(array('websiteConfigID' => WEB_CONF_ID, 'eventID' => $eventID)); ?>
</div>
<div role="region" tabindex="-1" id="event-info-guarantee" class="event-info-guarantee" style="display: block;">
        <h3>We stand behind you 100%</h3>
        <br>
        <p>Whether you are buying or selling tickets on our site, we safeguard your transaction.</p>
        <div class="event-info-guarantee-cnt">
            <p><strong>You will receive a 100% refund for your tickets if:</strong></p>
            <ul>
                <li>Your order was accepted but not delivered by the seller.</li>
                <li>Your order was accepted but not shipped in time for the event.</li>
                <li>Your tickets were not valid for entry.<sup>(1)</sup></li>
                <li>Your event is cancelled and is not rescheduled.<sup>(2)</sup></li>
            </ul>
        </div>
        <div class="event-info-guarantee-cnt">
            <p><strong>Notes:</strong></p>
            <p>(1) Verified proof must be provided in letter form from the venue. Written or stamped "voids" do not constitute verified proof.</p>
            <p>(2) 100% refund for a cancelled event does not include shipping.</p>
        </div>
        <button id="event-info-guarantee-close" class="sea-accessible-button event-info-guarantee-close cm-close" aria-label="Close"></button>
</div>
<div id="social-share">
 <p>Share</p>
            <a class="twitter-share-button" target="_blank" href="https://twitter.com/intent/tweet?text=tix4cause&url={{ 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] }}&src=sdkpreparse" class="fb-xfbml-parse-ignore"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg></a>
	</div>
	<div id="map-container"></div>
</div>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<div id="cause-div">
	<a id="close-overlay" style="
    position: absolute;
    right: 5%;
    top: 5%; cursor:pointer;
"><img src="https://s3.us-east-2.amazonaws.com/elasticbeanstalk-us-east-2-698644334116/close.png"></a>
	<h1>Before You Checkout...</h1>
	<p class="cause-checkout-intro">Your purchase through our site makes a difference so please select one of these three featured causes to benefit at no additional cost.</p>
	<div class="row">
	@foreach ($causes as $cause)
			<div class="col-md-4">
        <a class="choose-cause"><img src="{{ Voyager::image( $cause->image ) }}" style="width:100%">
        <img src="https://s3.us-east-2.amazonaws.com/elasticbeanstalk-us-east-2-698644334116/heartoverlay.png" class="heart-overlay">
        <h2 id="cause-name">{{ $cause->name }}</h2>
        <p>{{ $cause->excerpt }}</p>
      	</a>
        <p><a class="learn-more" href="{{ route('causecheckout.show', $cause->slug) }}" target="_blank">Learn More</a></p>
      </div>
      @endforeach
      
  </div>
  <form id="cause-email-form">
      	<input type='hidden' id="cause-name-input" name="cause-name">
      	<h4>Enter your email here:</h4>
      	<input type="email" name="email-address">
      	<input type="submit" id="submit-form" class="red-btn">
  </form>
</div>
<script>

	$(document).ready(function(){
		$('.choose-cause')[0].id = 'cause-1';
		$('.choose-cause')[1].id = 'cause-2';
		$('.choose-cause')[2].id = 'cause-3';
		$('#cause-1').click(function(){
		$('.choose-cause').removeClass('active-cause');
		$('.heart-overlay').hide();
		$('#cause-1').addClass('active-cause');
		$('#cause-1 .heart-overlay').show();
	});
	$('#cause-2').click(function(){
		$('.choose-cause').removeClass('active-cause');
		$('.heart-overlay').hide();
		$('#cause-2').addClass('active-cause');
		$('#cause-2 .heart-overlay').show();
	});
	$('#cause-3').click(function(){
		$('.choose-cause').removeClass('active-cause');
		$('.heart-overlay').hide();
		$('#cause-3').addClass('active-cause');
		$('#cause-3 .heart-overlay').show();
	});
	$('#event-info-guarantee').hide();
	$('#open-guarantee').click(function(){
		$('#event-info-guarantee').show();
	});
	$('#event-info-guarantee-close').click(function(){
		$('#event-info-guarantee').hide();
	})
	});
	
</script>
@endsection

