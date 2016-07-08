<div class="navbar-default sidebar" role="navigation">
   <div class="sidebar-nav navbar-collapse">
       <ul class="nav" id="side-menu">
           <li class="sidebar-search">
               <div class="input-group custom-search-form">
                   <input type="text" class="form-control" placeholder="Search...">
                   <span class="input-group-btn">
                   <button class="btn btn-default" type="button">
                       <i class="fa fa-search"></i>
                   </button>
               </span>
               </div>
               <!-- /input-group -->
           </li>
             <li> <a <?php if ($pagename == "home-management") echo 'class="active"'; ?> href="{{ route('home_management_path') }}">  <i class="fa fa-home fa-fw"></i> Home </a></li>
             <li> <a <?php if ($pagename == "edit-about-us") echo 'class="active"'; ?> href="{{ route('edit_about_us_path') }}">  <i class="fa fa-info-circle fa-fw"></i> About us</a></li>
             <li> <a <?php if ($pagename == "edit-eteam") echo 'class="active"'; ?> href="{{ route('edit_eteam_path') }}">  <i class="fa fa-edge fa-fw"></i> E-team</a></li>
             <li> <a <?php if ($pagename == "news-management") echo 'class="active"'; ?> href="{{ route('news_management_path') }}">  <i class="fa fa-newspaper-o fa-fw"></i> News</a></li>
             <li> <a <?php if ($pagename == "where-to-buy-management") echo 'class="active"'; ?> href="{{ route('where_to_buy_management_path',0) }}">  <i class="fa fa-globe fa-fw"></i> Where to buy</a></li>
             <li> <a <?php if ($pagename == "products-management") echo 'class="active"'; ?> href="{{ route('products_management_path') }}">  <i class="fa fa-truck fa-fw"></i> Products</a></li>
             <li> <a <?php if ($pagename == "best-seller-management") echo 'class="active"'; ?> href="{{ route('best_seller_management_path') }}">  <i class="fa fa-money fa-fw"></i> Best Sellers</a></li>
             <li> <a <?php if ($pagename == "product-of-the-month") echo 'class="active"'; ?> href="{{ route('product_of_the_month_management_path') }}">  <i class="fa fa-star fa-fw"></i> Product of the month</a></li>
             <li> <a <?php if ($pagename == "medias-management") echo 'class="active"'; ?> href="{{ route('medias_management_path') }}">  <i class="fa fa-play-circle fa-fw"></i> Medias</a></li>
             <li> <a <?php if ($pagename == "brands-management") echo 'class="active"'; ?> href="{{ route('brands_management_path') }}">  <i class="fa fa-tags fa-fw"></i> Brands</a></li>
             <li> <a <?php if ($pagename == "users-management") echo 'class="active"'; ?> href="{{ route('users_management_path') }}">  <i class="fa fa-users fa-fw"></i> Users</a></li>
             <li> <a <?php if ($pagename == "shopping-management") echo 'class="active"'; ?> href="{{ route('shopping_management_path') }}">  <i class="fa fa-shopping-cart fa-fw"></i> Shopping </a></li>
           <!--   <li> <a <?php if ($pagename == "management-products-category") echo 'class="active"'; ?> href="{{ route('products_category_management_path') }}">  <i class="fa fa-th fa-fw"></i> Products category </a></li> -->
       </ul>
   </div>
   <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->