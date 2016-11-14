<h1 class="product_type"> PRODUCTS </h1>
<ul class="product_list">
	<li class="hidden-xs"><a <?php if($pagename == "all-products") echo 'class="product_li_selected";' ?> href="{{ route('all_products_path') }}"> Product Categories </a></li>
</ul>
<?php
  $categ_number = $i-1;        


for($a=1; $a<=$categ_number; $a++)
{
 ?>
 <h2 class="product_title">{{ $category_tab[$a] }}</h2>
 <ul class="product_list">
<?php
   
    for($b=1; $b<=$subcategory_counter[$a]; $b++)
    {
  ?>
  	<li class="hidden-xs"><a <?php if($subcategory_id_tab[$a][$b] == $id) echo 'class="product_li_selected";' ?> href="{{ route('products_path', $subcategory_id_tab[$a][$b]) }}"> {{ $subcategory_tab[$a][$b] }}  </a></li>
    <li class="visible-xs"><a <?php if($subcategory_id_tab[$a][$b] == $id) echo 'class="product_li_selected";' ?> href="{{ route('products_path', $subcategory_id_tab[$a][$b]) }}#products"> {{ $subcategory_tab[$a][$b] }}  </a></li>
 <?php 
    }
  echo "</ul>";  
}
  ?>    
<br/ class="hidden-xs">

  <button type="button" class="ask_the_expert"><a href="{{ route('contact_us_path') }}"> ASK THE EXPERT </a></button>    

  <br/><br/>