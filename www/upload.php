<?php
   /* File upload example */
   $FIELDNAME=$_GET["fieldname"]?:"images";
   $MULTIPLE=$_GET["multiple"]==1;

   if(isset($_FILES[$FIELDNAME])){
        $upload_errors=[];
        $upload_messages=[];
        $upload_files=[];

        $FILES = $_FILES[$FIELDNAME];

        if (!is_array($_FILES[$FIELDNAME]["name"])){
         $FILES=[];  
         $FILES['name'][0]=$_FILES[$FIELDNAME]['name'];
         $FILES['size'][0]=$_FILES[$FIELDNAME]['size'];
         $FILES['tmp_name'][0]=$_FILES[$FIELDNAME]['tmp_name'];
         $FILES['type'][0]=$_FILES[$FIELDNAME]['type'];
        };

        foreach($FILES["name"] as $index => $file_name ){
            $errors= array();
            $messages = array();
            $file_size =$FILES['size'][$index];
            $file_tmp =$FILES['tmp_name'][$index];
            $file_type=$FILES['type'][$index];
            $file_ext=strtolower(end(explode('.',$file_name)));
            $file=["name"=>$file_name,"size"=>$file_size*1,"type"=>$file_type];
            
            $extensions= array("jpeg","jpg","png");
            
            if(in_array($file_ext,$extensions)=== false){
               $errors[]="[$file_ext] extension not allowed, please choose a JPEG or PNG file.";
            }
            
            $POSTMAXSIZE = explode("M",ini_get("post_max_size"))[0] * 1024*1024;
            $UPLOADMAXSIZE = explode("M",ini_get("upload_max_filesize"))[0] * 1024*1024;
            $MAXSIZE = max($POSTMAXSIZE,$UPLOADMAXSIZE);
            

            if($file_size > $MAXSIZE){
                $MAXMB = $MAXSIZE / (1024*1024);
                $errors[]="File size must be less than $MAXSIZE ($MAXMB Mb)";
            }
            
            if(empty($errors)==true){
               @mkdir("images");
               $target="images/".$file_name;
               $result=move_uploaded_file($file_tmp,$target);
               if ($result){
                  $messages[]= "Received : $target";
               }else{
                  $errors[]="Can't save file : $target "; 
                  $errors[]=(error_get_last()["message"]);
               }
               
            }
            $upload_errors[$index]=$errors;
            $upload_messages[$index]=$messages;
            $upload_files[$index]=$file;
            
        }

        header("Content-type: text/json");
        $output["files"]=$upload_files;
        $output["errors"]=$upload_errors;
        $output["messages"]=$upload_messages;
        echo json_encode($output);
        die();

      
   }
?>
<html>
   <body>
      
      <form action="" method="POST" enctype="multipart/form-data">
         <input type="file" name="<?php echo $FIELDNAME ?><?php if($MULTIPLE) echo "[]" ?>" <?php if($MULTIPLE) echo "multiple" ?>/>
         <input type="submit"/>
      </form>
   </body>
</html>