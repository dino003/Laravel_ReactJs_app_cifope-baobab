@extends('admin.templates.main')

@section('content')
<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700);
    .board{
    width: 97%;
margin: 2px auto;
height: 500px;
background: #fff;
/*box-shadow: 10px 10px #ccc,-10px 20px #ddd;*/
}
.board .nav-tabs {
    position: relative;
    /* border-bottom: 0; */
    /* width: 80%; */
    margin: 40px auto;
    margin-bottom: 0;
    box-sizing: border-box;

}


p.narrow{
    width: 60%;
    margin: 10px auto;
}

.liner{
    height: 2px;
    background: #ddd;
    position: absolute;
    width: 80%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 50%;
    z-index: 1;
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    /* background-color: #ffffff; */
    border: 0;
    border-bottom-color: transparent;
}

span.round-tabs{
    width: 70px;
    height: 70px;
    line-height: 70px;
    display: inline-block;
    border-radius: 100px;
    background: white;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 25px;
}

span.round-tabs.one{
    color: rgb(34, 194, 34);border: 2px solid rgb(34, 194, 34);
}

li.active span.round-tabs.one{
    background: #fff !important;
    border: 2px solid #ddd;
    color: rgb(34, 194, 34);
}

span.round-tabs.two{
    color: #febe29;border: 2px solid #febe29;
}

li.active span.round-tabs.two{
    background: #fff !important;
    border: 2px solid #ddd;
    color: #febe29;
}

span.round-tabs.three{
    color: #3e5e9a;border: 2px solid #3e5e9a;
}

li.active span.round-tabs.three{
    background: #fff !important;
    border: 2px solid #ddd;
    color: #3e5e9a;
}

span.round-tabs.four{
    color: #f1685e;border: 2px solid #f1685e;
}

li.active span.round-tabs.four{
    background: #fff !important;
    border: 2px solid #ddd;
    color: #f1685e;
}

span.round-tabs.five{
    color: #999;border: 2px solid #999;
}

li.active span.round-tabs.five{
    background: #fff !important;
    border: 2px solid #ddd;
    color: #999;
}

.nav-tabs > li.active > a span.round-tabs{
    background: #fafafa;
}
.nav-tabs > li {
    width: 20%;
}
/*li.active:before {
    content: " ";
    position: absolute;
    left: 45%;
    opacity:0;
    margin: 0 auto;
    bottom: -2px;
    border: 10px solid transparent;
    border-bottom-color: #fff;
    z-index: 1;
    transition:0.2s ease-in-out;
}*/
.nav-tabs > li:after {
    content: " ";
    position: absolute;
    left: 45%;
   opacity:0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #ddd;
    transition:0.1s ease-in-out;
    
}
.nav-tabs > li.active:after {
    content: " ";
    position: absolute;
    left: 45%;
   opacity:1;
    margin: 0 auto;
    bottom: 0px;
    border: 10px solid transparent;
    border-bottom-color: #ddd;
    
}
.nav-tabs > li a{
   width: 70px;
   height: 70px;
   margin: 20px auto;
   border-radius: 100%;
   padding: 0;
}

.nav-tabs > li a:hover{
    background: transparent;
}

.tab-content{
}
.tab-pane{
   position: relative;
padding-top: 50px;
}
.tab-content .head{
    font-family: 'Roboto Condensed', sans-serif;
    font-size: 25px;
    text-transform: uppercase;
    padding-bottom: 10px;
}
.btn-outline-rounded{
    padding: 10px 40px;
    margin: 20px 0;
    border: 2px solid transparent;
    border-radius: 25px;
}

.btn.green{
    background-color:#5cb85c;
    /*border: 2px solid #5cb85c;*/
    color: #ffffff;
}



@media( max-width : 585px ){
    
    .board {
width: 90%;
height:auto !important;
}
    span.round-tabs {
        font-size:16px;
width: 50px;
height: 50px;
line-height: 50px;
    }
    .tab-content .head{
        font-size:20px;
        }
    .nav-tabs > li a {
width: 50px;
height: 50px;
line-height:50px;
}

.nav-tabs > li.active:after {
content: " ";
position: absolute;
left: 35%;
}

.btn-outline-rounded {
    padding:12px 20px;
    }
}

