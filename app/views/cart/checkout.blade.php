@extends('layouts.default')

@section('content')

 <div id="start" class="container">
 <br/>

 <div class="container">
    
       <div class="row">
          
          <div class="col-lg-6 col-md-6" style="padding-right:30px; width: 100%; margin: auto;">
             <div class="application_form">
               <h1 class="contact_info_title" style="padding-left:15px;"> PERSONAL INFORMATION </h1>
               
                 {{ Form::open(['route' => 'place_your_order_path', 'role' => 'form', 'id'=> 'checkout_form']) }}
                
                    <table class="careers_table">
                      <tr>
                        <td> First name <span class="red_asterix">*</span>: </td>
                        <td> <input type="text" name="firstname" value="{{ Session::get('firstname'); }}" class="career_input" placeholder="First name" value="{{Input::old('firstname')}}"/> </td>
                      </tr>
                      <tr>
                        <td class="tooltip_td" colspan="2">
                              @if ($errors->has('firstname'))
                              <div class="validation">
                                    {{ $errors->get('firstname')['0'] }} 
                              </div>
                              @endif
                        </td> 
                      </tr>  

                      <tr>
                        <td> Last name <span class="red_asterix">*</span>: </td>
                        <td> <input name="lastname" value="{{ Session::get('lastname'); }}" type="text" class="career_input" placeholder="Last name" value="{{Input::old('lastname')}}"/>  </td>
                      </tr>
                     <tr>
                        <td class="tooltip_td" colspan="2">
                              @if ($errors->has('lastname'))
                              <div class="validation">
                                    {{ $errors->get('lastname')['0'] }} 
                              </div>
                              @endif
                        </td> 
                      </tr>  

                      <tr>
                        <td> Email <span class="red_asterix">*</span>: </td>
                        <td> <input name="email" type="email" value="{{ Session::get('email'); }}" class="career_input" placeholder="Email" value="{{Input::old('email')}}"/>  </td>
                      </tr>
                      <tr>
                        <td class="tooltip_td" colspan="2">
                              @if ($errors->has('email'))
                              <div class="validation">
                                    {{ $errors->get('email')['0'] }} 
                              </div>
                              @endif
                        </td> 
                      </tr>  

                      <tr>
                        <td> Phone <span class="red_asterix">*</span>: </td>
                        <td> <input name="phone" type="text" value="{{ Session::get('phone'); }}" class="career_input" placeholder="Phone" value="{{Input::old('phone')}}"/>  </td>
                      </tr>
                      <tr>
                        <td class="tooltip_td" colspan="2">
                              @if ($errors->has('phone'))
                              <div class="validation">
                                    {{ $errors->get('phone')['0'] }} 
                              </div>
                              @endif
                        </td> 
                      </tr> 

                    </table>
                   

                 <h1 class="contact_info_title" style="padding-left:15px;"> DELIVERY INFORMATION </h1>

                    <table class="careers_table">
                        <tr>
                             <td> Country <span class="red_asterix">*</span>: </td>
                             <td> <select class="career_input" name="country" id="country" value="{{Input::old('country')}}">
                                        <option value="">Select your country</option>
                                        <option value="Afghanistan" @if (Input::old('country') == 'Afghanistan') selected="selected" @endif>Afghanistan</option>
                                        <option value="Ƭand Islands" @if (Input::old('country') == 'Ƭand Islands') selected="selected" @endif>Ƭand Islands</option>
                                        <option value="Albania" @if (Input::old('country') == 'Albania') selected="selected" @endif>Albania</option>
                                        <option value="Algeria" @if (Input::old('country') == 'Algeria') selected="selected" @endif>Algeria</option>
                                        <option value="American Samoa" @if (Input::old('country') == 'American Samoa') selected="selected" @endif>American Samoa</option>
                                        <option value="Andorra" @if (Input::old('country') == 'Andorra') selected="selected" @endif>Andorra</option>
                                        <option value="Angola" @if (Input::old('country') == 'Angola') selected="selected" @endif>Angola</option>
                                        <option value="Anguilla" @if (Input::old('country') == 'Anguilla') selected="selected" @endif>Anguilla</option>
                                        <option value="Antarctica" @if (Input::old('country') == 'Antarctica') selected="selected" @endif>Antarctica</option>
                                        <option value="Antigua and Barbuda" @if (Input::old('country') == 'Antigua and Barbuda') selected="selected" @endif>Antigua and Barbuda</option>
                                        <option value="Argentina" @if (Input::old('country') == 'Argentina') selected="selected" @endif>Argentina</option>
                                        <option value="Armenia" @if (Input::old('country') == 'Armenia') selected="selected" @endif>Armenia</option>
                                        <option value="Aruba" @if (Input::old('country') == 'Aruba') selected="selected" @endif>Aruba</option>
                                        <option value="Australia" @if (Input::old('country') == 'Australia') selected="selected" @endif>Australia</option>
                                        <option value="Austria" @if (Input::old('country') == 'Austria') selected="selected" @endif>Austria</option>
                                        <option value="Azerbaijan" @if (Input::old('country') == 'Azerbaijan') selected="selected" @endif>Azerbaijan</option>
                                        <option value="Bahamas" @if (Input::old('country') == 'Bahamas') selected="selected" @endif>Bahamas</option>
                                        <option value="Bahrain" @if (Input::old('country') == 'Bahrain') selected="selected" @endif>Bahrain</option>
                                        <option value="Bangladesh" @if (Input::old('country') == 'Bangladesh') selected="selected" @endif>Bangladesh</option>
                                        <option value="Barbados" @if (Input::old('country') == 'Barbados') selected="selected" @endif>Barbados</option>
                                        <option value="Belarus" @if (Input::old('country') == 'Belarus') selected="selected" @endif>Belarus</option>
                                        <option value="Belgium" @if (Input::old('country') == 'Belgium') selected="selected" @endif>Belgium</option>
                                        <option value="Belize" @if (Input::old('country') == 'Belize') selected="selected" @endif>Belize</option>
                                        <option value="Benin" @if (Input::old('country') == 'Benin') selected="selected" @endif>Benin</option>
                                        <option value="Bermuda" @if (Input::old('country') == 'Bermuda') selected="selected" @endif>Bermuda</option>
                                        <option value="Bhutan" @if (Input::old('country') == 'Bhutan') selected="selected" @endif>Bhutan</option>
                                        <option value="Bolivia" @if (Input::old('country') == 'Bolivia') selected="selected" @endif>Bolivia</option>
                                        <option value="Bonaire" @if (Input::old('country') == 'Bonaire') selected="selected" @endif>Bonaire</option>
                                        <option value="Bosnia and Herzegovina" @if (Input::old('country') == 'Bosnia and Herzegovina') selected="selected" @endif>Bosnia and Herzegovina</option>
                                        <option value="Botswana" @if (Input::old('country') == 'Botswana') selected="selected" @endif>Botswana</option>
                                        <option value="Bouvet Island" @if (Input::old('country') == 'Bouvet Island') selected="selected" @endif>Bouvet Island</option>
                                        <option value="Brazil" @if (Input::old('country') == 'Brazil') selected="selected" @endif>Brazil</option>
                                        <option value="British Indian Ocean Territory" @if (Input::old('country') == 'British Indian Ocean Territory') selected="selected" @endif>British Indian Ocean Territory</option>
                                        <option value="Brunei" @if (Input::old('country') == 'Brunei') selected="selected" @endif>Brunei</option>
                                        <option value="Bulgaria" @if (Input::old('country') == 'Bulgaria') selected="selected" @endif>Bulgaria</option>
                                        <option value="Burkina Faso" @if (Input::old('country') == 'Burkina Faso') selected="selected" @endif>Burkina Faso</option>
                                        <option value="Burundi" @if (Input::old('country') == 'Burundi') selected="selected" @endif>Burundi</option>
                                        <option value="Cambodia" @if (Input::old('country') == 'Cambodia') selected="selected" @endif>Cambodia</option>
                                        <option value="Cameroon" @if (Input::old('country') == 'Cameroon') selected="selected" @endif>Cameroon</option>
                                        <option value="Canada" @if (Input::old('country') == 'Canada') selected="selected" @endif>Canada</option>
                                        <option value="Cape Verde" @if (Input::old('country') == 'Cape Verde') selected="selected" @endif>Cape Verde</option>
                                        <option value="Cayman Islands" @if (Input::old('country') == 'Cayman Islands') selected="selected" @endif>Cayman Islands</option>
                                        <option value="Central African Republic" @if (Input::old('country') == 'Central African Republic') selected="selected" @endif>Central African Republic</option>
                                        <option value="Chad" @if (Input::old('country') == 'Chad') selected="selected" @endif>Chad</option>
                                        <option value="Chile" @if (Input::old('country') == 'Chile') selected="selected" @endif>Chile</option>
                                        <option value="China" @if (Input::old('country') == 'China') selected="selected" @endif>China</option>
                                        <option value="Christmas Island" @if (Input::old('country') == 'Christmas Island') selected="selected" @endif>Christmas Island</option>
                                        <option value="Cocos (Keeling) Islands" @if (Input::old('country') == 'Cocos (Keeling) Islands') selected="selected" @endif>Cocos (Keeling) Islands</option>
                                        <option value="Colombia" @if (Input::old('country') == 'Colombia') selected="selected" @endif>Colombia</option>
                                        <option value="Comoros" @if (Input::old('country') == 'Comoros') selected="selected" @endif>Comoros</option>
                                        <option value="Congo" @if (Input::old('country') == 'Congo') selected="selected" @endif>Congo</option>
                                        <option value="Congo (DRC)" @if (Input::old('country') == 'Congo (DRC)') selected="selected" @endif>Congo (DRC)</option>
                                        <option value="Cook Islands" @if (Input::old('country') == 'Cook Islands') selected="selected" @endif>Cook Islands</option>
                                        <option value="Costa Rica" @if (Input::old('country') == 'Costa Rica') selected="selected" @endif>Costa Rica</option>
                                        <option value="Croatia" @if (Input::old('country') == 'Croatia') selected="selected" @endif>Croatia</option>
                                        <option value="Cuba" @if (Input::old('country') == 'Cuba') selected="selected" @endif>Cuba</option>
                                        <option value="Curaçao" @if (Input::old('country') == 'Curaçao') selected="selected" @endif>Curaçao</option>
                                        <option value="Cyprus" @if (Input::old('country') == 'Cyprus') selected="selected" @endif>Cyprus</option>
                                        <option value="Czech Republic" @if (Input::old('country') == 'Czech Republic') selected="selected" @endif>Czech Republic</option>
                                        <option value="Denmark" @if (Input::old('country') == 'Denmark') selected="selected" @endif>Denmark</option>
                                        <option value="Djibouti" @if (Input::old('country') == 'Djibouti') selected="selected" @endif>Djibouti</option>
                                        <option value="Dominica" @if (Input::old('country') == 'Dominica') selected="selected" @endif>Dominica</option>
                                        <option value="Dominican Republic" @if (Input::old('country') == 'Dominican Republic') selected="selected" @endif>Dominican Republic</option>
                                        <option value="Ecuador" @if (Input::old('country') == 'Ecuador') selected="selected" @endif>Ecuador</option>
                                        <option value="Egypt" @if (Input::old('country') == 'Egypt') selected="selected" @endif>Egypt</option>
                                        <option value="El Salvador" @if (Input::old('country') == 'El Salvador') selected="selected" @endif>El Salvador</option>
                                        <option value="Equatorial Guinea" @if (Input::old('country') == 'Equatorial Guinea') selected="selected" @endif>Equatorial Guinea</option>
                                        <option value="Eritrea" @if (Input::old('country') == 'Eritrea') selected="selected" @endif>Eritrea</option>
                                        <option value="Estonia" @if (Input::old('country') == 'Estonia') selected="selected" @endif>Estonia</option>
                                        <option value="Ethiopia" @if (Input::old('country') == 'Ethiopia') selected="selected" @endif>Ethiopia</option>
                                        <option value="Falkland Islands (Islas Malvinas)" @if (Input::old('country') == 'Falkland Islands (Islas Malvinas)') selected="selected" @endif>Falkland Islands (Islas Malvinas)</option>
                                        <option value="Faroe Islands" @if (Input::old('country') == 'Faroe Islands') selected="selected" @endif>Faroe Islands</option>
                                        <option value="FJ" @if (Input::old('country') == 'FJ') selected="selected" @endif>Fiji Islands</option>
                                        <option value="Finland" @if (Input::old('country') == 'Finland') selected="selected" @endif>Finland</option>
                                        <option value="France" @if (Input::old('country') == 'France') selected="selected" @endif>France</option>
                                        <option value="French Guiana" @if (Input::old('country') == 'French Guiana') selected="selected" @endif>French Guiana</option>
                                        <option value="French Polynesia" @if (Input::old('country') == 'French Polynesia') selected="selected" @endif>French Polynesia</option>
                                        <option value="French Southern and Antarctic Lands" @if (Input::old('country') == 'French Southern and Antarctic Lands') selected="selected" @endif>French Southern and Antarctic Lands</option>
                                        <option value="Gabon" @if (Input::old('country') == 'Gabon') selected="selected" @endif>Gabon</option>
                                        <option value="Gambia, The" @if (Input::old('country') == 'Gambia, The') selected="selected" @endif>Gambia, The</option>
                                        <option value="Georgia" @if (Input::old('country') == 'Georgia') selected="selected" @endif>Georgia</option>
                                        <option value="Germany" @if (Input::old('country') == 'Germany') selected="selected" @endif>Germany</option>
                                        <option value="Ghana" @if (Input::old('country') == 'Ghana') selected="selected" @endif>Ghana</option>
                                        <option value="Gibraltar" @if (Input::old('country') == 'Gibraltar') selected="selected" @endif>Gibraltar</option>
                                        <option value="Greece" @if (Input::old('country') == 'Greece') selected="selected" @endif>Greece</option>
                                        <option value="Greenland" @if (Input::old('country') == 'Greenland') selected="selected" @endif>Greenland</option>
                                        <option value="Grenada" @if (Input::old('country') == 'Grenada') selected="selected" @endif>Grenada</option>
                                        <option value="Guadeloupe" @if (Input::old('country') == 'Guadeloupe') selected="selected" @endif>Guadeloupe</option>
                                        <option value="Guam" @if (Input::old('country') == 'Guam') selected="selected" @endif>Guam</option>
                                        <option value="Guatemala" @if (Input::old('country') == 'Guatemala') selected="selected" @endif>Guatemala</option>
                                        <option value="Guernsey" @if (Input::old('country') == 'Guernsey') selected="selected" @endif>Guernsey</option>
                                        <option value="Guinea" @if (Input::old('country') == 'Guinea') selected="selected" @endif>Guinea</option>
                                        <option value="Guinea-Bissau" @if (Input::old('country') == 'Guinea-Bissau') selected="selected" @endif>Guinea-Bissau</option>
                                        <option value="Guyana" @if (Input::old('country') == 'Guyana') selected="selected" @endif>Guyana</option>
                                        <option value="Haiti" @if (Input::old('country') == 'Haiti') selected="selected" @endif>Haiti</option>
                                        <option value="Heard Island and McDonald Islands" @if (Input::old('country') == 'Heard Island and McDonald Islands') selected="selected" @endif>Heard Island and McDonald Islands</option>
                                        <option value="Honduras" @if (Input::old('country') == 'Honduras') selected="selected" @endif>Honduras</option>
                                        <option value="Hong Kong SAR" @if (Input::old('country') == 'Hong Kong SAR') selected="selected" @endif>Hong Kong SAR</option>
                                        <option value="Hungary" @if (Input::old('country') == 'Hungary') selected="selected" @endif>Hungary</option>
                                        <option value="Iceland" @if (Input::old('country') == 'Iceland') selected="selected" @endif>Iceland</option>
                                        <option value="India" @if (Input::old('country') == 'India') selected="selected" @endif>India</option>
                                        <option value="Indonesia" @if (Input::old('country') == 'Indonesia') selected="selected" @endif>Indonesia</option>
                                        <option value="Iran" @if (Input::old('country') == 'Iran') selected="selected" @endif>Iran</option>
                                        <option value="Iraq" @if (Input::old('country') == 'Iraq') selected="selected" @endif>Iraq</option>
                                        <option value="Ireland" @if (Input::old('country') == 'Ireland') selected="selected" @endif>Ireland</option>
                                        <option value="Isle of Man" @if (Input::old('country') == 'Isle of Man') selected="selected" @endif>Isle of Man</option>
                                        <option value="Israel" @if (Input::old('country') == 'Israel') selected="selected" @endif>Israel</option>
                                        <option value="Italy" @if (Input::old('country') == 'Italy') selected="selected" @endif>Italy</option>
                                        <option value="Jamaica" @if (Input::old('country') == 'Jamaica') selected="selected" @endif>Jamaica</option>
                                        <option value="Jan Mayen" @if (Input::old('country') == 'Jan Mayen') selected="selected" @endif>Jan Mayen</option>
                                        <option value="Japan" @if (Input::old('country') == 'Japan') selected="selected" @endif>Japan</option>
                                        <option value="Jersey" @if (Input::old('country') == 'Jersey') selected="selected" @endif>Jersey</option>
                                        <option value="Jordan" @if (Input::old('country') == 'Jordan') selected="selected" @endif>Jordan</option>
                                        <option value="Kazakhstan" @if (Input::old('country') == 'Kazakhstan') selected="selected" @endif>Kazakhstan</option>
                                        <option value="Kenya" @if (Input::old('country') == 'Kenya') selected="selected" @endif>Kenya</option>
                                        <option value="Kiribati" @if (Input::old('country') == 'Kiribati') selected="selected" @endif>Kiribati</option>
                                        <option value="Korea" @if (Input::old('country') == 'Korea') selected="selected" @endif>Korea</option>
                                        <option value="Kuwait" @if (Input::old('country') == 'Kuwait') selected="selected" @endif>Kuwait</option>
                                        <option value="Kyrgyzstan" @if (Input::old('country') == 'Kyrgyzstan') selected="selected" @endif>Kyrgyzstan</option>
                                        <option value="Laos" @if (Input::old('country') == 'Laos') selected="selected" @endif>Laos</option>
                                        <option value="Latvia" @if (Input::old('country') == 'Latvia') selected="selected" @endif>Latvia</option>
                                        <option value="Lebanon" @if (Input::old('country') == 'Lebanon') selected="selected" @endif>Lebanon</option>
                                        <option value="Lesotho" @if (Input::old('country') == 'Lesotho') selected="selected" @endif>Lesotho</option>
                                        <option value="Liberia" @if (Input::old('country') == 'Liberia') selected="selected" @endif>Liberia</option>
                                        <option value="Libya" @if (Input::old('country') == 'Libya') selected="selected" @endif>Libya</option>
                                        <option value="Liechtenstein" @if (Input::old('country') == 'Liechtenstein') selected="selected" @endif>Liechtenstein</option>
                                        <option value="Lithuania" @if (Input::old('country') == 'Lithuania') selected="selected" @endif>Lithuania</option>
                                        <option value="Luxembourg" @if (Input::old('country') == 'Luxembourg') selected="selected" @endif>Luxembourg</option>
                                        <option value="Macao SAR" @if (Input::old('country') == 'Macao SAR') selected="selected" @endif>Macao SAR</option>
                                        <option value="Macedonia, Former Yugoslav Republic of" @if (Input::old('country') == 'Macedonia, Former Yugoslav Republic of') selected="selected" @endif>Macedonia, Former Yugoslav Republic of</option>
                                        <option value="Madagascar" @if (Input::old('country') == 'Madagascar') selected="selected" @endif>Madagascar</option>
                                        <option value="Malawi" @if (Input::old('country') == 'Malawi') selected="selected" @endif>Malawi</option>
                                        <option value="Malaysia" @if (Input::old('country') == 'Malaysia') selected="selected" @endif>Malaysia</option>
                                        <option value="Maldives" @if (Input::old('country') == 'Maldives') selected="selected" @endif>Maldives</option>
                                        <option value="Mali" @if (Input::old('country') == 'Mali') selected="selected" @endif>Mali</option>
                                        <option value="Malta" @if (Input::old('country') == 'Malta') selected="selected" @endif>Malta</option>
                                        <option value="Marshall Islands" @if (Input::old('country') == 'Marshall Islands') selected="selected" @endif>Marshall Islands</option>
                                        <option value="Martinique" @if (Input::old('country') == 'Martinique') selected="selected" @endif>Martinique</option>
                                        <option value="Mauritania" @if (Input::old('country') == 'Mauritania') selected="selected" @endif>Mauritania</option>
                                        <option value="Mauritius" @if (Input::old('country') == 'Mauritius') selected="selected" @endif>Mauritius</option>
                                        <option value="Mayotte" @if (Input::old('country') == 'Mayotte') selected="selected" @endif>Mayotte</option>
                                        <option value="Mexico" @if (Input::old('country') == 'Mexico') selected="selected" @endif>Mexico</option>
                                        <option value="Micronesia" @if (Input::old('country') == 'Micronesia') selected="selected" @endif>Micronesia</option>
                                        <option value="Moldova" @if (Input::old('country') == 'Moldova') selected="selected" @endif>Moldova</option>
                                        <option value="Monaco" @if (Input::old('country') == 'Monaco') selected="selected" @endif>Monaco</option>
                                        <option value="Mongolia" @if (Input::old('country') == 'Mongolia') selected="selected" @endif>Mongolia</option>
                                        <option value="Montenegro" @if (Input::old('country') == 'Montenegro') selected="selected" @endif>Montenegro</option>
                                        <option value="Montserrat" @if (Input::old('country') == 'Montserrat') selected="selected" @endif>Montserrat</option>
                                        <option value="Morocco" @if (Input::old('country') == 'Morocco') selected="selected" @endif>Morocco</option>
                                        <option value="Mozambique" @if (Input::old('country') == 'Mozambique') selected="selected" @endif>Mozambique</option>
                                        <option value="Myanmar" @if (Input::old('country') == 'Myanmar') selected="selected" @endif>Myanmar</option>
                                        <option value="Namibia" @if (Input::old('country') == 'Namibia') selected="selected" @endif>Namibia</option>
                                        <option value="Nauru" @if (Input::old('country') == 'Nauru') selected="selected" @endif>Nauru</option>
                                        <option value="Nepal" @if (Input::old('country') == 'Nepal') selected="selected" @endif>Nepal</option>
                                        <option value="Netherlands" @if (Input::old('country') == 'Netherlands') selected="selected" @endif>Netherlands</option>
                                        <option value="New Caledonia" @if (Input::old('country') == 'New Caledonia') selected="selected" @endif>New Caledonia</option>
                                        <option value="New Zealand" @if (Input::old('country') == 'New Zealand') selected="selected" @endif>New Zealand</option>
                                        <option value="Nicaragua" @if (Input::old('country') == 'Nicaragua') selected="selected" @endif>Nicaragua</option>
                                        <option value="Niger" @if (Input::old('country') == 'Niger') selected="selected" @endif>Niger</option>
                                        <option value="Nigeria" @if (Input::old('country') == 'Nigeria') selected="selected" @endif>Nigeria</option>
                                        <option value="Niue" @if (Input::old('country') == 'Niue') selected="selected" @endif>Niue</option>
                                        <option value="Norfolk Island" @if (Input::old('country') == 'Norfolk Island') selected="selected" @endif>Norfolk Island</option>
                                        <option value="North Korea" @if (Input::old('country') == 'North Korea') selected="selected" @endif>North Korea</option>
                                        <option value="Northern Mariana Islands" @if (Input::old('country') == 'Northern Mariana Islands') selected="selected" @endif>Northern Mariana Islands</option>
                                        <option value="Norway" @if (Input::old('country') == 'Norway') selected="selected" @endif>Norway</option>
                                        <option value="Oman" @if (Input::old('country') == 'Oman') selected="selected" @endif>Oman</option>
                                        <option value="Pakistan" @if (Input::old('country') == 'Pakistan') selected="selected" @endif>Pakistan</option>
                                        <option value="Palau" @if (Input::old('country') == 'Palau') selected="selected" @endif>Palau</option>
                                        <option value="Palestinian Authority" @if (Input::old('country') == 'Palestinian Authority') selected="selected" @endif>Palestinian Authority</option>
                                        <option value="Panama" @if (Input::old('country') == 'Panama') selected="selected" @endif>Panama</option>
                                        <option value="Papua New Guinea" @if (Input::old('country') == 'Papua New Guinea') selected="selected" @endif>Papua New Guinea</option>
                                        <option value="Paraguay" @if (Input::old('country') == 'Paraguay') selected="selected" @endif>Paraguay</option>
                                        <option value="Peru" @if (Input::old('country') == 'Peru') selected="selected" @endif>Peru</option>
                                        <option value="Philippines" @if (Input::old('country') == 'Philippines') selected="selected" @endif>Philippines</option>
                                        <option value="Pitcairn Islands" @if (Input::old('country') == 'Pitcairn Islands') selected="selected" @endif>Pitcairn Islands</option>
                                        <option value="Poland" @if (Input::old('country') == 'Poland') selected="selected" @endif>Poland</option>
                                        <option value="Portugal" @if (Input::old('country') == 'Portugal') selected="selected" @endif>Portugal</option>
                                        <option value="Puerto Rico" @if (Input::old('country') == 'Puerto Rico') selected="selected" @endif>Puerto Rico</option>
                                        <option value="Qatar" @if (Input::old('country') == 'Qatar') selected="selected" @endif>Qatar</option>
                                        <option value="Republic of Côte d'Ivoire" @if (Input::old('country') == 'Republic of Côte d\'Ivoire') selected="selected" @endif>Republic of Côte d'Ivoire</option>
                                        <option value="Reunion" @if (Input::old('country') == 'Reunion') selected="selected" @endif>Reunion</option>
                                        <option value="Romania" @if (Input::old('country') == 'Romania') selected="selected" @endif>Romania</option>
                                        <option value="Russia" @if (Input::old('country') == 'Russia') selected="selected" @endif>Russia</option>
                                        <option value="Rwanda" @if (Input::old('country') == 'Rwanda') selected="selected" @endif>Rwanda</option>
                                        <option value="Saba" @if (Input::old('country') == 'Saba') selected="selected" @endif>Saba</option>
                                        <option value="Samoa" @if (Input::old('country') == 'Samoa') selected="selected" @endif>Samoa</option>
                                        <option value="San Marino" @if (Input::old('country') == 'San Marino') selected="selected" @endif>San Marino</option>
                                        <option value="São Tomé and Príncipe" @if (Input::old('country') == 'São Tomé and Príncipe') selected="selected" @endif>São Tomé and Príncipe</option>
                                        <option value="Saudi Arabia" @if (Input::old('country') == 'Saudi Arabia') selected="selected" @endif>Saudi Arabia</option>
                                        <option value="Senegal" @if (Input::old('country') == 'Senegal') selected="selected" @endif>Senegal</option>
                                        <option value="Serbia" @if (Input::old('country') == 'Serbia') selected="selected" @endif>Serbia</option>
                                        <option value="Seychelles" @if (Input::old('country') == 'Seychelles') selected="selected" @endif>Seychelles</option>
                                        <option value="Sierra Leone" @if (Input::old('country') == 'Sierra Leone') selected="selected" @endif>Sierra Leone</option>
                                        <option value="Singapore" @if (Input::old('country') == 'Singapore') selected="selected" @endif>Singapore</option>
                                        <option value="Sint Eustatius" @if (Input::old('country') == 'Sint Eustatius') selected="selected" @endif>Sint Eustatius</option>
                                        <option value="Sint Maarten" @if (Input::old('country') == 'Sint Maarten') selected="selected" @endif>Sint Maarten</option>
                                        <option value="Slovakia" @if (Input::old('country') == 'Slovakia') selected="selected" @endif>Slovakia</option>
                                        <option value="Slovenia" @if (Input::old('country') == 'Slovenia') selected="selected" @endif>Slovenia</option>
                                        <option value="Solomon Islands" @if (Input::old('country') == 'Solomon Islands') selected="selected" @endif>Solomon Islands</option>
                                        <option value="Somalia" @if (Input::old('country') == 'Somalia') selected="selected" @endif>Somalia</option>
                                        <option value="South Africa" @if (Input::old('country') == 'South Africa') selected="selected" @endif>South Africa</option>
                                        <option value="South Georgia and the South Sandwich Islands" @if (Input::old('country') == 'South Georgia and the South Sandwich Islands') selected="selected" @endif>South Georgia and the South Sandwich Islands</option>
                                        <option value="Spain" @if (Input::old('country') == 'Spain') selected="selected" @endif>Spain</option>
                                        <option value="Sri Lanka" @if (Input::old('country') == 'Sri Lanka') selected="selected" @endif>Sri Lanka</option>
                                        <option value="St. Barthélemy" @if (Input::old('country') == 'St. Barthélemy') selected="selected" @endif>St. Barthélemy</option>
                                        <option value="St. Helena" @if (Input::old('country') == 'St. Helena') selected="selected" @endif>St. Helena</option>
                                        <option value="St. Kitts and Nevis" @if (Input::old('country') == 'St. Kitts and Nevis') selected="selected" @endif>St. Kitts and Nevis</option>
                                        <option value="St. Lucia" @if (Input::old('country') == 'St. Lucia') selected="selected" @endif>St. Lucia</option>
                                        <option value="St. Martin" @if (Input::old('country') == 'St. Martin') selected="selected" @endif>St. Martin</option>
                                        <option value="St. Pierre and Miquelon" @if (Input::old('country') == 'St. Pierre and Miquelon') selected="selected" @endif>St. Pierre and Miquelon</option>
                                        <option value="St. Vincent and the Grenadines" @if (Input::old('country') == 'St. Vincent and the Grenadines') selected="selected" @endif>St. Vincent and the Grenadines</option>
                                        <option value="Sudan" @if (Input::old('country') == 'Sudan') selected="selected" @endif>Sudan</option>
                                        <option value="Suriname" @if (Input::old('country') == 'Suriname') selected="selected" @endif>Suriname</option>
                                        <option value="Swaziland" @if (Input::old('country') == 'Swaziland') selected="selected" @endif>Swaziland</option>
                                        <option value="Sweden" @if (Input::old('country') == 'Sweden') selected="selected" @endif>Sweden</option>
                                        <option value="Switzerland" @if (Input::old('country') == 'Switzerland') selected="selected" @endif>Switzerland</option>
                                        <option value="Syria" @if (Input::old('country') == 'Syria') selected="selected" @endif>Syria</option>
                                        <option value="Taiwan" @if (Input::old('country') == 'Taiwan') selected="selected" @endif>Taiwan</option>
                                        <option value="Tajikistan" @if (Input::old('country') == 'Tajikistan') selected="selected" @endif>Tajikistan</option>
                                        <option value="Tanzania" @if (Input::old('country') == 'Tanzania') selected="selected" @endif>Tanzania</option>
                                        <option value="Thailand" @if (Input::old('country') == 'Thailand') selected="selected" @endif>Thailand</option>
                                        <option value="Timor-Leste" @if (Input::old('country') == 'Timor-Leste') selected="selected" @endif>Timor-Leste</option>
                                        <option value="Togo" @if (Input::old('country') == 'Togo') selected="selected" @endif>Togo</option>
                                        <option value="Tokelau" @if (Input::old('country') == 'Tokelau') selected="selected" @endif>Tokelau</option>
                                        <option value="Tonga" @if (Input::old('country') == 'Tonga') selected="selected" @endif>Tonga</option>
                                        <option value="Trinidad and Tobago" @if (Input::old('country') == 'Trinidad and Tobago') selected="selected" @endif>Trinidad and Tobago</option>
                                        <option value="Tunisia" @if (Input::old('country') == 'Tunisia') selected="selected" @endif>Tunisia</option>
                                        <option value="Turkey" @if (Input::old('country') == 'Turkey') selected="selected" @endif>Turkey</option>
                                        <option value="Turkmenistan" @if (Input::old('country') == 'Turkmenistan') selected="selected" @endif>Turkmenistan</option>
                                        <option value="Turks and Caicos Islands" @if (Input::old('country') == 'Turks and Caicos Islands') selected="selected" @endif>Turks and Caicos Islands</option>
                                        <option value="Tuvalu" @if (Input::old('country') == 'Tuvalu') selected="selected" @endif>Tuvalu</option>
                                        <option value="Uganda" @if (Input::old('country') == 'Uganda') selected="selected" @endif>Uganda</option>
                                        <option value="Ukraine" @if (Input::old('country') == 'Ukraine') selected="selected" @endif>Ukraine</option>
                                        <option value="United Arab Emirates" @if (Input::old('country') == 'United Arab Emirates') selected="selected" @endif>United Arab Emirates</option>
                                        <option value="United Kingdom" @if (Input::old('country') == 'United Kingdom') selected="selected" @endif>United Kingdom</option>
                                        <option value="United States" @if (Input::old('country') == 'United States') selected="selected" @endif>United States</option>
                                        <option value="United States Minor Outlying Islands" @if (Input::old('country') == '>United States Minor Outlying Islands') selected="selected" @endif>United States Minor Outlying Islands</option>
                                        <option value="Uruguay" @if (Input::old('country') == 'Uruguay') selected="selected" @endif>Uruguay</option>
                                        <option value="Uzbekistan" @if (Input::old('country') == 'Uzbekistan') selected="selected" @endif>Uzbekistan</option>
                                        <option value="Vanuatu" @if (Input::old('country') == 'Vanuatu') selected="selected" @endif>Vanuatu</option>
                                        <option value="Vatican City" @if (Input::old('country') == 'Vatican City') selected="selected" @endif>Vatican City</option>
                                        <option value="Venezuela" @if (Input::old('country') == 'Venezuela') selected="selected" @endif>Venezuela</option>
                                        <option value="Vietnam" @if (Input::old('country') == 'Vietnam') selected="selected" @endif>Vietnam</option>
                                        <option value="Virgin Islands, British" @if (Input::old('country') == 'Virgin Islands, British') selected="selected" @endif>Virgin Islands, British</option>
                                        <option value="Virgin Islands, U.S." @if (Input::old('country') == 'Virgin Islands, U.S.') selected="selected" @endif>Virgin Islands, U.S.</option>
                                        <option value="Wallis and Futuna" @if (Input::old('country') == 'Wallis and Futuna') selected="selected" @endif>Wallis and Futuna</option>
                                        <option value="Yemen" @if (Input::old('country') == 'Yemen') selected="selected" @endif>Yemen</option>
                                        <option value="Zambia" @if (Input::old('country') == 'Zambia') selected="selected" @endif>Zambia</option>
                                        <option value="Zimbabwe" @if (Input::old('country') == 'Zimbabwe') selected="selected" @endif>Zimbabwe</option>
                                      </select>
                                    </td>
                         </tr>
                         <tr>
                            <td class="tooltip_td" colspan="2">
                                  @if ($errors->has('country'))
                                  <div class="validation">
                                        {{ $errors->get('country')['0'] }} 
                                  </div>
                                  @endif
                            </td> 
                          </tr>   

                          <tr>
                            <td> City <span class="red_asterix">*</span>: </td>
                            <td> <input type="text" class="career_input" placeholder="City" name="city" value="{{Input::old('city')}}" />  </td>
                          </tr>
                           <tr>
                            <td class="tooltip_td" colspan="2">
                                  @if ($errors->has('city'))
                                  <div class="validation">
                                        {{ $errors->get('city')['0'] }} 
                                  </div>
                                  @endif
                            </td> 
                          </tr>  

                          <tr>
                            <td> Shipping Address <span class="red_asterix">*</span>: </td>
                            <td> <textarea id="test" class="career_input" placeholder="Address" name="address" value="{{Input::old('address')}}"></textarea> </td>
                          </tr>
                           <td class="tooltip_td" colspan="2">
                                  @if ($errors->has('address'))
                                  <div class="validation">
                                        {{ $errors->get('address')['0'] }} 
                                  </div>
                                  @endif
                            </td>  

                    </table>

                
                 <h1 class="contact_info_title" style="padding-left:15px;"> PAYMENT INFORMATION </h1>

                 <table class="careers_table">
                      <!-- <tr>
                        <td> Promo Code <span class="red_asterix">*</span>: </td>
                        <td> <input type="text" name="promocode" class="career_input" placeholder="Promo Code" value="{{Input::old('promocode')}}"/> </td>
                      </tr>
                      <tr>
                        <td class="tooltip_td" colspan="2">
                              @if ($errors->has('promocode'))
                              <div class="validation">
                                    {{ $errors->get('promocode')['0'] }} 
                              </div>
                              @endif
                        </td> 
                      </tr> 
                       -->

                      <tr>
                        <td class="tooltip_td"> Payment Method <span class="red_asterix">*</span>: </td>
                        <td>
                          <input class="payment_method" id="cash_on_delivery" type="radio" name="payement" value="1" disabled = "disabled"/> <label for="cash_on_delivery"> Cash on Delivery <i>(Available only for UAE)</i> </label><br/>
                          <input class="payment_method" id="online_payment" type="radio" name="payement" value="0" checked/> <label for="online_payment"> Online payment </label>
                        </td>
                      </tr>

                      <tr>
                          <td></td>
                          <td class="pull-right">
                            <input id="checkout_button" name="checkout" type="submit" class="btn" style="width:100px; font-family:MontserratLight; color:white;
                            background-color:#5d8c7a;" value="Checkout"/>
                          </td>
                      </tr>

                  </table>

              {{ Form::close() }}
             <br/>
             </div> <!-- end application_form -->
            <br/>
          </div> <!-- end col-6 -->
       </div> 


    </div> <!-- end container -->

</div>

<script type="text/javascript">
  

  $( document ).ready(function() { 

    if( $('#country').val() == 'United Arab Emirates' )
        $('#cash_on_delivery').attr("disabled",false); // enable the cash on delivery radio button

    $('#country').change( function(){

        // when changing the country enable cash on delivery if the user selects UAE and disable it if selecting other countries
        if($('#country').val() == "United Arab Emirates")
            $('#cash_on_delivery').attr("disabled",false);
        else
        {   

            if($("input[name='payement']:checked").val() == 1 ) // cash on delivery
                {
                    alert('You can online use the payment method "Cash on delivery" inside the UAE');
                    $('#country').val('United Arab Emirates');  
                  //  $('#cash_on_delivery').attr("disabled",true); // disable the cash on delivery radio button
                  //  $("#online_payment").prop("checked", true); // check the online payment radio button     
                }

            if($("input[name='payement']:checked").val() == 0 ) // online payment
                {
                     alert('For temporary shipment reasons, you can only pay online for a shipping address inside the UAE');
                     $('#country').val('United Arab Emirates');
                     $('#cash_on_delivery').attr("disabled",false);   
                }

        }

    });

 
});
  
</script>
<script type='text/javascript' src='js/header_margin.js'></script>



@stop


