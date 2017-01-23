<?php


use GuzzleHttp\Message\Request;
use Illuminate\Support\Facades\Session;


/* ------------------- HOME  ---------------*/

Route::get('/', [
    'as' => 'home_path',
    'uses' => 'HomeController@index'
]);


Route::post('/', [
    'as' => 'home_newsletters_signup',
    'uses' => 'HomeController@newlettersSignup'
]);


Route::get('about-us', [
    'as' => 'about_us_path',
    'uses' => 'HomeController@aboutUs'
]);


Route::post('where-to-buy-{country_id}', [
    'as' => 'where_to_buy_path',
    'uses' => 'HomeController@whereToBuySearch'
]);

Route::get('where-to-buy-{country_id}', [
    'as' => 'where_to_buy_path',
    'uses' => 'HomeController@whereToBuy'
]);


Route::get('e-team', [
    'as' => 'eteam_path',
    'uses' => 'HomeController@eteam'
]);




/* ------------------- CONTACT  ---------------*/


Route::get('contact-us', [
    'as' => 'contact_us_path',
    'uses' => 'ContactController@index'
]);

Route::post('contact-us', [
    'as' => 'contact_us_path',
    'uses' => 'ContactController@index'
]);

Route::post('cv-contact-us', [
    'as' => 'send_cv_path',
    'uses' => 'ContactController@sendCv'
]);



/* ------------------- USERS  ---------------*/

Route::get('sign-up', [
    'as' => 'sign_up_path',
    'uses' => 'UsersController@signUp'
]);


Route::post('success-sign-up', [
    'as' => 'confirm_sign_up_path',
    'uses' => 'UsersController@create'
]);


Route::get('my-account', [
    'as' => 'my_account_path',
    'uses' => 'UsersController@index'
]);

Route::get('edit-my-account', [
    'as' => 'edit_my_account_path',
    'uses' => 'UsersController@edit'
]);

Route::post('edit-my-account', [
    'as' => 'edit_my_account_path',
    'uses' => 'UsersController@update'
]);



/* ------------------- PRODUCTS  ---------------*/

Route::post('products', [
    'as' => 'products_path_search',
    'uses' => 'ProductController@productSearch'
]);


Route::get('products-{id}-{order}', [
    'as' => 'products_path',
    'uses' => 'ProductController@indexOrder'
]);


Route::get('products-{id}', [
    'as' => 'products_path',
    'uses' => 'ProductController@index'
]);



Route::post('products-{id}', [
    'as' => 'products_path',
    'uses' => 'ProductController@index'
]);


Route::get('all-products', [
    'as' => 'all_products_path',
    'uses' => 'ProductController@allProducts'
]);



Route::get('details-products-{product_id}-{id}-{quoteCurrency}',[
    'as' => 'products_details_path',
    'uses' => 'ProductController@productDetails'
    ]);


Route::post('details-products-{product_id}-{id}-{quoteCurrency}',[
    'as' => 'products_details_path',
    'uses' => 'ProductController@productDetails'
    ]);


/* ------------------- NEWS  ---------------*/


Route::get('news-{news_date}',[
    'as' => 'news_path',
    'uses' => 'NewController@index'
    ]);

Route::get('display-news-{id}',[
    'as' => 'display_news_path',
    'uses' => 'NewController@display'
    ]);


/* ------------------- VIDEOS  ---------------*/


Route::get('videos',[
    'as' => 'videos_path',
    'uses' => 'VideoController@index'
    ]);


/* ------------------- CART  ---------------*/

Route::get('shopping-cart',[
    'as' => 'cart_path',
    'uses' => 'CartController@index'
]);


Route::get('checkout',[
    'as' => 'checkout_path',
    'uses' => 'CartController@checkout'
]);

Route::post('place-your-order',[
    'as' => 'place_your_order_path',
    'uses' => 'CartController@placeOrder'
]);


Route::post('apply-promo-code',[
    'as' => 'apply_promo_code_path',
    'uses' => 'CartController@applyPromoCode'
]);


Route::get('shopping-cart-{product_id}',[
    'as' => 'cart_path_product',
    'uses' => 'CartController@store'
]);

