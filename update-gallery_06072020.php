 <?php
error_reporting(0);
if (isset($_POST['j'])){
	
	
	$types = $_POST['types'];
	$title = $_POST['title'];
	$id = $_POST['id'];
	
	$p1 = $_POST['p1'];
	$p2 = $_POST['p2'];
	$p3 = $_POST['p3'];
	$p4 = $_POST['p4'];
	$p5 = $_POST['p5'];
	$p6 = $_POST['p6'];
	$p7 = $_POST['p7'];
	$p8 = $_POST['p8'];
	$p9 = $_POST['p9'];
	$p10 = $_POST['p10'];
	
	
	
	include "db.php";

    $query48= mysqli_query($con,"select * from add_gallery where title='$title' ");
    		$count =1;
    $countRow = mysqli_num_rows($query48);
    		
    while($eef=mysqli_fetch_assoc($query48)){
    	
    	
    	$pic1 = $eef['p1'];
    	
    	if(!$pic1){
    		
    		$filter1 = "none";
    		
    	}else{
    		
    	$filter1 = preg_replace('/\d/', '', substr(strrchr($pic1, "/"), 1) );	
    		
    	}
    	
    	
    	
    	$pic2 = $eef['p2'];
    	
    	if(!$pic2){
    		
    		$filter2 = "none";
    		
    	}else{
    	
    	$filter2 = preg_replace('/\d/', '', substr(strrchr($pic2, "/"), 1) );
    	
    	}
    	
    	$pic3 = $eef['p3'];
    	
    	if(!$pic3){
    		
    		$filter3 = "none";
    		
    	}else{
    	
    	$filter3 = preg_replace('/\d/', '', substr(strrchr($pic3, "/"), 1) );
    	}
    	
    	
    	$pic4 = $eef['p4'];
    	
    	if(!$pic4){
    		
    		$filter4 = "none";
    		
    	}else{
    	
    	$filter4 = preg_replace('/\d/', '', substr(strrchr($pic4, "/"), 1) );
    	
    	}
    	
    	
    	$pic5 = $eef['p5'];
    	
    	if(!$pic5){
    		
    		$filter5 = "none";
    		
    	}else{
    	
    	$filter5 = preg_replace('/\d/', '', substr(strrchr($pic5, "/"), 1) );
    	}
    	
    	
    	$pic6 = $eef['p6'];
    	if(!$pic6){
    		
    		$filter6 = "none";
    		
    	}else{
    	$filter6 = preg_replace('/\d/', '', substr(strrchr($pic6, "/"), 1) );
    	}
    	
    	
    	$pic7 = $eef['p7'];
    	if(!$pic7){
    		
    		$filter7 = "none";
    		
    	}else{
    	
    	$filter7 = preg_replace('/\d/', '', substr(strrchr($pic7, "/"), 1) );
    	}
    	
    	$pic8 = $eef['p8'];
    	
    	if(!$pic8){
    		
    		$filter8 = "none";
    		
    	}else{
    	
    	$filter8 = preg_replace('/\d/', '', substr(strrchr($pic8, "/"), 1) );
    	}
    	
    	$pic9 = $eef['p9'];
    	if(!$pic9){
    		
    		$filter9 = "none";
    		
    	}else{
    	$filter9 = preg_replace('/\d/', '', substr(strrchr($pic9, "/"), 1) );
    	}
    	
    	
    	$pic10 = $eef['p10'];
    	if(!$pic10){
    		
    		$filter10 = "none";
    		
    	}else{
    	$filter10 = preg_replace('/\d/', '', substr(strrchr($pic10, "/"), 1) );
    	}
    	
    	if($_FILES['myFile1']['name'] == $filter1 || $_FILES['myFile1']['name'] == $filter2 || $_FILES['myFile1']['name'] == $filter3 || $_FILES['myFile1']['name'] == $filter4 || $_FILES['myFile1']['name'] == $filter5 || $_FILES['myFile1']['name'] == $filter6 || $_FILES['myFile1']['name'] == $filter7 || $_FILES['myFile1']['name'] == $filter8 || $_FILES['myFile1']['name'] == $filter9 || $_FILES['myFile1']['name'] == $filter10
    	
    	||	$_FILES['myFile2']['name'] == $filter1 || $_FILES['myFile2']['name'] == $filter2 || $_FILES['myFile2']['name'] == $filter3 || $_FILES['myFile2']['name'] == $filter4 || $_FILES['myFile2']['name'] == $filter5 || $_FILES['myFile2']['name'] == $filter6 || $_FILES['myFile2']['name'] == $filter7 || $_FILES['myFile2']['name'] == $filter8 || $_FILES['myFile2']['name'] == $filter9 || $_FILES['myFile2']['name'] == $filter10
    		
    	||	$_FILES['myFile3']['name'] == $filter1 || $_FILES['myFile3']['name'] == $filter2 || $_FILES['myFile3']['name'] == $filter3 || $_FILES['myFile3']['name'] == $filter4 || $_FILES['myFile3']['name'] == $filter5 || $_FILES['myFile3']['name'] == $filter6 || $_FILES['myFile3']['name'] == $filter7 || $_FILES['myFile3']['name'] == $filter8 || $_FILES['myFile3']['name'] == $filter9 || $_FILES['myFile3']['name'] == $filter10
    		
    	||	$_FILES['myFile4']['name'] == $filter1 || $_FILES['myFile4']['name'] == $filter2 || $_FILES['myFile4']['name'] == $filter3 || $_FILES['myFile4']['name'] == $filter4 || $_FILES['myFile4']['name'] == $filter5 || $_FILES['myFile4']['name'] == $filter6 || $_FILES['myFile4']['name'] == $filter7 || $_FILES['myFile4']['name'] == $filter8 || $_FILES['myFile4']['name'] == $filter9 || $_FILES['myFile4']['name'] == $filter10
    		
    	||	$_FILES['myFile5']['name'] == $filter1 || $_FILES['myFile5']['name'] == $filter2 || $_FILES['myFile5']['name'] == $filter3 || $_FILES['myFile5']['name'] == $filter4 || $_FILES['myFile5']['name'] == $filter5 || $_FILES['myFile5']['name'] == $filter6 || $_FILES['myFile5']['name'] == $filter7 || $_FILES['myFile5']['name'] == $filter8 || $_FILES['myFile5']['name'] == $filter9 || $_FILES['myFile5']['name'] == $filter10
    		
    	||	$_FILES['myFile6']['name'] == $filter1 || $_FILES['myFile6']['name'] == $filter2 || $_FILES['myFile6']['name'] == $filter3 || $_FILES['myFile6']['name'] == $filter4 || $_FILES['myFile6']['name'] == $filter5 || $_FILES['myFile6']['name'] == $filter6 || $_FILES['myFile6']['name'] == $filter7 || $_FILES['myFile6']['name'] == $filter8 || $_FILES['myFile6']['name'] == $filter9 || $_FILES['myFile6']['name'] == $filter10
    		
    	||	$_FILES['myFile7']['name'] == $filter1 || $_FILES['myFile7']['name'] == $filter2 || $_FILES['myFile7']['name'] == $filter3 || $_FILES['myFile7']['name'] == $filter4 || $_FILES['myFile7']['name'] == $filter5 || $_FILES['myFile7']['name'] == $filter6 || $_FILES['myFile7']['name'] == $filter7 || $_FILES['myFile7']['name'] == $filter8 || $_FILES['myFile7']['name'] == $filter9 || $_FILES['myFile7']['name'] == $filter10
    		
    	||	$_FILES['myFile8']['name'] == $filter1 || $_FILES['myFile8']['name'] == $filter2 || $_FILES['myFile8']['name'] == $filter3 || $_FILES['myFile8']['name'] == $filter4 || $_FILES['myFile8']['name'] == $filter5 || $_FILES['myFile8']['name'] == $filter6 || $_FILES['myFile8']['name'] == $filter7 || $_FILES['myFile8']['name'] == $filter8 || $_FILES['myFile8']['name'] == $filter9 || $_FILES['myFile8']['name'] == $filter10
    		
    	||	$_FILES['myFile9']['name'] == $filter1 || $_FILES['myFile9']['name'] == $filter2 || $_FILES['myFile9']['name'] == $filter3 || $_FILES['myFile9']['name'] == $filter4 || $_FILES['myFile9']['name'] == $filter5 || $_FILES['myFile9']['name'] == $filter6 || $_FILES['myFile9']['name'] == $filter7 || $_FILES['myFile9']['name'] == $filter8 || $_FILES['myFile9']['name'] == $filter9 || $_FILES['myFile9']['name'] == $filter10
    		
    	||	$_FILES['myFile10']['name'] == $filter1 || $_FILES['myFile10']['name'] == $filter2 || $_FILES['myFile10']['name'] == $filter3 || $_FILES['myFile10']['name'] == $filter4 || $_FILES['myFile10']['name'] == $filter5 || $_FILES['myFile10']['name'] == $filter6 || $_FILES['myFile10']['name'] == $filter7 || $_FILES['myFile10']['name'] == $filter8 || $_FILES['myFile10']['name'] == $filter9 || $_FILES['myFile10']['name'] == $filter10
    	
    	
    	
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
            	
            	//$types = $_POST['state'];
            
                if(!$_FILES['myFile1']['name']){
                	
                	$path3 = $p1;
                	
                }else{
                
                    $b = $_FILES['myFile1']['name'];
                    
                    if($types=='Resort Tents'){
                        $path2="uploads/pageimages/addgallery/resort/";
                    }
                    
                    if($types=='Projects'){
                        $path2="uploads/pageimages/addgallery/project/";
                    }
                	
                	
                }
                
                if(!$_FILES['myFile2']['name']){
                	
                	$path5 = $p2;
                	
                }else{
                
                    $c = $_FILES['myFile2']['name'];
                    if($types=='Resort Tents'){
                    $path4="uploads/pageimages/addgallery/resort/";
                    }
                    
                    if($types=='Projects'){
                        $path4="uploads/pageimages/addgallery/project/";
                    }
                	
                	
                }
                
                
                if(!$_FILES['myFile3']['name']){
                	
                	$path7 = $p3;
                	
                }else{
                
                    $a1 = $_FILES['myFile3']['name'];
                    if($types=='Resort Tents'){
                        $path6="uploads/pageimages/addgallery/resort/";
                    }
                    
                    if($types=='Projects'){
                        $path6="uploads/pageimages/addgallery/project/";
                    }
                	
                }
                
                
                if(!$_FILES['myFile4']['name']){
                	
                	$path9 = $p4;
                	
                }else{
                    $b1 = $_FILES['myFile4']['name'];
                    if($types=='Resort Tents'){
                        $path8="uploads/pageimages/addgallery/resort/";
                    }
                    
                    if($types=='Projects'){
                        $path8="uploads/pageimages/addgallery/project/";
                    }
                	
                }
                
                if(!$_FILES['myFile5']['name']){
                	
                	$path11 = $p5;
                	
                }else{
                
                    $c1 = $_FILES['myFile5']['name'];
                    if($types=='Resort Tents'){
                        $path10="uploads/pageimages/addgallery/resort/";
                    }
                    
                    if($types=='Projects'){
                        $path10="uploads/pageimages/addgallery/project/";
                    }
                	
                }
                
                if(!$_FILES['myFile6']['name']){
                	
                	$path13 = $p6;
                	
                }else{
                    $a2 = $_FILES['myFile6']['name'];
                    if($types=='Resort Tents'){
                        $path12="uploads/pageimages/addgallery/resort/";
                    }
                    
                    if($types=='Projects'){
                        $path12="uploads/pageimages/addgallery/project/";
                    }
                    	
                }
                
                if(!$_FILES['myFile7']['name']){
                	
                	$path15 = $p7;
                	
                }else{
                    $b2 = $_FILES['myFile7']['name'];
                    if($types=='Resort Tents'){
                        $path14="uploads/pageimages/addgallery/resort/";
                    }
                    
                    if($types=='Projects'){
                        $path14="uploads/pageimages/addgallery/project/";
                    }
                	
                }
                
                
                if(!$_FILES['myFile8']['name']){
                	
                	$path17 = $p8;
                	
                }else{
                    $c2 = $_FILES['myFile8']['name'];
                    if($types=='Resort Tents'){
                        $path16="uploads/pageimages/addgallery/resort/";
                    }
                    
                    if($types=='Projects'){
                        $path16="uploads/pageimages/addgallery/project/";
                    }
                    
                }
                
                if(!$_FILES['myFile9']['name']){
                	
                	$path19 = $p9;
                	
                }else{
                    $a3 = $_FILES['myFile9']['name'];
                    if($types=='Resort Tents'){
                        $path18="uploads/pageimages/addgallery/resort/";
                    }
                    
                    if($types=='Projects'){
                        $path18="uploads/pageimages/addgallery/project/";
                    }
                	
                }
                
                if(!$_FILES['myFile10']['name']){
                	
                	$path21 = $p10;
                	
                }else{
                    $b3 = $_FILES['myFile10']['name'];
                    if($types=='Resort Tents'){
                        $path20="uploads/pageimages/addgallery/resort/";
                    }
                    
                    if($types=='Projects'){
                        $path20="uploads/pageimages/addgallery/project/";
                    }
                	
                }
            
                if(($b != '' && (file_exists("uploads/pageimages/".$b) || 
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
                	) ||
                	($b3 != '' && (file_exists("uploads/pageimages/".$b3) || 
    					file_exists("uploads/pageimages/addgallery/".$b3) || 
    					file_exists("uploads/pageimages/addgallery/project/".$b3) || 
    					file_exists("uploads/pageimages/addgallery/resort/".$b3) || 
    					file_exists("uploads/pageimages/blogs/".$b3) || 
    					file_exists("uploads/pageimages/blogs/single/".$b3)  || 
    					file_exists("uploads/pageimages/contact/".$b3) || 
    					file_exists("uploads/pageimages/nav/".$b3) || 
    					file_exists("uploads/pageimages/nav/category/".$b3) || 
    					file_exists("uploads/pageimages/nav/types/".$b3) || 
    					file_exists("uploads/pageimages/project/".$b3) || 
    					file_exists("uploads/pageimages/project/category/".$b3) || 
    					file_exists("uploads/pageimages/project/types/".$b3) || 
    					file_exists("uploads/pageimages/resort/".$b3) || 
    					file_exists("uploads/pageimages/resort/category/".$b3) || 
    					file_exists("uploads/pageimages/resort/types/".$b3) || 
    					file_exists("uploads/pageimages/slider/".$b3) || 
    					file_exists("uploads/pageimages/youtube/".$b3))
                	)
                )
                {
                    $FileExists = true;
    	           header( "refresh:2; url=update-gallery.php" );
                }
                else {
                    
                    if(move_uploaded_file($_FILES['myFile1']['tmp_name'],$path2.$b)) 
                    {
                	    $path3=$path2.$b;
                    }
                   
                	if(move_uploaded_file($_FILES['myFile2']['tmp_name'],$path4.$c))
                	{
                	    $path5=$path4.$c;
                	}
                	
                	if(move_uploaded_file($_FILES['myFile3']['tmp_name'],$path6.$a1))
                	{
                	    $path7=$path6.$a1;
                	}
                	
                	if(move_uploaded_file($_FILES['myFile4']['tmp_name'],$path8.$b1))
                	{
                	    $path9=$path8.$b1;
                	}
                	
                	if(move_uploaded_file($_FILES['myFile5']['tmp_name'],$path10.$c1))
                	{
                	    $path11=$path10.$c1;
                	}
                	
                	if(move_uploaded_file($_FILES['myFile6']['tmp_name'],$path12.$a2))
                	{
                	    $path13=$path12.$a2;
                	}
                	
                	if(move_uploaded_file($_FILES['myFile7']['tmp_name'],$path14.$b2))
                	{
                	    $path15=$path14.$b2;
                	}
                	
                	if(move_uploaded_file($_FILES['myFile8']['tmp_name'],$path16.$c2))
                	{
                	    $path17=$path16.$c2;
                	}
                	
                	if(move_uploaded_file($_FILES['myFile9']['tmp_name'],$path18.$a3))
                	{
                	    $path19=$path18.$a3;
                	}
                	
                	if(move_uploaded_file($_FILES['myFile10']['tmp_name'],$path20.$b3))
                	{
                	    $path21=$path20.$b3;
                	}
                	
                    include "db.php";
                
                	mysqli_query($con,"update add_gallery SET p1='$path3',p2='$path5',p3='$path7',p4='$path9',p5='$path11',p6='$path13',p7='$path15',p8='$path17',p9='$path19',p10='$path21' where id=$id ");
                	
                	//header("location:update-gallery.php");
                	header( "refresh:2; url=update-gallery.php" );
                }	
            	
        	}else{
        		$count++;
        		continue;
        		
        		
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
			            <div>
                            <div class="page-body">
                                <div class="row">
                                    <div class="col-sm-12">
						                <?php include "alert-update.php" ?>
                                        <div class="card mb-30">
                                            <div class="card-header">Update Gallery</div>
                                                <div class="card-body">
                                                    <div class="row mb-30">
                                                        <div class="col-sm-6">
                                                            <div class="galleryDrop">
                                                                <select name="state" class="form-control country input" required>
                                                                    <option value="">--Select--</option>
								                                    <option value="Resort Tents">Resort Tents</option>
									                                <option value="Projects">Projects</option>
								                                </select><br>
								  
								                                <div id="categories">
					                                            </div>
					                                            <br><br>
					                                            
								                                <div id="response">
					                                            </div>
					                                            <br><br>
					 
					
                                            					<script>
                                                                    $(document).ready(function(){
                                                                        $("select.country").change(function(){
                                                                            var selectedCountry = $(".country option:selected").val();
                                                                    		
                                                                    		console.log(selectedCountry);
                                                                            $.ajax({
                                                                                type: "POST",
                                                                                url: "getSelectedCategory.php",
                                                                                data: { country : selectedCountry } 
                                                                            }).done(function(data){
                                                                                $("#categories").html(data);
                                                                            });
                                                                        });
                                                                    });
                                                                </script>
                                                            </div>
                                                        </div>
								                        <div class="col-sm-6"></div>
								
                                                        </div>
                                                        <hr>
                                                        <!---->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
						
            						    <div id="response1">
            					        </div>
                                    </div>
                                </div>
					       </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!---->
	  
	  
	  
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/ckeditor.js"></script>
        <!---->
    </body>
</html>