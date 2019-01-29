@extends('layout')
@section('title')
Sports, Concert & Show Tickets | Tix4Cause | Live Event Tickets
@endsection

@section('description', 'Find sports, concert and show tickets with ease at Tix4Cause. Browse millions of tickets, buy with confidence and give back to charity with every purchase.')

@section('content')
<style>
#donated-ticket-message{
  display:none;
}
#subject{
  width:100%;
  height:30px;
}
</style>
<div class="main-contact-container">
<div class="container contact">
    <h1>Contact Us</h1>
    <div class="intro">
      <div class="row">
        <div class="text">
          <h2 style="margin-bottom:10px;">Call: <a href="tel:877.344.8384">877.344.8384</a></h2>
          <h2>Email: <a href="mailto:customersupport@tix4cause.com">customersupport@tix4cause.com</a></h2>
          
          <form method="POST" enctype="text/plain" action="{{ url('contact') }}">
            {{ csrf_field() }}
            <div class="form-name">
              <label>Name*</label>
              <input id="name" name="name" type="text" required />
              
            </div>
            <div class="form-email">
              <label>Email*</label>
              <input id="email" name="email" type="email" required />
              
            </div>
            
            <div class="form-phone">
              <label>Phone*</label>
              <input id="phone" name="phone" type="text" required />
            </div>
            <div class="form-subject">
              <label>Subject*</label>
              <select id="subject" name="subject" required >
                <option value="General Inquiry">General Inquiry</option>
                <option value="Ticket Order">Ticket Order</option>
                <option id="donate-tickets" value="Donate Tickets">Donate Tickets</option>
                <option value="Press">Press</option>
                <option value="Other">Other</option>
              </select>
            </div>
        
            <p id="donated-ticket-message">Thanks for your interest in donating tickets to Tix4Cause! We review each inquiry individually and will follow up with you if your tickets are accepted or if we need additional information. Please include the following in your submission: <br><br>
Name of event, Venue, City & State, Date of event, Number of tickets, Type of ticket (Paper/eTicket/Mobile), Seating information, Cause/Charity to benefit. </p>
            <div class="form-message">
              <label>Message</label>
              <textarea id="message" rows=8 name="message"></textarea>
              
            </div>
            <input type="submit" id="submit-contact-form" class="red-btn" value="Submit">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  $('#subject').change(function(){
  var x = document.getElementById("subject").selectedIndex;
  if(x == 2){
    $('#donated-ticket-message').show();
  }
  else{
    $('#donated-ticket-message').hide();
  }
});
  function GetURLParameter(sParam){
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++){
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam){
                return sParameterName[1];
            }
        }
    };
  $(document).ready(function(){
    var term = GetURLParameter('subject');
    if(term){
      $('#subject').val('Donate Tickets');
      $('#donated-ticket-message').show();
    }
  });
</script>
@endsection