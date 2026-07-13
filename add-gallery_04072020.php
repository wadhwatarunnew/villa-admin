<?php

error_reporting(0);
$page = $_GET['page'];

if (isset($_POST['sub'])){
	
	
    $types = $_POST['state'];
    $title = $_POST['city'];	
    	
    	
    //
    
    
    include "db.php";
    
    $query40= mysqli_query($con,"select * from add_gallery where title='$title' ");
    		$count =1;
    $countRow = mysqli_num_rows($query40);
    
    
    if($countRow == 0){
    	$page = "Update";
    	
    	$a = $_FILES['imag']['name'][0];
    
    
        if($types=='Resort Tents'){
        
            $path="uploads/pageimages/addgallery/resort/";
        }
        
        if($types=='Projects'){
            $path="uploads/pageimages/addgallery/project/";
        }
    	
    	
        //End	
        
        if(!$_FILES['imag']['name'][1]){
        	
        	$path3 = "";
        	
        }else{
        
            $b = $_FILES['imag']['name'][1];
            
            if($types=='Resort Tents'){
                $path2="uploads/pageimages/addgallery/resort/";
            }
        
            if($types=='Projects'){
                $path2="uploads/pageimages/addgallery/project/";
            }
        }
    
        if(!$_FILES['imag']['name'][2]){
        	
        	$path5 = "";
        	
        }else{
        
            $c = $_FILES['imag']['name'][2];
            if($types=='Resort Tents'){
                $path4="uploads/pageimages/addgallery/resort/";
            }
            
            if($types=='Projects'){
                $path4="uploads/pageimages/addgallery/project/";
            }
        	
        }
    
    
        if(!$_FILES['imag']['name'][3]){
        	
        	$path7 = "";
        	
        }else{
        
            $a1 = $_FILES['imag']['name'][3];
            if($types=='Resort Tents'){
                $path6="uploads/pageimages/addgallery/resort/";
            }
            
            if($types=='Projects'){
                $path6="uploads/pageimages/addgallery/project/";
            }
        	
        }
    
    
        if(!$_FILES['imag']['name'][4]){
        	
            $path9 = "";
        
        }else{
            $b1 = $_FILES['imag']['name'][4];
            if($types=='Resort Tents'){
                $path8="uploads/pageimages/addgallery/resort/";
            }
            
            if($types=='Projects'){
                $path8="uploads/pageimages/addgallery/project/";
            }
        	
        }
    
        if(!$_FILES['imag']['name'][5]){
        	
        	$path11 = "";
        	
        }else{
        
            $c1 = $_FILES['imag']['name'][5];
            if($types=='Resort Tents'){
                $path10="uploads/pageimages/addgallery/resort/";
            }
            
            if($types=='Projects'){
                $path10="uploads/pageimages/addgallery/project/";
            }
        	
        }
    
        if(!$_FILES['imag']['name'][6]){
        	
        	$path13 = "";
        	
        }else{
            $a2 = $_FILES['imag']['name'][6];
            if($types=='Resort Tents'){
                $path12="uploads/pageimages/addgallery/resort/";
            }
        
            if($types=='Projects'){
                $path12="uploads/pageimages/addgallery/project/";
            }
        	
        }
    
        if(!$_FILES['imag']['name'][7]){
        	
        	$path15 = "";
        	
        }else{
            $b2 = $_FILES['imag']['name'][7];
            if($types=='Resort Tents'){
                $path14="uploads/pageimages/addgallery/resort/";
            }
            
            if($types=='Projects'){
                $path14="uploads/pageimages/addgallery/project/";
            }
        	
        }
    
    
        if(!$_FILES['imag']['name'][8]){
        	
        	$path17 = "";
        	
        }else{
            $c2 = $_FILES['imag']['name'][8];
            if($types=='Resort Tents'){
                $path16="uploads/pageimages/addgallery/resort/";
            }
            
            if($types=='Projects'){
                $path16="uploads/pageimages/addgallery/project/";
            }
        	
        }
    
        if(!$_FILES['imag']['name'][9]){
        	
        	$path19 = "";
        	
        }else{
            $a3 = $_FILES['imag']['name'][9];
            if($types=='Resort Tents'){
                $path18="uploads/pageimages/addgallery/resort/";
            }
            
            if($types=='Projects'){
                $path18="uploads/pageimages/addgallery/project/";
            }

        }
        
        if(($a != '' && (file_exists("uploads/pageimages/".$a) || 
					file_exists("uploads/pageimages/addgallery/".$a) || 
					file_exists("uploads/pageimages/addgallery/project/".$a) || 
					file_exists("uploads/pageimages/addgallery/resort/".$a) || 
					file_exists("uploads/pageimages/blogs/".$a) || 
					file_exists("uploads/pageimages/blogs/single/".$a)  || 
					file_exists("uploads/pageimages/contact/".$a) || 
					file_exists("uploads/pageimages/nav/".$a) || 
					file_exists("uploads/pageimages/nav/category/".$a) || 
					file_exists("uploads/pageimages/nav/types/".$a) || 
					file_exists("uploads/pageimages/project/".$a) || 
					file_exists("uploads/pageimages/project/category/".$a) || 
					file_exists("uploads/pageimages/project/types/".$a) || 
					file_exists("uploads/pageimages/resort/".$a) || 
					file_exists("uploads/pageimages/resort/category/".$a) || 
					file_exists("uploads/pageimages/resort/types/".$a) || 
					file_exists("uploads/pageimages/slider/".$a) || 
					file_exists("uploads/pageimages/youtube/".$a))
        		) ||
        	($b != '' && (file_exists("uploads/pageimages/".$b) || 
					file_exists("uploads/pageimages/addgallery/".$b) || 
					file_exists("uploads/pageimages/addgallery/project/".$b) || 
					file_exists("uploads/pageimages/addgallery/resort/".$b) || 
					file_exists("uploads/pageimages/blogs/".$b) || 
					file_exists("uploads/pageimages/blogs/single/".$b)  || 
					file_exists("uploads/pageimages/contact/".$b) || 
					file_exists("uploads/pageimages/nav/".$b) || 
					file_exists("uploads/pageimages/nav/category/".$b) || 
					file_exists("uploads/pageimages/nav/types/".$b) || 
					file_exists("uploads/pageimages/project/".$b) || 
					file_exists("uploads/pageimages/project/category/".$b) || 
					file_exists("uploads/pageimages/project/types/".$b) || 
					file_exists("uploads/pageimages/resort/".$b) || 
					file_exists("uploads/pageimages/resort/category/".$b) || 
					file_exists("uploads/pageimages/resort/types/".$b) || 
					file_exists("uploads/pageimages/slider/".$b) || 
					file_exists("uploads/pageimages/youtube/".$b))
        		) || 
        	($c != '' && (file_exists("uploads/pageimages/".$c) || 
					file_exists("uploads/pageimages/addgallery/".$c) || 
					file_exists("uploads/pageimages/addgallery/project/".$c) || 
					file_exists("uploads/pageimages/addgallery/resort/".$c) || 
					file_exists("uploads/pageimages/blogs/".$c) || 
					file_exists("uploads/pageimages/blogs/single/".$c)  || 
					file_exists("uploads/pageimages/contact/".$c) || 
					file_exists("uploads/pageimages/nav/".$c) || 
					file_exists("uploads/pageimages/nav/category/".$c) || 
					file_exists("uploads/pageimages/nav/types/".$c) || 
					file_exists("uploads/pageimages/project/".$c) || 
					file_exists("uploads/pageimages/project/category/".$c) || 
					file_exists("uploads/pageimages/project/types/".$c) || 
					file_exists("uploads/pageimages/resort/".$c) || 
					file_exists("uploads/pageimages/resort/category/".$c) || 
					file_exists("uploads/pageimages/resort/types/".$c) || 
					file_exists("uploads/pageimages/slider/".$c) || 
					file_exists("uploads/pageimages/youtube/".$c))
        		) ||
        	($a1 != '' && (file_exists("uploads/pageimages/".$a1) || 
					file_exists("uploads/pageimages/addgallery/".$a1) || 
					file_exists("uploads/pageimages/addgallery/project/".$a1) ||
					file_exists("uploads/pageimages/addgallery/resort/".$a1) || 
					file_exists("uploads/pageimages/blogs/".$a1) || 
					file_exists("uploads/pageimages/blogs/single/".$a1)  || 
					file_exists("uploads/pageimages/contact/".$a1) || 
					file_exists("uploads/pageimages/nav/".$a1) || 
					file_exists("uploads/pageimages/nav/category/".$a1) || 
					file_exists("uploads/pageimages/nav/types/".$a1) || 
					file_exists("uploads/pageimages/project/".$a1) || 
					file_exists("uploads/pageimages/project/category/".$a1) || 
					file_exists("uploads/pageimages/project/types/".$a1) || 
					file_exists("uploads/pageimages/resort/".$a1) || 
					file_exists("uploads/pageimages/resort/category/".$a1) || 
					file_exists("uploads/pageimages/resort/types/".$a1) || 
					file_exists("uploads/pageimages/slider/".$a1) || 
					file_exists("uploads/pageimages/youtube/".$a1))
        		) ||
        	($b1 != '' && (file_exists("uploads/pageimages/".$b1) || 
					file_exists("uploads/pageimages/addgallery/".$b1) || 
					file_exists("uploads/pageimages/addgallery/project/".$b1) ||
					file_exists("uploads/pageimages/addgallery/resort/".$b1) || 
					file_exists("uploads/pageimages/blogs/".$b1) || 
					file_exists("uploads/pageimages/blogs/single/".$b1)  || 
					file_exists("uploads/pageimages/contact/".$b1) || 
					file_exists("uploads/pageimages/nav/".$b1) || 
					file_exists("uploads/pageimages/nav/category/".$b1) || 
					file_exists("uploads/pageimages/nav/types/".$b1) || 
					file_exists("uploads/pageimages/project/".$b1) || 
					file_exists("uploads/pageimages/project/category/".$b1) || 
					file_exists("uploads/pageimages/project/types/".$b1) || 
					file_exists("uploads/pageimages/resort/".$b1) || 
					file_exists("uploads/pageimages/resort/category/".$b1) || 
					file_exists("uploads/pageimages/resort/types/".$b1) || 
					file_exists("uploads/pageimages/slider/".$b1) || 
					file_exists("uploads/pageimages/youtube/".$b1))
        		) ||
        	($c1 != '' && (file_exists("uploads/pageimages/".$c1) || 
					file_exists("uploads/pageimages/addgallery/".$c1) || 
					file_exists("uploads/pageimages/addgallery/project/".$c1) ||
					file_exists("uploads/pageimages/addgallery/resort/".$c1) || 
					file_exists("uploads/pageimages/blogs/".$c1) || 
					file_exists("uploads/pageimages/blogs/single/".$c1)  || 
					file_exists("uploads/pageimages/contact/".$c1) || 
					file_exists("uploads/pageimages/nav/".$c1) || 
					file_exists("uploads/pageimages/nav/category/".$c1) || 
					file_exists("uploads/pageimages/nav/types/".$c1) || 
					file_exists("uploads/pageimages/project/".$c1) || 
					file_exists("uploads/pageimages/project/category/".$c1) || 
					file_exists("uploads/pageimages/project/types/".$c1) || 
					file_exists("uploads/pageimages/resort/".$c1) || 
					file_exists("uploads/pageimages/resort/category/".$c1) || 
					file_exists("uploads/pageimages/resort/types/".$c1) || 
					file_exists("uploads/pageimages/slider/".$c1) || 
					file_exists("uploads/pageimages/youtube/".$c1))
        		) ||
        	($a2 != '' && (file_exists("uploads/pageimages/".$a2) || 
					file_exists("uploads/pageimages/addgallery/".$a2) || 
					file_exists("uploads/pageimages/addgallery/project/".$a2) ||
					file_exists("uploads/pageimages/addgallery/resort/".$a2) || 
					file_exists("uploads/pageimages/blogs/".$a2) || 
					file_exists("uploads/pageimages/blogs/single/".$a2)  || 
					file_exists("uploads/pageimages/contact/".$a2) || 
					file_exists("uploads/pageimages/nav/".$a2) || 
					file_exists("uploads/pageimages/nav/category/".$a2) || 
					file_exists("uploads/pageimages/nav/types/".$a2) || 
					file_exists("uploads/pageimages/project/".$a2) || 
					file_exists("uploads/pageimages/project/category/".$a2) || 
					file_exists("uploads/pageimages/project/types/".$a2) || 
					file_exists("uploads/pageimages/resort/".$a2) || 
					file_exists("uploads/pageimages/resort/category/".$a2) || 
					file_exists("uploads/pageimages/resort/types/".$a2) || 
					file_exists("uploads/pageimages/slider/".$a2) || 
					file_exists("uploads/pageimages/youtube/".$a2))
        		) ||
        	($b2 != '' && (file_exists("uploads/pageimages/".$b2) || 
					file_exists("uploads/pageimages/addgallery/".$b2) || 
					file_exists("uploads/pageimages/addgallery/project/".$b2) ||
					file_exists("uploads/pageimages/addgallery/resort/".$b2) || 
					file_exists("uploads/pageimages/blogs/".$b2) || 
					file_exists("uploads/pageimages/blogs/single/".$b2)  || 
					file_exists("uploads/pageimages/contact/".$b2) || 
					file_exists("uploads/pageimages/nav/".$b2) || 
					file_exists("uploads/pageimages/nav/category/".$b2) || 
					file_exists("uploads/pageimages/nav/types/".$b2) || 
					file_exists("uploads/pageimages/project/".$b2) || 
					file_exists("uploads/pageimages/project/category/".$b2) || 
					file_exists("uploads/pageimages/project/types/".$b2) || 
					file_exists("uploads/pageimages/resort/".$b2) || 
					file_exists("uploads/pageimages/resort/category/".$b2) || 
					file_exists("uploads/pageimages/resort/types/".$b2) || 
					file_exists("uploads/pageimages/slider/".$b2) || 
					file_exists("uploads/pageimages/youtube/".$b2))
        		) ||
        	($c2 != '' && (file_exists("uploads/pageimages/".$c2) || 
					file_exists("uploads/pageimages/addgallery/".$c2) || 
					file_exists("uploads/pageimages/addgallery/project/".$c2) ||
					file_exists("uploads/pageimages/addgallery/resort/".$c2) || 
					file_exists("uploads/pageimages/blogs/".$c2) || 
					file_exists("uploads/pageimages/blogs/single/".$c2)  || 
					file_exists("uploads/pageimages/contact/".$c2) || 
					file_exists("uploads/pageimages/nav/".$c2) || 
					file_exists("uploads/pageimages/nav/category/".$c2) || 
					file_exists("uploads/pageimages/nav/types/".$c2) || 
					file_exists("uploads/pageimages/project/".$c2) || 
					file_exists("uploads/pageimages/project/category/".$c2) || 
					file_exists("uploads/pageimages/project/types/".$c2) || 
					file_exists("uploads/pageimages/resort/".$c2) || 
					file_exists("uploads/pageimages/resort/category/".$c2) || 
					file_exists("uploads/pageimages/resort/types/".$c2) || 
					file_exists("uploads/pageimages/slider/".$c2) || 
					file_exists("uploads/pageimages/youtube/".$c2))
        		) ||
        	($a3 != '' && (file_exists("uploads/pageimages/".$a3) || 
					file_exists("uploads/pageimages/addgallery/".$a3) || 
					file_exists("uploads/pageimages/addgallery/project/".$a3) ||
					file_exists("uploads/pageimages/addgallery/resort/".$a3) || 
					file_exists("uploads/pageimages/blogs/".$a3) || 
					file_exists("uploads/pageimages/blogs/single/".$a3)  || 
					file_exists("uploads/pageimages/contact/".$a3) || 
					file_exists("uploads/pageimages/nav/".$a3) || 
					file_exists("uploads/pageimages/nav/category/".$a3) || 
					file_exists("uploads/pageimages/nav/types/".$a3) || 
					file_exists("uploads/pageimages/project/".$a3) || 
					file_exists("uploads/pageimages/project/category/".$a3) || 
					file_exists("uploads/pageimages/project/types/".$a3) || 
					file_exists("uploads/pageimages/resort/".$a3) || 
					file_exists("uploads/pageimages/resort/category/".$a3) || 
					file_exists("uploads/pageimages/resort/types/".$a3) || 
					file_exists("uploads/pageimages/slider/".$a3) || 
					file_exists("uploads/pageimages/youtube/".$a3))
        		)
        )
    	{
    	    $FileExists = true;
    	    header( "refresh:2; url=add-gallery.php" );
    	}
    	else
    	{
            
        	if(move_uploaded_file($_FILES['imag']['tmp_name'][0],$path.$a))
        	{
        	    $path1=$path.$a;
        	}
        	
        	if(move_uploaded_file($_FILES['imag']['tmp_name'][1],$path2.$b))
        	{
        	    $path3=$path2.$b;
        	}
        	        	
        	if(move_uploaded_file($_FILES['imag']['tmp_name'][2],$path4.$c))
        	{
        	    $path5=$path4.$c;
        	}
        	
        	if(move_uploaded_file($_FILES['imag']['tmp_name'][3],$path6.$a1))
        	{
        	    $path7=$path6.$a1;
        	}
        	
        	if(move_uploaded_file($_FILES['imag']['tmp_name'][4],$path8.$b1))
        	{
        	    $path9=$path8.$b1;
        	}
        	
        	if(move_uploaded_file($_FILES['imag']['tmp_name'][5],$path10.$c1))
        	{
        	    $path11=$path10.$c1;
        	}
        	
        	if(move_uploaded_file($_FILES['imag']['tmp_name'][6],$path12.$a2))
        	{
        	    $path13=$path12.$a2;
        	}
        	
        	if(move_uploaded_file($_FILES['imag']['tmp_name'][7],$path14.$b2))
        	{
        	    $path15=$path14.$b2;
        	}
        	
        	if(move_uploaded_file($_FILES['imag']['tmp_name'][8],$path16.$c2))
        	{
        	    $path17=$path16.$c2;
        	}
        	
        	if(move_uploaded_file($_FILES['imag']['tmp_name'][9],$path18.$a3))
        	{
        	    $path19=$path18.$a3;
        	}
        	
            include "db.php";
        
        	mysqli_query($con,"insert into add_gallery (types,title,p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,dateTime) values ('$types','$title','$path1','$path3','$path5','$path7','$path9','$path11','$path13','$path15','$path17','$path19',NOW())");
        
            //header("location:add-gallery.php");
            header( "refresh:2; url=add-gallery.php" );
    
    	}	
    	
    	
    }else{
    
    		
        while($ee=mysqli_fetch_assoc($query40)){
    	
    	
        	$pic1 = $ee['p1'];
        	
        	if(!$pic1){
        		
        		$filter1 = "none";
        		
        	}else{
        		
        	    $filter1 = preg_replace('/\d/', '', substr(strrchr($pic1, "/"), 1) );	
        		
        	}
    	
    	
        	$pic2 = $ee['p2'];
        	
        	if(!$pic2){
        		
        		$filter2 = "none";
        		
        	}else{
        	
        	    $filter2 = preg_replace('/\d/', '', substr(strrchr($pic2, "/"), 1) );
        	
        	}
        	
        	$pic3 = $ee['p3'];
        	
        	if(!$pic3){
        		
        		$filter3 = "none";
        		
        	}else{
        	
        	    $filter3 = preg_replace('/\d/', '', substr(strrchr($pic3, "/"), 1) );
        	}
        	
        	
        	$pic4 = $ee['p4'];
        	
        	if(!$pic4){
        		
        		$filter4 = "none";
        		
        	}else{
        	
        	    $filter4 = preg_replace('/\d/', '', substr(strrchr($pic4, "/"), 1) );
        	
        	}
        	
        	
        	$pic5 = $ee['p5'];
        	
        	if(!$pic5){
        		
        		$filter5 = "none";
        		
        	}else{
        	
        	    $filter5 = preg_replace('/\d/', '', substr(strrchr($pic5, "/"), 1) );
        	}
        	
        	
        	$pic6 = $ee['p6'];
        	if(!$pic6){
        		
        		$filter6 = "none";
        		
        	}else{
        	    $filter6 = preg_replace('/\d/', '', substr(strrchr($pic6, "/"), 1) );
        	}
        	
        	
        	$pic7 = $ee['p7'];
        	if(!$pic7){
        		
        		$filter7 = "none";
        		
        	}else{
        	
        	    $filter7 = preg_replace('/\d/', '', substr(strrchr($pic7, "/"), 1) );
        	}
        	
        	$pic8 = $ee['p8'];
        	
        	if(!$pic8){
        		
        		$filter8 = "none";
        		
        	}else{
        	
        	    $filter8 = preg_replace('/\d/', '', substr(strrchr($pic8, "/"), 1) );
        	}
        	
        	$pic9 = $ee['p9'];
        	if(!$pic9){
        		
        		$filter9 = "none";
        		
        	}else{
        	    $filter9 = preg_replace('/\d/', '', substr(strrchr($pic9, "/"), 1) );
        	}
        	
        	
        	$pic10 = $ee['p10'];
        	if(!$pic10){
        		
        		$filter10 = "none";
        		
        	}else{
        	    $filter10 = preg_replace('/\d/', '', substr(strrchr($pic10, "/"), 1) );
        	}
    	
        	if($_FILES['imag']['name'][0] == $filter1 || $_FILES['imag']['name'][0] == $filter2 || $_FILES['imag']['name'][0] == $filter3 || $_FILES['imag']['name'][0] == $filter4 || $_FILES['imag']['name'][0] == $filter5 || $_FILES['imag']['name'][0] == $filter6 || $_FILES['imag']['name'][0] == $filter7 || $_FILES['imag']['name'][0] == $filter8 || $_FILES['imag']['name'][0] == $filter9 || $_FILES['imag']['name'][0] == $filter10
        	
        	||	$_FILES['imag']['name'][1] == $filter1 || $_FILES['imag']['name'][1] == $filter2 || $_FILES['imag']['name'][1] == $filter3 || $_FILES['imag']['name'][1] == $filter4 || $_FILES['imag']['name'][1] == $filter5 || $_FILES['imag']['name'][1] == $filter6 || $_FILES['imag']['name'][1] == $filter7 || $_FILES['imag']['name'][1] == $filter8 || $_FILES['imag']['name'][1] == $filter9 || $_FILES['imag']['name'][1] == $filter10
        		
        	||	$_FILES['imag']['name'][2] == $filter1 || $_FILES['imag']['name'][2] == $filter2 || $_FILES['imag']['name'][2] == $filter3 || $_FILES['imag']['name'][2] == $filter4 || $_FILES['imag']['name'][2] == $filter5 || $_FILES['imag']['name'][2] == $filter6 || $_FILES['imag']['name'][2] == $filter7 || $_FILES['imag']['name'][2] == $filter8 || $_FILES['imag']['name'][2] == $filter9 || $_FILES['imag']['name'][2] == $filter10
        		
        	||	$_FILES['imag']['name'][3] == $filter1 || $_FILES['imag']['name'][3] == $filter2 || $_FILES['imag']['name'][3] == $filter3 || $_FILES['imag']['name'][3] == $filter4 || $_FILES['imag']['name'][3] == $filter5 || $_FILES['imag']['name'][3] == $filter6 || $_FILES['imag']['name'][3] == $filter7 || $_FILES['imag']['name'][3] == $filter8 || $_FILES['imag']['name'][3] == $filter9 || $_FILES['imag']['name'][3] == $filter10
        		
        	||	$_FILES['imag']['name'][4] == $filter1 || $_FILES['imag']['name'][4] == $filter2 || $_FILES['imag']['name'][4] == $filter3 || $_FILES['imag']['name'][4] == $filter4 || $_FILES['imag']['name'][4] == $filter5 || $_FILES['imag']['name'][4] == $filter6 || $_FILES['imag']['name'][4] == $filter7 || $_FILES['imag']['name'][4] == $filter8 || $_FILES['imag']['name'][4] == $filter9 || $_FILES['imag']['name'][4] == $filter10
        		
        	||	$_FILES['imag']['name'][5] == $filter1 || $_FILES['imag']['name'][5] == $filter2 || $_FILES['imag']['name'][5] == $filter3 || $_FILES['imag']['name'][5] == $filter4 || $_FILES['imag']['name'][5] == $filter5 || $_FILES['imag']['name'][5] == $filter6 || $_FILES['imag']['name'][5] == $filter7 || $_FILES['imag']['name'][5] == $filter8 || $_FILES['imag']['name'][5] == $filter9 || $_FILES['imag']['name'][5] == $filter10
        		
        	||	$_FILES['imag']['name'][6] == $filter1 || $_FILES['imag']['name'][6] == $filter2 || $_FILES['imag']['name'][6] == $filter3 || $_FILES['imag']['name'][6] == $filter4 || $_FILES['imag']['name'][6] == $filter5 || $_FILES['imag']['name'][6] == $filter6 || $_FILES['imag']['name'][6] == $filter7 || $_FILES['imag']['name'][6] == $filter8 || $_FILES['imag']['name'][6] == $filter9 || $_FILES['imag']['name'][6] == $filter10
        		
        	||	$_FILES['imag']['name'][7] == $filter1 || $_FILES['imag']['name'][7] == $filter2 || $_FILES['imag']['name'][7] == $filter3 || $_FILES['imag']['name'][7] == $filter4 || $_FILES['imag']['name'][7] == $filter5 || $_FILES['imag']['name'][7] == $filter6 || $_FILES['imag']['name'][7] == $filter7 || $_FILES['imag']['name'][7] == $filter8 || $_FILES['imag']['name'][7] == $filter9 || $_FILES['imag']['name'][7] == $filter10
        		
        	||	$_FILES['imag']['name'][8] == $filter1 || $_FILES['imag']['name'][8] == $filter2 || $_FILES['imag']['name'][8] == $filter3 || $_FILES['imag']['name'][8] == $filter4 || $_FILES['imag']['name'][8] == $filter5 || $_FILES['imag']['name'][8] == $filter6 || $_FILES['imag']['name'][8] == $filter7 || $_FILES['imag']['name'][8] == $filter8 || $_FILES['imag']['name'][8] == $filter9 || $_FILES['imag']['name'][8] == $filter10
        		
        	||	$_FILES['imag']['name'][9] == $filter1 || $_FILES['imag']['name'][9] == $filter2 || $_FILES['imag']['name'][9] == $filter3 || $_FILES['imag']['name'][9] == $filter4 || $_FILES['imag']['name'][9] == $filter5 || $_FILES['imag']['name'][9] == $filter6 || $_FILES['imag']['name'][9] == $filter7 || $_FILES['imag']['name'][9] == $filter8 || $_FILES['imag']['name'][9] == $filter9 || $_FILES['imag']['name'][9] == $filter10
        	
        	
        	){
    	
    		?>
    	
                <script>
                alert("Photo Already in Gallery.Please select again!");
                </script>
                	
                <?php
                break;
            
            }else{
    	
    	
    	
            	if($count == $countRow){
            		$page = "Update";
            		
            		$a = $_FILES['imag']['name'][0];
            
            
                    if($types=='Resort Tents'){
                    
                        $path="uploads/pageimages/addgallery/resort/";
                    }
                    
                    if($types=='Projects'){
                        $path="uploads/pageimages/addgallery/project/";
                    }
            	
                	
            	
                    //End	
                    
                    if(!$_FILES['imag']['name'][1]){
                    	
                    	$path3 = "";
                    	
                    }else{
                    
                        $b = $_FILES['imag']['name'][1];
                    
                        if($types=='Resort Tents'){
                            $path2="uploads/pageimages/addgallery/resort/";
                        }
                        
                        if($types=='Projects'){
                            $path2="uploads/pageimages/addgallery/project/";
                        }
                	    
                    	
                    }
            
                    if(!$_FILES['imag']['name'][2]){
                    	
                    	$path5 = "";
                    	
                    }else{
                    
                        $c = $_FILES['imag']['name'][2];
                        if($types=='Resort Tents'){
                            $path4="uploads/pageimages/addgallery/resort/";
                        }
                        
                        if($types=='Projects'){
                            $path4="uploads/pageimages/addgallery/project/";
                        }
                    	
                    }
            
            
                    if(!$_FILES['imag']['name'][3]){
                    	
                    	$path7 = "";
                    	
                    }else{
                    
                        $a1 = $_FILES['imag']['name'][3];
                        if($types=='Resort Tents'){
                            $path6="uploads/pageimages/addgallery/resort/";
                        }
                        
                        if($types=='Projects'){
                            $path6="uploads/pageimages/addgallery/project/";
                        }
                    	
                    }
            
            
                    if(!$_FILES['imag']['name'][4]){
                    	
                    	$path9 = "";
                    	
                    }else{
                        $b1 = $_FILES['imag']['name'][4];
                        if($types=='Resort Tents'){
                            $path8="uploads/pageimages/addgallery/resort/";
                        }
                        
                        if($types=='Projects'){
                            $path8="uploads/pageimages/addgallery/project/";
                        }
                    	
                    }
            
                    if(!$_FILES['imag']['name'][5]){
                    	
                    	$path11 = "";
                    	
                    }else{
                    
                        $c1 = $_FILES['imag']['name'][5];
                        if($types=='Resort Tents'){
                            $path10="uploads/pageimages/addgallery/resort/";
                        }
                        
                        if($types=='Projects'){
                            $path10="uploads/pageimages/addgallery/project/";
                        }
                    	
                    }
            
                    if(!$_FILES['imag']['name'][6]){
                    	
                    	$path13 = "";
                    	
                    }else{
                        $a2 = $_FILES['imag']['name'][6];
                        if($types=='Resort Tents'){
                            $path12="uploads/pageimages/addgallery/resort/";
                        }
                        
                        if($types=='Projects'){
                            $path12="uploads/pageimages/addgallery/project/";
                        }
                    	
                    }
            
                    if(!$_FILES['imag']['name'][7]){
                    	
                    	$path15 = "";
                    	
                    }else{
                        $b2 = $_FILES['imag']['name'][7];
                        if($types=='Resort Tents'){
                            $path14="uploads/pageimages/addgallery/resort/";
                        }
                        
                        if($types=='Projects'){
                            $path14="uploads/pageimages/addgallery/project/";
                        }
                    	
                    }
            
            
                    if(!$_FILES['imag']['name'][8]){
                    	
                    	$path17 = "";
                    	
                    }else{
                        $c2 = $_FILES['imag']['name'][8];
                        if($types=='Resort Tents'){
                            $path16="uploads/pageimages/addgallery/resort/";
                        }
                        
                        if($types=='Projects'){
                            $path16="uploads/pageimages/addgallery/project/";
                        }
                    	
                    }
            
                    if(!$_FILES['imag']['name'][9]){
                    	
                    	$path19 = "";
                    	
                    }else{
                        $a3 = $_FILES['imag']['name'][9];
                        if($types=='Resort Tents'){
                            $path18="uploads/pageimages/addgallery/resort/";
                        }
                        
                        if($types=='Projects'){
                            $path18="uploads/pageimages/addgallery/project/";
                        }
                    	
                    }
            
                    if(($a != '' && (file_exists("uploads/pageimages/".$a) || 
            					file_exists("uploads/pageimages/addgallery/".$a) || 
            					file_exists("uploads/pageimages/addgallery/project/".$a) || 
            					file_exists("uploads/pageimages/addgallery/resort/".$a) || 
            					file_exists("uploads/pageimages/blogs/".$a) || 
            					file_exists("uploads/pageimages/blogs/single/".$a)  || 
            					file_exists("uploads/pageimages/contact/".$a) || 
            					file_exists("uploads/pageimages/nav/".$a) || 
            					file_exists("uploads/pageimages/nav/category/".$a) || 
            					file_exists("uploads/pageimages/nav/types/".$a) || 
            					file_exists("uploads/pageimages/project/".$a) || 
            					file_exists("uploads/pageimages/project/category/".$a) || 
            					file_exists("uploads/pageimages/project/types/".$a) || 
            					file_exists("uploads/pageimages/resort/".$a) || 
            					file_exists("uploads/pageimages/resort/category/".$a) || 
            					file_exists("uploads/pageimages/resort/types/".$a) || 
            					file_exists("uploads/pageimages/slider/".$a) || 
            					file_exists("uploads/pageimages/youtube/".$a))
                    		) ||
                    	($b != '' && (file_exists("uploads/pageimages/".$b) || 
            					file_exists("uploads/pageimages/addgallery/".$b) || 
            					file_exists("uploads/pageimages/addgallery/project/".$b) || 
            					file_exists("uploads/pageimages/addgallery/resort/".$b) || 
            					file_exists("uploads/pageimages/blogs/".$b) || 
            					file_exists("uploads/pageimages/blogs/single/".$b)  || 
            					file_exists("uploads/pageimages/contact/".$b) || 
            					file_exists("uploads/pageimages/nav/".$b) || 
            					file_exists("uploads/pageimages/nav/category/".$b) || 
            					file_exists("uploads/pageimages/nav/types/".$b) || 
            					file_exists("uploads/pageimages/project/".$b) || 
            					file_exists("uploads/pageimages/project/category/".$b) || 
            					file_exists("uploads/pageimages/project/types/".$b) || 
            					file_exists("uploads/pageimages/resort/".$b) || 
            					file_exists("uploads/pageimages/resort/category/".$b) || 
            					file_exists("uploads/pageimages/resort/types/".$b) || 
            					file_exists("uploads/pageimages/slider/".$b) || 
            					file_exists("uploads/pageimages/youtube/".$b))
                    		) || 
                    	($c != '' && (file_exists("uploads/pageimages/".$c) || 
            					file_exists("uploads/pageimages/addgallery/".$c) || 
            					file_exists("uploads/pageimages/addgallery/project/".$c) || 
            					file_exists("uploads/pageimages/addgallery/resort/".$c) || 
            					file_exists("uploads/pageimages/blogs/".$c) || 
            					file_exists("uploads/pageimages/blogs/single/".$c)  || 
            					file_exists("uploads/pageimages/contact/".$c) || 
            					file_exists("uploads/pageimages/nav/".$c) || 
            					file_exists("uploads/pageimages/nav/category/".$c) || 
            					file_exists("uploads/pageimages/nav/types/".$c) || 
            					file_exists("uploads/pageimages/project/".$c) || 
            					file_exists("uploads/pageimages/project/category/".$c) || 
            					file_exists("uploads/pageimages/project/types/".$c) || 
            					file_exists("uploads/pageimages/resort/".$c) || 
            					file_exists("uploads/pageimages/resort/category/".$c) || 
            					file_exists("uploads/pageimages/resort/types/".$c) || 
            					file_exists("uploads/pageimages/slider/".$c) || 
            					file_exists("uploads/pageimages/youtube/".$c))
                    		) ||
                    	($a1 != '' && (file_exists("uploads/pageimages/".$a1) || 
            					file_exists("uploads/pageimages/addgallery/".$a1) || 
            					file_exists("uploads/pageimages/addgallery/project/".$a1) ||
            					file_exists("uploads/pageimages/addgallery/resort/".$a1) || 
            					file_exists("uploads/pageimages/blogs/".$a1) || 
            					file_exists("uploads/pageimages/blogs/single/".$a1)  || 
            					file_exists("uploads/pageimages/contact/".$a1) || 
            					file_exists("uploads/pageimages/nav/".$a1) || 
            					file_exists("uploads/pageimages/nav/category/".$a1) || 
            					file_exists("uploads/pageimages/nav/types/".$a1) || 
            					file_exists("uploads/pageimages/project/".$a1) || 
            					file_exists("uploads/pageimages/project/category/".$a1) || 
            					file_exists("uploads/pageimages/project/types/".$a1) || 
            					file_exists("uploads/pageimages/resort/".$a1) || 
            					file_exists("uploads/pageimages/resort/category/".$a1) || 
            					file_exists("uploads/pageimages/resort/types/".$a1) || 
            					file_exists("uploads/pageimages/slider/".$a1) || 
            					file_exists("uploads/pageimages/youtube/".$a1))
                    		) ||
                    	($b1 != '' && (file_exists("uploads/pageimages/".$b1) || 
            					file_exists("uploads/pageimages/addgallery/".$b1) || 
            					file_exists("uploads/pageimages/addgallery/project/".$b1) ||
            					file_exists("uploads/pageimages/addgallery/resort/".$b1) || 
            					file_exists("uploads/pageimages/blogs/".$b1) || 
            					file_exists("uploads/pageimages/blogs/single/".$b1)  || 
            					file_exists("uploads/pageimages/contact/".$b1) || 
            					file_exists("uploads/pageimages/nav/".$b1) || 
            					file_exists("uploads/pageimages/nav/category/".$b1) || 
            					file_exists("uploads/pageimages/nav/types/".$b1) || 
            					file_exists("uploads/pageimages/project/".$b1) || 
            					file_exists("uploads/pageimages/project/category/".$b1) || 
            					file_exists("uploads/pageimages/project/types/".$b1) || 
            					file_exists("uploads/pageimages/resort/".$b1) || 
            					file_exists("uploads/pageimages/resort/category/".$b1) || 
            					file_exists("uploads/pageimages/resort/types/".$b1) || 
            					file_exists("uploads/pageimages/slider/".$b1) || 
            					file_exists("uploads/pageimages/youtube/".$b1))
                    		) ||
                    	($c1 != '' && (file_exists("uploads/pageimages/".$c1) || 
            					file_exists("uploads/pageimages/addgallery/".$c1) || 
            					file_exists("uploads/pageimages/addgallery/project/".$c1) ||
            					file_exists("uploads/pageimages/addgallery/resort/".$c1) || 
            					file_exists("uploads/pageimages/blogs/".$c1) || 
            					file_exists("uploads/pageimages/blogs/single/".$c1)  || 
            					file_exists("uploads/pageimages/contact/".$c1) || 
            					file_exists("uploads/pageimages/nav/".$c1) || 
            					file_exists("uploads/pageimages/nav/category/".$c1) || 
            					file_exists("uploads/pageimages/nav/types/".$c1) || 
            					file_exists("uploads/pageimages/project/".$c1) || 
            					file_exists("uploads/pageimages/project/category/".$c1) || 
            					file_exists("uploads/pageimages/project/types/".$c1) || 
            					file_exists("uploads/pageimages/resort/".$c1) || 
            					file_exists("uploads/pageimages/resort/category/".$c1) || 
            					file_exists("uploads/pageimages/resort/types/".$c1) || 
            					file_exists("uploads/pageimages/slider/".$c1) || 
            					file_exists("uploads/pageimages/youtube/".$c1))
                    		) ||
                    	($a2 != '' && (file_exists("uploads/pageimages/".$a2) || 
            					file_exists("uploads/pageimages/addgallery/".$a2) || 
            					file_exists("uploads/pageimages/addgallery/project/".$a2) ||
            					file_exists("uploads/pageimages/addgallery/resort/".$a2) || 
            					file_exists("uploads/pageimages/blogs/".$a2) || 
            					file_exists("uploads/pageimages/blogs/single/".$a2)  || 
            					file_exists("uploads/pageimages/contact/".$a2) || 
            					file_exists("uploads/pageimages/nav/".$a2) || 
            					file_exists("uploads/pageimages/nav/category/".$a2) || 
            					file_exists("uploads/pageimages/nav/types/".$a2) || 
            					file_exists("uploads/pageimages/project/".$a2) || 
            					file_exists("uploads/pageimages/project/category/".$a2) || 
            					file_exists("uploads/pageimages/project/types/".$a2) || 
            					file_exists("uploads/pageimages/resort/".$a2) || 
            					file_exists("uploads/pageimages/resort/category/".$a2) || 
            					file_exists("uploads/pageimages/resort/types/".$a2) || 
            					file_exists("uploads/pageimages/slider/".$a2) || 
            					file_exists("uploads/pageimages/youtube/".$a2))
                    		) ||
                    	($b2 != '' && (file_exists("uploads/pageimages/".$b2) || 
            					file_exists("uploads/pageimages/addgallery/".$b2) || 
            					file_exists("uploads/pageimages/addgallery/project/".$b2) ||
            					file_exists("uploads/pageimages/addgallery/resort/".$b2) || 
            					file_exists("uploads/pageimages/blogs/".$b2) || 
            					file_exists("uploads/pageimages/blogs/single/".$b2)  || 
            					file_exists("uploads/pageimages/contact/".$b2) || 
            					file_exists("uploads/pageimages/nav/".$b2) || 
            					file_exists("uploads/pageimages/nav/category/".$b2) || 
            					file_exists("uploads/pageimages/nav/types/".$b2) || 
            					file_exists("uploads/pageimages/project/".$b2) || 
            					file_exists("uploads/pageimages/project/category/".$b2) || 
            					file_exists("uploads/pageimages/project/types/".$b2) || 
            					file_exists("uploads/pageimages/resort/".$b2) || 
            					file_exists("uploads/pageimages/resort/category/".$b2) || 
            					file_exists("uploads/pageimages/resort/types/".$b2) || 
            					file_exists("uploads/pageimages/slider/".$b2) || 
            					file_exists("uploads/pageimages/youtube/".$b2))
                    		) ||
                    	($c2 != '' && (file_exists("uploads/pageimages/".$c2) || 
            					file_exists("uploads/pageimages/addgallery/".$c2) || 
            					file_exists("uploads/pageimages/addgallery/project/".$c2) ||
            					file_exists("uploads/pageimages/addgallery/resort/".$c2) || 
            					file_exists("uploads/pageimages/blogs/".$c2) || 
            					file_exists("uploads/pageimages/blogs/single/".$c2)  || 
            					file_exists("uploads/pageimages/contact/".$c2) || 
            					file_exists("uploads/pageimages/nav/".$c2) || 
            					file_exists("uploads/pageimages/nav/category/".$c2) || 
            					file_exists("uploads/pageimages/nav/types/".$c2) || 
            					file_exists("uploads/pageimages/project/".$c2) || 
            					file_exists("uploads/pageimages/project/category/".$c2) || 
            					file_exists("uploads/pageimages/project/types/".$c2) || 
            					file_exists("uploads/pageimages/resort/".$c2) || 
            					file_exists("uploads/pageimages/resort/category/".$c2) || 
            					file_exists("uploads/pageimages/resort/types/".$c2) || 
            					file_exists("uploads/pageimages/slider/".$c2) || 
            					file_exists("uploads/pageimages/youtube/".$c2))
                    		) ||
                    	($a3 != '' && (file_exists("uploads/pageimages/".$a3) || 
            					file_exists("uploads/pageimages/addgallery/".$a3) || 
            					file_exists("uploads/pageimages/addgallery/project/".$a3) ||
            					file_exists("uploads/pageimages/addgallery/resort/".$a3) || 
            					file_exists("uploads/pageimages/blogs/".$a3) || 
            					file_exists("uploads/pageimages/blogs/single/".$a3)  || 
            					file_exists("uploads/pageimages/contact/".$a3) || 
            					file_exists("uploads/pageimages/nav/".$a3) || 
            					file_exists("uploads/pageimages/nav/category/".$a3) || 
            					file_exists("uploads/pageimages/nav/types/".$a3) || 
            					file_exists("uploads/pageimages/project/".$a3) || 
            					file_exists("uploads/pageimages/project/category/".$a3) || 
            					file_exists("uploads/pageimages/project/types/".$a3) || 
            					file_exists("uploads/pageimages/resort/".$a3) || 
            					file_exists("uploads/pageimages/resort/category/".$a3) || 
            					file_exists("uploads/pageimages/resort/types/".$a3) || 
            					file_exists("uploads/pageimages/slider/".$a3) || 
            					file_exists("uploads/pageimages/youtube/".$a3))
                    		)
                    )
                	{
                	    $FileExists = true;
                	    header( "refresh:2; url=add-gallery.php" );
                	}
                	else
                	{
    	                if(move_uploaded_file($_FILES['imag']['tmp_name'][0],$path.$a))
    	                {
                	        $path1=$path.$a;
    	                }
    	                
                    	if(move_uploaded_file($_FILES['imag']['tmp_name'][1],$path2.$b))
                    	{
                    	    $path3=$path2.$b;
                    	}
                    	
                    	if(move_uploaded_file($_FILES['imag']['tmp_name'][2],$path4.$c))
                    	{
                    	    $path5=$path4.$c;
                    	}
                    	
                    	if(move_uploaded_file($_FILES['imag']['tmp_name'][3],$path6.$a1))
                    	{
                    	    $path7=$path6.$a1;
                    	}
                    	
                    	if(move_uploaded_file($_FILES['imag']['tmp_name'][4],$path8.$b1))
                    	{
                    	    $path9=$path8.$b1;
                    	}
                    	
                    	if(move_uploaded_file($_FILES['imag']['tmp_name'][5],$path10.$c1))
                    	{
                    	    $path11=$path10.$c1;
                    	}
                    	
                    	if(move_uploaded_file($_FILES['imag']['tmp_name'][6],$path12.$a2))
                    	{
                    	    $path13=$path12.$a2;
                    	}
                    	
                    	if(move_uploaded_file($_FILES['imag']['tmp_name'][7],$path14.$b2))
                    	{
                    	    $path15=$path14.$b2;
                    	}
                    	
                    	if(move_uploaded_file($_FILES['imag']['tmp_name'][8],$path16.$c2))
                    	{
                    	    $path17=$path16.$c2;
                    	}
                    	
                    	if(move_uploaded_file($_FILES['imag']['tmp_name'][9],$path18.$a3))
                    	{
                    	    $path19=$path18.$a3;
                    	}
                    	
                        include "db.php";
                    
                    	mysqli_query($con,"insert into add_gallery (types,title,p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,dateTime) values ('$types','$title','$path1','$path3','$path5','$path7','$path9','$path11','$path13','$path15','$path17','$path19',NOW())");
                
                        //header("location:add-gallery.php");
                        header( "refresh:2; url=add-gallery.php" );
                	}
            		
            		
            	}else{
            		$count++;
            		continue;
            		
            		
            	}
            	
            	
            	
            	
            }
    
    
    
    
        }
    
    
    
    }
    
	


}

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Villatent: Gallery</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style.css"/>
      <link rel="stylesheet" href="css/feather.css"/>
      <link rel="stylesheet" href="css/font-awesome.min.css"/>
	  <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
	  
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <body>
      <!---->
      <?php include_once('common/header.php'); ?>
      <!--sidebar-->
       <?php include_once('common/sidebar.php'); ?>
      <!---->
      <div class="pcoded-content">
         <div class="pcoded-inner-content">
            <div class="main-body">
               <div class="page-wrapper">
			   
			   <form action="" method="post" enctype="multipart/form-data">
			   <div>
                  <div class="page-body">
                     <div class="row">
                        <div class="col-sm-12">
							<?PHP include "alert-insert.php"; ?>
                           <div class="card mb-30">
                              <div class="card-header">Add Gallery</div>
                              <div class="card-body">
                                 <div class="row mb-30">
                                 <div class="col-sm-6">
                                 <div class="galleryDrop">
                                  <select name="state" class="form-control country input" required>
                                   <option value="">--Select--</option>
								   
								                                    
								  <option value="Resort Tents">Resort Tents</option>
									<option value="Projects">Projects</option>
								   
								   
								
                                  
								  </select>
								  <br>
								  
								    <div id="response">
					</div>
					
					<script>

                        $(document).ready(function(){
                            $("select.country").change(function(){
                                var selectedCountry = $(".country option:selected").val();
                        		
                        		console.log(selectedCountry);
                                $.ajax({
                                    type: "POST",
                                    url: "categoryAjax.php",
                                    data: { country : selectedCountry } 
                                }).done(function(data){
                                    $("#response").html(data);
                                });
                            });
                        });
                    
                    </script>
				           
								  
                                 </div>
                                 </div>
                                 </div>
                                 <hr>
                                 <div class="row">
                                 <!---->
                                      <div class="col-sm-2">
                                       <div class="">
                                      <input name="imag[]" id="image" type="file"  multiple="multiple"  required>
                                       </div>
                                      </div>
                                       
                                      </div>
									  
									  <script>
   
   $("#image").on("change", function() {
    if ($("#image")[0].files.length > 10) {
        alert("You can select only 10 images");
		
		document.getElementById('image').value= "";
    } 
});
   
   </script>
                                  <!---->
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                     <div class="row">
                        <div class="col-sm-2">
                           <div class="commonSection">
                              <input type="submit" class="btn btn-success btn-lg" name="sub" value="Add">
                           </div>
                        </div>
                     </div>
					 
					 </div>
					 
					 </form>
					 
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!---->
				<script>
				 
					$(document).ready(function() {
						 $('#mydiv').delay(3000).hide(0); 
						 
					});
					
					</script>
	  
	  
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <script src="js/ckeditor.js"></script>
      <!---->
   </body>
</html>