Route::get('remove-shopping-cart-{product_id}',[
    'as' => 'remove_one_item_from_cart_path',
    'uses' => 'CartController@remove'
]);


Route::get('delete-item-{product_id}-{product_code}',[
    'as' => 'delete_cart_item_path',
    'uses' => 'CartController@delete'
]);


Route::get('destroy-cart',[
    'as' => 'destroy_cart_path',
    'uses' => 'CartController@destroy'
]);

Route::post('cash-on-delivery',[
    'as' => 'cash_on_delivery_path',
    'uses' => 'CartController@cashOndelivery'
]);

Route::get('buy-product-results',[
    'as' => 'buy_result_path',
    'uses' => 'CartController@buy'
]);

Route::get('bank-audi-response',[
    'as' => 'bank_audi_response_path',
    'uses' => 'CartController@bankAudiResponse'
]);

Route::get('paypal-response',[
    'as' => 'paypal_response_path',
    'uses' => 'CartController@paypalResponse'
]);



/* ------------------- SIGNIN  ---------------*/

Route::get('sign-in',[
    'as' => 'sign_in_path',
    'uses' => 'SignInController@index'
    ]);

Route::post('sign-in', [
    'as' => 'sign_in_path',
    'uses' => 'SignInController@signIn'
]);

/* ------------------- SIGNIN  ---------------*/





Route::get('password-forgotten-step1',[
    'as' => 'password_forgotten_step_1_path',
    'uses' => 'PasswordForgottenController@index'
    ]);


Route::post('password-forgotten-step2',[
    'as' => 'password_forgotten_step_2_path',
    'uses' => 'PasswordForgottenController@reset'
]);




/* ------------------- PRIVACY  ---------------*/

Route::get('privacy',[
    'as' => 'privacy_path',
    'uses' => 'PrivacyController@index'
    ]);

/* ------------------- DISCLAIMER   ---------------*/

Route::get('disclaimer',[
    'as' => 'disclaimer_path',
    'uses' => 'DisclaimerController@index'
    ]);

/* ------------------- TERMS   ---------------*/

Route::get('terms',[
    'as' => 'terms_path',
    'uses' => 'TermsController@index'
    ]);

/* ------------------- BRANDS   ---------------*/

Route::get('brands-{brand_id}',[
    'as' => 'brands_path',
    'uses' => 'BrandController@index'
    ]);


/* ------------------- SERVICES   ---------------*/

Route::get('service-{service_id}',[
    'as' => 'service_path',
    'uses' => 'ServiceController@index'
    ]);



/* ------------------- FAQ  ---------------*/

Route::get('faq',[
    'as' => 'faq_path',
    'uses' => 'TermsController@faq'
    ]);


Route::post('/currency-convert', [
    'as' => 'currency_convert_path',
    'uses' => 'CurrencyController@index'
]);











/* ------------------------------------------------------
----------------- CONTENT MANAGEMENT SYSTEM -------------
--------------------------------------------------------- */


Route::get('/admin', [
    'as' => 'admin_cms_path',
    'uses' => 'SessionsController@create'
]);

Route::post('/admin', [
    'as' => 'admin_cms_path',
    'uses' => 'SessionsController@store'
]);


/* -------------
HOME MANAGEMENT
------------ */

Route::get('/home-management', [
    'before' => 'auth',
    'as' => 'home_management_path',
    'uses' => 'HomeController@showSlideShow'
]);


Route::get('/create-slideshow', [
    'before' => 'auth',
    'as' => 'create_slideshow_path',
    'uses' => 'HomeController@createSlideShow'
]);

Route::post('/create-slideshow', [
    'before' => 'auth',
    'as' => 'create_slideshow_path',
    'uses' => 'HomeController@addSlideShow'
]);

Route::get('/edit-slideshow-{id}', [
    'before' => 'auth',
    'as' => 'edit_slideshow_path',
    'uses' => 'HomeController@editSlideShow'
]);

Route::post('/edit-slideshow-{id}', [
    'before' => 'auth',
    'as' => 'edit_slideshow_path',
    'uses' => 'HomeController@updateSlideShow'
]);

Route::get('/delete-slideshow-{id}', [
    'before' => 'auth',
    'as' => 'delete_slideshow_path',
    'uses' => 'HomeController@deleteSlideShow'
]);


