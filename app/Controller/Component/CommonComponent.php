<?php

App::uses('AppController', 'Controller');

/**
 * Common Component
 * Developer By: pushkar
*/
class CommonComponent extends Component {

	
    function set_google_xml($data){  // get search record
   
        extract($data);
        $user_email=$user_email;
           $contact="
		<atom:entry xmlns:atom='http://www.w3.org/2005/Atom'
		xmlns:gd='http://schemas.google.com/g/2005'
		xmlns:gContact='http://schemas.google.com/contact/2008'>
	  <atom:category scheme='http://schemas.google.com/g/2005#kind'
		term='http://schemas.google.com/contact/2008#contact'/>
	  <gd:name>		
		 <gd:fullName>".$name."</gd:fullName>
	  </gd:name>
	  <atom:content type='text'>Notes</atom:content>
	  <gd:email rel='http://schemas.google.com/g/2005#work'
		primary='true'
		address='".$w_email."' displayName='".$name."'/>
	  <gd:email rel='http://schemas.google.com/g/2005#home'
		address='".$h_email."'/>";
           
           if(trim($w_phone)){
	  $contact.="<gd:phoneNumber rel='http://schemas.google.com/g/2005#work'
		>".trim($w_phone)."</gd:phoneNumber>";
           }
          
            if(trim($m_phoneNumber)){
                $contact.="<gd:phoneNumber rel='http://schemas.google.com/g/2005#mobile'
                    primary='true'>".trim($m_phoneNumber)."</gd:phoneNumber>";
            }
           
            if(trim($h_phone)){
	  $contact.="<gd:phoneNumber rel='http://schemas.google.com/g/2005#home'>".trim($h_phone)."</gd:phoneNumber>";
            }
            
            $contact.="<gd:im address='".$g_chat_email."'
		protocol='http://schemas.google.com/g/2005#GOOGLE_TALK'
		primary='true'
		rel='http://schemas.google.com/g/2005#home'/>";
	
            $contact.="<gd:structuredPostalAddress
		  rel='http://schemas.google.com/g/2005#work'
		  primary='true'>
		 <gd:formattedAddress>
		 ".$w_address."
		</gd:formattedAddress>
            </gd:structuredPostalAddress>
          
          <gd:structuredPostalAddress
		  rel='http://schemas.google.com/g/2005#home'
		>
		 <gd:formattedAddress>
		 ".$h_address."
		</gd:formattedAddress>
	 </gd:structuredPostalAddress>

                

	 <gContact:groupMembershipInfo deleted='false'
			href='http://www.google.com/m8/feeds/groups/".$user_email."/base/6'/>
	</atom:entry>
	";
           return $contact;
           /*
            <gd:structuredPostalAddress
		  rel='http://schemas.google.com/g/2005#work'
		  primary='true'>
		<gd:city>".$city."</gd:city>
		
		<gd:region>".$state."</gd:region>
		<gd:postcode>".$zipcode."</gd:postcode>
		<gd:country>".$country."</gd:country>
                 <gd:formattedAddress>
		 ".$h_address."
		</gd:formattedAddress>
		
	  </gd:structuredPostalAddress>*/
      }
      
        function date_format($timestamp) {
            if (!$timestamp) {
                $timestamp = time();
            }
            $date = date('Y-m-d\TH:i:s', $timestamp);

            $matches = array();
            if (preg_match('/^([\-+])(\d{2})(\d{2})$/', date('O', $timestamp), $matches)) {
                $date .= $matches[1].$matches[2].':'.$matches[3];
            } else {
                $date .= 'Z';
            }
            return $date;
        }
}