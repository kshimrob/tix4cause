<?php use MaxMind\Db\Reader; ?>
<?php
        $location = GeoIP::getLocation();
        $country = $location['country'];
        $city = $location['city'];
        $state = $location['state'];
        $lat = $location['lat'];
        $lng = $location['lon'];
?>
<style>
header {
  background-color: white;
  position: fixed;
  width: 100%;
  z-index: 100;
}
header .top-nav {
  padding: 20px 100px;
}
header .top-nav .top-nav-left {
  display: inline-block;
}
header .top-nav .top-nav-left a {
  display: inline-block;
  max-width: 173px;
  transition: 0.2s;
}
header .top-nav .top-nav-left button {
  transition: 0.2s;
}
header .top-nav .top-nav-left a:hover,
header .top-nav .top-nav-left button:hover {
  opacity: 0.5;
}
header .top-nav .top-nav-left form {
  display: inline-block;
  vertical-align: top;
  margin-top: 28px;
  margin-left: 40px;
}
header .top-nav .top-nav-left form input[type=text] {
  max-width: 240px;
  width: 240px;
  padding: 5px 10px;
  margin-right: -6px;
  display: inline-block;
  font: bold 14px "Roboto Condensed", sans-serif;
  text-transform: uppercase;
  border: 2px solid #12A8DE;
  border-right: none;
  letter-spacing: 0.2px;
}
header .top-nav .top-nav-left form button {
  background-color: #E81C40;
  color: white;
  text-transform: uppercase;
  font: bold 14px "Roboto Condensed", sans-serif;
  letter-spacing: 0.2px;
  padding: 5px 10px;
  border: 2px solid #E81C40;
  display: inline-block;
}
header .top-nav .top-nav-right {
  float: right;
}
header .top-nav .top-nav-right .mobile-nav,
header .top-nav .top-nav-right #nav-toggle,
header .top-nav .top-nav-right #nav-toggle-label,
header .top-nav .top-nav-right .mobile-nav .sub-menu,
header .top-nav .top-nav-right .mobile-nav .sub-submenu {
  display: none;
}
header .top-nav .top-nav-right a {
  font: bold 14px "Roboto Condensed", sans-serif;
  text-transform: uppercase;
  letter-spacing: 0.2px;
}
header .top-nav .top-nav-right a:hover,
header .top-nav .top-nav-right button:hover {
  cursor: pointer;
}
header .top-nav .top-nav-right .nav-location {
  text-align: right;
  position: relative;
}
header .top-nav .top-nav-right .nav-location a {
  color: #12A8DE;
  text-decoration: underline;
}
header .top-nav .top-nav-right .nav-location svg {
  vertical-align: top;
}
header .top-nav .top-nav-right .nav-location #location-dropdown {
  display: none;
  position: absolute;
  box-shadow: 0 3px 7px 2px rgba(0, 0, 0, 0.2);
  z-index: 10;
  padding: 10px;
  right: 0;
  background-color: white;
}
header .top-nav .top-nav-right .nav-location #location-dropdown #current-location {
  background-color: #E81C40;
  color: white;
  text-transform: uppercase;
  font: bold 14px "Roboto Condensed", sans-serif;
  letter-spacing: 0.2px;
  padding: 5px 10px;
  border: 2px solid #E81C40;
  display: inline-block;
  margin-bottom: 10px;
  -webkit-appearance: none;
  -moz-appearance: none;
}
header .top-nav .top-nav-right .nav-location #location-dropdown #city-input-toggle {
  display: block;
  text-align: left;
}
header .top-nav .top-nav-right .nav-location #location-dropdown #city-input-container {
  display: none;
  background-color: #dfdfdf;
  padding: 10px;
}
header .top-nav .top-nav-right .nav-location #location-dropdown #city-input-container #close-btn {
  font-size: 30px;
  margin-bottom: 0;
  line-height: 0.8;
}
header .top-nav .top-nav-right .nav-location #location-dropdown #city-input-container label {
  display: block;
  text-align: left;
  font-size: 12px;
  font-weight: bold;
}
header .top-nav .top-nav-right .nav-location #location-dropdown #city-input-container input {
  display: block;
  width: 150px;
  color: black;
  font-family: "Roboto", sans-serif;
}
header .top-nav .top-nav-right .nav-location #location-dropdown #city-input-container #change-location {
  background-color: #FFDA00;
  color: black;
  text-transform: uppercase;
  font: bold 14px "Roboto Condensed", sans-serif;
  letter-spacing: 0.2px;
  padding: 5px 10px;
  width: 100%;
  margin-top: 10px;
  border: 2px solid #FFDA00;
  display: inline-block;
}
header .top-nav .top-nav-right .nav-location #location-dropdown #city-input-container #nav-error-message {
  display: none;
  color: red;
  font-weight: bold;
  font-size: 12px;
  text-align: left;
  margin-bottom: 0;
}
header .top-nav .top-nav-right .nav-location #location-dropdown #city-input-container #error-input {
  border-color: red;
}
header .top-nav .top-nav-right .main-nav {
  display: flex;
  display: -webkit-flex;
}
header .top-nav .top-nav-right .main-nav li {
  margin: 0 10px;
  position: relative;
}
header .top-nav .top-nav-right .main-nav .sub-menu {
  display: none;
  position: absolute;
  padding: 10px 0;
  top: 33px;
  left: 0;
  height: auto;
  border: 1px solid lightgrey;
  background-color: white;
  width: 100px;
}
header .top-nav .top-nav-right .main-nav .sub-menu li {
  padding: 0 20px;
  margin: 0;
}
header .top-nav .top-nav-right .main-nav .sub-menu .sub-submenu {
  display: none;
  position: absolute;
  padding: 10px;
  top: 0;
  left: 98px;
  border: 1px solid lightgrey;
  background-color: white;
}
header .top-nav .top-nav-right .main-nav .concerts {
  width: 100px;
}
header .top-nav .top-nav-right .main-nav .arts-theater,
header .top-nav .top-nav-right .main-nav .other-tickets {
  width: 150px;
}
header .top-nav .top-nav-right .main-nav > li:hover {
  border-bottom: 5px solid #12A8DE;
}
header .top-nav .top-nav-right .main-nav li:hover .sub-menu,
header .top-nav .top-nav-right .main-nav .sub-menu:hover,
header .top-nav .top-nav-right .main-nav .sub-submenu:hover {
  display: inline-block;
}
header .top-nav .top-nav-right .main-nav li:hover > .sub-submenu {
  display: inline-block;
}