Route::get('/edit-eteam', [
    'before' => 'auth',
    'as' => 'edit_eteam_path',
    'uses' => 'HomeController@showEteam'
]);


Route::post('/edit-eteam', [
    'before' => 'auth',
    'as' => 'edit_eteam_path',
    'uses' => 'HomeController@updateEteam'
]);



/* -------------
ABOUT US MANAGEMENT
------------ */

Route::get('/edit-about-us', [
    'before' => 'auth',
    'as' => 'edit_about_us_path',
    'uses' => 'HomeController@editAboutUs'
]);

Route::post('/edit-about-us', [
    'before' => 'auth',
    'as' => 'edit_about_us_path',
    'uses' => 'HomeController@updateAboutUs'
]);


/* -------------
WHERE TO BUY MANAGEMENT
------------ */

Route::post('/cms-where-to-buy-{country_id}', [
    'before' => 'auth',
    'as' => 'where_to_buy_management_path',
    'uses' => 'HomeController@showSearch'
]);

Route::get('/cms-where-to-buy-{country_id}', [
    'before' => 'auth',
    'as' => 'where_to_buy_management_path',
    'uses' => 'HomeController@show'
]);

Route::get('/create-store-locator-{country_id}', [
    'before' => 'auth',
    'as' => 'create_store_locator_path',
    'uses' => 'HomeController@create'
]);

Route::post('/create-store-locator-{country_id}', [
    'before' => 'auth',
    'as' => 'create_store_locator_path',
    'uses' => 'HomeController@add'
]);

Route::get('/edit-store-locator-{id}-{country_id}', [
    'before' => 'auth',
    'as' => 'edit_store_locator_path',
    'uses' => 'HomeController@edit'
]);

Route::post('/edit-store-locator-{id}-{country_id}', [
    'before' => 'auth',
    'as' => 'edit_store_locator_path',
    'uses' => 'HomeController@update'
]);

Route::get('/delete-store-locator-{id}-{country_id}', [
    'before' => 'auth',
    'as' => 'delete_store_locator_path',
    'uses' => 'HomeController@delete'
]);




/* -------------
PRODUCTS MANAGEMENT
------------ */

Route::get('/admin-products', [
    'before' => 'auth',
    'as' => 'products_management_path',
    'uses' => 'ProductController@show'
]);

Route::get('/create-products', [
    'before' => 'auth',
    'as' => 'create_products_path',
    'uses' => 'ProductController@create'
]);

Route::post('/create-products', [
    'before' => 'auth',
    'as' => 'create_products_path',
    'uses' => 'ProductController@add'
]);

Route::get('/edit-products-{id}', [
    'before' => 'auth',
    'as' => 'edit_products_path',
    'uses' => 'ProductController@edit'
]);

Route::post('/edit-products-{id}', [
    'before' => 'auth',
    'as' => 'edit_products_path',
    'uses' => 'ProductController@update'
]);

Route::get('/delete-products-{id}', [
    'before' => 'auth',
    'as' => 'delete_products_path',
    'uses' => 'ProductController@delete'
]);



/* -------------
BEST SELLER MANAGEMENT
------------ */

Route::get('/best-seller-management', [
    'before' => 'auth',
    'as' => 'best_seller_management_path',
    'uses' => 'ProductController@showBestSeller'
]);


Route::post('/best-seller-management', [
    'before' => 'auth',
    'as' => 'best_seller_management_path',
    'uses' => 'ProductController@changeBestSeller'
]);


/* -------------
BEST SELLER MANAGEMENT
------------ */

Route::get('/product-of-the-month-management', [
    'before' => 'auth',
    'as' => 'product_of_the_month_management_path',
    'uses' => 'ProductController@showProductOfTheMonth'
]);


Route::post('/product-of-the-month-management', [
    'before' => 'auth',
    'as' => 'product_of_the_month_management_path',
    'uses' => 'ProductController@changeProductOfTheMonth'
]);


/* -------------
PRODUCTS CATEGORY MANAGEMENT
------------ */

Route::get('/management-products-category', [
    'before' => 'auth',
    'as' => 'products_category_management_path',
    'uses' => 'ProductController@showProductsCategory'
]);


