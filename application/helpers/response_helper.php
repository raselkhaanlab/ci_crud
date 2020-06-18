<?php
      function json_response($data,$status=200,$headers=[]){
        header("content-type:application/json");
        http_custom_status_and_header_set($status,$headers);
        $encode = json_encode($data);
        echo $encode;
     }
     
     function http_custom_status_and_header_set($status,$headers){
        header_remove("X-Powered-By");
        foreach($headers as $key=>$value){
            header("{$key}:{$value}");
          }
      http_response_code($status);
     }