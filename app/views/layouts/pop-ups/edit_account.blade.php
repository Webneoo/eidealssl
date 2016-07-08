<div id="edit_account" class="container_640 note_popup">
  <div class="signup_label_2">EDIT ACCOUNT</div>
  <div class="inner_container_640 striped_bg">
     <span class="gray_small left_magin"> All fiels marked with <span class="red_asterix"> * </span>are mandatory </span>
    {{ Form::open(['route' => 'edit_account_path', 'role' => 'form']) }}
      <div class="signup_left">
        <input class="big_signup_input" name="firstname" type="text" placeholder="first name" value="{{ Session::get('firstname') }}" required><span class="red_asterix"> * </span>
        <input class="big_signup_input" name="lastname" type="text" placeholder="last name" value="{{ Session::get('lastname') }}" required><span class="red_asterix"> * </span>
        <input class="big_signup_input" name="email" type="text" placeholder="e-mail" value="{{ Session::get('email') }}" required><span class="red_asterix"> * </span>
      <br/><br/>
      <br/>

      </div>

      <div class="signup_middle">

          <div id="default-settings"></div>
          <input class="medium_signup_input" name="phone_number" type="text" placeholder="Phone number" value="{{ Session::get('phone') }}" required><span class="red_asterix"> * </span>
          <input class="medium_signup_input" name="address" type="text" placeholder="address" value="{{ Session::get('address') }}" required><span class="red_asterix"> * </span>


          <input type="checkbox" class="checkbox" name="newsletters" value="1">
          <span class="promotion_number"> Sign up to Newsletter</span>
      </div>

      <div class="signup_right edit_account_signup_right">


         <br/><br/><br/>

      </div>

      <div class="edit_account_end">
        <img class="lock" src="images/lock.png">
        <input class="submit_edit_account" type="submit" name="edit_account" value="SAVE CHANES"/>
      </div>

   {{ Form::close() }}
  </div>
</div>