.user-row {
    margin-bottom: 14px;
}

.user-row:last-child {
    margin-bottom: 0;
}

.dropdown-user {
    margin: 13px 0;
    padding: 5px;
    height: 100%;
}

.dropdown-user:hover {
    cursor: pointer;
}

.table-user-information > tbody > tr {
    border-top: 1px solid rgb(221, 221, 221);
}

.table-user-information > tbody > tr:first-child {
    border-top: 0;
}


.table-user-information > tbody > tr > td {
    border-top: 0;
}
.toppad
{margin-top:20px;
}

.message-item {
margin-bottom: 25px;
margin-left: 40px;
position: relative;
}
.message-item .message-inner {
background: #fff;
border: 1px solid #ddd;
border-radius: 3px;
padding: 10px;
position: relative;
}
.message-item .message-inner:before {
border-right: 10px solid #ddd;
border-style: solid;
border-width: 10px;
color: rgba(0,0,0,0);
content: "";
display: block;
height: 0;
position: absolute;
left: -20px;
top: 6px;
width: 0;
}
.message-item .message-inner:after {
border-right: 10px solid #fff;
border-style: solid;
border-width: 10px;
color: rgba(0,0,0,0);
content: "";
display: block;
height: 0;
position: absolute;
left: -18px;
top: 6px;
width: 0;
}
.message-item:before {
background: #fff;
border-radius: 2px;
bottom: -30px;
box-shadow: 0 0 3px rgba(0,0,0,0.2);
content: "";
height: 100%;
left: -30px;
position: absolute;
width: 3px;
}
.message-item:after {
background: #fff;
border: 2px solid #ccc;
border-radius: 50%;
box-shadow: 0 0 5px rgba(0,0,0,0.1);
content: "";
height: 15px;
left: -36px;
position: absolute;
top: 10px;
width: 15px;
}
.clearfix:before, .clearfix:after {
content: " ";
display: table;
}
.message-item .message-head {
border-bottom: 1px solid #eee;
margin-bottom: 8px;
padding-bottom: 8px;
}
.message-item .message-head .avatar {
margin-right: 20px;
}
.message-item .message-head .user-detail {
overflow: hidden;
}
.message-item .message-head .user-detail h5 {
font-size: 16px;
font-weight: bold;
margin: 0;
}
.message-item .message-head .post-meta {
float: left;
padding: 0 15px 0 0;
}
.message-item .message-head .post-meta >div {
color: #333;
font-weight: bold;
text-align: right;
}
.post-meta > div {
color: #777;
font-size: 12px;
line-height: 22px;
}
.message-item .message-head .post-meta >div {
color: #333;
font-weight: bold;
text-align: right;
}
.post-meta > div {
color: #777;
font-size: 12px;
line-height: 22px;
}
img {
 min-height: 40px;
 max-height: 40px;
}


</style>
<!-- include summernote css/js-->

        
<div class="container">


