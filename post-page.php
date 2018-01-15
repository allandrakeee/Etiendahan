<?php
	session_start();
	
	$post_page = $_SESSION['post_page'];

	if($_SESSION['post_page'] != '') {
		function get_page_access_token($user_access_token,$id_page)
		{
			$endpoint = $id_page."?fields=access_token,id,name&access_token=".$user_access_token;
			$url = "https://graph.facebook.com/".$endpoint;
			$data = array();
			
			$result = curl($url, $data, "GET");
			
			$tab = json_decode($result, true);
			return $tab["access_token"];
			
		}
	 
		//Post on your wall OR on Page
		//$user_access_token == Your token, you have to generate it every 2 hours here : https://developers.facebook.com/tools/explorer/
		//$id == Your id or the page id
		//$msg == Your msg Captain !
		//$img_url == If you want to add a picture => Direct link only
		//$post_as ==> "PAGE" = Publish on your page || "USER" (or leave empty) = Publish as you
		function posting($user_access_token, $id, $msg, $post_as)
		{
			
			$access_token = $user_access_token;
			if ($post_as == "PAGE")
			{
				//This will generate an access_token for your page
				$access_token = get_page_access_token($user_access_token, $id);
			}
			
			//Basics datas for a post
			$endpoint = "feed";
			$data["access_token"] = $access_token;
			$data["message"] = $msg;
			
			if (!empty($img_url))
			{
				//If you want to post a picture => This is the required fields
				$endpoint = "photos";
				$data["caption"] = $msg;
				$data["url"] = $img_url;
			}
			
			//Let's create the URL!
			$url = "https://graph.facebook.com/".$id."/".$endpoint;
			
			//Let's go !
			curl($url, $data, "POST");
			

		}
		
		//Usual curl 
		function curl($url, $data, $method)
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER , true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , false);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
			
			$query = http_build_query($data);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
			
			$result = curl_exec($ch);
			print_r($result);
			echo "<br>";
			return $result;
		}
		
		
		//-------------------------------------------------------
		
		$access_token	= "EAACEdEose0cBAFCRbO4tQRK83iN9dk3sShokaXCCvkzvm6Xw6wwlvrE7cokVfXEZC85oYK9xcYIDq4we9R4NdLrZBft5YdqwPAa0525rCtJCHjPQtx9fdtUqsyU2Pa0ZAQIVFnWptwNypg8gcveWbzwZBdhPAoBknpxTKB2c5EHby86ECCmgqzxNyA4uAabWkkZAlkQm0rwZDZD";
		$id_page 		= "1742699689126908";
		$msg 			= "Looking seller for $post_page. Go now to our Sell on Etiendahan page and create an account to start showcase your products.";
		$post_on 		= "PAGE";
		
		//posting($access_user_token, $msg, $post_as)
		posting($access_token, $id_page, $msg, $post_on);

		$_SESSION['successfully-posted'] = 'Successfully posted to our page';
		header('location: /etiendahan/search/');
	}
	




?>
