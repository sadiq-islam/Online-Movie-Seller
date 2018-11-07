<?php
				$username = "u1";
				$password = "1111";
				$to = "sadiq.islam96@gmail.com";
				$subject = 'Your Recovered Password!';
				$msg='Please, use this username and password to login.       Username : ' .$username. ' & Password : ' . $password . '';
				$header="From : sadiq.testmail@gmail.com";

				if(mail($to,$subject,$msg,$header))
				{
					echo "Mail Sent";
				}
				/*mail('sadiq.islam96@gmail.com','Sample mail','Sample content','From : hriday.k007@gmail.com');*/
				

?>