Route::get('/edit-the-product-category-{sub_category_id}', [
    'before' => 'auth',
    'as' => 'edit_products_category_path',
    'uses' => 'ProductController@editProductCategory'
]);

Route::post('/edit-the-product-category-{sub_category_id}', [
    'before' => 'auth',
    'as' => 'edit_products_category_path',
    'uses' => 'ProductController@updateProductCategory'
]);



/* -------------
NEWS MANAGEMENT
------------ */

Route::get('/cms-news-management', [
    'before' => 'auth',
    'as' => 'news_management_path',
    'uses' => 'NewController@show'
]);

Route::get('/create-news', [
    'before' => 'auth',
    'as' => 'create_news_path',
    'uses' => 'NewController@create'
]);

Route::post('/create-news', [
    'before' => 'auth',
    'as' => 'create_news_path',
    'uses' => 'NewController@add'
]);

Route::get('/edit-news-{id}', [
    'before' => 'auth',
    'as' => 'edit_news_path',
    'uses' => 'NewController@edit'
]);

Route::post('/edit-news-{id}', [
    'before' => 'auth',
    'as' => 'edit_news_path',
    'uses' => 'NewController@update'
]);

Route::get('/delete-news-{id}', [
    'before' => 'auth',
    'as' => 'delete_news_path',
    'uses' => 'NewController@delete'
]);



/* -------------
VIDEOS MANAGEMENT
------------ */

Route::get('/cms-video-management', [
    'before' => 'auth',
    'as' => 'video_management_path',
    'uses' => 'VideoController@show'
]);

Route::get('/create-video', [
    'before' => 'auth',
    'as' => 'create_video_path',
    'uses' => 'VideoController@create'
]);

Route::post('/create-video', [
    'before' => 'auth',
    'as' => 'create_video_path',
    'uses' => 'VideoController@add'
]);

Route::get('/edit-video-{id}', [
    'before' => 'auth',
    'as' => 'edit_video_path',
    'uses' => 'VideoController@edit'
]);

Route::post('/edit-video-{id}', [
    'before' => 'auth',
    'as' => 'edit_video_path',
    'uses' => 'VideoController@update'
]);

Route::get('/delete-video-{id}', [
    'before' => 'auth',
    'as' => 'delete_video_path',
    'uses' => 'VideoController@delete'
]);




/* -------------
MEDIAS MANAGEMENT
------------ */

Route::get('/medias-management', [
    'before' => 'auth',
    'as' => 'medias_management_path',
    'uses' => 'MediaController@show'
]);


Route::get('/create-media', [
    'before' => 'auth',
    'as' => 'create_media_path',
    'uses' => 'MediaController@create'
]);

Route::post('/create-media', [
    'before' => 'auth',
    'as' => 'create_media_path',
    'uses' => 'MediaController@add'
]);

Route::get('/edit-media-{id}', [
    'before' => 'auth',
    'as' => 'edit_media_path',
    'uses' => 'MediaController@edit'
]);

Route::post('/edit-media-{id}', [
    'before' => 'auth',
    'as' => 'edit_media_path',
    'uses' => 'MediaController@update'
]);

Route::get('/delete-media-{id}', [
    'before' => 'auth',
    'as' => 'delete_media_path',
    'uses' => 'MediaController@delete'
]);



/* -------------
BRAND MANAGEMENT
------------ */

Route::get('/cms-brands-management', [
    'before' => 'auth',
    'as' => 'brands_management_path',
    'uses' => 'BrandController@show'
]);



Route::get('/create-brand', [
    'before' => 'auth',
    'as' => 'create_brand_path',
    'uses' => 'BrandController@createBrand'
]);

Route::post('/create-brand', [
    'before' => 'auth',
    'as' => 'create_brand_path',
    'uses' => 'BrandController@add'
]);


Route::get('/edit-brand-details-{id}', [
    'before' => 'auth',
    'as' => 'edit_brand_details_path',
    'uses' => 'BrandController@editDetails'
]);

Route::post('/edit-brand-details-{id}', [
    'before' => 'auth',
    'as' => 'edit_brand_details_path',
    'uses' => 'BrandController@updateDetails'
]);