<section style="background:#efefe9; height: auto;">
        <div class="container">

        

            

 


            <div class="row">
                <div class="board" style="height: auto;">
                    <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>-->
                    <div class="board-inner">
                    <ul class="nav nav-tabs" id="myTab">
                    <div class="liner"></div>
                     <li >
                     <a href="#home" data-toggle="tab" title="">
                      
                  </a></li>

                     <li class="active">
                    <a href="#profile" data-toggle="tab" title="profil">
                     <span class="round-tabs two">
                         <i class="glyphicon glyphicon-user"></i>
                         <span style="font-size: 15px;"> Profil</span>
                     </span> 
           </a>
                 </li>
                 <li><a href="#messages" data-toggle="tab" title="Modifier mon mot de passe">
                     <span class="round-tabs three" style="width: 100px;">
                          <i class="glyphicon glyphicon-lock"></i>
                          <span style="font-size: 15px;"> Mot de passe</span>
                          
                     </span> </a>
                     </li>



                     <li><a href="#settings" data-toggle="tab" >
                         
                     </a></li>
                     <!--
                     <li><a href="#doner" data-toggle="tab" title="completed">
                         <span class="round-tabs four">
                         <span style="font-size: 6px;"> Communaute de pratiques</span>


                         </span> </a>
                     </li>
                     -->
                   
                     
                     </ul></div>

                     <div class="tab-content">
                       
           
                      <div class="tab-pane fade in active" id="profile" style="height: auto;">
                         

      
     
        <div class="col-xs-12 col-sm-12 toppad" >
   
   
          <div class="panel panel-info">
              @php
                $auth = Auth::user();
              @endphp
            <div class="panel-heading">
              <h3 class="panel-title">{{$auth->userName()}}</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{$auth->photo}}" class="img-circle img-responsive"> </div>
                
                @php
                    $prof = \App\User::find(Auth::user()->id)->profil()->latest()->first(); 

                    $date_naissance = \App\User::find(Auth::user()->id)->profil()->latest()->first(); 


                @endphp
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Nom</td>
                        <td>{{$auth->name}}</td>
                      </tr>
                      <tr>
                        <td>Prénoms</td>
                        <td>{{$auth->prenom}}</td>
                      </tr>
                     
                   
                         
                           
                        
                      <tr>
                        <td>Email</td>
                        <td>{{$auth->email}}</td>
                      </tr>

                        <tr>
                        <td>Numero de téléphone</td>
                        <td>{{$auth->numero}}</td>

                        </tr>

                       
                        <tr>
                        <td>Matricule</td>
                        @if(isset($prof->matricule))
                        <td>{{$prof->matricule}}</td>
                        @endif
                        </tr>
                       
                        <tr>
                        <td>Nom de l'Organisme</td>
                        @if(isset($prof->nom_organisme))

                        <td>{{$prof->nom_organisme}}</td>
                        @endif
                        </tr>
                       
                        <tr>
                        <td>Fonction</td>
                        @if(isset($prof->fonction))

                        <td>{{$prof->fonction}}</td>
                        @endif
                        </tr>
                        <tr>
                        <td>Adresse</td>
                        @if(isset($prof->adresse))

                        <td>{{$prof->adresse}}</td>
                        @endif
                        </tr>
                        <tr>
                        <td>Pays</td>
                        @if(isset($prof->pays))

                        <td>{{$prof->pays}}</td>
                        @endif

                        </tr>
                        <tr>
                        <td>Télécopie</td>
                        @if(isset($prof->telecopie))

                        <td>{{$prof->telecopie}}</td>
                        @endif
                        </tr>

                        <tr>
                        <td>Date de naisance</td>
                        @if(isset($prof->naissance))

                        <td>{{$prof->maDateSimple()}}</td>
                        @endif
                        </tr>
                           
                    
                     
                    </tbody>
                  </table>
                  <!--
                    <a href="#" @click.prevent="mod" data-original-title="Modifier mes infos"  type="button" class="btn btn-sm btn-warning pull-right"><i class="glyphicon glyphicon-edit"></i></a>
                    -->
                </div>
              </div>
            </div>
            <!--
                 <div class="panel-footer">
                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
                            <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                    </div>

                    -->
            
          </div>
        </div>
       

                 <form class="ui form" action="{{url('completer_profil')}}" method="post">
                  {{csrf_field()}}
  <h4 class="ui dividing header">Modifier mes Informations</h4>

   <div class="fields">
    <div class="nine wide field">
      <label>Matricule</label>
      <input type="text" name="matricule" 
      <?php if (isset($prof->matricule)) {

            ?>
                              value="{{$prof->matricule}}"
                            <?php

                        }
                        ?>
             >
    </div>
   
    <div class="seven wide field">
      <label>Civilité</label>
      
          <select class="ui fluid search dropdown" name="civilite"
          <?php if (isset($prof->civilite)) {

                ?>
                              value="{{$prof->civilite}}"
                            <?php

                        }
                        ?> >

                             <?php if (isset($prof->civilite)) {
                                ?>   
                                <option selected>{{$prof->civilite}}</option>
                             

                            <?php

                        }
                        ?>
            <option value="M.">M.</option>
            <option value="Mme">Mme</option>
            <option value="Mlle">Mlle</option>

           
          </select>
      
       
    
    </div>
  </div>
   <div class="fields">
    <div class="seven wide field">
      <label>Fonction</label>
      <input type="text" name="fonction" 
      <?php if (isset($prof->fonction)) {

            ?>
                              value="{{$prof->fonction}}"
                            <?php

                        }
                        ?>
      >
    </div>

    <div class="nine wide field">
      <label>Nom de L'organisme</label>
      <input type="text" name="nom_organisme" 
      <?php if (isset($prof->nom_organisme)) {

            ?>
                              value="{{$prof->nom_organisme}}"
                            <?php

                        }
                        ?>
      >
    </div>
   
   
  </div>
  <div class="field">
    <label> Adresse</label>
    <div class="fields">
      <div class="nine wide field">
        <input type="text" name="adresse" 
        <?php if (isset($prof->adresse)) {

            ?>
                              value="{{$prof->adresse}}"
                            <?php

                        }
                        ?>
        >
      </div>
      <div class="seven wide field">
        <input type="date" name="naissance" 
        <?php if (isset($prof->naissance)) 
        {

            ?>
                  value="{{$prof->naissance}}"
                <?php

            }
            ?>
        >
      </div>
    </div>
  </div>
  <div class="two fields">
    <div class="field">
      <label>Télécopie</label>
      <div class="sixteen wide field">
        <input type="text" name="telecopie" 
        <?php if (isset($prof->telecopie)) {

            ?>
                              value="{{$prof->telecopie}}"
                            <?php

                        }
                        ?>
        >
      </div>
    </div>

    <div class="field">
      <label>Numéro de téléphone</label>
      <div class="ten wide field">
        <input type="tel" name="numeroTelephone" 
        <?php if (isset($prof->numeroTelephone)) {

            ?>
                              value="{{$prof->numeroTelephone}}"
                            <?php

                        }
                        ?>
        >
      </div>
    </div>
    <div class="field">
      <label>Pays</label>
      <select name="pays" 
      <?php if (isset($prof->pays)) {

            ?>
                              value="{{$prof->pays}}"
                            <?php

                        }
                        ?> >
      >

        <?php if (isset($prof->pays)) {
            ?>   
                                <option selected>{{$prof->pays}}</option>
                             

                            <?php

                        }
                        ?>
  <option value="United States">United States</option> 
  <option value="United Kingdom">United Kingdom</option> 
  <option value="Afghanistan">Afghanistan</option> 
  <option value="Albania">Albania</option> 
  <option value="Algeria">Algeria</option> 
  <option value="American Samoa">American Samoa</option> 
  <option value="Andorra">Andorra</option> 
  <option value="Angola">Angola</option> 
  <option value="Anguilla">Anguilla</option> 
  <option value="Antarctica">Antarctica</option> 
  <option value="Antigua and Barbuda">Antigua and Barbuda</option> 
  <option value="Argentina">Argentina</option> 
  <option value="Armenia">Armenia</option> 
  <option value="Aruba">Aruba</option> 
  <option value="Australia">Australia</option> 
  <option value="Austria">Austria</option> 
  <option value="Azerbaijan">Azerbaijan</option> 
  <option value="Bahamas">Bahamas</option> 
  <option value="Bahrain">Bahrain</option> 
  <option value="Bangladesh">Bangladesh</option> 
  <option value="Barbados">Barbados</option> 
  <option value="Belarus">Belarus</option> 
  <option value="Belgium">Belgium</option> 
  <option value="Belize">Belize</option> 
  <option value="Benin">Benin</option> 
  <option value="Bermuda">Bermuda</option> 
  <option value="Bhutan">Bhutan</option> 
  <option value="Bolivia">Bolivia</option> 
  <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
  <option value="Botswana">Botswana</option> 
  <option value="Bouvet Island">Bouvet Island</option> 
  <option value="Brazil">Brazil</option> 
  <option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
  <option value="Brunei Darussalam">Brunei Darussalam</option> 
  <option value="Bulgaria">Bulgaria</option> 
  <option value="Burkina Faso">Burkina Faso</option> 
  <option value="Burundi">Burundi</option> 
  <option value="Cambodia">Cambodia</option> 
  <option value="Cameroon">Cameroon</option> 
  <option value="Canada">Canada</option> 
  <option value="Cape Verde">Cape Verde</option> 
  <option value="Cayman Islands">Cayman Islands</option> 
  <option value="Central African Republic">Central African Republic</option> 
  <option value="Chad">Chad</option> 
  <option value="Chile">Chile</option> 
  <option value="China">China</option> 
  <option value="Christmas Island">Christmas Island</option> 
  <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
  <option value="Colombia">Colombia</option> 
  <option value="Comoros">Comoros</option> 
  <option value="Congo">Congo</option> 
  <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option> 
  <option value="Cook Islands">Cook Islands</option> 
  <option value="Costa Rica">Costa Rica</option> 
  <option value="Cote D'ivoire">Cote D'ivoire</option> 
  <option value="Croatia">Croatia</option> 
  <option value="Cuba">Cuba</option> 
  <option value="Cyprus">Cyprus</option> 
  <option value="Czech Republic">Czech Republic</option> 
  <option value="Denmark">Denmark</option> 
  <option value="Djibouti">Djibouti</option> 
  <option value="Dominica">Dominica</option> 
  <option value="Dominican Republic">Dominican Republic</option> 
  <option value="Ecuador">Ecuador</option> 
  <option value="Egypt">Egypt</option> 
  <option value="El Salvador">El Salvador</option> 
  <option value="Equatorial Guinea">Equatorial Guinea</option> 
  <option value="Eritrea">Eritrea</option> 
  <option value="Estonia">Estonia</option> 
  <option value="Ethiopia">Ethiopia</option> 
  <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
  <option value="Faroe Islands">Faroe Islands</option> 
  <option value="Fiji">Fiji</option> 
  <option value="Finland">Finland</option> 
  <option value="France">France</option> 
  <option value="French Guiana">French Guiana</option> 
  <option value="French Polynesia">French Polynesia</option> 
  <option value="French Southern Territories">French Southern Territories</option> 
  <option value="Gabon">Gabon</option> 
  <option value="Gambia">Gambia</option> 
  <option value="Georgia">Georgia</option> 
  <option value="Germany">Germany</option> 
  <option value="Ghana">Ghana</option> 
  <option value="Gibraltar">Gibraltar</option> 
  <option value="Greece">Greece</option> 
  <option value="Greenland">Greenland</option> 
  <option value="Grenada">Grenada</option> 
  <option value="Guadeloupe">Guadeloupe</option> 
  <option value="Guam">Guam</option> 
  <option value="Guatemala">Guatemala</option> 
  <option value="Guinea">Guinea</option> 
  <option value="Guinea-bissau">Guinea-bissau</option> 
  <option value="Guyana">Guyana</option> 
  <option value="Haiti">Haiti</option> 
  <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option> 
  <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 
  <option value="Honduras">Honduras</option> 
  <option value="Hong Kong">Hong Kong</option> 
  <option value="Hungary">Hungary</option> 
  <option value="Iceland">Iceland</option> 
  <option value="India">India</option> 
  <option value="Indonesia">Indonesia</option> 
  <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
  <option value="Iraq">Iraq</option> 
  <option value="Ireland">Ireland</option> 
  <option value="Israel">Israel</option> 
  <option value="Italy">Italy</option> 
  <option value="Jamaica">Jamaica</option> 
  <option value="Japan">Japan</option> 
  <option value="Jordan">Jordan</option> 
  <option value="Kazakhstan">Kazakhstan</option> 
  <option value="Kenya">Kenya</option> 
  <option value="Kiribati">Kiribati</option> 
  <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option> 
  <option value="Korea, Republic of">Korea, Republic of</option> 
  <option value="Kuwait">Kuwait</option> 
  <option value="Kyrgyzstan">Kyrgyzstan</option> 
  <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
  <option value="Latvia">Latvia</option> 
  <option value="Lebanon">Lebanon</option> 
  <option value="Lesotho">Lesotho</option> 
  <option value="Liberia">Liberia</option> 
  <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 
  <option value="Liechtenstein">Liechtenstein</option> 
  <option value="Lithuania">Lithuania</option> 
  <option value="Luxembourg">Luxembourg</option> 
  <option value="Macao">Macao</option> 
  <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option> 
  <option value="Madagascar">Madagascar</option> 
  <option value="Malawi">Malawi</option> 
  <option value="Malaysia">Malaysia</option> 
  <option value="Maldives">Maldives</option> 
  <option value="Mali">Mali</option> 
  <option value="Malta">Malta</option> 
  <option value="Marshall Islands">Marshall Islands</option> 
  <option value="Martinique">Martinique</option> 
  <option value="Mauritania">Mauritania</option> 
  <option value="Mauritius">Mauritius</option> 
  <option value="Mayotte">Mayotte</option> 
  <option value="Mexico">Mexico</option> 
  <option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 
  <option value="Moldova, Republic of">Moldova, Republic of</option> 
  <option value="Monaco">Monaco</option> 
  <option value="Mongolia">Mongolia</option> 
  <option value="Montserrat">Montserrat</option> 
  <option value="Morocco">Morocco</option> 
  <option value="Mozambique">Mozambique</option> 
  <option value="Myanmar">Myanmar</option> 
  <option value="Namibia">Namibia</option> 
  <option value="Nauru">Nauru</option> 
  <option value="Nepal">Nepal</option> 
  <option value="Netherlands">Netherlands</option> 
  <option value="Netherlands Antilles">Netherlands Antilles</option> 
  <option value="New Caledonia">New Caledonia</option> 
  <option value="New Zealand">New Zealand</option> 
  <option value="Nicaragua">Nicaragua</option> 
  <option value="Niger">Niger</option> 
  <option value="Nigeria">Nigeria</option> 
  <option value="Niue">Niue</option> 
  <option value="Norfolk Island">Norfolk Island</option> 
  <option value="Northern Mariana Islands">Northern Mariana Islands</option> 
  <option value="Norway">Norway</option> 
  <option value="Oman">Oman</option> 
  <option value="Pakistan">Pakistan</option> 
  <option value="Palau">Palau</option> 
  <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 
  <option value="Panama">Panama</option> 
  <option value="Papua New Guinea">Papua New Guinea</option> 
  <option value="Paraguay">Paraguay</option> 
  <option value="Peru">Peru</option> 
  <option value="Philippines">Philippines</option> 
  <option value="Pitcairn">Pitcairn</option> 
  <option value="Poland">Poland</option> 
  <option value="Portugal">Portugal</option> 
  <option value="Puerto Rico">Puerto Rico</option> 
  <option value="Qatar">Qatar</option> 
  <option value="Reunion">Reunion</option> 
  <option value="Romania">Romania</option> 
  <option value="Russian Federation">Russian Federation</option> 
  <option value="Rwanda">Rwanda</option> 
  <option value="Saint Helena">Saint Helena</option> 
  <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
  <option value="Saint Lucia">Saint Lucia</option> 
  <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
  <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 
  <option value="Samoa">Samoa</option> 
  <option value="San Marino">San Marino</option> 
  <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
  <option value="Saudi Arabia">Saudi Arabia</option> 
  <option value="Senegal">Senegal</option> 
  <option value="Serbia and Montenegro">Serbia and Montenegro</option> 
  <option value="Seychelles">Seychelles</option> 
  <option value="Sierra Leone">Sierra Leone</option> 
  <option value="Singapore">Singapore</option> 
  <option value="Slovakia">Slovakia</option> 
  <option value="Slovenia">Slovenia</option> 
  <option value="Solomon Islands">Solomon Islands</option> 
  <option value="Somalia">Somalia</option> 
  <option value="South Africa">South Africa</option> 
  <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option> 
  <option value="Spain">Spain</option> 
  <option value="Sri Lanka">Sri Lanka</option> 
  <option value="Sudan">Sudan</option> 
  <option value="Suriname">Suriname</option> 
  <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
  <option value="Swaziland">Swaziland</option> 
  <option value="Sweden">Sweden</option> 
  <option value="Switzerland">Switzerland</option> 
  <option value="Syrian Arab Republic">Syrian Arab Republic</option> 
  <option value="Taiwan, Province of China">Taiwan, Province of China</option> 
  <option value="Tajikistan">Tajikistan</option> 
  <option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
  <option value="Thailand">Thailand</option> 
  <option value="Timor-leste">Timor-leste</option> 
  <option value="Togo">Togo</option> 
  <option value="Tokelau">Tokelau</option> 
  <option value="Tonga">Tonga</option> 
  <option value="Trinidad and Tobago">Trinidad and Tobago</option> 
  <option value="Tunisia">Tunisia</option> 
  <option value="Turkey">Turkey</option> 
  <option value="Turkmenistan">Turkmenistan</option> 
  <option value="Turks and Caicos Islands">Turks and Caicos Islands</option> 
  <option value="Tuvalu">Tuvalu</option> 
  <option value="Uganda">Uganda</option> 
  <option value="Ukraine">Ukraine</option> 
  <option value="United Arab Emirates">United Arab Emirates</option> 
  <option value="United Kingdom">United Kingdom</option> 
  <option value="United States">United States</option> 
  <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option> 
  <option value="Uruguay">Uruguay</option> 
  <option value="Uzbekistan">Uzbekistan</option> 
  <option value="Vanuatu">Vanuatu</option> 
  <option value="Venezuela">Venezuela</option> 
  <option value="Viet Nam">Viet Nam</option> 
  <option value="Virgin Islands, British">Virgin Islands, British</option> 
  <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 
  <option value="Wallis and Futuna">Wallis and Futuna</option> 
  <option value="Western Sahara">Western Sahara</option> 
  <option value="Yemen">Yemen</option> 
  <option value="Zambia">Zambia</option> 
  <option value="Zimbabwe">Zimbabwe</option>
