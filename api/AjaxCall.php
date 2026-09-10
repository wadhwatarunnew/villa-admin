<?php
	header("Access-Control-Allow-Origin: http://localhost:4000");
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
	header("Access-Control-Allow-Headers: Content-Type, Authorization");
	header("Content-Type: application/json");
	include "db.php";

	if(isset($_GET['Action']) && $_GET['Action'] == "GetURLs")
	{
		$FinalArray = array(); 
		$Result = mysqli_query($con, "SELECT * FROM header_nav");
		if(mysqli_num_rows($Result) > 0)
		{
			$Row = mysqli_fetch_object($Result);

			if($Row->name_one != '' && $Row->link_one != '')
			{
				$FinalArray[$Row->name_one]['URL'] = $Row->link_one;
			}

			if($Row->name_two != '' && $Row->link_two != '')
			{
				$FinalArray[$Row->name_two]['URL'] = $Row->link_two;
			}

			if($Row->name_three != '' && $Row->link_three != '')
			{
				$FinalArray['ResortTents']['id'] = 1;
				$FinalArray['ResortTents']['name'] = $Row->name_three;
				$FinalArray['ResortTents']['slug'] = $Row->link_three;
				$FinalArray['ResortTents']['type'] = "resort-tents";
				$FinalArray['ResortTents']['api'] = "Action=GetResortTentPage";

				$Result = mysqli_query($con, "SELECT * FROM resort_category ORDER BY order_no ASC");
				if(mysqli_num_rows($Result) > 0)
				{
					$i=0;
					while ($ResortRow = mysqli_fetch_assoc($Result))
					{
						$CleanURL = preg_replace('/[^a-z]/', '-', strtolower($ResortRow['title']));
						$FinalArray['ResortTents']['children'][$i]['id'] = $ResortRow['id'];
						$FinalArray['ResortTents']['children'][$i]['name'] = $ResortRow['title'];
						$FinalArray['ResortTents']['children'][$i]['slug'] = $CleanURL;
						$FinalArray['ResortTents']['children'][$i]['type'] = "resortCategory";
						$FinalArray['ResortTents']['children'][$i]['api'] = "Action=GetResortTentByCategory&id=".$ResortRow['id'];

						$CategoryName = $ResortRow['title'];
						$CatResult = mysqli_query($con, "SELECT * FROM resort_types WHERE category='$CategoryName' ORDER BY order_no ASC");
						if(mysqli_num_rows($CatResult) > 0)
						{
							$j=0;
							while($CategoryRow = mysqli_fetch_assoc($CatResult))
							{
								$CategoryTitle = preg_replace('/[^a-z]/', '-', strtolower($CategoryRow['title']));
							   	$CategoryTitle = str_replace('--', '-', strtolower($CategoryTitle));
						      	$CategoryTitle = trim($CategoryTitle, '-');

						      	$FinalArray['ResortTents']['children'][$i]['children'][$j]['id'] = $CategoryRow['id'];
								$FinalArray['ResortTents']['children'][$i]['children'][$j]['name'] = $CategoryRow['title'];
								$FinalArray['ResortTents']['children'][$i]['children'][$j]['slug'] = $CategoryTitle;
								$FinalArray['ResortTents']['children'][$i]['children'][$j]['type'] = "resortTent";
								$FinalArray['ResortTents']['children'][$i]['children'][$j]['api'] = "Action=GetResortTentByType&id=".$CategoryRow['id'];
						      	$j++;
							}
						}
						$i++;
					}
				}
			}

			if($Row->name_four != '' && $Row->link_four != '')
			{
				$FinalArray['Projects']['id'] = 1;
				$FinalArray['Projects']['name'] = $Row->name_four;
				$FinalArray['Projects']['slug'] = $Row->link_four;
				$FinalArray['Projects']['type'] = "projects";
				$FinalArray['Projects']['api'] = "Action=GetProjectsPage";

				$Result = mysqli_query($con, "SELECT * FROM project_category ORDER BY order_no ASC");
				if(mysqli_num_rows($Result) > 0)
				{
					$i=0;
					while ($ResortRow = mysqli_fetch_assoc($Result))
					{
						$CleanURL = preg_replace('/[^a-z]/', '-', strtolower($ResortRow['title']));
						$FinalArray['Projects']['children'][$i]['id'] = $ResortRow['id'];
						$FinalArray['Projects']['children'][$i]['name'] = $ResortRow['title'];
						$FinalArray['Projects']['children'][$i]['slug'] = $CleanURL;
						$FinalArray['Projects']['children'][$i]['type'] = "projectCategory";
						$FinalArray['Projects']['children'][$i]['api'] = "Action=GetProjectByCategory&id=".$ResortRow['id'];

						$CategoryName = $ResortRow['title'];
						$CatResult = mysqli_query($con, "SELECT * FROM project_types WHERE category='$CategoryName' ORDER BY order_no ASC");
						if(mysqli_num_rows($CatResult) > 0)
						{
							$j=0;
							while($CategoryRow = mysqli_fetch_assoc($CatResult))
							{
								$CategoryTitle = preg_replace('/[^a-z]/', '-', strtolower($CategoryRow['title']));
							   	$CategoryTitle = str_replace('--', '-', strtolower($CategoryTitle));
						      	$CategoryTitle = trim($CategoryTitle, '-');

						      	$FinalArray['Projects']['children'][$i]['children'][$j]['id'] = $CategoryRow['id'];
								$FinalArray['Projects']['children'][$i]['children'][$j]['name'] = $CategoryRow['title'];
								$FinalArray['Projects']['children'][$i]['children'][$j]['slug'] = $CategoryTitle;
								$FinalArray['Projects']['children'][$i]['children'][$j]['type'] = "project";
								$FinalArray['Projects']['children'][$i]['children'][$j]['api'] = "Action=GetProjectByType&id=".$CategoryRow['id'];
						      	$j++;
							}
						}
						$i++;
					}
				}
			}

			if($Row->name_five != '' && $Row->link_five != '')
			{
				$FinalArray['Blogs']['id'] = 1;
				$FinalArray['Blogs']['name'] = $Row->name_five;
				$FinalArray['Blogs']['slug'] = $Row->link_five;
				$FinalArray['Blogs']['type'] = "blogs";
				$FinalArray['Blogs']['api'] = "Action=GetBlogsPage";
				$FinalArray[$Row->name_five]['URL'] = $Row->link_five;

				$Result = mysqli_query($con, "SELECT * FROM blog_inner_content");
				if(mysqli_num_rows($Result) > 0)
				{
					$i=0;
					while ($BlogRow = mysqli_fetch_assoc($Result))
					{
						$BlogURL = preg_replace('/[^a-z]/', '-', strtolower($BlogRow['title']));
			        	$BlogURL = str_replace('--', '-', strtolower($BlogURL));

						$FinalArray['Blogs']['children'][$i]['id'] 		= $BlogRow['id'];
						$FinalArray['Blogs']['children'][$i]['name'] 	= $BlogRow['title'];
						$FinalArray['Blogs']['children'][$i]['slug'] 	= trim($BlogURL, '-');
						$FinalArray['Blogs']['children'][$i]['type'] 	= "blogDetail";
						$FinalArray['Blogs']['children'][$i]['api'] 	= "Action=GetBlogById&id=".$BlogRow['id'];
						$i++;
					}
				}
			}

			if($Row->name_six != '' && $Row->link_six != '')
			{
				$FinalArray[$Row->name_six]['URL'] = $Row->link_six;
			}

			if($Row->name_seven != '' && $Row->link_seven != '')
			{
				$FinalArray[$Row->name_seven]['URL'] = $Row->link_seven;
			}
		}

		$i=0;
		$Result = mysqli_query($con, "SELECT * FROM footer_follow_us ORDER BY id ASC");
		if(mysqli_num_rows($Result) > 0)
		{
			while($Row = mysqli_fetch_assoc($Result))
			{
				$FinalArray['SocialMedia'][$i]['name'] = $Row['name'];
				$FinalArray['SocialMedia'][$i]['icon'] = $Row['icon'];
				$FinalArray['SocialMedia'][$i]['link'] = $Row['link'];
				$i++;
			}
		}

		$Result = mysqli_query($con, "SELECT * FROM footer_get_in_touch");
		if(mysqli_num_rows($Result) > 0)
		{
			$Row = mysqli_fetch_assoc($Result);
			$FinalArray['ContactInfo']['title'] 	= $Row['title'];
			$FinalArray['ContactInfo']['address'] 	= $Row['address'];
			$FinalArray['ContactInfo']['email'] 	= $Row['email'];
			$FinalArray['ContactInfo']['mobile'] 	= $Row['mobile'];
		}

		$Result = mysqli_query($con, "SELECT * FROM footer_about_us");
		if(mysqli_num_rows($Result) > 0)
		{
			$Row = mysqli_fetch_assoc($Result);
			$FinalArray['FooterAboutInfo']['title'] 	= $Row['title'];
			$FinalArray['FooterAboutInfo']['content'] 	= $Row['content'];
		}

		$Result = mysqli_query($con, "SELECT * FROM add_nav WHERE title='TERMS AND CONDITIONS'");
		$Row 	= mysqli_fetch_assoc($Result);
	   	$FinalArray['TermsInfo']['name'] 	= $Row['name'];
	   	$FinalArray['TermsInfo']['link'] 	= $Row['link'];

	   	$LogoResult = mysqli_query($con, "SELECT title, description, favicon, path, bro_status FROM logo");
		$LogoRow 	= mysqli_fetch_assoc($LogoResult);
		$FinalArray['HeaderInfo']['title'] 			= $LogoRow['title'];
		$FinalArray['HeaderInfo']['description'] 	= $LogoRow['description'];
		$FinalArray['HeaderInfo']['brochureStatus'] = ($LogoRow['bro_status'] == 1) ? 1 : 0;
		$FinalArray['HeaderInfo']['favicon'] 		= "http://app.thevillatent.com/villadashboard/".$LogoRow['favicon'];
		$FinalArray['HeaderInfo']['logo'] 			= "http://app.thevillatent.com/villadashboard/".$LogoRow['path'];

		$Response['success'] = true; 
		$Response['data'] 	= $FinalArray; 
		echo json_encode($Response);
		exit;
	}
	else if(isset($_GET['Action']) && $_GET['Action'] == "GetHomePage")
	{
		$FinalArray = array();

		$LogoResult = mysqli_query($con, "SELECT * FROM logo");
		$LogoRow 	= mysqli_fetch_assoc($LogoResult);

		// SEO Info
	   	$SEOResult = mysqli_query($con, "SELECT * FROM home_seo_meta_data");										
	   	$SEORow = mysqli_fetch_assoc($SEOResult);
	   	$FinalArray['SEOInfo']['title'] 	= $SEORow['title'];
	   	$FinalArray['SEOInfo']['keyword'] 	= $SEORow['keyword'];
	   	$FinalArray['SEOInfo']['content'] 	= $SEORow['discription'];

		// Top Section
		// $Result = mysqli_query($con, "SELECT * FROM home_top_section");
		// $Row 	= mysqli_fetch_assoc($Result);
		// $FinalArray['TopSection']['logo'] 		= "http://app.thevillatent.com/villadashboard/".$LogoRow['path'];
		// $FinalArray['TopSection']['title'] 		= $Row['title'];
		// $FinalArray['TopSection']['content'] 	= $Row['content'];

		$Result = mysqli_query($con, "SELECT title, subtitle, description, btn_txt, btn_url, image, local_path FROM top_banner WHERE page='Home' AND status='Published'");
		$Row 	= mysqli_fetch_assoc($Result);
		$FinalArray['TopSection']['title']	 		= $Row['title'];
		$FinalArray['TopSection']['subtitle'] 		= $Row['subtitle'];
		$FinalArray['TopSection']['description'] 	= $Row['description'];
		$FinalArray['TopSection']['btn_txt'] 		= $Row['btn_txt'];
		$FinalArray['TopSection']['btn_url'] 		= $Row['btn_url'];
       	$FinalArray['TopSection']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['image'];
		if(isset($Row['local_path']) && $Row['local_path'] !== '')
       	{
       		$FinalArray['TopSection']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['local_path'];
       	}

		// About Section
		$Result = mysqli_query($con, "SELECT * FROM home_top_section");
		$Row 	= mysqli_fetch_assoc($Result);
		$FinalArray['AboutSection']['title'] 	= $Row['title'];
		$FinalArray['AboutSection']['content'] 	= $Row['content'];
		$FinalArray['AboutSection']['btn_txt'] 	= $FinalArray['TopSection']['btn_txt'];
		$FinalArray['AboutSection']['btn_url'] 	= $FinalArray['TopSection']['btn_url'];

		$FinalArray['AboutSection']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['image'];
		if(isset($Row['local_path']) && $Row['local_path'] !== '')
       	{
       		$FinalArray['AboutSection']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['local_path'];
       	}

		// Bottom Section
		$Result = mysqli_query($con, "SELECT * FROM home_bottom_section");
		$Row    = mysqli_fetch_assoc($Result);
		$FinalArray['BottomSection']['title'] 	= $Row['title'];
		$FinalArray['BottomSection']['content'] = $Row['content'];

		// Latest Posts
		$i = 0;
		$FinalArray['LatestPosts']  = array();
		$PostResult = mysqli_query($con, "SELECT * FROM blog_inner_content ORDER BY date DESC LIMIT 3");
        while($PostRow = mysqli_fetch_assoc($PostResult))
        {
           	$BlogURL = preg_replace('/[^a-z]/', '-', strtolower($PostRow['title']));
           	$BlogURL = str_replace('--', '-', strtolower($BlogURL));
           	$BlogURL = trim($BlogURL, '-');
           	$Pieces = explode(" ", $PostRow['content']);

          	$FinalArray['LatestPosts'][$i]['title'] 	= $PostRow['title'];
          	$FinalArray['LatestPosts'][$i]['content'] 	= implode(" ", array_splice($Pieces, 0, 12));
           	if(isset($PostRow['local_path']) && $PostRow['local_path'] !== '')
           	{
           		$FinalArray['LatestPosts'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$PostRow['local_path'];
           	}
           	else
           	{
           		$FinalArray['LatestPosts'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$PostRow['image'];
           	}


           	$PostDate = date_create($PostRow['date']);
           	$FinalArray['LatestPosts'][$i]['PostDate'] =  date_format($PostDate,"l, jS F Y");
           	$i++;
        }

        // Testimonials
        $i = 0;
        $Result = mysqli_query($con, "SELECT name, brandname, designation, rating, discription FROM home_testimonials ORDER BY id DESC");
		while($Row = mysqli_fetch_assoc($Result))
		{
			$FinalArray['Testimonials'][$i]['name'] 	= $Row['name'];
			$FinalArray['Testimonials'][$i]['brand'] 	= $Row['brandname'];
			$FinalArray['Testimonials'][$i]['role'] 	= $Row['designation'];
			$FinalArray['Testimonials'][$i]['rating'] 	= $Row['rating'];
			$FinalArray['Testimonials'][$i]['quote'] 	= $Row['discription'];
			$i++;
		}

		// Tent Collection
		$i = 0;
        $Result = mysqli_query($con, "SELECT title, content, image, local_path FROM resort_category ORDER BY order_no ASC LIMIT 4");
		while($Row = mysqli_fetch_assoc($Result))
		{
			$FinalArray['TentsCollection'][$i]['index'] 		= $i+1;
			$FinalArray['TentsCollection'][$i]['title'] 		= $Row['title'];
			$FinalArray['TentsCollection'][$i]['description'] 	= $Row['content'];

			$CategoryTitle = preg_replace('/[^a-z]/', '-', strtolower($Row['title']));
		   	$CategoryTitle = str_replace('--', '-', strtolower($CategoryTitle));
	      	$FinalArray['TentsCollection'][$i]['slug'] = trim($CategoryTitle, '-');

			$FinalArray['TentsCollection'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$Row['local_path'];
		   	if(isset($Row['image']) && $Row['image'] != '')
		   	{
		   		$FinalArray['TentsCollection'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$Row['image'];
		   	}
			$i++;
		}

		// Featured Projects
		$i = 0;
        $Result = mysqli_query($con, "SELECT category, title, image, local_path FROM project_types ORDER BY id DESC LIMIT 4");
        $TotalProjectsCount = mysqli_num_rows($Result);
		while($Row = mysqli_fetch_assoc($Result))
		{
			$FinalArray['FeaturedProjects'][$i]['title'] 		= $Row['category'];
			$FinalArray['FeaturedProjects'][$i]['location'] 	= $Row['title'];

			$CategoryTitle = preg_replace('/[^a-z]/', '-', strtolower($Row['title']));
		   	$CategoryTitle = str_replace('--', '-', strtolower($CategoryTitle));
	      	$FinalArray['FeaturedProjects'][$i]['slug'] = trim($CategoryTitle, '-');

			$FinalArray['FeaturedProjects'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$Row['local_path'];
		   	if(isset($Row['image']) && $Row['image'] != '')
		   	{
		   		$FinalArray['FeaturedProjects'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$Row['image'];
		   	}
			$i++;
		}

		$i=0;
		$Result = mysqli_query($con, "SELECT category, title, image, local_path FROM project_types ORDER BY id DESC");
        $TotalProjectsCount = mysqli_num_rows($Result);
		$FinalArray['RewardStats'][$i]['label'] 	= "Projects Completed";
		$FinalArray['RewardStats'][$i]['target'] 	= $TotalProjectsCount;
		$FinalArray['RewardStats'][$i]['display']  	= $TotalProjectsCount."+";
		$FinalArray['RewardStats'][$i]['suffix']   	= "+";
		$FinalArray['RewardStats'][$i]['iconName'] 	= 'work';

		$i++;
		$Result = mysqli_query($con, "SELECT title, suffix, number, icon FROM counters WHERE status='Active' ORDER BY display_order ASC");
		while($Row = mysqli_fetch_assoc($Result))
		{
			$FinalArray['RewardStats'][$i]['label'] 	= $Row['title'];
			$FinalArray['RewardStats'][$i]['target'] 	= $Row['number'];
			$FinalArray['RewardStats'][$i]['suffix'] 	= $Row['suffix'];
			$FinalArray['RewardStats'][$i]['iconName'] 	= $Row['icon'];
			$FinalArray['RewardStats'][$i]['display'] 	= $Row['number'].$Row['suffix'];
			$i++;
		}

		// Brands Info
		$i = 0;
        $Result = mysqli_query($con, "SELECT name, link, logo FROM brands WHERE status='Active' ORDER BY display_order ASC");
        $TotalProjectsCount = mysqli_num_rows($Result);
		while($Row = mysqli_fetch_assoc($Result))
		{
			$FinalArray['Brands'][$i]['name'] 	= $Row['name'];
			$FinalArray['Brands'][$i]['link'] 	= $Row['link'];
			$FinalArray['Brands'][$i]['logo'] 	= $Row['logo'];
			$i++;
		}

		// Home features
		$i = 0;
        $Result = mysqli_query($con, "SELECT title FROM home_features");
		while($Row = mysqli_fetch_assoc($Result))
		{
			$FinalArray['Features'][$i]['title'] 	= $Row['title'];
			$i++;
		}

		$Response['Status'] = 1; 
		$Response['Data'] 	= $FinalArray; 
		echo json_encode($Response);
		exit;
	}
	else if(isset($_GET['Action']) && $_GET['Action'] == "GetAboutPage")
	{
		$FinalArray = array();

		// Top Section
		// $Result = mysqli_query($con, "SELECT * FROM about_top_section");
		// $Row 	= mysqli_fetch_assoc($Result);
		// $FinalArray['TopSection']['title'] 		= $Row['title'];
		// $FinalArray['TopSection']['content'] 	= $Row['content'];
		// $FinalArray['TopSection']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['local_path'];
	   	// if(isset($Row['image']) && $Row['image'] != '')
	   	// {
	   	// 	$FinalArray['TopSection']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['image'];
	   	// }

	   	$Result = mysqli_query($con, "SELECT title, subtitle, description, btn_txt, btn_url, image, local_path FROM top_banner WHERE page='About Us' AND status='Published'");
		$Row 	= mysqli_fetch_assoc($Result);
		$FinalArray['TopSection']['title']	 		= $Row['title'];
		$FinalArray['TopSection']['subtitle'] 		= $Row['subtitle'];
		$FinalArray['TopSection']['content'] 		= $Row['description'];
		$FinalArray['TopSection']['btn_txt'] 		= $Row['btn_txt'];
		$FinalArray['TopSection']['btn_url'] 		= $Row['btn_url'];
       	$FinalArray['TopSection']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['image'];
		if(isset($Row['local_path']) && $Row['local_path'] !== '')
       	{
       		$FinalArray['TopSection']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['local_path'];
       	}

		// Page Content
		$AboutResult = mysqli_query($con, "SELECT * FROM about_page");   											
	   	$AboutRow = mysqli_fetch_assoc($AboutResult);
	   	$FinalArray['AboutInfo']['title'] 	= $AboutRow['title'];
	   	$FinalArray['AboutInfo']['content'] = $AboutRow['content'];
	   	
	   	$FinalArray['AboutInfo']['image'] = "http://app.thevillatent.com/villadashboard/".$AboutRow['local_path'];
	   	if(isset($AboutRow['image']) && $AboutRow['image'] != '')
	   	{
	   		$FinalArray['AboutInfo']['image'] = "http://app.thevillatent.com/villadashboard/".$AboutRow['image'];
	   	}

	   	// SEO Info
	   	$SEOResult = mysqli_query($con, "SELECT * FROM about_seo");										
	   	$SEORow = mysqli_fetch_assoc($SEOResult);
	   	$FinalArray['SEOInfo']['title'] 	= $SEORow['title'];
	   	$FinalArray['SEOInfo']['keyword'] 	= $SEORow['keyword'];
	   	$FinalArray['SEOInfo']['content'] 	= $SEORow['discription'];

		// Founders info
	   	$i=0;
		$Result = mysqli_query($con, "SELECT name, designation, image, bio FROM founders WHERE status='Active' ORDER BY display_order");
		while($Row = mysqli_fetch_assoc($Result))
		{
			$FinalArray['Founders'][$i]['name'] 	 	= $Row['name'];
			$FinalArray['Founders'][$i]['designation'] 	= $Row['designation'];
			$FinalArray['Founders'][$i]['image'] 	 	= "http://app.thevillatent.com/villadashboard/".$Row['image'];
			$FinalArray['Founders'][$i]['bio'] 	 		= $Row['bio'];
			$i++;
		}

	   	// Rewards Stat
	   	$i=0;
		$Result = mysqli_query($con, "SELECT title, suffix, number, icon FROM counters WHERE status='Active' ORDER BY display_order ASC");
		while($Row = mysqli_fetch_assoc($Result))
		{
			$FinalArray['RewardStats'][$i]['label'] 	= $Row['title'];
			$FinalArray['RewardStats'][$i]['target'] 	= $Row['number'];
			$FinalArray['RewardStats'][$i]['suffix'] 	= $Row['suffix'];
			$FinalArray['RewardStats'][$i]['iconName'] 	= $Row['icon'];
			$FinalArray['RewardStats'][$i]['display'] 	= $Row['number'].$Row['suffix'];
			$i++;
		}

		// Our Values
	   	$i=0;
		$Result = mysqli_query($con, "SELECT title, description, icon FROM company_values WHERE status='Active' ORDER BY display_order ASC");
		while($Row = mysqli_fetch_assoc($Result))
		{
			$FinalArray['Values'][$i]['title'] = $Row['title'];
			$FinalArray['Values'][$i]['description'] = $Row['description'];
			$FinalArray['Values'][$i]['icon'] = $Row['icon'];
			$i++;
		}

		$Result = mysqli_query($con, "SELECT * FROM mission_vision WHERE status='Active' ORDER BY display_order ASC");
		while($Row = mysqli_fetch_assoc($Result))
		{
			$FinalArray['MissionVision']['mission_title'] = $Row['mission_title'];
			$FinalArray['MissionVision']['mission_heading'] = $Row['mission_heading'];
			$FinalArray['MissionVision']['mission_desc'] = $Row['mission_desc'];
			$FinalArray['MissionVision']['vision_title'] = $Row['vision_title'];
			$FinalArray['MissionVision']['vision_heading'] = $Row['vision_heading'];
			$FinalArray['MissionVision']['vision_desc'] = $Row['vision_desc'];
			$FinalArray['MissionVision']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['image'];
		}

	   	$Response['Status'] = 1; 
		$Response['Data'] 	= $FinalArray; 
		echo json_encode($Response);
		exit;
	}
	else if(isset($_GET['Action']) && $_GET['Action'] == "GetResortTentPage")
	{
		$FinalArray = array();

		// Top Section
	   	$Result = mysqli_query($con, "SELECT title, subtitle, description, btn_txt, btn_url, image, local_path FROM top_banner WHERE page='Resort Tent' AND status='Published'");
		$Row 	= mysqli_fetch_assoc($Result);
		$FinalArray['TopSection']['title']		= $Row['title'];
		$FinalArray['TopSection']['subtitle'] 	= $Row['subtitle'];
		$FinalArray['TopSection']['content'] 	= $Row['description'];
		$FinalArray['TopSection']['btn_txt'] 	= $Row['btn_txt'];
		$FinalArray['TopSection']['btn_url'] 	= $Row['btn_url'];
       	$FinalArray['TopSection']['image'] 	= "http://app.thevillatent.com/villadashboard/".$Row['image'];
		if(isset($Row['local_path']) && $Row['local_path'] !== '')
       	{
       		$FinalArray['TopSection']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['local_path'];
       	}

		// Resort Tent Content
		$ResortsResult = mysqli_query($con, "SELECT * FROM resort_content");
		$ResortRow = mysqli_fetch_assoc($ResortsResult);

		$FinalArray['ResortInfo']['title'] 		= $ResortRow['title'];
	   	$FinalArray['ResortInfo']['content'] 	= $ResortRow['content'];
	   	
	   	// $FinalArray['ResortInfo']['image'] = "http://app.thevillatent.com/villadashboard/".$ResortRow['local_path'];
	   	// if(isset($ResortRow['image']) && $ResortRow['image'] != '')
	   	// {
	   	// 	$FinalArray['ResortInfo']['image'] = "http://app.thevillatent.com/villadashboard/".$ResortRow['image'];
	   	// }
   											
	   	// SEO Info
	   	$SEOResult = mysqli_query($con, "SELECT * FROM resort_seo");										
	   	$SEORow = mysqli_fetch_assoc($SEOResult);
	   	$FinalArray['SEOInfo']['title'] 	= $SEORow['title'];
	   	$FinalArray['SEOInfo']['keyword'] 	= $SEORow['keyword'];
	   	$FinalArray['SEOInfo']['content'] 	= $SEORow['discription'];

	   	// Tents Categories
	   	$i=0;
	   	$CategoryResult = mysqli_query($con, "SELECT category, COUNT(*) AS TotalCount, MAX(C.image) AS image, MAX(C.local_path) AS local_path FROM resort_types T, resort_category C WHERE T.category=C.title GROUP BY category ORDER BY category DESC");
		while($CategoryRow = mysqli_fetch_assoc($CategoryResult))
		{
			$CategoryTitle = preg_replace('/[^a-z]/', '-', strtolower($CategoryRow['category']));
		   	$CategoryTitle = str_replace('--', '-', strtolower($CategoryTitle));
	      	$CategoryTitle = trim($CategoryTitle, '-');
			$FinalArray['Categories'][$i]['name'] 	= $CategoryRow['category'];
		   	$FinalArray['Categories'][$i]['slug'] 	= $CategoryTitle;
		   	$FinalArray['Categories'][$i]['total'] 	= $CategoryRow['TotalCount'];
		   	$FinalArray['Categories'][$i]['image'] 	= "http://app.thevillatent.com/villadashboard/".$CategoryRow['local_path'];
		   	if(isset($CategoryRow['image']) && $CategoryRow['image'] != '')
		   	{
		   		$FinalArray['Categories'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$CategoryRow['image'];
		   	}
		   	$i++;
		}

	   	// Resort Gallery
	   	// $GalleryResult = mysqli_query($con, "SELECT * FROM add_gallery where title='".$ResortRow['title']."' ORDER BY dateTime DESC");
	   	// if(mysqli_num_rows($GalleryResult))
	   	// {
	   	// 	while($GalleryRow = mysqli_fetch_assoc($GalleryResult))
	   	// 	{
		//    		$FinalArray['GalleryInfo']['title'] = $GalleryRow['title'];
		//    		$FinalArray['GalleryInfo']['type'] 	= $GalleryRow['types'];

		//    		if(isset($GalleryRow['p1']) && $GalleryRow['p1'] !== '')
	   	// 		{
	   	// 			$FinalArray['GalleryInfo']['content'][] = $GalleryRow['p1'];
	   	// 		}

	   	// 		if(isset($GalleryRow['p2']) && $GalleryRow['p2'] !== '')
	   	// 		{
	   	// 			$FinalArray['GalleryInfo']['content'][] = $GalleryRow['p2'];
	   	// 		}

	   	// 		if(isset($GalleryRow['p3']) && $GalleryRow['p3'] !== '')
	   	// 		{
	   	// 			$FinalArray['GalleryInfo']['content'][] = $GalleryRow['p3'];
	   	// 		}

	   	// 		if(isset($GalleryRow['p4']) && $GalleryRow['p4'] !== '')
	   	// 		{
	   	// 			$FinalArray['GalleryInfo']['content'][] = $GalleryRow['p4'];
	   	// 		}

	   	// 		if(isset($GalleryRow['p5']) && $GalleryRow['p5'] !== '')
	   	// 		{
	   	// 			$FinalArray['GalleryInfo']['content'][] = $GalleryRow['p5'];
	   	// 		}

	   	// 		if(isset($GalleryRow['p6']) && $GalleryRow['p6'] !== '')
	   	// 		{
	   	// 			$FinalArray['GalleryInfo']['content'][] = $GalleryRow['p6'];
	   	// 		}

	   	// 		if(isset($GalleryRow['p7']) && $GalleryRow['p7'] !== '')
	   	// 		{
	   	// 			$FinalArray['GalleryInfo']['content'][] = $GalleryRow['p7'];
	   	// 		}

	   	// 		if(isset($GalleryRow['p8']) && $GalleryRow['p8'] !== '')
	   	// 		{
	   	// 			$FinalArray['GalleryInfo']['content'][] = $GalleryRow['p8'];
	   	// 		}

	   	// 		if(isset($GalleryRow['p9']) && $GalleryRow['p9'] !== '')
	   	// 		{
	   	// 			$FinalArray['GalleryInfo']['content'][] = $GalleryRow['p9'];
	   	// 		}

	   	// 		if(isset($GalleryRow['p10']) && $GalleryRow['p10'] !== '')
	   	// 		{
	   	// 			$FinalArray['GalleryInfo']['content'][] = $GalleryRow['p10'];
	   	// 		}
	   	// 	}
	   	// }
	   	
		$Response['Status'] = 1; 
		$Response['Data'] 	= $FinalArray; 
		echo json_encode($Response);
		exit;
	}
	else if(isset($_GET['Action']) && $_GET['Action'] == "GetResortTentByCategory")
	{
		$FinalArray = array();
		$CategoryID = $_GET['id'];

		// Resort Tent Content
		$ResortsResult = mysqli_query($con, "SELECT * FROM resort_category WHERE id='$CategoryID'");
		$ResortRow = mysqli_fetch_assoc($ResortsResult);

		$FinalArray['Data']['title'] 		= $ResortRow['title'];
	   	$FinalArray['Data']['short_desc'] 	= $ResortRow['short_desc'];
	   	$FinalArray['Data']['content'] 		= $ResortRow['content'];
	   	$FinalArray['Data']['order_no'] 	= $ResortRow['order_no'];
	   	
	   	$FinalArray['Data']['image'] = "http://app.thevillatent.com/villadashboard/".$ResortRow['local_path'];
	   	if(isset($ResortRow['image']) && $ResortRow['image'] != '')
	   	{
	   		$FinalArray['Data']['image'] = "http://app.thevillatent.com/villadashboard/".$ResortRow['image'];
	   	}

	   	$FinalArray['SEOInfo']['title'] 	= $ResortRow['metatitle'];
	   	$FinalArray['SEOInfo']['keyword'] 	= $ResortRow['keyword'];
	   	$FinalArray['SEOInfo']['content'] 	= $ResortRow['discription'];

	   	// Resort Tents
	   	$i=0;
	   	$TitleToSearch = $ResortRow['title'];
	   	$Result = mysqli_query($con, "SELECT * FROM resort_types WHERE category='$TitleToSearch' AND status='Published' ORDER BY order_no ASC");
		while($Row = mysqli_fetch_assoc($Result))
		{
			$CategoryTitle = preg_replace('/[^a-z]/', '-', strtolower($Row['title']));
		   	$CategoryTitle = str_replace('--', '-', strtolower($CategoryTitle));
	      	$CategoryTitle = trim($CategoryTitle, '-');
			$FinalArray['Tents'][$i]['name'] 		= $Row['title'];
			$FinalArray['Tents'][$i]['slug'] 		= $CategoryTitle;
			$FinalArray['Tents'][$i]['content'] 	= $Row['content'];
			$FinalArray['Tents'][$i]['category'] 	= $Row['category'];
			$FinalArray['Tents'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$Row['local_path'];
		   	if(isset($Row['image']) && $Row['image'] != '')
		   	{
		   		$FinalArray['Tents'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$Row['image'];
		   	}
			$i++;
		}

	   	// Resort Gallery
	   	// $GalleryResult = mysqli_query($con, "SELECT * FROM add_gallery where title='".$ResortRow['title']."' ORDER BY dateTime DESC");
	   	// if(mysqli_num_rows($GalleryResult))
	   	// {
	   	// 	while($GalleryRow = mysqli_fetch_assoc($GalleryResult))
	   	// 	{
		//    		$FinalArray['GalleryInfo']['title'] = $GalleryRow['title'];
		//    		$FinalArray['GalleryInfo']['type'] 	= $GalleryRow['types'];

		//    		if(isset($GalleryRow['p1']) && $GalleryRow['p1'] !== '')
	   	// 		{
	   	// 			$FinalArray['GalleryInfo']['content'][] = $GalleryRow['p1'];
	   	// 		}

	   	// 		if(isset($GalleryRow['p2']) && $GalleryRow['p2'] !== '')
	   	// 		{
	   	// 			$FinalArray['GalleryInfo']['content'][] = $GalleryRow['p2'];
	   	// 		}

	   	// 		if(isset($GalleryRow['p3']) && $GalleryRow['p3'] !== '')
	   	// 		{
	   	// 			$FinalArray['GalleryInfo']['content'][] = $GalleryRow['p3'];
	   	// 		}

	   	// 		if(isset($GalleryRow['p4']) && $GalleryRow['p4'] !== '')
	   	// 		{
	   	// 			$FinalArray['GalleryInfo']['content'][] = $GalleryRow['p4'];
	   	// 		}

	   	// 		if(isset($GalleryRow['p5']) && $GalleryRow['p5'] !== '')
	   	// 		{
	   	// 			$FinalArray['GalleryInfo']['content'][] = $GalleryRow['p5'];
	   	// 		}

	   	// 		if(isset($GalleryRow['p6']) && $GalleryRow['p6'] !== '')
	   	// 		{
	   	// 			$FinalArray['GalleryInfo']['content'][] = $GalleryRow['p6'];
	   	// 		}

	   	// 		if(isset($GalleryRow['p7']) && $GalleryRow['p7'] !== '')
	   	// 		{
	   	// 			$FinalArray['GalleryInfo']['content'][] = $GalleryRow['p7'];
	   	// 		}

	   	// 		if(isset($GalleryRow['p8']) && $GalleryRow['p8'] !== '')
	   	// 		{
	   	// 			$FinalArray['GalleryInfo']['content'][] = $GalleryRow['p8'];
	   	// 		}

	   	// 		if(isset($GalleryRow['p9']) && $GalleryRow['p9'] !== '')
	   	// 		{
	   	// 			$FinalArray['GalleryInfo']['content'][] = $GalleryRow['p9'];
	   	// 		}

	   	// 		if(isset($GalleryRow['p10']) && $GalleryRow['p10'] !== '')
	   	// 		{
	   	// 			$FinalArray['GalleryInfo']['content'][] = $GalleryRow['p10'];
	   	// 		}
	   	// 	}
	   	// }

		$Response['Status'] = 1; 
		$Response['Data'] 	= $FinalArray; 
		echo json_encode($Response);
		exit;
	}
	else if(isset($_GET['Action']) && $_GET['Action'] == "GetResortTentByType")
	{
		$FinalArray = array();
		$TentID = $_GET['id'];

		// Resort Tent Content
		$ResortsResult = mysqli_query($con, "SELECT * FROM resort_types WHERE id='$TentID'");
		$ResortRow = mysqli_fetch_assoc($ResortsResult);

		$FinalArray['Data']['title'] 		= $ResortRow['title'];
		$FinalArray['Data']['banner_desc'] 	= $ResortRow['banner_desc'];
	   	$FinalArray['Data']['category'] 	= $ResortRow['category'];
	   	$FinalArray['Data']['content'] 		= $ResortRow['content'];
	   	$FinalArray['Data']['order_no'] 	= $ResortRow['order_no'];
	   	$FinalArray['Data']['y_url'] 		= $ResortRow['y_url'];
	   	$FinalArray['Data']['dimension'] 	= $ResortRow['dimension'];
	   	$FinalArray['Data']['floor_image'] 	= "http://app.thevillatent.com/villadashboard/".$ResortRow['floor_image'];

	   	$LogoResult = mysqli_query($con, "SELECT bro_status FROM logo");
		$LogoRow 	= mysqli_fetch_assoc($LogoResult);
		$FinalArray['Data']['brochureStatus'] = ($LogoRow['bro_status'] == 1) ? 1 : 0;
	   	
	   	$FinalArray['Data']['image'] = "http://app.thevillatent.com/villadashboard/".$ResortRow['local_path'];
	   	if(isset($ResortRow['image']) && $ResortRow['image'] != '')
	   	{
	   		$FinalArray['Data']['image'] = "http://app.thevillatent.com/villadashboard/".$ResortRow['image'];
	   	}

	   	$FinalArray['SEOInfo']['title'] 	= $ResortRow['metatitle'];
	   	$FinalArray['SEOInfo']['keyword'] 	= $ResortRow['keyword'];
	   	$FinalArray['SEOInfo']['content'] 	= $ResortRow['discription'];

	   	// Resort Gallery
	   	$GalleryResult = mysqli_query($con, "SELECT * FROM add_gallery where title='".$ResortRow['title']."' ORDER BY dateTime DESC");
	   	if(mysqli_num_rows($GalleryResult))
	   	{
	   		while($GalleryRow = mysqli_fetch_assoc($GalleryResult))
	   		{
		   		$FinalArray['GalleryInfo']['title'] = $GalleryRow['title'];
		   		$FinalArray['GalleryInfo']['type'] 	= $GalleryRow['types'];

		   		if(isset($GalleryRow['p1']) && $GalleryRow['p1'] !== '')
	   			{
	   				$FinalArray['GalleryInfo']['images'][] = "http://app.thevillatent.com/villadashboard/".$GalleryRow['p1'];
	   			}

	   			if(isset($GalleryRow['p2']) && $GalleryRow['p2'] !== '')
	   			{
	   				$FinalArray['GalleryInfo']['images'][] = "http://app.thevillatent.com/villadashboard/".$GalleryRow['p2'];
	   			}

	   			if(isset($GalleryRow['p3']) && $GalleryRow['p3'] !== '')
	   			{
	   				$FinalArray['GalleryInfo']['images'][] = "http://app.thevillatent.com/villadashboard/".$GalleryRow['p3'];
	   			}

	   			if(isset($GalleryRow['p4']) && $GalleryRow['p4'] !== '')
	   			{
	   				$FinalArray['GalleryInfo']['images'][] = "http://app.thevillatent.com/villadashboard/".$GalleryRow['p4'];
	   			}

	   			if(isset($GalleryRow['p5']) && $GalleryRow['p5'] !== '')
	   			{
	   				$FinalArray['GalleryInfo']['images'][] = "http://app.thevillatent.com/villadashboard/".$GalleryRow['p5'];
	   			}

	   			if(isset($GalleryRow['p6']) && $GalleryRow['p6'] !== '')
	   			{
	   				$FinalArray['GalleryInfo']['images'][] = "http://app.thevillatent.com/villadashboard/".$GalleryRow['p6'];
	   			}

	   			if(isset($GalleryRow['p7']) && $GalleryRow['p7'] !== '')
	   			{
	   				$FinalArray['GalleryInfo']['images'][] = "http://app.thevillatent.com/villadashboard/".$GalleryRow['p7'];
	   			}

	   			if(isset($GalleryRow['p8']) && $GalleryRow['p8'] !== '')
	   			{
	   				$FinalArray['GalleryInfo']['images'][] = "http://app.thevillatent.com/villadashboard/".$GalleryRow['p8'];
	   			}

	   			if(isset($GalleryRow['p9']) && $GalleryRow['p9'] !== '')
	   			{
	   				$FinalArray['GalleryInfo']['images'][] = "http://app.thevillatent.com/villadashboard/".$GalleryRow['p9'];
	   			}

	   			if(isset($GalleryRow['p10']) && $GalleryRow['p10'] !== '')
	   			{
	   				$FinalArray['GalleryInfo']['images'][] = "http://app.thevillatent.com/villadashboard/".$GalleryRow['p10'];
	   			}
	   		}
	   	}

	   	// Other Resort Tent
		$ResortsResult = mysqli_query($con, "SELECT * FROM resort_types WHERE id!='$TentID' AND category='".$ResortRow['category']."'");
		$i=0;
		while($ResortRow = mysqli_fetch_assoc($ResortsResult))
		{
			$CategoryTitle = preg_replace('/[^a-z]/', '-', strtolower($ResortRow['title']));
		   	$CategoryTitle = str_replace('--', '-', strtolower($CategoryTitle));
	      	$CategoryTitle = trim($CategoryTitle, '-');
			$FinalArray['OtherTents'][$i]['title'] 		= $ResortRow['title'];
			$FinalArray['OtherTents'][$i]['slug'] 		= $CategoryTitle;
		   	$FinalArray['OtherTents'][$i]['category'] 	= $ResortRow['category'];
		   	
		   	$FinalArray['OtherTents'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$ResortRow['local_path'];
		   	if(isset($ResortRow['image']) && $ResortRow['image'] != '')
		   	{
		   		$FinalArray['OtherTents'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$ResortRow['image'];
		   	}
		   	$i++;
		}

		// Tent Details
		$i=0;
		$TempCategory = "";
		$DetailedResult = mysqli_query($con, "SELECT * FROM tent_details WHERE tent_id='$TentID' ORDER BY category ASC");
		while($Row = mysqli_fetch_assoc($DetailedResult))
		{
			if($TempCategory != $Row['category']) $i=0;
			$CategoryTitle = str_replace(" ", "", $Row['category']);
			$FinalArray['TentDetails'][$CategoryTitle][$i]['category'] = $Row['category'];
			$FinalArray['TentDetails'][$CategoryTitle][$i]['title'] = $Row['title'];
			$FinalArray['TentDetails'][$CategoryTitle][$i]['description'] = $Row['description'];
			$FinalArray['TentDetails'][$CategoryTitle][$i]['icon'] = $Row['icon'];
			$FinalArray['TentDetails'][$CategoryTitle][$i]['feet'] = $Row['feet'];
			$FinalArray['TentDetails'][$CategoryTitle][$i]['meters'] = $Row['meters'];
			$TempCategory = $Row['category'];
			$i++;
		}

		$Response['Status'] = 1; 
		$Response['Data'] 	= $FinalArray; 
		echo json_encode($Response);
		exit;
	}
	else if(isset($_GET['Action']) && $_GET['Action'] == "GetProjectsPage")
	{
		$FinalArray = array();

		// Top Section
	   	$Result = mysqli_query($con, "SELECT title, subtitle, description, btn_txt, btn_url, image, local_path FROM top_banner WHERE page='Projects' AND status='Published'");
		$Row 	= mysqli_fetch_assoc($Result);
		$FinalArray['TopSection']['title']		= $Row['title'];
		$FinalArray['TopSection']['subtitle'] 	= $Row['subtitle'];
		$FinalArray['TopSection']['content'] 	= $Row['description'];
		$FinalArray['TopSection']['btn_txt'] 	= $Row['btn_txt'];
		$FinalArray['TopSection']['btn_url'] 	= $Row['btn_url'];
       	$FinalArray['TopSection']['image'] 	= "http://app.thevillatent.com/villadashboard/".$Row['image'];
		if(isset($Row['local_path']) && $Row['local_path'] !== '')
       	{
       		$FinalArray['TopSection']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['local_path'];
       	}

		// Projects Content
		$ProjectsResult = mysqli_query($con, "SELECT * FROM project_content");
		$ProjectRow = mysqli_fetch_assoc($ProjectsResult);

		$FinalArray['ProjectInfo']['title'] 	= $ProjectRow['title'];
	   	$FinalArray['ProjectInfo']['content'] 	= $ProjectRow['content'];
	   	
	   	$FinalArray['ProjectInfo']['image'] = "http://app.thevillatent.com/villadashboard/".$ProjectRow['local_path'];
	   	if(isset($ProjectRow['image']) && $ProjectRow['image'] != '')
	   	{
	   		$FinalArray['ProjectInfo']['image'] = "http://app.thevillatent.com/villadashboard/".$ProjectRow['image'];
	   	}

	   	// Projects Categories
	   	$i=0;
	   	$CategoryResult = mysqli_query($con, "SELECT category, COUNT(*) AS TotalCount, MAX(C.image) AS image, MAX(C.local_path) AS local_path FROM project_types T, project_category C WHERE T.category=C.title GROUP BY category ORDER BY category ASC");
		while($CategoryRow = mysqli_fetch_assoc($CategoryResult))
		{
			$CategoryTitle = preg_replace('/[^a-z]/', '-', strtolower($CategoryRow['category']));
		   	$CategoryTitle = str_replace('--', '-', strtolower($CategoryTitle));
	      	$CategoryTitle = trim($CategoryTitle, '-');
			$FinalArray['Categories'][$i]['name'] 	= $CategoryRow['category'];
		   	$FinalArray['Categories'][$i]['slug'] 	= $CategoryTitle;
		   	$FinalArray['Categories'][$i]['total'] 	= $CategoryRow['TotalCount'];
		   	$FinalArray['Categories'][$i]['image'] 	= "http://app.thevillatent.com/villadashboard/".$CategoryRow['local_path'];
		   	if(isset($CategoryRow['image']) && $CategoryRow['image'] != '')
		   	{
		   		$FinalArray['Categories'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$CategoryRow['image'];
		   	}
		   	$i++;
		}
   											
	   	// SEO Info
	   	$SEOResult = mysqli_query($con, "SELECT * FROM project_seo");										
	   	$SEORow = mysqli_fetch_assoc($SEOResult);
	   	$FinalArray['SEOInfo']['title'] 	= $SEORow['title'];
	   	$FinalArray['SEOInfo']['keyword'] 	= $SEORow['keyword'];
	   	$FinalArray['SEOInfo']['content'] 	= $SEORow['discription'];

		$Response['Status'] = 1; 
		$Response['Data'] 	= $FinalArray; 
		echo json_encode($Response);
		exit;
	}
	else if(isset($_GET['Action']) && $_GET['Action'] == "GetProjectByCategory")
	{
		$FinalArray = array();
		$CategoryID = $_GET['id'];

		// Resort Tent Content
		$ProjectResult = mysqli_query($con, "SELECT * FROM project_category WHERE id='$CategoryID'");
		$ProjectRow = mysqli_fetch_assoc($ProjectResult);

		$FinalArray['Data']['title'] 		= $ProjectRow['title'];
	   	$FinalArray['Data']['short_desc'] 	= $ProjectRow['short_desc'];
	   	$FinalArray['Data']['content'] 		= $ProjectRow['content'];
	   	$FinalArray['Data']['order_no'] 	= $ProjectRow['order_no'];
	   	
	   	$FinalArray['Data']['image'] = "http://app.thevillatent.com/villadashboard/".$ProjectRow['local_path'];
	   	if(isset($ProjectRow['image']) && $ProjectRow['image'] != '')
	   	{
	   		$FinalArray['Data']['image'] = "http://app.thevillatent.com/villadashboard/".$ProjectRow['image'];
	   	}

	   	$FinalArray['SEOInfo']['title'] 	= $ProjectRow['metatitle'];
	   	$FinalArray['SEOInfo']['keyword'] 	= $ProjectRow['keyword'];
	   	$FinalArray['SEOInfo']['content'] 	= $ProjectRow['discription'];

	   	// Projects
	   	$i=0;
	   	$TitleToSearch = $ProjectRow['title'];
	   	$Result = mysqli_query($con, "SELECT * FROM project_types WHERE category='$TitleToSearch' AND status='Published' ORDER BY order_no ASC");
		while($Row = mysqli_fetch_assoc($Result))
		{
			$CategoryTitle = preg_replace('/[^a-z]/', '-', strtolower($Row['title']));
		   	$CategoryTitle = str_replace('--', '-', strtolower($CategoryTitle));
	      	$CategoryTitle = trim($CategoryTitle, '-');
			$FinalArray['Projects'][$i]['name'] 	= $Row['title'];
			$FinalArray['Projects'][$i]['slug'] 	= $CategoryTitle;
			$FinalArray['Projects'][$i]['content'] 	= $Row['content'];
			$FinalArray['Projects'][$i]['category'] = $Row['category'];
			$FinalArray['Projects'][$i]['image'] 	= "http://app.thevillatent.com/villadashboard/".$Row['local_path'];
		   	if(isset($Row['image']) && $Row['image'] != '')
		   	{
		   		$FinalArray['Projects'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$Row['image'];
		   	}
			$i++;
		}

		$Response['Status'] = 1; 
		$Response['Data'] 	= $FinalArray; 
		echo json_encode($Response);
		exit;
	}
	else if(isset($_GET['Action']) && $_GET['Action'] == "GetProjectByType")
	{
		$FinalArray = array();
		$TypeID = $_GET['id'];

		// Resort Tent Content
		$ProjectsResult = mysqli_query($con, "SELECT * FROM project_types WHERE id='$TypeID'");
		$ProjectRow = mysqli_fetch_assoc($ProjectsResult);

		$FinalArray['Data']['title'] 		= $ProjectRow['title'];
		$FinalArray['Data']['banner_desc'] 	= $ProjectRow['banner_desc'];
		$FinalArray['Data']['subtitle'] 	= $ProjectRow['subtitle'];
	   	$FinalArray['Data']['category'] 	= $ProjectRow['category'];
	   	$FinalArray['Data']['content'] 		= $ProjectRow['content'];
	   	$FinalArray['Data']['order_no'] 	= $ProjectRow['order_no'];
	   	$FinalArray['Data']['quote'] 		= $ProjectRow['quote'];
	   	$FinalArray['Data']['client_name'] 	= $ProjectRow['client_name'];
	   	$FinalArray['Data']['designation'] 	= $ProjectRow['designation'];
	   	$FinalArray['Data']['company'] 		= $ProjectRow['company'];
	   	$FinalArray['Data']['back_color'] 	= $ProjectRow['back_color'];
	   	$FinalArray['Data']['text_color'] 	= $ProjectRow['text_color'];
	   	$FinalArray['Data']['accent_color'] = $ProjectRow['accent_color'];
	   	$FinalArray['Data']['border'] 		= $ProjectRow['border'];
	   	
	   	$FinalArray['Data']['image'] = "http://app.thevillatent.com/villadashboard/".$ProjectRow['local_path'];
	   	if(isset($ProjectRow['image']) && $ProjectRow['image'] != '')
	   	{
	   		$FinalArray['Data']['image'] = "http://app.thevillatent.com/villadashboard/".$ProjectRow['image'];
	   	}

	   	$FinalArray['SEOInfo']['title'] 	= $ProjectRow['metatitle'];
	   	$FinalArray['SEOInfo']['keyword'] 	= $ProjectRow['keyword'];
	   	$FinalArray['SEOInfo']['content'] 	= $ProjectRow['discription'];

	   	// Project Details
	   	$i=0;
	   	$TempCategory = "";
		$DetailResult = mysqli_query($con, "SELECT * FROM project_details WHERE project_id='$TypeID' ORDER BY category, sort_order");
		while($DetailRow = mysqli_fetch_assoc($DetailResult))
		{
			if($TempCategory != $DetailRow['category']) $i=0;
			$CategoryTitle = str_replace(" ", "", $DetailRow['category']);
			$FinalArray['ProjectDetails'][$CategoryTitle][$i]['category'] = $DetailRow['category'];
			$FinalArray['ProjectDetails'][$CategoryTitle][$i]['title'] = $DetailRow['title'];
			$FinalArray['ProjectDetails'][$CategoryTitle][$i]['description'] = $DetailRow['description'];
			$FinalArray['ProjectDetails'][$CategoryTitle][$i]['icon'] = $DetailRow['icon'];
			$TempCategory = $DetailRow['category'];
			$i++;
		}

	   	// Project Gallery
	   	$FinalArray['GalleryInfo']['content'] = array();
	   	$GalleryResult = mysqli_query($con, "SELECT * FROM add_gallery where title='".$ProjectRow['title']."' ORDER BY dateTime DESC");
	   	if(mysqli_num_rows($GalleryResult))
	   	{
	   		while($GalleryRow = mysqli_fetch_assoc($GalleryResult))
	   		{
		   		$FinalArray['GalleryInfo']['title'] = $GalleryRow['title'];
		   		$FinalArray['GalleryInfo']['type'] 	= $GalleryRow['types'];

		   		if(isset($GalleryRow['p1']) && $GalleryRow['p1'] !== '')
	   			{
	   				$FinalArray['GalleryInfo']['content'][] = "http://app.thevillatent.com/villadashboard/".$GalleryRow['p1'];
	   			}

	   			if(isset($GalleryRow['p2']) && $GalleryRow['p2'] !== '')
	   			{
	   				$FinalArray['GalleryInfo']['content'][] = "http://app.thevillatent.com/villadashboard/".$GalleryRow['p2'];
	   			}

	   			if(isset($GalleryRow['p3']) && $GalleryRow['p3'] !== '')
	   			{
	   				$FinalArray['GalleryInfo']['content'][] = "http://app.thevillatent.com/villadashboard/".$GalleryRow['p3'];
	   			}

	   			if(isset($GalleryRow['p4']) && $GalleryRow['p4'] !== '')
	   			{
	   				$FinalArray['GalleryInfo']['content'][] = "http://app.thevillatent.com/villadashboard/".$GalleryRow['p4'];
	   			}

	   			if(isset($GalleryRow['p5']) && $GalleryRow['p5'] !== '')
	   			{
	   				$FinalArray['GalleryInfo']['content'][] = "http://app.thevillatent.com/villadashboard/".$GalleryRow['p5'];
	   			}

	   			if(isset($GalleryRow['p6']) && $GalleryRow['p6'] !== '')
	   			{
	   				$FinalArray['GalleryInfo']['content'][] = "http://app.thevillatent.com/villadashboard/".$GalleryRow['p6'];
	   			}

	   			if(isset($GalleryRow['p7']) && $GalleryRow['p7'] !== '')
	   			{
	   				$FinalArray['GalleryInfo']['content'][] = "http://app.thevillatent.com/villadashboard/".$GalleryRow['p7'];
	   			}

	   			if(isset($GalleryRow['p8']) && $GalleryRow['p8'] !== '')
	   			{
	   				$FinalArray['GalleryInfo']['content'][] = "http://app.thevillatent.com/villadashboard/".$GalleryRow['p8'];
	   			}

	   			if(isset($GalleryRow['p9']) && $GalleryRow['p9'] !== '')
	   			{
	   				$FinalArray['GalleryInfo']['content'][] = "http://app.thevillatent.com/villadashboard/".$GalleryRow['p9'];
	   			}

	   			if(isset($GalleryRow['p10']) && $GalleryRow['p10'] !== '')
	   			{
	   				$FinalArray['GalleryInfo']['content'][] = "http://app.thevillatent.com/villadashboard/".$GalleryRow['p10'];
	   			}
	   		}
	   	}

	   	// Other Projects
		$ResortsResult = mysqli_query($con, "SELECT * FROM project_types WHERE id!='$TypeID' AND category='".$ProjectRow['category']."'");
		$i=0;
		while($ProjectRow = mysqli_fetch_assoc($ResortsResult))
		{
			$CategoryTitle = preg_replace('/[^a-z]/', '-', strtolower($ProjectRow['title']));
		   	$CategoryTitle = str_replace('--', '-', strtolower($CategoryTitle));
	      	$CategoryTitle = trim($CategoryTitle, '-');
			$FinalArray['OtherProjects'][$i]['title'] 		= $ProjectRow['title'];
			$FinalArray['OtherProjects'][$i]['slug'] 		= $CategoryTitle;
		   	$FinalArray['OtherProjects'][$i]['category'] 	= $ProjectRow['category'];
		   	
		   	$FinalArray['OtherProjects'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$ProjectRow['local_path'];
		   	if(isset($ProjectRow['image']) && $ProjectRow['image'] != '')
		   	{
		   		$FinalArray['OtherProjects'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$ProjectRow['image'];
		   	}
		   	$i++;
		}

		$Response['Status'] = 1; 
		$Response['Data'] 	= $FinalArray; 
		echo json_encode($Response);
		exit;
	}
	else if(isset($_GET['Action']) && $_GET['Action'] == "GetGalleryInfo")
	{
		$FinalArray = array();

		// Top Section
	   	$Result = mysqli_query($con, "SELECT title, subtitle, description, btn_txt, btn_url, image, local_path FROM top_banner WHERE page='Gallery' AND status='Published'");
		$Row 	= mysqli_fetch_assoc($Result);
		$Response['TopSection']['title']	 	= $Row['title'];
		$Response['TopSection']['subtitle'] 	= $Row['subtitle'];
		$Response['TopSection']['content'] 	= $Row['description'];
		$Response['TopSection']['btn_txt'] 	= $Row['btn_txt'];
		$Response['TopSection']['btn_url'] 	= $Row['btn_url'];
       	$Response['TopSection']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['image'];
		if(isset($Row['local_path']) && $Row['local_path'] !== '')
       	{
       		$Response['TopSection']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['local_path'];
       	}

	   	// SEO Info
	   	$Result = mysqli_query($con, "SELECT * FROM gallery_top_section");										
	   	$Row = mysqli_fetch_assoc($Result);
	   	$Response['SEOInfo']['title'] 	= $Row['meta_title'];
	   	$Response['SEOInfo']['keyword'] = $Row['meta_keyword'];
	   	$Response['SEOInfo']['content'] = $Row['meta_desc'];

		$Result = mysqli_query($con, "SELECT * FROM add_gallery ORDER BY dateTime DESC");
		if(mysqli_num_rows($Result) > 0)
		{
			$i=0;
			while($Row = mysqli_fetch_assoc($Result))
	   		{
		   		if(isset($Row['p1']) && $Row['p1'] !== '')
	   			{
	   				$FinalArray[$i]['title'] 	= $Row['title'];
		   			$FinalArray[$i]['location']	= "";
		   			$FinalArray[$i]['category']	= str_replace(" ", "-", strtolower($Row['types']));;
		   			$FinalArray[$i]['image']	= "http://app.thevillatent.com/villadashboard/".$Row['p1'];
		   			$i++;
	   			}

	   			if(isset($Row['p2']) && $Row['p2'] !== '')
	   			{
	   				$FinalArray[$i]['title'] 	= $Row['title'];
		   			$FinalArray[$i]['location']	= "";
		   			$FinalArray[$i]['category']	= str_replace(" ", "-", strtolower($Row['types']));;
		   			$FinalArray[$i]['image']	= "http://app.thevillatent.com/villadashboard/".$Row['p2'];
		   			$i++;
	   			}

	   			if(isset($Row['p3']) && $Row['p3'] !== '')
	   			{
	   				$FinalArray[$i]['title'] 	= $Row['title'];
		   			$FinalArray[$i]['location']	= "";
		   			$FinalArray[$i]['category']	= str_replace(" ", "-", strtolower($Row['types']));;
		   			$FinalArray[$i]['image']	= "http://app.thevillatent.com/villadashboard/".$Row['p3'];
		   			$i++;
	   			}

	   			if(isset($Row['p4']) && $Row['p4'] !== '')
	   			{
	   				$FinalArray[$i]['title'] 	= $Row['title'];
		   			$FinalArray[$i]['location']	= "";
		   			$FinalArray[$i]['category']	= str_replace(" ", "-", strtolower($Row['types']));;
		   			$FinalArray[$i]['image']	= "http://app.thevillatent.com/villadashboard/".$Row['p4'];
		   			$i++;
	   			}

	   			if(isset($Row['p5']) && $Row['p5'] !== '')
	   			{
	   				$FinalArray[$i]['title'] 	= $Row['title'];
		   			$FinalArray[$i]['location']	= "";
		   			$FinalArray[$i]['category']	= str_replace(" ", "-", strtolower($Row['types']));;
		   			$FinalArray[$i]['image']	= "http://app.thevillatent.com/villadashboard/".$Row['p5'];
		   			$i++;
	   			}

	   			if(isset($Row['p6']) && $Row['p6'] !== '')
	   			{
	   				$FinalArray[$i]['title'] 	= $Row['title'];
		   			$FinalArray[$i]['location']	= "";
		   			$FinalArray[$i]['category']	= str_replace(" ", "-", strtolower($Row['types']));;
		   			$FinalArray[$i]['image']	= "http://app.thevillatent.com/villadashboard/".$Row['p6'];
		   			$i++;
	   			}

	   			if(isset($Row['p7']) && $Row['p7'] !== '')
	   			{
	   				$FinalArray[$i]['title'] 	= $Row['title'];
		   			$FinalArray[$i]['location']	= "";
		   			$FinalArray[$i]['category']	= str_replace(" ", "-", strtolower($Row['types']));;
		   			$FinalArray[$i]['image']	= "http://app.thevillatent.com/villadashboard/".$Row['p7'];
		   			$i++;
	   			}

	   			if(isset($Row['p8']) && $Row['p8'] !== '')
	   			{
	   				$FinalArray[$i]['title'] 	= $Row['title'];
		   			$FinalArray[$i]['location']	= "";
		   			$FinalArray[$i]['category']	= str_replace(" ", "-", strtolower($Row['types']));;
		   			$FinalArray[$i]['image']	= "http://app.thevillatent.com/villadashboard/".$Row['p8'];
		   			$i++;
	   			}

	   			if(isset($Row['p9']) && $Row['p9'] !== '')
	   			{
	   				$FinalArray[$i]['title'] 	= $Row['title'];
		   			$FinalArray[$i]['location']	= "";
		   			$FinalArray[$i]['category']	= str_replace(" ", "-", strtolower($Row['types']));;
		   			$FinalArray[$i]['image']	= "http://app.thevillatent.com/villadashboard/".$Row['p9'];
		   			$i++;
	   			}

	   			if(isset($Row['p10']) && $Row['p10'] !== '')
	   			{
	   				$FinalArray[$i]['title'] 	= $Row['title'];
		   			$FinalArray[$i]['location']	= "";
		   			$FinalArray[$i]['category']	= str_replace(" ", "-", strtolower($Row['types']));;
		   			$FinalArray[$i]['image']	= "http://app.thevillatent.com/villadashboard/".$Row['p10'];
		   			$i++;
	   			}
	   		}
	   		$i++;
		}

		$Result = mysqli_query($con, "SELECT types FROM add_gallery GROUP BY types ORDER BY types ASC");
		$Response['Categories'][0]['label'] = 'All';
		$Response['Categories'][0]['value'] = 'all';
		if(mysqli_num_rows($Result) > 0)
		{
			$i=1;
			while($Row = mysqli_fetch_assoc($Result))
			{
				$Response['Categories'][$i]['label'] = $Row['types'];
				$Response['Categories'][$i]['value'] = str_replace(" ", "-", strtolower($Row['types']));
				$i++;
			}
		}

	   	$Response['Status'] = 1; 
		$Response['Data'] 	= $FinalArray; 
		echo json_encode($Response);
		exit;
	}
	else if(isset($_GET['Action']) && $_GET['Action'] == "GetBlogsPage")
	{
		$FinalArray = array();

		// Top Section
	   	$Result = mysqli_query($con, "SELECT title, subtitle, description, btn_txt, btn_url, image, local_path FROM top_banner WHERE page='Blogs' AND status='Published'");
		$Row 	= mysqli_fetch_assoc($Result);
		$FinalArray['Info']['title']	 	= $Row['title'];
		$FinalArray['Info']['subtitle'] 	= $Row['subtitle'];
		$FinalArray['Info']['content'] 	= $Row['description'];
		$FinalArray['Info']['btn_txt'] 	= $Row['btn_txt'];
		$FinalArray['Info']['btn_url'] 	= $Row['btn_url'];
       	$FinalArray['Info']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['image'];
		if(isset($Row['local_path']) && $Row['local_path'] !== '')
       	{
       		$FinalArray['Info']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['local_path'];
       	}

	   	// SEO Info
	   	$SEOResult = mysqli_query($con, "SELECT * FROM blog_seo_meta_data");										
	   	$SEORow = mysqli_fetch_assoc($SEOResult);
	   	$FinalArray['SEOInfo']['title'] 	= $SEORow['title'];
	   	$FinalArray['SEOInfo']['keyword'] 	= $SEORow['keyword'];
	   	$FinalArray['SEOInfo']['content'] 	= $SEORow['discription'];

		// Brands Info
		$i = 0;
        $Result = mysqli_query($con, "SELECT name, link, logo FROM brands WHERE status='Active' ORDER BY display_order ASC");
        $TotalProjectsCount = mysqli_num_rows($Result);
		while($Row = mysqli_fetch_assoc($Result))
		{
			$FinalArray['Brands'][$i]['name'] 	= $Row['name'];
			$FinalArray['Brands'][$i]['link'] 	= $Row['link'];
			$FinalArray['Brands'][$i]['logo'] 	= $Row['logo'];
			$i++;
		}

	   	// Blog Content
		$sql = "SELECT * FROM blog_inner_content ORDER BY date DESC";
		$totalCount = mysqli_query($con,$sql);
		$BlogsResult = mysqli_query($con,$sql);
		
		$i=0;   					 
		while($BlogRow = mysqli_fetch_assoc($BlogsResult))
		{
	   		$FinalArray['Blogs'][$i]['title'] 		= $BlogRow['title'];
	   		$FinalArray['Blogs'][$i]['author'] 		= "By: Ajay Garg";
	   		$FinalArray['Blogs'][$i]['category'] 	= "GLAMPING GUIDE";
	   		$FinalArray['Blogs'][$i]['readTime'] 	= "";
            
            $Pieces = explode(" ", $BlogRow['content']);
            $FinalArray['Blogs'][$i]['excerpt'] = implode(" ", array_splice($Pieces, 0, 50));

			$BlogURL = preg_replace('/[^a-z]/', '-', strtolower($BlogRow['title']));
        	$BlogURL = str_replace('--', '-', strtolower($BlogURL));
            $FinalArray['Blogs'][$i]['blogurl'] = trim($BlogURL, '-');

            $BlogDate = date_create($BlogRow['date']);
            $FinalArray['Blogs'][$i]['date'] =  date_format($BlogDate,"l, jS F Y");

			$FinalArray['Blogs'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$BlogRow['local_path'];
		   	if(isset($BlogRow['image']) && $BlogRow['image'] != '')
		   	{
		   		$FinalArray['Blogs'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$BlogRow['image'];
		   	}
		   	$i++;
		}
        
		$Response['Status'] = 1; 
		$Response['Data'] 	= $FinalArray; 
		echo json_encode($Response);
		exit;
	}
	else if(isset($_GET['Action']) && $_GET['Action'] == "GetBlogById")
	{
		$FinalArray = array();
		$BlogID = $_GET['id'];

		// Page Content
		$Result = mysqli_query($con, "SELECT * FROM blog_inner_content WHERE id='$BlogID'");
		$Row = mysqli_fetch_assoc($Result);
	   	$BlogDate = date_create($Row['date']);
		$FinalArray['BlogInfo']['id'] 		= $Row['id'];
		$FinalArray['BlogInfo']['title'] 	= $Row['title'];
	   	$FinalArray['BlogInfo']['content'] 	= $Row['content'];
        $FinalArray['BlogInfo']['date'] 	=  date_format($BlogDate,"l, jS F Y");
        $FinalArray['BlogInfo']['readTime'] = "";
	   	
	   	$FinalArray['BlogInfo']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['local_path'];
	   	if(isset($Row['image']) && $Row['image'] != '')
	   	{
	   		$FinalArray['BlogInfo']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['image'];
	   	}

	   	// SEO Info
	   	$FinalArray['SEOInfo']['title'] 	= $Row['metatitle'];
	   	$FinalArray['SEOInfo']['keyword'] 	= $Row['keyword'];
	   	$FinalArray['SEOInfo']['content'] 	= $Row['discription'];

		// Brands Info
		$i = 0;
        $Result = mysqli_query($con, "SELECT name, link, logo FROM brands WHERE status='Active' ORDER BY display_order ASC");
        $TotalProjectsCount = mysqli_num_rows($Result);
		while($Row = mysqli_fetch_assoc($Result))
		{
			$FinalArray['Brands'][$i]['name'] 	= $Row['name'];
			$FinalArray['Brands'][$i]['link'] 	= $Row['link'];
			$FinalArray['Brands'][$i]['logo'] 	= $Row['logo'];
			$i++;
		}

		// Recent Posts
		$Result = mysqli_query($con, "SELECT * FROM blog_inner_content ORDER BY date DESC");
		$Row = mysqli_fetch_assoc($Result);
		if(mysqli_num_rows($Result))
	   	{
	   		$i=0;
	   		while($Row = mysqli_fetch_assoc($Result))
	   		{
				$BlogDate = date_create($Row['date']);
	   			$FinalArray['RecentPosts'][$i]['id'] 		= $Row['id'];
				$FinalArray['RecentPosts'][$i]['title'] 	= $Row['title'];
			   	$FinalArray['RecentPosts'][$i]['content'] 	= $Row['content'];
		        $FinalArray['RecentPosts'][$i]['date'] 		=  date_format($BlogDate,"l, jS F Y");
		        $FinalArray['RecentPosts'][$i]['readTime'] 	= "";

		        $BlogURL = preg_replace('/[^a-z]/', '-', strtolower($Row['title']));
			    $BlogURL = str_replace('--', '-', strtolower($BlogURL));
			    $FinalArray['RecentPosts'][$i]['slug'] = trim($BlogURL, '-');
			   	
			   	$FinalArray['RecentPosts'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$Row['local_path'];
			   	if(isset($Row['image']) && $Row['image'] != '')
			   	{
			   		$FinalArray['RecentPosts'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$Row['image'];
			   	}
			   	$i++;
	   		}
	   	}
        
		$Response['Status'] = 1; 
		$Response['Data'] 	= $FinalArray; 
		echo json_encode($Response);
		exit;
	}
	else if(isset($_GET['Action']) && $_GET['Action'] == "GetRecentPosts")
	{
		$FinalArray = array();

		// Recent Posts
		$Result = mysqli_query($con, "SELECT * FROM blog_inner_content ORDER BY date DESC LIMIT 10");
		$Row = mysqli_fetch_assoc($Result);
		if(mysqli_num_rows($Result))
	   	{
	   		$i=0;
	   		while($Row = mysqli_fetch_assoc($Result))
	   		{
				$BlogDate = date_create($Row['date']);
	   			$FinalArray['RecentPosts'][$i]['id'] 		= $Row['id'];
				$FinalArray['RecentPosts'][$i]['title'] 	= $Row['title'];
			   	$FinalArray['RecentPosts'][$i]['content'] 	= $Row['content'];
		        $FinalArray['RecentPosts'][$i]['date'] 		=  date_format($BlogDate,"l, jS F Y");
		        $FinalArray['RecentPosts'][$i]['readTime'] 	= "";

		        $BlogURL = preg_replace('/[^a-z]/', '-', strtolower($BlogRow['title']));
			    $BlogURL = str_replace('--', '-', strtolower($BlogURL));
			    $FinalArray['RecentPosts'][$i]['slug'] = trim($BlogURL, '-');
			   	
			   	$FinalArray['RecentPosts'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$Row['local_path'];
			   	if(isset($Row['image']) && $Row['image'] != '')
			   	{
			   		$FinalArray['RecentPosts'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$Row['image'];
			   	}
	   		}
	   	}

	   	$Response['Status'] = 1; 
		$Response['Data'] 	= $FinalArray; 
		echo json_encode($Response);
		exit;
	}
	else if(isset($_GET['Action']) && $_GET['Action'] == "GetContactPage")
	{
		$FinalArray = array();

		// Top Section
	   	$Result = mysqli_query($con, "SELECT title, subtitle, description, btn_txt, btn_url, image, local_path FROM top_banner WHERE page='Contact Us' AND status='Published'");
		$Row 	= mysqli_fetch_assoc($Result);
		$FinalArray['TopSection']['title']	= $Row['title'];
		$FinalArray['TopSection']['subtitle'] = $Row['subtitle'];
		$FinalArray['TopSection']['content'] 	= $Row['description'];
		$FinalArray['TopSection']['btn_txt'] 	= $Row['btn_txt'];
		$FinalArray['TopSection']['btn_url'] 	= $Row['btn_url'];
       	$FinalArray['TopSection']['image'] 	= "http://app.thevillatent.com/villadashboard/".$Row['image'];
		if(isset($Row['local_path']) && $Row['local_path'] !== '')
       	{
       		$FinalArray['TopSection']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['local_path'];
       	}

		// Page Content
		$ContactResult = mysqli_query($con, "SELECT * FROM contact_content");   											
	   	$ContactRow = mysqli_fetch_assoc($ContactResult);
	   	$FinalArray['ContactInfo']['title'] 	= $ContactRow['title'];
	   	$FinalArray['ContactInfo']['content'] 	= $ContactRow['content'];
	   	$FinalArray['ContactInfo']['image'] 	= "http://app.thevillatent.com/villadashboard/".$ContactRow['local_path'];
	   	if(isset($ContactRow['image']) && $ContactRow['image'] != '')
	   	{
	   		$FinalArray['ContactInfo']['image'] = "http://app.thevillatent.com/villadashboard/".$ContactRow['image'];
	   	}
	   
	    // SEO Info
	   	$SEOResult = mysqli_query($con, "SELECT * FROM contact_seo");										
	   	$SEORow = mysqli_fetch_assoc($SEOResult);
	   	$FinalArray['SEOInfo']['title'] 	= $SEORow['title'];
	   	$FinalArray['SEOInfo']['keyword'] 	= $SEORow['keyword'];
	   	$FinalArray['SEOInfo']['content'] 	= $SEORow['discription'];

	   	// Contact Cards
	   	$i=0;
	   	$CardsResult = mysqli_query($con, "SELECT * FROM contact_cards WHERE status=1 ORDER BY sort_order ASC");
	   	while($CardRow = mysqli_fetch_assoc($CardsResult))									
	   	{
		   	$FinalArray['CardsInfo'][$i]['label'] 		= $CardRow['title'];
		   	$FinalArray['CardsInfo'][$i]['icon'] 		= $CardRow['icon'];
		   	$FinalArray['CardsInfo'][$i]['line_one'] 	= $CardRow['line_one'];
		   	$FinalArray['CardsInfo'][$i]['line_two'] 	= $CardRow['line_two'];
		   	$FinalArray['CardsInfo'][$i]['note'] 		= $CardRow['note'];
			if($CardRow['title'] == 'CALL US')
			{
				$FinalArray['CardsInfo'][$i]['links'][0]['label'] 	= $CardRow['line_one'];
				$FinalArray['CardsInfo'][$i]['links'][0]['href'] 	= "tel:".$CardRow['line_one'];
				$FinalArray['CardsInfo'][$i]['links'][1]['label']	= $CardRow['line_two'];
				$FinalArray['CardsInfo'][$i]['links'][1]['href']	= "tel:".$CardRow['line_two'];
			}
			else if($CardRow['title'] == 'EMAIL US')
			{	
				$FinalArray['CardsInfo'][$i]['links'][0]['label'] 	= $CardRow['line_one'];
				$FinalArray['CardsInfo'][$i]['links'][0]['href'] 	= "mailto:".$CardRow['line_one'];
				$FinalArray['CardsInfo'][$i]['links'][1]['label']	= $CardRow['line_two'];
				$FinalArray['CardsInfo'][$i]['links'][1]['href']	= "mailto:".$CardRow['line_two'];
			}
			else if($CardRow['title'] == 'WHATSAPP')
			{
				$FinalArray['CardsInfo'][$i]['links'][0]['label'] 	= $CardRow['line_one'];
				$FinalArray['CardsInfo'][$i]['links'][0]['href'] 	= "https://wa.me/".$CardRow['line_one'];
				$FinalArray['CardsInfo'][$i]['links'][1]['label']	= $CardRow['line_two'];
				$FinalArray['CardsInfo'][$i]['links'][1]['href']	= "https://wa.me/".$CardRow['line_two'];
			}
			else
			{
				$FinalArray['CardsInfo'][$i]['links'][0]['label'] 	= $CardRow['line_one'];
				$FinalArray['CardsInfo'][$i]['links'][0]['href'] 	= $CardRow['line_one'];
				$FinalArray['CardsInfo'][$i]['links'][1]['label']	= $CardRow['line_two'];
				$FinalArray['CardsInfo'][$i]['links'][1]['href']	= $CardRow['line_two'];
				$FinalArray['CardsInfo'][$i]['links'][1]['map']		= "https://maps.app.goo.gl/dezHUeS5BxspzXge8";
			}
            $i++;
		}

		$AddressResult = mysqli_query($con, "SELECT * FROM contact_cards WHERE title='OUR OFFICE'");
		$AddressRow = mysqli_fetch_assoc($AddressResult);
		$FinalArray['AddressInfo']['title']   	= $AddressRow['title'];
		$FinalArray['AddressInfo']['icon'] 		= $AddressRow['icon'];
		$FinalArray['AddressInfo']['heading'] 	= $AddressRow['line_one'];
		$FinalArray['AddressInfo']['note']  	= $AddressRow['note'];
		$FinalArray['AddressInfo']['map']	  	= "https://maps.app.goo.gl/dezHUeS5BxspzXge8";
		$FinalArray['AddressInfo']['google_map']= "https://www.google.com/maps/embed?pb=!1m0!4v1501761618415!6m8!1m7!1sCAoSLEFGMVFpcE1Pa0RXT0E5NmRmcERhVE4wRWpfNXREaW5FQ0pjT0hqa1I0Q2sz!2m2!1d30.374135157514!2d76.799366129008!3f0!4f0!5f0.7820865974627469";

	   	$Response['Status'] = 1; 
		$Response['Data'] 	= $FinalArray; 
		echo json_encode($Response);
		exit;
	}
	else if(isset($_POST['Action']) && $_POST['Action'] == "SaveContactForm")
	{
		$sql = "INSERT INTO contact_query (date, type, name, email, mobile, location, referredby, message) VALUES (now(), '" .$_POST['type'] . "', '" .$_POST['name'] . "', '". $_POST['email'] . "', '". $_POST['phonenumber'] ."', '". $_POST['location']. "', '". $_POST['referredby']."', '". $_POST['message']."')";

        if ($con->query($sql) === TRUE)
        {   
            // Contact Information to Client
            // sendEmail('info@thevillatent.com', "Contact Information", userInformationHtml($_POST));
            // $message = customerEmailData($_POST['name']);
           
            // sendEmail($_POST['email'], 'Thank you for Contact the villa tent', $message);
            
            $Response = array('Status' => 'success', 'Message' => '<p>Thank you for appreciate our resort tents and sent request to get information about our luxury resort tents.The villa tent team will be contact you very soon.</p> 
                <p>Best Regard</p>
                <p>The Villa Tent.</p>');
        }
        else
        {
            $Response = array('Status' => 'error', 'Message' => 'Error while submitting information.');
        }

		echo json_encode($Response);
		exit;
	}
	else if(isset($_GET['Action']) && $_GET['Action'] == "GetBrochurePage")
	{
		$FinalArray = array();

		$Result = mysqli_query($con, "SELECT title, subtitle, description, btn_txt, btn_url, image, local_path FROM top_banner WHERE page='Brochure' AND status='Published'");
		$Row 	= mysqli_fetch_assoc($Result);
		$FinalArray['TopSection']['title']	 		= $Row['title'];
		$FinalArray['TopSection']['subtitle'] 		= $Row['subtitle'];
		$FinalArray['TopSection']['description'] 	= $Row['description'];
		$FinalArray['TopSection']['btn_txt'] 		= $Row['btn_txt'];
		$FinalArray['TopSection']['btn_url'] 		= $Row['btn_url'];
       	$FinalArray['TopSection']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['image'];
		if(isset($Row['local_path']) && $Row['local_path'] !== '')
       	{
       		$FinalArray['TopSection']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['local_path'];
       	}

       	// SEO Info
       	$Result = mysqli_query($con, "SELECT bro_meta, bro_keyword, bro_desc FROM logo");					
	   	$Row = mysqli_fetch_assoc($Result);
	   	$FinalArray['SEOInfo']['title']   = $Row['bro_meta'];
	   	$FinalArray['SEOInfo']['keyword'] = $Row['bro_keyword'];
	   	$FinalArray['SEOInfo']['content'] = $Row['bro_desc'];

	   	$Response['Status'] = 1; 
		$Response['Data'] 	= $FinalArray; 
		echo json_encode($Response);
		exit;
	}
	else if(isset($_GET['Action']) && $_GET['Action'] == "GetQuotePage")
	{
		$FinalArray = array();

	   	// Top Section
	   	$Result = mysqli_query($con, "SELECT title, subtitle, description, btn_txt, btn_url, image, local_path FROM top_banner WHERE page='Quote' AND status='Published'");
		$Row 	= mysqli_fetch_assoc($Result);
		$FinalArray['TopSection']['title']	 		= $Row['title'];
		$FinalArray['TopSection']['subtitle'] 		= $Row['subtitle'];
		$FinalArray['TopSection']['description'] 	= $Row['description'];
		$FinalArray['TopSection']['btn_txt'] 		= $Row['btn_txt'];
		$FinalArray['TopSection']['btn_url'] 		= $Row['btn_url'];
       	$FinalArray['TopSection']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['image'];
		if(isset($Row['local_path']) && $Row['local_path'] !== '')
       	{
       		$FinalArray['TopSection']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['local_path'];
       	}

       	// Other Page Info
	   	$Result = mysqli_query($con, "SELECT * FROM get_quote_content ORDER BY id ASC LIMIT 1");					
	   	$Row = mysqli_fetch_assoc($Result);
		$FinalArray['Data']['main_heading'] 			= $Row['main_heading'];
		$FinalArray['Data']['description'] 				= $Row['description'];
		$FinalArray['WhyChooseItems'][0]['title']		= $Row['help_title'];
		$FinalArray['WhyChooseItems'][0]['text'] 		= $Row['help_phone'];
		$FinalArray['WhyChooseItems'][0]['link'] 		= "tel:".$Row['help_phone'];
		$FinalArray['WhyChooseItems'][0]['iconName'] 	= "call";

		$FinalArray['WhyChooseItems'][1]['title']		= $Row['email_title'];
		$FinalArray['WhyChooseItems'][1]['text'] 		= $Row['email_address'];
		$FinalArray['WhyChooseItems'][1]['link'] 		= "mailto:".$Row['email_address'];
		$FinalArray['WhyChooseItems'][1]['iconName'] 	= "email";

		$FinalArray['WhyChooseItems'][2]['title']		= $Row['hours_title'];
		$FinalArray['WhyChooseItems'][2]['text'] 		= $Row['hours_text'];
		$FinalArray['WhyChooseItems'][2]['link'] 		= "";
		$FinalArray['WhyChooseItems'][2]['iconName'] 	= "schedule";

		$FinalArray['WhyChooseItems'][3]['title']		= $Row['location_title'];
		$FinalArray['WhyChooseItems'][3]['text'] 		= $Row['location_text'];
		$FinalArray['WhyChooseItems'][3]['link'] 		= "https://maps.app.goo.gl/Xgxp1b7sZWSW3TGN8";
		$FinalArray['WhyChooseItems'][3]['iconName'] 	= "place";

		$FinalArray['Data']['email_title'] 		= $Row['email_title'];
		$FinalArray['Data']['email_address'] 	= $Row['email_address'];
		$FinalArray['Data']['hours_title'] 		= $Row['hours_title'];
		$FinalArray['Data']['hours_text'] 		= $Row['hours_text'];
		$FinalArray['Data']['location_title'] 	= $Row['location_title'];
		$FinalArray['Data']['location_text'] 	= $Row['location_text'];
		$FinalArray['Data']['logo_url'] 		= "http://app.thevillatent.com/villadashboard/".$Row['logo_url'];

	   	// SEO Info
	   	$Result = mysqli_query($con, "SELECT * FROM get_quote_seo ORDER BY id ASC LIMIT 1");					
	   	$Row = mysqli_fetch_assoc($Result);
	   	$FinalArray['SEOInfo']['title']   = $Row['title'];
	   	$FinalArray['SEOInfo']['keyword'] = $Row['keyword'];
	   	$FinalArray['SEOInfo']['content'] = $Row['discription'];

	   	// Tents Categories
	   	$i=0;
	   	$CategoryResult = mysqli_query($con, "SELECT category, COUNT(*) AS TotalCount, C.image, C.local_path FROM resort_types T, resort_category C WHERE T.category=C.title GROUP BY category ORDER BY category ASC");
		while($CategoryRow = mysqli_fetch_assoc($CategoryResult))
		{
			$FinalArray['TentCategories'][$i]['name'] 	= $CategoryRow['category'];
		   	$i++;
		}

	   	$Response['Status'] = 1; 
		$Response['Data'] 	= $FinalArray; 
		echo json_encode($Response);
		exit;
	}
	else if(isset($_POST['Action']) && $_POST['Action'] == "SaveQuoteForm")
	{
		$sql = "INSERT INTO quote_requests (name, email, phone, country, tent_category, project_location, timeline, quantity, message) VALUES ('" .$_POST['name'] . "', '" .$_POST['email'] . "', '". $_POST['phone'] . "', '". $_POST['country'] ."', '". $_POST['category']. "', '". $_POST['location']."', '". $_POST['timeline']."', '". $_POST['quantity']."', '". $_POST['message']."')";

        if ($con->query($sql) === TRUE)
        {   
            // Contact Information to Client
            // sendEmail('info@thevillatent.com', "Contact Information", userInformationHtml($_POST));
            // $message = customerEmailData($_POST['name']);
           
            // sendEmail($_POST['email'], 'Thank you for Contact the villa tent', $message);
            
            $Response = array('Status' => 'success', 'Message' => '<p>Thank you for appreciate our resort tents and sent request to get information about our luxury resort tents.The villa tent team will be contact you very soon.</p> 
                <p>Best Regard</p>
                <p>The Villa Tent.</p>');
        }
        else
        {
            $Response = array('Status' => 'error', 'Message' => 'Error while submitting information.');
        }

		echo json_encode($Response);
		exit;
	}
	else if(isset($_GET['Action']) && $_GET['Action'] == "GetYoutubePage")
	{
		require_once('core/pagination.class.php');
		$perPage = new PerPage();
		$FinalArray = array();

		// Page Content
		$Result = mysqli_query($con, "SELECT * FROM youtube_content");
		$Row = mysqli_fetch_assoc($Result);
		$FinalArray['Info']['title'] 	= $Row['title'];
	   	$FinalArray['Info']['content'] 	= $Row['content'];
	   	
	   	$FinalArray['Info']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['local_path'];
	   	if(isset($Row['image']) && $Row['image'] != '')
	   	{
	   		$FinalArray['Info']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['image'];
	   	}

	   	// SEO Info
	   	$SEOResult = mysqli_query($con, "SELECT * FROM youtube_seo_meta_data");										
	   	$SEORow = mysqli_fetch_assoc($SEOResult);
	   	$FinalArray['SEOInfo']['title'] 	= $SEORow['title'];
	   	$FinalArray['SEOInfo']['keyword'] 	= $SEORow['keyword'];
	   	$FinalArray['SEOInfo']['content'] 	= $SEORow['discription'];

	   	// Youtube videos
		$sql = "SELECT * FROM youtube_video ORDER BY id DESC";
		$PaginationLink = "youtube-videos.php?page=";    
		$PaginationSetting = "all-links";
		                
		$page = 1;
		if(!empty($_GET["page"]))
		{
		    $page = $_GET["page"];
		}

		$start = ($page-1)*$perPage->perpage;
		if($start < 0) $start = 0;

		$query =  $sql . " limit " . $start . "," . $perPage->perpage;
		$totalCount = mysqli_query($con,$sql);
		$YoutubeResult = mysqli_query($con,$query);

		if(empty($_GET["rowcount"]))
		{
		    $_GET["rowcount"] = mysqli_num_rows($totalCount);
		}

		$perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $PaginationLink,$PaginationSetting);
		$pageName = basename($_SERVER['PHP_SELF']);
		$pageName = str_replace(".php","",$pageName);
		
		$i=0;   					 
		while($VideoRow = mysqli_fetch_assoc($YoutubeResult))
		{
	   		$FinalArray['Videos'][$i]['title'] 	= $VideoRow['title'];
			$FinalArray['Videos'][$i]['url'] 	= $VideoRow['youtube_url'];

			$FinalArray['Videos'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$VideoRow['local_path'];
		   	if(isset($VideoRow['image']) && $VideoRow['image'] != '')
		   	{
		   		$FinalArray['Videos'][$i]['image'] = "http://app.thevillatent.com/villadashboard/".$VideoRow['image'];
		   	}
		   	$i++;
		}

		if(!empty($perpageresult))
		{
            $FinalArray['Videos']['pagination_links'] = $perpageresult;
        }

		$Response['Status'] = 1; 
		$Response['Data'] 	= $FinalArray; 
		echo json_encode($Response);
		exit;
	}
	else if(isset($_GET['Action']) && $_GET['Action'] == "GetTermsPage")
	{
		$FinalArray = array();

		$Result = mysqli_query($con, "SELECT title, subtitle, description, btn_txt, btn_url, image, local_path FROM top_banner WHERE page='Terms' AND status='Published'");
		$Row 	= mysqli_fetch_assoc($Result);
		$FinalArray['TopSection']['title']	 		= $Row['title'];
		$FinalArray['TopSection']['subtitle'] 		= $Row['subtitle'];
		$FinalArray['TopSection']['description'] 	= $Row['description'];
		$FinalArray['TopSection']['btn_txt'] 		= $Row['btn_txt'];
		$FinalArray['TopSection']['btn_url'] 		= $Row['btn_url'];
       	$FinalArray['TopSection']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['image'];
		if(isset($Row['local_path']) && $Row['local_path'] !== '')
       	{
       		$FinalArray['TopSection']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['local_path'];
       	}

       	// Page Info
       	$Result = mysqli_query($con, "SELECT * FROM add_nav WHERE title='TERMS AND CONDITIONS'");
		$Row 	= mysqli_fetch_assoc($Result);

		// SEO Info
	   	$FinalArray['SEOInfo']['title'] 	= $Row['metatitle'];
	   	$FinalArray['SEOInfo']['keyword'] 	= $Row['keyword'];
	   	$FinalArray['SEOInfo']['content'] 	= $Row['discription'];

	   	$FinalArray['Data']['name'] 	= $Row['name'];
	   	$FinalArray['Data']['link'] 	= $Row['link'];
	   	$FinalArray['Data']['position'] = $Row['position'];
	   	$FinalArray['Data']['title'] 	= $Row['title'];
	   	$FinalArray['Data']['content'] 	= $Row['content'];
	   	$FinalArray['Data']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['image'];
		if(isset($Row['local_path']) && $Row['local_path'] !== '')
       	{
       		$FinalArray['Data']['image'] = "http://app.thevillatent.com/villadashboard/".$Row['local_path'];
       	}

       	$Response['Status'] = 1; 
		$Response['Data'] 	= $FinalArray; 
		echo json_encode($Response);
		exit;
	}

	function userInformationHtml($request)
	{
	    $email_content 	= "Name: ".$request['name']." <br>";
	    $email_content .= "Email Address: ".$request['email']." <br>";
	    $email_content .= "Phone Number: ".$request['phonenumber']." <br>";
	    $email_content .= "Location: ".$request['message']." <br>";
	    $email_content .= "Referred By: ".$request['referredby']." <br>";
	    $email_content .= "Message: ".$request['message']." <br>";
	    return $email_content;
	}

	function customerEmailData($Name)
	{
	    $email_content = '<html>
							<head>
								<title>HTML email</title>
							</head>
							<body>
								<table cellpadding="0" cellspacing="0" align="center" border="0" style="max-width:610px;width:100%;margin:auto;padding:0;background-color:#ffffff;color:#222222;overflow:hidden;border-left:1px solid #eee;border-right:1px solid #eee">
							    <tbody>
							        <tr>
							            <td>
							                <table align="center" valign="middle" cellpadding="0" cellspacing="0" border="0" style="max-width:610px;width:100%;overflow:hidden;margin:0;padding:0;background-color:#49535c;text-align:center">
							                    <tbody>
							                        <tr>
							                            <td>
							                                <img style="width:100%" src="https://www.thevillatent.com/emailimages/headerbg.jpg" alt="image" class="CToWUd a6T" tabindex="0"><div class="a6S" dir="ltr" style="opacity: 0.01; left: 846px; top: 119px;"><div id=":18l" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0" aria-label="Download attachment " data-tooltip-class="a1V" data-tooltip="Download"><div class="aSK J-J5-Ji aYr"></div></div></div>
							                            </td>
							                        </tr>
							                    </tbody>
							                </table>
							            </td>
							        </tr>

							        <tr style="max-width:610px;width:100%;box-sizing:border-box">
							            <td>

							                <table align="center" valign="middle" cellpadding="0" cellspacing="0" border="0" style="overflow:hidden;max-width:610px;width:100%;box-sizing:border-box;margin:0;padding:30px 15px 10px">
							                    <tbody>
							                        <tr>
							                            <td style="text-align:left">
							                                <p style="color:#575f62;font-family:"Lato",sans-serif;font-size:15px;line-height:20px;margin-top:0;margin-bottom:20px;padding:0;text-align:left">
							                                    Hello <span style="text-transform:capitalize">'.$Name.'</span>,
							                                </p>

							                                <p style="color:#575f62;font-family:"Lato",sans-serif;font-size:15px;line-height:19px;margin-top:0;margin-bottom:20px;padding:0;font-weight:normal">
							                                  Thank you for appreciate our resort tents and sent request to get information about our luxury resort tents.The villa tent team will be contact you very soon.
							                                </p>
							                                <p style="color:#005027;font-family:"Lato",sans-serif;font-size:15px;line-height:19px;margin-top:0;margin-bottom:20px;padding:0">
							                                    Best Regards <br>  <a href="https://www.thevillatent.com/" style="color:#005027;text-decoration:none;font-weight:bold" target="_blank">The Villatent Team</a>
							                                </p>


							                            </td>
							                        </tr>

							                    </tbody>
							                </table>

							            </td>
							        </tr>
							        <tr style="box-sizing:border-box;background-color:#fff;height:22px">
							            <td style="text-align:center;border-left:1px solid #eee;border-right:1px solid #eee">&nbsp;</td>
							        </tr>
							        <tr>
							            <td>
							                <table align="center" valign="center" cellpadding="0" cellspacing="0" border="0" style="max-width:610px;width:100%;overflow:hidden;background-color:#005027;padding:30px 20px 0px;box-sizing:border-box;color:#fff;text-align:center;">

							                    <tbody>
							                        <tr>
							                            <td>
							                                   <p style="text-align:center;height:30px;overflow:hidden;margin:0">
							                                    <a href="https://www.facebook.com/thevillatents/" style="text-decoration:none;padding:0;display:inline-block;margin:0 5px" target="_blank"><img alt="image" border="0" src="https://www.thevillatent.com/emailimages/Facebook.png" height="auto" width="28" style="outline:none;color:#ffffff;display:block;text-decoration:none;border-color:#ececec" class="CToWUd"></a>
							                                    <a href="https://twitter.com/thevillatent/" style="text-decoration:none;padding:0;display:inline-block;margin:0 5px" target="_blank"><img alt="image" border="0" src="https://www.thevillatent.com/emailimages/Twitter.png" height="auto" width="28" style="outline:none;color:#ffffff;display:block;text-decoration:none;border-color:#ececec" class="CToWUd"></a>
							                                    <a href="https://www.youtube.com/channel/UCKg87eksAdTZkMu7OB7FrSQ" style="text-decoration:none;padding:0;display:inline-block;margin:0 5px" target="_blank"><img alt="image" border="0" src="https://www.thevillatent.com/emailimages/Youtube.png" height="auto" width="28" style="outline:none;color:#ffffff;display:block;text-decoration:none;border-color:#ececec" class="CToWUd"></a>
							                                    <a href="https://www.pinterest.com/thevillatent/" style="text-decoration:none;padding:0;display:inline-block;margin:0 5px" target="_blank"><img alt="image" border="0" src="https://www.thevillatent.com/emailimages/Pinterest.png" height="auto" width="28" style="outline:none;color:#ffffff;display:block;text-decoration:none;border-color:#ececec" class="CToWUd"></a>
							                                </p>
							                                <p style="color:#fff;font-family:"Lato",sans-serif;font-size:15px;line-height:15px;margin-top:10px;margin-bottom:0px;padding:0;font-weight:normal;text-align:center">
							                                    <a href="https://www.thevillatent.com/" style="color:#fff;text-decoration:none;font-family:"Lato",sans-serif" target="_blank" data-saferedirecturl="">https://www.thevillatent.com/</a>
							                                </p>
							                                <p style="color:#fff;font-size:15px;line-height:15px;margin:10px 0 0 0;padding:0;font-weight:normal;text-align:center;font-family:"Lato",sans-serif">Copyright © 2015. All rights reserved.</p>
							                            </td>
							                        </tr>

							                    </tbody>
							                </table>

							            </td>
							        </tr>
							        <tr>
							            <td>
							                <table align="center" valign="center" cellpadding="0" cellspacing="0" border="0" style="max-width:610px;width:100%;overflow:hidden;background-color:#005027;padding:0px;box-sizing:border-box;color:#fff;text-align:center;margin: -17px 0 0 0;">
							                    <tbody>
							                        <tr>
							                            <td>
							                                <p style="color:#fff;font-size:13px;line-height:15px;margin:0;padding:0;font-weight:normal;text-align:center;font-family:"Lato",sans-serif">The Vedanta International Dhulkot,Behind Kingfisher,Vedanta Street, <br> Ambala City -134003. Haryana, India.</p>
							                            </td>
							                        </tr>
							                    </tbody>
							                </table>
							            </td>
							        </tr>
							    </tbody>
								</table>
							</body>
						</html>';
	    return $email_content;
	}

	function sendEmail($to_email, $subject, $message)
	{
	    try
	    {
	        $from_email = 	'info@thevillatent.com';
	        $mailheader = 	'';
	        $mailheader .= 	'From: ' . $from_email . "\r\n";
	        $mailheader .= 	'Reply-To:' . $from_email . "\r\n"; 
	        $mailheader = 	"MIME-Version: 1.0" . "\r\n";
	        $mailheader .= 	"Content-type:text/html;charset=UTF-8" . "\r\n"; 
	    
	        mail($to_email, $subject, $message, $mailheader) or die('error'); 
	    }
	    catch(Exception $ex)
	    {
	        echo '<pre>';print_r($ex);die;
	    }
	}
?>