@media only screen and (max-width: 1300px) {
  header .top-nav {
    padding: 20px;
    .top-nav-left {
      form {
        margin-left: 15px;
      }
    }
  }
}

@media only screen and (max-width: 1100px) {
  header .top-nav .top-nav-left form input[type="text"] {
    width: 150px;
  }
}

@media only screen and (max-width: 1000px) {
  .mobile-nav {
    background-color: white;
    display: inline-block;
    position: absolute;
    padding: 20px;
    width: 190px;
    right: 0;

    li {
      padding: 10px 0;
      position: relative;

      svg {
        position: absolute;
        top: 17px;
        right: 5px;
      }

      a:hover {
        cursor: pointer;
      }

      .sub-menu li {
        padding: 0 0 0 10px;
      }
    }
  }
  header .top-nav .top-nav-left form {
    margin-top: 12px;
  }
  header .top-nav .top-nav-right {
    #nav-toggle {
      display: inline-block;
    }
  
    .main-nav {
      display: none;
    }

    .nav-location {
      margin-right: 70px;
      margin-top: 15px;
    }
  
    #nav-toggle {
      position: fixed;
      top: 0;
      right: 0;
      -webkit-opacity: 0;
      -ms-opacity: 0;
      -moz-opacity: 0;
      -o-opacity: 0;
      opacity: 0;
   }
   
   #nav-toggle-label {
    display: inline-block;
    height: 80px;
      width: 60px;
      position: fixed;
      z-index: 12;
      right: 0;
      top: 35px;
      -webkit-transform: rotate(0deg);
      -ms-transform: rotate(0deg);
      -moz-transform: rotate(0deg);
      -o-transform: rotate(0deg);
      transform: rotate(0deg);
      cursor: pointer;
      -webkit-transition: 0.25s ease-in-out;
      -ms-transition: 0.25s ease-in-out;
      -moz-transition: 0.25s ease-in-out;
      -o-transition: 0.25s ease-in-out;
      transition: 0.25s ease-in-out;
    }
    
  
   
    #hamburger {
      display: block;
      float: right;
      position: absolute;
          height: 28px;
          width: 40px;
          top: 0;
          right: 28px;
          color: black;
    }
  
    #hamburger span {
      width: 100%;
      height: 2px;
      position: relative;
      margin: 0 0 11px 0;
      background: black;
      transition: width 0.3s;
      display: block;
    }
  
    #hamburger span:nth-child(1) {
    -webkit-transition-delay: 0.5s;
        -ms-transition-delay: 0.5s;
        -moz-transition-delay: 0.5s;
        -o-transition-delay: 0.5s;
        transition-delay: 0.5s;
    }
  
    #hamburger span:nth-child(2) {
    -webkit-transition-delay: 0.625s;
        -ms-transition-delay: 0.625s;
        -moz-transition-delay: 0.625s;
        -o-transition-delay: 0.625s;
        transition-delay: 0.625s;
    }
  
    #hamburger span:nth-child(3) {
    -webkit-transition-delay: 0.75s;
        -ms-transition-delay: 0.75s;
        -moz-transition-delay: 0.75s;
        -o-transition-delay: 0.75s;
        transition-delay: 0.75s;
    }
  
    #nav-toggle:checked + #nav-toggle-label #hamburger span {
        width: 0%;
      }
    
    #nav-toggle:checked + #nav-toggle-label #hamburger span:nth-child(1) {
      -webkit-transition-delay: 0s;
        -ms-transition-delay: 0s;
        -moz-transition-delay: 0s;
        -o-transition-delay: 0s;
        transition-delay: 0s;
  
    }
      
    #nav-toggle:checked + #nav-toggle-label #hamburger span:nth-child(2) {
    
          -webkit-transition-delay: 0.125s;
        -ms-transition-delay: 0.125s;
        -moz-transition-delay: 0.125s;
        -o-transition-delay: 0.125s;
        transition-delay: 0.125s;
    }
    
      #nav-toggle:checked + #nav-toggle-label #hamburger span:nth-child(3) {
  
          -webkit-transition-delay: 0.25s;
        -ms-transition-delay: 0.25s;
        -moz-transition-delay: 0.25s;
        -o-transition-delay: 0.25s;
        transition-delay: 0.25s;
    }
  
    
    #cross {
      display: block;
        position: absolute;
                right: 28px;
        top: -5px;
        width: 40px;
        height: 40px;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -moz-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        transform: rotate(45deg);
    }
  
    #cross span {
        display: block;
        background: black;
        transition: 0.3s;
    }
  
    #cross span:nth-child(1) {
      height: 0%;
        width: 2px;
        position: absolute;
        top: 0;
        left: 50%;
        margin-left: -1px;
            -ms-transition-delay: 0s;
        -moz-transition-delay: 0s;
        -o-transition-delay: 0s;
        transition-delay: 0s;
  
    }
  
    #cross span:nth-child(2) {
      width: 0%;
        height: 2px;
        position: absolute;
        left: 0;
        top: 50%;
        margin-top: -1px;
            -webkit-transition-delay: 0.125s;
        -ms-transition-delay: 0.125s;
        -moz-transition-delay: 0.125s;
        -o-transition-delay: 0.125s;
        transition-delay: 0.125s;
    }
  
    #nav-toggle:checked + #nav-toggle-label #cross span:nth-child(1) {
      height: 100%;
        -webkit-transition-delay: 0s;
        -webkit-transition-delay: 0.5s;
        -ms-transition-delay: 0.5s;
        -moz-transition-delay: 0.5s;
        -o-transition-delay: 0.5s;
        transition-delay: 0.5s;
    }
  
    #nav-toggle:checked + #nav-toggle-label #cross span:nth-child(2) {
      width: 100%;
        -webkit-transition-delay: 0.625s;
        -ms-transition-delay: 0.625s;
        -moz-transition-delay: 0.625s;
        -o-transition-delay: 0.625s;
        transition-delay: 0.625s;
    }
  }
}
@media only screen and (max-width: 1300px) {
  header .top-nav {
    padding: 10px 20px;
  }
  header .top-nav-left img{
    width:140px;
  }
  header .top-nav .top-nav-left form {
    margin-left: 15px;
  }
}
@media only screen and (max-width: 1100px) {
  header .top-nav .top-nav-left form input[type=text] {
    width: 150px;
  }
}
@media only screen and (max-width: 1000px) {
  .mobile-nav {
    background-color: white;
    display: inline-block;
    position: absolute;
    padding: 20px;
    width: 190px;
    right: 0;
  }
  .top-nav .nav-location{display:none;}
  .mobile-nav li {
    padding: 10px 0;
    position: relative;
  }
  .mobile-nav li svg {
    position: absolute;
    top: 17px;
    right: 5px;
  }
  .mobile-nav li a:hover {
    cursor: pointer;
  }
  .mobile-nav li .sub-menu li {
    padding: 0 0 0 10px;
  }

  header .top-nav .top-nav-left form {
    margin-top: 12px;
  }

  header .top-nav .top-nav-right #nav-toggle {
    display: inline-block;
  }
  header .top-nav .top-nav-right .main-nav {
    display: none;
  }
  header .top-nav .top-nav-right .nav-location {
    margin-right: 70px;
    margin-top: 15px;
  }
  header .top-nav .top-nav-right #nav-toggle {
    position: fixed;
    top: 0;
    right: 0;
    -webkit-opacity: 0;
    -ms-opacity: 0;
    -moz-opacity: 0;
    -o-opacity: 0;
    opacity: 0;
  }
  header .top-nav .top-nav-right #nav-toggle-label {
    display: inline-block;
    height: 80px;
    width: 60px;
    position: fixed;
    z-index: 12;
    right: 0;
    top: 20px;
    -webkit-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
    cursor: pointer;
    -webkit-transition: 0.25s ease-in-out;
    -ms-transition: 0.25s ease-in-out;
    -moz-transition: 0.25s ease-in-out;
    -o-transition: 0.25s ease-in-out;
    transition: 0.25s ease-in-out;
  }
  header .top-nav .top-nav-right #hamburger {
    display: block;
    float: right;
    position: absolute;
    height: 28px;
    width: 40px;
    top: 0;
    right: 28px;
    color: black;
  }
  header .top-nav .top-nav-right #hamburger span {
    width: 100%;
    height: 2px;
    position: relative;
    margin: 0 0 11px 0;
    background: black;
    transition: width 0.3s;
    display: block;
  }
  header .top-nav .top-nav-right #hamburger span:nth-child(1) {
    -webkit-transition-delay: 0.5s;
    -ms-transition-delay: 0.5s;
    -moz-transition-delay: 0.5s;
    -o-transition-delay: 0.5s;
    transition-delay: 0.5s;
  }
  header .top-nav .top-nav-right #hamburger span:nth-child(2) {
    -webkit-transition-delay: 0.625s;
    -ms-transition-delay: 0.625s;
    -moz-transition-delay: 0.625s;
    -o-transition-delay: 0.625s;
    transition-delay: 0.625s;
  }
  header .top-nav .top-nav-right #hamburger span:nth-child(3) {
    -webkit-transition-delay: 0.75s;
    -ms-transition-delay: 0.75s;
    -moz-transition-delay: 0.75s;
    -o-transition-delay: 0.75s;
    transition-delay: 0.75s;
  }
  header .top-nav .top-nav-right #nav-toggle:checked + #nav-toggle-label #hamburger span {
    width: 0%;
  }
  header .top-nav .top-nav-right #nav-toggle:checked + #nav-toggle-label #hamburger span:nth-child(1) {
    -webkit-transition-delay: 0s;
    -ms-transition-delay: 0s;
    -moz-transition-delay: 0s;
    -o-transition-delay: 0s;
    transition-delay: 0s;
  }
  header .top-nav .top-nav-right #nav-toggle:checked + #nav-toggle-label #hamburger span:nth-child(2) {
    -webkit-transition-delay: 0.125s;
    -ms-transition-delay: 0.125s;
    -moz-transition-delay: 0.125s;
    -o-transition-delay: 0.125s;
    transition-delay: 0.125s;
  }
  header .top-nav .top-nav-right #nav-toggle:checked + #nav-toggle-label #hamburger span:nth-child(3) {
    -webkit-transition-delay: 0.25s;
    -ms-transition-delay: 0.25s;
    -moz-transition-delay: 0.25s;
    -o-transition-delay: 0.25s;
    transition-delay: 0.25s;
  }
  header .top-nav .top-nav-right #cross {
    display: block;
    position: absolute;
    right: 28px;
    top: -5px;
    width: 40px;
    height: 40px;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    transform: rotate(45deg);
  }
  header .top-nav .top-nav-right #cross span {
    display: block;
    background: black;
    transition: 0.3s;
  }
  header .top-nav .top-nav-right #cross span:nth-child(1) {
    height: 0%;
    width: 2px;
    position: absolute;
    top: 0;
    left: 50%;
    margin-left: -1px;
    -ms-transition-delay: 0s;
    -moz-transition-delay: 0s;
    -o-transition-delay: 0s;
    transition-delay: 0s;
  }
  header .top-nav .top-nav-right #cross span:nth-child(2) {
    width: 0%;
    height: 2px;
    position: absolute;
    left: 0;
    top: 50%;
    margin-top: -1px;
    -webkit-transition-delay: 0.125s;
    -ms-transition-delay: 0.125s;
    -moz-transition-delay: 0.125s;
    -o-transition-delay: 0.125s;
    transition-delay: 0.125s;
  }
  header .top-nav .top-nav-right #nav-toggle:checked + #nav-toggle-label #cross span:nth-child(1) {
    height: 100%;
    -webkit-transition-delay: 0s;
    -webkit-transition-delay: 0.5s;
    -ms-transition-delay: 0.5s;
    -moz-transition-delay: 0.5s;
    -o-transition-delay: 0.5s;
    transition-delay: 0.5s;
  }
  header .top-nav .top-nav-right #nav-toggle:checked + #nav-toggle-label #cross span:nth-child(2) {
    width: 100%;
    -webkit-transition-delay: 0.625s;
    -ms-transition-delay: 0.625s;
    -moz-transition-delay: 0.625s;
    -o-transition-delay: 0.625s;
    transition-delay: 0.625s;
  }
}
@media only screen and (max-width: 670px) {
  header .top-nav .top-nav-left form {
    display: block;
    margin-left: 0;
  }

  header .top-nav .top-nav-right .nav-location {
    right: 0;
    bottom: -75px;
    position: relative;
    margin: 0;
  }

  header .top-nav {
    min-height: 75px;
  }
}
    
  


