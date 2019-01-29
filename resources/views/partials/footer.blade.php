<style>
@media only screen and (min-width:601px){
    .mobile-footer{
        display:none !important;
    }
}
@media only screen and (max-width:600px){
    .mobile-footer{
        display:flex !important;
    }
    .desktop-footer{
        display:none !important;
    }
}
</style>
<footer class="clearfix">
    <div class="footer-main">
        <div class="footer-left">
            <a href="/"><img src="{{ asset('img/logo.png') }}"></a>
            <p>Tix4Cause is a ticket exchange where every purchase does good in the community. Our social enterprise allows you to shop millions of tickets, and with every purchase, we donate 50% of our earnings to the cause of your choice. </p>
            <ul class="desktop-footer">
                <li><a href="/about">About Us</a></li>
                <li><a href="/faq">FAQ</a></li>

                <li><a href="/search?category=concerts">Concerts</a></li>
                <li><a href="/search?category=arts-and-theater">Arts & Theater</a></li>
                <li><a href="/contact">Contact</a></li>
                <li><a href="/search">Search</a></li>
                <li><a href="/search?category=sports">Sports</a></li>
                <li><a href="/search?category=other-tickets">Other Tickets</a></li>
                <li><a href="/blog">News + Updates</a></li>
            </ul>
            <ul class="mobile-footer">
                <li><a href="/about">About Us</a></li>
                <li><a href="/search?category=concerts">Concerts</a></li>
                <li><a href="/faq">FAQ</a></li>
                <li><a href="/search?category=arts-and-theater">Arts & Theater</a></li>
                <li><a href="/contact">Contact</a></li>
                <li><a href="/search?category=sports">Sports</a></li>
                <li><a href="/search">News + Updates</a></li>
                
                <li><a href="/search?category=other-tickets">Other Tickets</a></li>
                <li><a href="/blog">Inspiring Stories</a></li>
            </ul>
            <p class="highlight-text">Join the crowd. Be the change.</p>
            <div class="footer-social">
                <a class="social" href="https://twitter.com/tix4cause" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                <a class="social" href="https://www.facebook.com/Tix4cause-668727526487607/" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg></a>
                <!--<a class="social" href="https://www.instagram.com/tix4cause/" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>-->
            </div>
        </div>
        <div class="footer-right">
            <p>Subscribe to our email newsletter for event updates, special offers, inspiring stories, and more!</p>
            <div id="mc_embed_signup" class="clearfix">
                <form id="mc-embedded-subscribe-form" class="validate" action="https://tix4cause.us8.list-manage.com/subscribe/post?u=3767fe17154b5912e946a8b28&amp;id=d9b9972639" method="post" name="mc-embedded-subscribe-form" novalidate="novalidate" target="_blank">
                <div id="mc_embed_signup_scroll">
                <div class="mc-field-group">
                <p><!--<label for="mce-EMAIL">Email Address </label>--><br />
                <input id="mce-EMAIL" class="required email mce_inline_error" name="EMAIL" type="email" value="" placeholder="EMAIL" aria-required="true" aria-invalid="true" /></p>
                <div class="mce_inline_error"></div>
                </div>
                <div id="mce-responses">
                <div id="mce-error-response" class="response" style="display: none;"></div>
                <div id="mce-success-response" class="response" style="display: none;"></div>
                </div>
                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input tabindex="-1" name="b_3767fe17154b5912e946a8b28_d9b9972639" type="text" value="" /></div>
                <div class="actions"><input id="mc-embedded-subscribe" class="button" name="subscribe" type="submit" value="Sign Me Up" /></div>
                </div>
                </form>
            </div>
            <h2>Interested in donating tickets?</h2>
            <p>Tix4Cause also provides individuals and companies the ability to donate tickets to benefit the cause of their choice. These tickets are offered exclusively through Tix4Cause, with 100% of the ticket value benefitting the cause.</p>
            <a href="/contact?subject=Donate Tickets" class="yellow-btn">Learn More</a>
        </div>
    </div>
    <div class="sub-footer">
            <p>&#169; 2018 Tix4Cause, LLC All Rights Reserved <a href="/terms">Terms & Conditions</a><a href="/privacy">Privacy Policy</a></p>
    </div>
</footer>
