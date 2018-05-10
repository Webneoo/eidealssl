<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3">
                <h1> INFORMATION </h1>
                <a href="{{ route('terms_path') }}">Terms & Conditions</a><br/>
                <a href="{{ route('privacy_path') }}">Privacy Policy</a><br/>
                <a href="{{ route('disclaimer_path') }}">Disclaimer</a><br/>  
                <a href="{{ route('about_us_path') }}">About us</a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 second_sub_footer">
                <h1> EIDEAL </h1>
                <a href="{{ route('all_products_path') }}">Products</a><br/>
                <a href="{{ route('brands_path', array($menu_brands[0]->brand_id, $menu_brands[0]->brand_title)) }}">Brands</a><br/>     
                <a href="{{ route('eteam_path') }}">E-Team</a><br/>           
                <a href="{{ route('videos_path') }}">Videos</a><br/>
                <a href="{{ route('news_path') }}">News</a>
                
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
                <h1> LEARN MORE </h1>
                <!-- <a href="{{ route('where_to_buy_path',0) }}">WHERE TO BUY</a><br/> -->
                <a href="{{ route('service_path', $menu_services[0]->service_id) }}">Services</a><br/>
                <a href="{{ route('contact_us_path') }}">Contact Us</a><br/>
                <a href="{{ route('contact_us_path') }}#careers">Careers</a><br/>
                <a href="{{ route('faq_path') }}">FAQs</a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
                <h1> FOLLOW US </h1>
                <a class="sm_links" target="_blank" href="https://instagram.com/eidealonline/"><i class="fa fa-3x fa-instagram" style="color:white;"></i></a>
                <a class="sm_links" target="_blank" href="https://www.facebook.com/EidealOnline"> <i class="fa fa-3x fa-facebook-square" style="color:white;"></i></a>
                <a class="sm_links" target="_blank" href="https://www.snapchat.com/add/eideal"><i class="fa fa-3x fa-snapchat-square" style="color:white;"></i></a>
                <a class="sm_links" target="_blank" href="https://www.youtube.com/user/eidealonline/"><i class="fa fa-3x fa-youtube-square" style="color:white;"></i></a>
                <a class="sm_links" target="_blank" href="https://www.linkedin.com/in/eideal"><i class="fa fa-3x fa-linkedin-square" style="color:white;"></i></a>
                <a class="sm_links" target="_blank" href="https://twitter.com/eidealonline"><i class="fa fa-3x fa-twitter-square" style="color:white;"></i></a>
                <a class="sm_links" target="_blank" href="https://eidealonline.wordpress.com/"><i class="fa fa-3x fa-wordpress" style="color:white;"></i></a>

                <h1 style="font-size:15px;">PAYMENT METHODS</h1>
                <div>
                    <img style="height:35px;" src="images/visa-mastercard-paypal.png" alt="Eideal | secured payment | Payment Method | visa | paypal | master card" title="Eideal Payement method">
                </div>
                 <div class="copyright">Copyright © 2017 <a target="_blank" class="webneoo_link" style="text-decoration: underline;" href="https://webneoo.com">webneoo</a>.</div>
            </div>
        </div>

    </div>

</footer>