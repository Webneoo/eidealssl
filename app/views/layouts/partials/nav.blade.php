<nav class="navbar navbar-default">

  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand hidden-lg hidden-md aaa" href="{{ route('home_path') }}"><img class="logo_eideal" src="images/logo.png"/></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse margin_for_nav" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li <?php if($pagename == 'about-us') echo 'class="active"'; ?>><a href="{{ route('about_us_path') }}">ABOUT US <span class="sr-only">(current)</span></a></li>
            <li <?php if($pagename == 'products') echo 'class="active"'; ?> ><a href="{{ route('products_path',1) }}">PRODUCTS</a></li>
            <li <?php if($pagename == 'news-0') echo 'class="active"'; ?>><a href="{{ route('news_path',0) }}">NEWS</a></li>
            <li class="dropdown" <?php if($pagename == 'brands-1' || $pagename == 'brands-2' || $pagename == 'brands-3' || $pagename == 'brands-4') echo 'class="active"'; ?>>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">BRANDS <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="brands-1">AMAZON KERATIN</a></li>
                <li><a href="brands-2">FacePro</a></li>
                <li><a href="brands-3">Priti NYC</a></li>
                <li><a href="brands-4">Vern</a></li>
              </ul>
            </li>

            <li <?php if($pagename == 'where-to-buy-0') echo 'class="active"'; ?>><a href="{{ route('where_to_buy_path',0) }}">WHERE TO BUY</a></li>
            <li <?php if($pagename == 'contact-us') echo 'class="active"'; ?>><a href="{{ route('contact_us_path') }}">CONTACT US</a></li>
          </ul>
         <!--  <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control hidden-sm" placeholder="Search" style="width:150px;">
            </div>
            <button type="submit" class="btn btn-default hidden-sm">OK</button>
          </form> -->
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
  </div>

</nav>