Route::get('/delete-brand-{id}', [
    'before' => 'auth',
    'as' => 'delete_brand_path',
    'uses' => 'BrandController@delete_brand'
]);


Route::get('/show-brand-slideshow-{id}', [
    'before' => 'auth',
    'as' => 'show_brand_slideshow_path',
    'uses' => 'BrandController@showBrandSlideShow'
]);


Route::get('/create-brand-slideshow-{brand_id}', [
    'before' => 'auth',
    'as' => 'create_brand_slideshow_path',
    'uses' => 'BrandController@createBrandSlideshow'
]);


Route::post('/create-brand-slideshow-{brand_id}', [
    'before' => 'auth',
    'as' => 'create_brand_slideshow_path',
    'uses' => 'BrandController@addSlideShowImage'
]);


Route::get('/edit-brand-slideshow-{brand_image_id}-{brand_id}', [
    'before' => 'auth',
    'as' => 'edit_brand_slideshow_path',
    'uses' => 'BrandController@editSlideshow'
]);

Route::post('/edit-brand-slideshow-{brand_image_id}-{brand_id}', [
    'before' => 'auth',
    'as' => 'edit_brand_slideshow_path',
    'uses' => 'BrandController@updateBrandImage'
]);


Route::get('/delete-image-brand-{brand_image_id}-{brand_id}', [
    'before' => 'auth',
    'as' => 'delete_image_brand_path',
    'uses' => 'BrandController@deleteBrandImage'
]);




/* -------------------
USERS MANAGEMENT
----------------- */

Route::get('/users-management', [
    'before' => 'auth',
    'as' => 'users_management_path',
    'uses' => 'UsersController@show'
]);

Route::get('/delete-user-{id}', [
    'before' => 'auth',
    'as' => 'delete_user_path',
    'uses' => 'UsersController@delete'
]);

Route::get('/user-{id}', [
    'before' => 'auth',
    'as' => 'display_user_path',
    'uses' => 'UsersController@display'
]);


/* -------------------
SHOPPING MANAGEMENT
----------------- */

Route::get('/validating-paypal-payment-{order_id}-{order_status_id}', [
    'before' => 'auth',
    'as' => 'paypal_validation_path',
    'uses' => 'ShoppingController@paypalValidation'
]);


Route::get('/shopping-management', [
    'before' => 'auth',
    'as' => 'shopping_management_path',
    'uses' => 'ShoppingController@show'
]);

Route::post('/shopping-management', [
    'before' => 'auth',
    'as' => 'shopping_management_path',
    'uses' => 'ShoppingController@updateCashOnDelivery'
]);

Route::get('/display-transaction-{order_id}', [
    'before' => 'auth',
    'as' => 'display_transaction_path',
    'uses' => 'ShoppingController@display'
]);

/* -------------------
PROMO MANAGEMENT
----------------- */

Route::get('/promo-management', [
    'before' => 'auth',
    'as' => 'promo_management_path',
    'uses' => 'PromoController@show'
]);


Route::post('/promo-management', [
    'before' => 'auth',
    'as' => 'promo_management_path',
    'uses' => 'PromoController@updateStatus'
]);

Route::get('/create-promo-management', [
    'before' => 'auth',
    'as' => 'create_promo_path',
    'uses' => 'PromoController@createPromo'
]);

Route::post('/create-promo-management', [
    'before' => 'auth',
    'as' => 'create_promo_path',
    'uses' => 'PromoController@addPromo'
]);

// ------------- promo per product ----------

Route::get('/promo-products-management', [
    'before' => 'auth',
    'as' => 'promo_products_management_path',
    'uses' => 'PromoController@showPromoProducts'
]);

Route::post('/create-promo-product-management', [
    'before' => 'auth',
    'as' => 'post_create_promo_product_path',
    'uses' => 'PromoController@addPromoForProduct'
]);

Route::get('/create-promo-product-management-{product_id}', [
    'before' => 'auth',
    'as' => 'create_promo_product_path',
    'uses' => 'PromoController@createPromoForProduct'
]);


Route::post('/stop-promo-product-management', [
    'before' => 'auth',
    'as' => 'stop_promo_product_path',
    'uses' => 'PromoController@stopPromoForProduct'
]);




