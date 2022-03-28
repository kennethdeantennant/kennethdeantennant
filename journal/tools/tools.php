<?php
    class Tools{

        function caseWord($text){
            $counts=0;
            $caseText="";
            $noUpper = array('a','an','are','at','from','in','is','of','the','to');
            $words = split(' ', $text);
            foreach($words as $word)
            {
                $counts+=1;
                // Take out commas and periods
                $word = str_replace("'","",$word);
                $word = str_replace(".","",$word);	
                // Not in array, word length greater than one, first position in word not (
                if((!in_array(trim($word),$noUpper) || $counts<2) && strlen(trim($word))>1 && substr($word, 0, 1)!="("){
                    $caseText=trim($caseText)." ".strtoupper(substr($word, 0, 1)).substr($word, 1);
                // Not in array, word length greater than one
                }else if((!in_array(trim($word),$noUpper) || $counts<2) && strlen(trim($word))>1){
                    $caseText=trim($caseText)." ".substr($word, 0, 1).strtoupper($word[1]).substr($word, 2);
                }else{
                    $caseText=trim($caseText)." ".trim($word);
                }
            }
            return trim($caseText);
        }
		
		function sendWelcomeEmail( $to, $name ){
			// subject
			$subject = 'Welcome to THE Money Manager - Registration';
			
			// message
			$message = 
				'Welcome!' . 
				"\r\n" . 
				"\r\n" . 
				'This is to notify you that you have registered on THE Money Manager website.  If this is done in error or you have questions about the site, please let me know.' .
				"\r\n" .
				"\r\n" .
				'Thanks for taking an interest and registering to use the site!' . "\r\n" . "\r\n" .'Sincerely,' . "\r\n" .'Ken Tennant';
			
			// To send HTML mail, the Content-type header must be set
			$headers   = array();
			$headers[] = "MIME-Version: 1.0";
			$headers[] = "Content-type: text/plain; charset=iso-8859-1";
			$headers[] = "From: Ken Tennant <kennethdeantennant@gmail.com>";
			$headers[] = "Bcc: Ken Tennant <kennethdeantennant@gmail.com>";
			$headers[] = "Reply-To: $name <$to>";
			$headers[] = "Subject: {$subject}";
			$headers[] = "X-Mailer: PHP/".phpversion();
			
			// Mail it
			mail($to, $subject, $message, implode("\r\n", $headers));
        }

		function sendUpdateEmail( $to, $name ){
			// subject
            $subject = 'THE Money Manager - Account Changes Made';

			// message
            $message = 
				'--- NOTIFICATION ---' . 
				"\r\n" . 
				"\r\n" . 
				'I am informing you that your account is updated on THE Money Manager website.  If this is done in error, please let me know.' . 
				"\r\n" . 
				"\r\n" .
				'Sincerely,' . 
				"\r\n" .
				'Ken Tennant';

			// To send HTML mail, the Content-type header must be set
			$headers   = array();
			$headers[] = "MIME-Version: 1.0";
			$headers[] = "Content-type: text/plain; charset=iso-8859-1";
			$headers[] = "From: Ken Tennant <kennethdeantennant@gmail.com>";
			$headers[] = "Bcc: Ken Tennant <kennethdeantennant@gmail.com>";
			$headers[] = "Reply-To: $name <$to>";
			$headers[] = "Subject: {$subject}";
			$headers[] = "X-Mailer: PHP/".phpversion();
            
			// Mail it
			mail($to, $subject, $message, implode("\r\n", $headers));
        }

    }
?>