</style>
<header>
    <div class="top-nav clearfix">
      <div class="top-nav-left">
          <a href="/"><img src="{{ asset('img/logo.png') }}"></a>
          @if (! (request()->is('/')))
          @include('partials.menus.search')
          @endif
      </div>
      <div class="top-nav-right">
            <div class="nav-location">
                @if($state) 
                    <a id="user-location">{{ $city }}, {{ $state }}</a>
                @else
                    <a id="user-location">{{ $city }}, {{ $country }}</a>
                @endif
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path style="fill: #12A8DE" d="M12 0c-4.198 0-8 3.403-8 7.602 0 4.198 3.469 9.21 8 16.398 4.531-7.188 8-12.2 8-16.398 0-4.199-3.801-7.602-8-7.602zm0 11c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3-1.343 3-3 3z"/></svg>
                <div id="location-dropdown">
                    <button id="current-location">Get Current Location</button>
                    <a id="city-input-toggle">Enter City</a>
                    <div id="city-input-container">
                            <p id="close-btn">&times;</p>
                            <label for="city-input" required>City*</label>
                            <input type="text" placeholder="Enter city" id="city-input">
                            <p id="nav-error-message">The city name is invalid.</p>
                            <label for="state-input">State</label>
                            <input type="text" placeholder="Enter state" id="state-input">
                            <button type="submit" id="change-location">Change Location</button>
                    </div>
                </div>
            </div>
                <ul class="main-nav">
                    <li>
                        <a href="/about">Why Tix4Cause?</a>
                    </li>
                    <li>
                        <a href="/searchEvents?category=concerts">Concerts</a>
                        <ul class="sub-menu wide concerts">
                            <li><a href="/searchEvents?category=country">Country</a></li>
                            <li><a href="/searchEvents?category=pop">Pop</a></li>
                            <li><a href="/searchEvents?category=rock">Rock</a></li>
                            <li><a href="/searchEvents?category=rap-hip-hop">Rap/Hip Hop</a></li>
                            <li><a href="/searchEvents?category=comedy">Comedy</a></li>
                            <li>
                                <a href="">Other</a>
                                <ul class="sub-submenu">
                                    <li><a href="/searchEvents?category=r-and-b">R&B</a></li>
                                    <li><a href="/searchEvents?category=children-and-family">Children & Family</a></li>
                                    <li><a href="/searchEvents?category=alternative">Alternative</a></li>
                                    <li><a href="/searchEvents?category=festival-tour">Festival/Tour</a></li>
                                    <li><a href="/searchEvents?category=jazz-blues">Jazz/Blues</a></li>
                                    <li><a href="/searchEvents?category=latin">Latin</a></li>
                                    <li><a href="/searchEvents?category=classical">Classical</a></li>
                                    <li><a href="/searchEvents?category=holiday">Holiday</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/searchEvents?category=sports">Sports</a>
                        <ul class="sub-menu wide sports">
                            <li><a href="/searchEvents?category=nfl">NFL</a></li>
                            <li><a href="/searchEvents?category=nba">NBA</a></li>
                            <li><a href="/searchEvents?category=mlb">MLB</a></li>
                            <li><a href="/searchEvents?category=nhl">NHL</a></li>
                            <li><a href="/searchEvents?category=ncaaf">NCAAF</a></li>
                            <li>
                                <a href="">Other</a>
                                <ul class="sub-submenu">
                                    <li><a href="/searchEvents?category=ncaab">NCAAB</a></li>
                                    <li><a href="/searchEvents?category=soccer">Soccer</a></li>
                                    <li><a href="/searchEvents?category=wwe">WWE</a></li>
                                    <li><a href="/searchEvents?category=pga">PGA</a></li>
                                    <li><a href="/searchEvents?category=nascar">NASCAR</a></li>
                                    <li><a href="/searchEvents?category=mma">MMA</a></li>
                                    <li><a href="/searchEvents?category=boxing">Boxing</a></li>
                                    <li><a href="/searchEvents?category=tennis">Tennis</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/searchEvents?category=arts-and-theater">Arts & Theater</a>
                        <ul class="sub-menu arts-theater">
                            <li><a href="/searchEvents?category=broadway">Broadway</a></li>
                            <li><a href="/searchEvents?category=children-family">Children/Family</a></li>
                            <li><a href="/searchEvents?category=musical-play">Musical/Play</a></li>
                            <li><a href="/searchEvents?category=opera">Opera</a></li>
                            <li><a href="/searchEvents?category=ballet-and-dance">Ballet & Dance</a></li>
                            <li><a href="/searchEvents?category=off-broadway">Off-Broadway</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/searchEvents?category=other-tickets">Other Tickets</a>
                        <ul class="sub-menu other-tickets">
                                <li><a href="/searchEvents?category=las-vegas-shows">Las Vegas Shows</a></li>
                                <li><a href="/searchEvents?category=fairs-festivals">Fairs/Festivals</a></li>
                                <li><a href="/searchEvents?category=circus">Circus</a></li>
                                <li><a href="/searchEvents?category=magic-shows">Magic Shows</a></li>
                                <li><a href="/searchEvents?category=lecture">Lecture</a></li>
                            </ul>
                    </li>
                </ul>
                <input type="checkbox" id="nav-toggle"/>
                <label id="nav-toggle-label" for="nav-toggle">
                    <div id="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div id="cross">
                        <span></span>
                        <span></span>
                    </div>
                </label>
                <ul class="mobile-nav" id="mobile" style="display:none;">
                    <li>
                        <p id="user-location" style="margin-bottom:0;">{{ $city }}, {{ $state }}</a>
                    </li>
                    <li>
                        <a href="/about">Why Tix4Cause?</a>
                    </li>
                    
                    </li>
                    <li>
                        <a class="subnav-toggle" data-category="concerts">Concerts<svg id="svg-concerts" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path style="fill:#12A8DE" d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z"/></svg></a>
                        <ul class="sub-menu" id="submenu-concerts">
                            <li><a href="/searchEvents?category=country">Country</a></li>
                            <li><a href="/searchEvents?category=pop">Pop</a></li>
                            <li><a href="/searchEvents?category=rock">Rock</a></li>
                            <li><a href="/searchEvents?category=rap-hip-hop">Rap/Hip Hop</a></li>
                            <li><a href="/searchEvents?category=comedy">Comedy</a></li>
                            <li><a href="/searchEvents?category=r-and-b">R&B</a></li>
                            <li><a href="/searchEvents?category=children-and-family">Children & Family</a></li>
                            <li><a href="/searchEvents?category=alternative">Alternative</a></li>
                            <li><a href="/searchEvents?category=festival-tour">Festival/Tour</a></li>
                            <li><a href="/searchEvents?category=jazz-blues">Jazz/Blues</a></li>
                            <li><a href="/searchEvents?category=latin">Latin</a></li>
                            <li><a href="/searchEvents?category=classical">Classical</a></li>
                            <li><a href="/searchEvents?category=holiday">Holiday</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="subnav-toggle" data-category="sports">Sports<svg id="svg-sports" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path style="fill:#12A8DE" d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z"/></svg></a>
                        <ul class="sub-menu" id="submenu-sports">
                            <li><a href="/searchEvents?category=nfl">NFL</a></li>
                            <li><a href="/searchEvents?category=nba">NBA</a></li>
                            <li><a href="/searchEvents?category=mlb">MLB</a></li>
                            <li><a href="/searchEvents?category=nhl">NHL</a></li>
                            <li><a href="/searchEvents?category=ncaaf">NCAAF</a></li>
                            <li><a href="/searchEvents?category=ncaab">NCAAB</a></li>
                            <li><a href="/searchEvents?category=soccer">Soccer</a></li>
                            <li><a href="/searchEvents?category=wwe">WWE</a></li>
                            <li><a href="/searchEvents?category=pga">PGA</a></li>
                            <li><a href="/searchEvents?category=nascar">NASCAR</a></li>
                            <li><a href="/searchEvents?category=mma">MMA</a></li>
                            <li><a href="/searchEvents?category=boxing">Boxing</a></li>
                            <li><a href="/searchEvents?category=tennis">Tennis</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="subnav-toggle" data-category="arts">Arts & Theater<svg id="svg-arts" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path style="fill:#12A8DE" d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z"/></svg></a>
                        <ul class="sub-menu" id="submenu-arts">
                            <li><a href="/searchEvents?category=broadway">Broadway</a></li>
                            <li><a href="/searchEvents?category=children-family">Children/Family</a></li>
                            <li><a href="/searchEvents?category=musical-play">Musical/Play</a></li>
                            <li><a href="/searchEvents?category=opera">Opera</a></li>
                            <li><a href="/searchEvents?category=ballet-and-dance">Ballet & Dance</a></li>
                            <li><a href="/searchEvents?catesgory=off-broadway">Off-Broadway</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="subnav-toggle" data-category="other">Other Tickets<svg id="svg-other" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path style="fill:#12A8DE" d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z"/></svg></a>
                        <ul class="sub-menu" id="submenu-other">
                                <li><a href="/searchEvents?category=las-vegas-shows">Las Vegas Shows</a></li>
                                <li><a href="/searchEvents?category=fairs-festivals">Fairs/Festivals</a></li>
                                <li><a href="/searchEvents?category=circus">Circus</a></li>
                                <li><a href="/searchEvents?category=magic-shows">Magic Shows</a></li>
                                <li><a href="/searchEvents?category=lecture">Lecture</a></li>
                            </ul>
                    </li>
                </ul>
          </div>
        </div> <!-- end top-nav -->
    </header>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
    // mobile menu
    $('#nav-toggle-label').click(toggleMenu);
    $('.subnav-toggle').click(function(){
       var category = $(this).attr('data-category');
       if ($(`#submenu-${category}`).css('display') === 'none') {
           $('#mobile .sub-menu').hide();
           $('.subnav-toggle svg').css('transform', 'rotate(0)');
           $(`#submenu-${category}`).show();
           $(`#svg-${category}`).css('transform', 'rotate(180deg)');
       } else {
            $(`#submenu-${category}`).hide();
            $(`#svg-${category}`).css('transform', 'rotate(0)');
       }
    });
    $(window).resize(function() {
        if ($('#mobile')[0].style.display === 'inline-block') {
            $('#nav-toggle-label').click();
        }
    });
    function toggleMenu() {
        var mobileMenu = $('#mobile')[0];
        if (mobileMenu.style.display === "none") {
            mobileMenu.style.display = "inline-block";
        } else {
            mobileMenu.style.display = "none";
            $('#mobile .sub-menu').hide();
            $('.subnav-toggle svg').css('transform', 'rotate(0)');
        }
    }
    // if local storage values exist, replace the location in nav with it
    if (window.localStorage.getItem('city')) {
        var userCity = window.localStorage.getItem('city');
        var userState = window.localStorage.getItem('state');
        var userCountry = window.localStorage.getItem('country');
        !!userState ? $('#user-location').html(`${userCity}, ${userState}, ${userCountry}`) : $('#user-location').html(`${userCity}, ${userCountry}`);
    }
    // CURRENT LOCATION FINDER
    $('#current-location').click(function(e){
        e.preventDefault();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        jQuery.ajax({
            url: "{{ url('/currentlocation') }}",
                  method: 'post',
                  data: {
                     _token: CSRF_TOKEN,
                  },
                  success: function(result){
                      // close the div
                      $('#location-dropdown').hide();
                      // reflect it in the navigation
                      if (result['state']) {
                        $('#user-location').html(result['city'] + ', ' + result['state']);
                      } else {
                        $('#user-location').html(result['city'] + ', ' + result['country']);
                      }
                      // store in local storage
                      window.localStorage.setItem('city', result['city']);
                      window.localStorage.setItem('country', result['country']);
                      if (result['state']) {
                          window.localStorage.setItem('state', result['state']);
                      }
                  }
                     
        });
    });
    // EDIT LOCATION DROPDOWN
    // open and close dropdown on click
    $('#user-location').click(function(){
        $('#location-dropdown').toggle();
    });
    // INPUT LOCATION FINDER
    // open finder on click
    $('#city-input-toggle').click(function(){
        $('#city-input-container').show();
    });
    // close finder on click
    $('#close-btn').click(function(){
        $('#city-input-container').hide();
    })
    // functionality
    $('#change-location').click(function(e){
        e.preventDefault();
        var cityInput = $('#city-input').val();
        var stateInput = $('#state-input').val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        jQuery.ajax({
            url: "{{ url('/inputlocation') }}",
                  method: 'post',
                  data: {
                     _token: CSRF_TOKEN,
                     'cityInput': cityInput,
                     'stateInput': stateInput,
                  },
                  success: function(result){
                        if (result['city']) {
                            // reflect it in the navigation
                            if (result['state']) {
                                $('#user-location').html(result['city'] + ', ' + result['state']);
                            } else {
                                $('#user-location').html(result['city'] + ', ' + result['country']);
                            }
                            // store in local storage
                            window.localStorage.setItem('city', result['city']);
                            window.localStorage.setItem('country', result['country']);
                            if (result['state']) {
                                window.localStorage.setItem('state', result['state']);
                            }
                            // close div and remove any error indications
                            $('#nav-error-message').hide();
                            $('#city-input').removeClass('error-input');
                            $('#city-input-container').hide();
                            $('#location-dropdown').hide();
                        } else {
                            // display error message and error styling
                            $('#nav-error-message').show();
                            $('#city-input').addClass('error-input');
                        }
                  },
                  error: function(result){
                    console.log(result);
                  }
        });
    });
</script>