Route::get('/sign-out', [
    'before' => 'auth',
    'as' => 'sign_out_path',
    'uses' => 'SessionsController@destroy'
]);

Route::get('/frontend-sign-out', [
    'before' => 'auth',
    'as' => 'sign_out_frontend_path',
    'uses' => 'SessionsController@destroy_fronted'
]);




/* -------------
NEWS LETTERS MANAGEMENT
------------ */

Route::get('/newsletters-management', [
    'before' => 'auth',
    'as' => 'newsletters_management_path',
    'uses' => 'HomeController@editNewsLetters'
]);

Route::post('/newsletters-management', [
    'before' => 'auth',
    'as' => 'newsletters_management_path',
    'uses' => 'HomeController@updateNewsLetters'
]);




/* ---------------------------------------------------------
SERVICE MANAGEMENT
---------------------------------------------------------- */

Route::get('/cms-services-management', [
    'before' => 'auth',
    'as' => 'services_management_path',
    'uses' => 'ServiceController@show'
]);


Route::get('/create-service', [
    'before' => 'auth',
    'as' => 'create_service_path',
    'uses' => 'ServiceController@createService'
]);

Route::post('/create-service', [
    'before' => 'auth',
    'as' => 'create_service_path',
    'uses' => 'ServiceController@addService'
]);


Route::get('/edit-service-{id}', [
    'before' => 'auth',
    'as' => 'edit_service_path',
    'uses' => 'ServiceController@editService'
]);

Route::post('/update-service', [
    'before' => 'auth',
    'as' => 'update_service_path',
    'uses' => 'ServiceController@updateService'
]);

Route::post('/delete-service', [
    'before' => 'auth',
    'as' => 'delete_service_path',
    'uses' => 'ServiceController@deleteService'
]);



/* ------------------------
IMAGES SERVICE MANAGEMENT
--------------------------- */


Route::get('/show-service-images-{service_id}', [
    'before' => 'auth',
    'as' => 'show_service_images_path',
    'uses' => 'ServiceController@showServiceImages'
]);


Route::get('/create-images-service-{service_id}', [
    'before' => 'auth',
    'as' => 'create_images_service_path',
    'uses' => 'ServiceController@createImagesService'
]);


Route::post('/add-images-service', [
    'before' => 'auth',
    'as' => 'add_images_service_path',
    'uses' => 'ServiceController@addImageService'
]);


Route::get('/edit-image-service-{service_carousel_id}', [
    'before' => 'auth',
    'as' => 'edit_image_service_path',
    'uses' => 'ServiceController@editImageService'
]);


Route::post('/update-image-service-{service_carousel_id}', [
    'before' => 'auth',
    'as' => 'update_image_service_path',
    'uses' => 'ServiceController@updateImageService'
]);


Route::post('/delete-img-service', [
    'before' => 'auth',
    'as' => 'delete_image_service_path',
    'uses' => 'ServiceController@deleteImageService'
]);


/* ------------------------
VIDEOS SERVICE MANAGEMENT
--------------------------- */


Route::get('/show-service-videos-{service_id}', [
    'before' => 'auth',
    'as' => 'show_service_videos_path',
    'uses' => 'ServiceController@showServiceVideos'
]);


Route::get('/create-video-service-{service_id}', [
    'before' => 'auth',
    'as' => 'create_video_service_path',
    'uses' => 'ServiceController@createVideoService'
]);


Route::post('/add-video-service', [
    'before' => 'auth',
    'as' => 'add_video_service_path',
    'uses' => 'ServiceController@addVideoService'
]);


Route::get('/video-edit-service-{service_video_id}', [
    'before' => 'auth',
    'as' => 'video_edit_service_path',
    'uses' => 'ServiceController@editVideoService'
]);


Route::post('/video-update-service-{service_video_id}', [
    'before' => 'auth',
    'as' => 'video_update_service_path',
    'uses' => 'ServiceController@updateVideoService'
]);


Route::post('/video-delete-service', [
    'before' => 'auth',
    'as' => 'video_delete_service_path',
    'uses' => 'ServiceController@deleteVideoService'
]);