</select>
    </div>
  </div>
 
 
  <div class="ui button" tabindex="0"><button type="submit">Enregistrer</button></div>
</form>
                      <!--  fin -->
    
    
                          
                      </div>
                      <div class="tab-pane fade" id="messages">
                          <h3 class="head text-center">Modification du mot de passe</h3>
                         <form class="ui form" action="{{url('modif')}}" method="POST">
                                                 {{csrf_field()}}
                                  <div class="field">
                                    <label>Mot de passe actuel</label>
                                    <input type="password" name="old">
                                  </div>
                                  <div class="field">
                                    <label>Nouveau mot de passe</label>
                                    <input type="password" name="password">
                                  </div>

                                  <div class="field">
                                    <label>Confirmation</label>
                                    <input type="password" name="password_confirmation">
                                  </div>
                                 
                                  <button class="ui button" type="submit">Enregistrer</button>
                      </form>
                      <!-- debut profil  -->
                   
                      </div>
                      
  
 </div>
<div class="clearfix"></div>
</div>

</div>
</div>
</div>

 <div class="modal fade" tabindex="-1" role="dialog" id="update_task_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <form action="{{url('editUserPerso')}}" method="post">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="PATCH">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Modification</h4>
                    </div>
                    <div class="modal-body">
 
                       
 
                        <div class="form-group">
                            <label for="name">Nom:</label>
                        <input type="text" placeholder="" name="name" class="form-control" value="{{Auth::user()->name}}"
                                   >
                        </div>

                        <div class="form-group">
                            <label for="name">Prenom:</label>
                            <input type="text"  placeholder="" name="prenom" class="form-control" value="{{Auth::user()->prenom}}"
                                   >
                        </div>

                        <div class="form-group">
                            <label for="name">Numero de téléphone:</label>
                            <input type="text"  placeholder="" name="numero" class="form-control" value="{{Auth::user()->numero}}"
                                   >
                        </div>

                        <div class="form-group">
                            <label for="name">Email:</label>
                            <input type="email" placeholder="" name="email" class="form-control" value="{{Auth::user()->email}}"
                                   >
                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
</section>
                   

</div>
@endsection