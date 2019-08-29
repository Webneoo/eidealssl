@extends('layouts.default')

@section('title', 'Eideal | Contact us | Hair tools in Dubai and Lebanon, curling iron, flat iron, hairdryer, beauty supplier, salon supplier, hair care')
@section('description', 'Get more information about our stores and Hair tools in Dubai and Lebanon')
@section('keywords', 'Hair tools, curling iron, flat iron, hairdryer, beauty supplier, salon supplier, hair care, keratin, hair brushes, round brush, ceramic brush, scissors')
@section('robots', 'INDEX,FOLLOW')

@section('content')

   

    <div id="start" class="container">
        <div class="page-title">
             <h1 class="page_h1"> CONTACT INFORMATION </h1>
             <h2 class="page_h2" style="margin-top:0px;"> <a style="color:#9a9a9a;" href="mailto:info@eidealonline.com">info@eideal.com </a> </h2>
             <p class="careers_intro" style="text-align:center">
              EIDEAL Fans! <span style="font-weight:bold; font-size:15px;">Hairdressers and Consumers</span>, feel free to contact us and we would be happy to assist you further.
              </p>   
            @include('layouts.partials.errors')
             @include('flash::message')
        </div>
    </div>
    <br/>
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6 google_map_div" style="padding-left:40px; padding-right:40px;">
          <div class="grey_bg">
            <div> 
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7218.485337491554!2d55.2863697439511!3d25.228750302086773!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f42ef2ff17d15%3A0xd41473487a5120e2!2sEIDEAL+TRADING+LLC%2C+SAMA+TOWER%2C+OFFICE+905!5e0!3m2!1sen!2sae!4v1454407209538" 
                 width="100%" height="310px" "border:none;" "padding:0px;">
              </iframe>
           </div>

            <div class="contact_info_div">
               <h1 class="contact_info_title"> DUBAI, UAE</h1>

                <div class="row form-group">
                  <div class="col-lg-6 contact_form">
                    {{ Form::open(['route' => 'contact_us_path', 'role' => 'form']) }}
                       <input type="text" name="name_contact_dubai" class="contact_input" placeholder="Name" style="width:70%">
                       <div class="dubai_name_val validation">  </div>
                       
                       <input type="tel" name="phone_contact_dubai" class="contact_input" placeholder="Phone Number" style="width:70%">
                       <div class="dubai_phone_val validation">  </div>
                       
                       <input type="email" name="email_contact_dubai" class="contact_input" placeholder="Mail" style="width:70%">
                       <div class="dubai_email_val validation">  </div>
                      
                      <textarea id="msg_contact_dubai" name="msg_contact_dubai" class="form-control contact_input" style="height:90px;" placeholder="Your message"></textarea> 
                       <div class="dubai_msg_val validation">  </div>
                       <input name="submit_dubai_form" class="send_contact" type="submit" value="SEND"/>
                     {{ Form::close() }}
                  </div>

                  <div class="col-lg-5 contact_info" style="width:46% !important;">
                    <p class="contact_info_p">
                        EIDEAL TRADING L.L.C <br/> 
                        P.O. Box: 187123 <br/>
                        Dubai, UAE <br/>
                        Tel: +97142594665 <br/>
                        Mob: +971556292853 <br/>

                 <!--    <div style="font-family: MontserratRegular;"> 
                      <img style="height:25px; position:relative; bottom:7px; margin-top:8px;" src="images/whatsapp_logo.png" alt="eideal whatsapp number" title="Eideal Whatsapp Number"/>  +971564452369 
                    </div> -->

                   <!--  <a style="color:#01aae9; font-size:16px;" href="skype:santiago.susie?call" title="Call us on skype"> 
                      <img style="height:25px; position:relative; bottom:7px; margin-top:8px;" src="images/skype.png"/> Call us 
                    </a> -->

                         <!--  <a href="skype:miachkar?call"> call me </a> -->
                    </p>  
                  </div>

                </div> <!-- end row form-group -->
              
            </div>  <!-- end contact_info_div -->  
          </div> <!-- end grey_bg -->
        </div> <!-- end google_map_div -->


        <div class="col-lg-6 col-md-6 google_map_div" style="padding-left:40px; padding-right:40px;">
          <div class="grey_bg">
            <div> 
                <iframe src="https://www.google.com/maps/d/embed?mid=zvCoHQXOTPLk.k_JpkGOJWZ14&z=17" width="100%" height="310px;" "border:none;" "padding:0px;"></iframe>
            </div>

            <div class="contact_info_div">
               <h1 class="contact_info_title"> BEIRUT, LEBANON</h1>

                <div class="row form-group">
                  <div class="col-lg-6 contact_form">
                     {{ Form::open(['route' => 'contact_us_path', 'role' => 'form']) }}
                       <input type="text" name="name_contact_beirut" class="contact_input" placeholder="Name" style="width:70%">
                       <div class="beirut_name_val validation">  </div>
                       
                       <input type="tel" name="phone_contact_beirut" class="contact_input" placeholder="Phone Number" style="width:70%">
                       <div class="beirut_phone_val validation">  </div>
                       
                       <input type="email" name="email_contact_beirut" class="contact_input" placeholder="Mail" style="width:70%">
                       <div class="beirut_email_val validation">  </div>
                      
                      <textarea id="msg_contact_beirut" name="msg_contact_beirut" class="form-control contact_input" style="height:90px;" placeholder="Your message"></textarea>
                       <div class="beirut_msg_val validation">  </div>
                       <input name="submit_beirut_form" class="send_contact" type="submit" value="SEND"/>
                     {{ Form::close() }}
                  </div>

                  <div class="col-lg-5 contact_info" style="width:46% !important;">
                    <p class="contact_info_p">
                        EIDEAL S.A.L <br/> 
                        Starco <br/>
                        Downtown, Beirut<br/>
                        Tel: +9611366081<br/>
                        Mob: +96170366007 <br/>
                    </p>  
                  </div>

                </div> <!-- end row form-group -->
      
            </div>  <!-- end contact_info_div -->  
          </div> <!-- end grey_bg -->
        </div> <!-- end google_map_div -->

      </div>  <!-- end row -->


       <h1 id="careers" class="page_h1"> CAREERS </h1>

       <div class="row" style="margin-bottom:25px">
          <div class="col-lg-5 col-md-5 careers_text" style="padding-left:30px; padding-right:30px;">
              <br/>
              <p class="careers_intro">
                EIDEAL has been growing at a substantial pace, and is always on the lookout for dynamic personnel to join the team.<br/><br/>
                At EIDEAL, we believe that our team should reflect the qualities that we develop in our tools. 
                An EIDEAL team member should be professional and innovative.<br/><br/>
                If you are ready to join us and execute an Excellently Ideal job, go ahead and fill out our application form.

              </p>     

             <br/>
             
             <!--
             <div class="col-lg-5 col-md-5 button_grey" style="width:100%;"> + Technical Educator (Hair & Beauty) 
                <span id="1" class="arrow-down" onclick="arrow_click(this.id);"> </span>
              </div> 
             <br/><br/>
             <div id="div_1" class="col-lg-5 col-md-5 gray_box divs" style="width:100%; background-color:#f5f5f5">
                We are looking for a professional Hair Stylist / Technician / Trainer for a prestigious Educational Program.
                As a trainer you will be required to provide thorough and detailed training to hair and beauty students in preparation 
                for their career in the salon.</br>
                <h5><b>Principal Duties and Responsibilities:</b></h5>
                <ul>
                  <li>Able to deliver training session and workshops to convey all the technical information of our hair care brands.</li>
                  <li>Provide technical support to the students during their training</li>
                  <li>Deliver all kinds of technical trainings to the hairdressers on the latest techniques in shaping, 
                    curling, cutting, trimming, setting, bleaching, dyeing, and tinting hair etc</li>
                  <li>Work with other members of the team to devise training strategies and enhance the program. </li>
                  <li>Able to analyse hair condition and recommend hair treatment. </li>
                  <li>Maintain technical knowledge by attending educational workshops; reviewing publications from different sources. </li>
                  <li>Maintain quality service by following company standards.</li>
                  <li>Increase students awareness of sales and selling techniques.</li>
                </ul></br>
              
                <h5><b>Requirements</b></h5>
                <ul>
                  <li>Job Specific Skills
                    <ul>
                      <li>Good communication & presentation skills</li>
                      <li>Excellent technical skill in cutting, shaping, styling, curling, etc of the hair</li>
                      <li>Creative stylist</li>
                    </ul>
                  </li>
                  <li>Computer Skills
                    <ul>
                      <li>Knowledge of MS Office, particularly Word & Power Point, Internet & e-mail is appreciated.</li>
                    </ul>
                  </li>
                  <li>Industry Skills:
                    <ul>
                      <li>Ideal business background would be: Hair Dresser, Trainer, Hair Technician</li>
                    </ul>
                  </li>
                  <li>Past Experience and Education:
                    <ul>
                      <li>5+ years of experience as Hair Stylist / Technician / Trainer from a well established organization salon, 
                        beauty center, academy</li>
                      <li>Knowledge in Sales will be appreciated.</li>
                    </ul>
                  </li>
                </ul></br></br>
              Job Location Dubai UAE
            </div> 

            -->

              

             <div class="col-lg-5 col-md-5 button_grey" style="width:100%;"> + Sales Executive (Field-Based) 
                <span id="2" class="arrow-down" onclick="arrow_click(this.id);"> </span>
             </div>
             <br/><br/>
             <div id="div_2" class="col-lg-5 col-md-5 gray_box divs" style="width:100%; background-color:#f5f5f5">
               We are looking for a dynamic Sales Executive with proven sales results to join our existing sales team.</br>
              <h5><b>Principal Duties and Responsibilities:</b></h5>
              <ul>
                <li> Perform sales and meet targets</li>
                <li>Maintain a high-quality service by following company standards</li>
                <li>Follow standard operating procedures</li>
                <li> Follow all standards set for appearance, behavior in order to maintain the brand image</li>
                <li>Attend training and use the new knowledge and skills to achieve sales</li>
                <li>Maintain an updated knowledge of the market</li>
                <li>Provide a memorable customer experience</li>
                <li>Refer any issues related to products and customers to the sales manager</li>
                <li>Cooperate with colleagues and display a team spirit</li>
              </ul></br>
              <h5><b>Requirements</b></h5>
              <ul>
                <li>Industry Skills:
                  <ul>
                    <li>Ideal business background would include:    Experience in the Hair, Beauty & Cosmetics Industry</li>
                  </ul>
                </li>
                <li>Past Experience and Education
                  <ul>
                    <li>1+ years of experience in face-to-face sales</li>
                    <li>Knowledge of the Middle Eastern market</li>
                  </ul>
                </li>
                <li>Candidate Profile:
                  <ul>
                    <li>FEMALE with UAE Experience in Sales & Training</li>
                    <li>Results driven to meet Sales Targets</li>
                    <li>Generate potential clients and increase customer database</li>
                    <li>Increase the distribution of the brands in the company’s portfolio by presenting and selling the company’s products to current and potential clients</li>
                    <li>Knowledge in hair treatment and beauty tools</li>
                    <li>Outgoing, friendly and exceptional at building rapport</li>
                    <li>Excellent presentation & communication skills</li>
                    <li>Car owner with valid UAE Driving License</li>
                  </ul>
                </li>
              </ul></br></br>
              Successful candidates will be given basic salary + commission & other benefits.<br/>
              Please send your CV accompanied by a recent photograph of yourself.<br/>
              Only Shortlisted Candidates will be contacted.<br/>
            </div> 

          </div> 
          

          <br/>
          <div class="col-lg-6 col-lg-offset-1 col-md-6 col-md-offset-1" style="padding-right:30px;">
             <div class="application_form">
               <h1 class="contact_info_title" style="padding-left:15px;"> APPLICATION FORM </h1>

                {{ Form::open(['route' => 'send_cv_path', 'role' => 'form', 'files' => true]) }}
                    <table class="careers_table">
                      <tr>
                        <td> Full name <span class="red_asterix">*</span>: </td>
                        <td> <input type="text" name="fullname" class="career_input" placeholder="Full name" value="{{Input::old('fullname')}}"/> </td>
                      </tr>

                      <tr>
                        <td> Date of birth <span class="red_asterix">*</span>: </td>
                        <td> <input type="text" name="birth_date" class="career_input" placeholder="Date of birth" value="{{Input::old('birth_date')}}"/>  </td>
                      </tr>

                      <tr>
                        <td> Email <span class="red_asterix">*</span>: </td>
                        <td> <input type="email" name="email" class="career_input" placeholder="Email" value="{{Input::old('email')}}"/>  </td>
                      </tr>

                      <tr>
                        <td> Position applied for <span class="red_asterix">*</span>: </td>
                        <td> <input type="text" name="position" class="career_input" placeholder="Position applied for" value="{{Input::old('position')}}"/>  </td>
                      </tr>

                      <tr>
                        <td> Expected salary <span class="red_asterix">*</span>: </td>
                        <td> <input type="text" name="salary" class="career_input" placeholder="Expected salary" value="{{Input::old('salary')}}"/>  </td>
                      </tr>

                      <tr>
                        <td style="vertical-align:top;"> Experience <span class="red_asterix">*</span>: </td>
                        <td> <textarea class="career_input" name="experience" style="height:100px;">{{Input::old('experience')}} </textarea> </td>
                      </tr>


                      <tr>
                        <td> Upload your photo: </td>
                        <td> <input type="file" name="photo_upload" class="career_input" value="{{Input::old('photo_upload')}}"/>  </td>
                      </tr>
                      <tr>
                        <td> Upload your CV <span class="red_asterix">*</span>: </td>
                        <td> <input type="file" name="cv_upload" class="career_input"/>  </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td> <input type="submit" class="submit_career" value="Submit"/>  </td>
                      </tr>
                    </table>
                  {{ Form::close() }}
                <br/>
             </div> <!-- end application_form -->
            <br/>

          </div>
        
       </div> 


    </div> <!-- end container -->

    <script type="text/javascript">


    $( document ).ready(function() {

        $('.divs').hide();
    });


      function arrow_click(id)
      {
          if($('#div_'+id).is(":visible"))
          {
            $('.divs').slideUp("slow");
          }

          else
          {
            $('.divs').slideUp("slow");
            $('#div_'+id).slideDown("slow");
          
            $('body,html').animate({
              'scrollTop':$('#div_'+id).offset().top }, 1000);
          }
      }


      // ------------------- DUBAI FORM CONTROL ------------------------------

       jQuery(function($) {
    var val_name_dubai, val_phone_dubai, val_email_dubai, val_msg_dubai;
   
    $("form input[name='submit_dubai_form']").click(function() { // triggred click 

        /************** form validation **************/
        val_name_dubai = val_phone_dubai = val_email_dubai = val_msg_dubai = 1;
        var name        = jQuery.trim($("form input[name='name_contact_dubai']").val()); // name field
        var phone       = jQuery.trim($("form input[name='phone_contact_dubai']").val()); // phone name field
        var phone_regex = /^[0-9\+]+$/;
        var email       = jQuery.trim($("form input[name='email_contact_dubai']").val()); // email field
        var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; // reg ex email check  
        var msg    = $('#msg_contact_dubai').val(); //textarea msg field


      // ------------------- Name control -----------------------------

        if(name == "") {
            $("div.dubai_name_val").html("Name required");
        val_name_dubai = 0;
        } 
        if(name != "") {
           $("div.dubai_name_val").html("");
        val_name_dubai = 1;
        } 
    
        // ---------------- Phone control -----------------------------

        if(phone == "") {
            $("div.beirut_phone_val").html("");
        val_phone_dubai = 1;
        }

        if(phone != "") {
            $("div.dubai_phone_val").html("");
        val_phone_dubai = 1;
        } 
        if(phone != "") {
            if(!phone_regex.test(phone)){ // if invalid phone
                $("div.dubai_phone_val").html("Invalid phone number");
                val_phone_dubai = 0;
            } 
        }
       

        // ---------------- Email control -----------------------------

        if(email == "") {
            $("div.dubai_email_val").html("Email is required.");
        val_email_dubai = 0;
        }
        if(email != "") {
            $("div.dubai_email_val").html("");
        val_email_dubai = 1;
        } 
        if(email != "") {
            if(!email_regex.test(email)){ // if invalid email
                $("div.dubai_email_val").html("Invalid email.");
                val_email_dubai = 0;
            } 
        }
      
        // ------------------- msg control -----------------------------
       
        if(msg == "") {
            $("div.dubai_msg_val").html("Message required");
        val_msg_dubai = 0;
        } 
        if(msg != "") {
           $("div.dubai_msg_val").html("");
        val_msg_dubai = 1;
        } 


        if(val_name_dubai * val_phone_dubai * val_email_dubai * val_msg_dubai == 0) {
            return false;
        }  
        
        /************** form validation end **************/

    }); // click end
}); // jquery end





  // ------------------- BEIRUT FORM CONTROL ------------------------------

       jQuery(function($) {
     var val_name_beirut, val_phone_beirut, val_email_beirut, val_msg_beirut;
   
    $("form input[name='submit_beirut_form']").click(function() { // triggred click 


        /************** form validation **************/
        val_holder_beirut      = 0;
        var name        = jQuery.trim($("form input[name='name_contact_beirut']").val()); // name field
        var phone       = jQuery.trim($("form input[name='phone_contact_beirut']").val()); // phone name field
        var phone_regex = /^[0-9\+]+$/;
        var email       = jQuery.trim($("form input[name='email_contact_beirut']").val()); // email field
        var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; // reg ex email check  
        var msg    = $('#msg_contact_beirut').val(); //textarea msg field


        
      // ------------------- Name control -----------------------------

        if(name == "") {
            $("div.beirut_name_val").html("Name required");
        val_name_beirut = 0;
        } 
        if(name != "") {
           $("div.beirut_name_val").html("");
        val_name_beirut = 1;
        } 

        // ---------------- Phone control -----------------------------

        if(phone == "") {
            $("div.beirut_phone_val").html("");
        val_phone_beirut = 1;
        } 

        if(phone != "") {
            $("div.beirut_phone_val").html("");
        val_phone_beirut = 1;
        } 
        if(phone != "") {
            if(!phone_regex.test(phone)){ // if invalid phone
                $("div.beirut_phone_val").html("Invalid phone number");
                val_phone_beirut = 0;
            } 
        }
        
        // ---------------- Email control -----------------------------

        if(email == "") {
            $("div.beirut_email_val").html("Email is required.");
        val_email_beirut = 0;
        }
        if(email != "") {
            $("div.beirut_email_val").html("");
        val_email_beirut = 1;
        } 
        if(email != "") {
            if(!email_regex.test(email)){ // if invalid email
                $("div.beirut_email_val").html("Invalid email.");
                val_email_beirut = 0;
            } 
        }

        // ------------------- msg control -----------------------------
       
        if(msg == "") {
            $("div.beirut_msg_val").html("Message required");
        val_msg_beirut = 0;
        } 
        if(msg != "") {
           $("div.beirut_msg_val").html("");
        val_msg_beirut = 1;
        } 
      

        if(val_name_beirut * val_phone_beirut * val_email_beirut * val_msg_beirut == 0) {
            return false;
        }  
        
        /************** form validation end **************/

    }); // click end
}); // jquery end


    </script>
<script type='text/javascript' src='js/header_margin.js'></script>
@stop