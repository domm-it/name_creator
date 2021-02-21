<?php
    function create_name($gender="m",$letter=false){
        $vocals = array("a","e","i","o","u");
        $consonants = array("b","c","d","f","g","h","j","k","l","m","n","p","q","r","s","t","v","w","x","z");
        
        if($letter=="v"){
            return $vocals[rand(0,count($vocals)-1)];
        }elseif($letter=="c"){
            return $consonants[rand(0,count($consonants)-1)];
        }
        $length = rand(3,8);
        $cons_tot = 2;
        $voc_tot = 1;

        $con=0;
        $voc=0;
        $last = "";
        $name = "";
        for($i=0; $i<$length-1; $i++){
            if($i==0){
                if(rand(0,1000)%2==0){
                    $letter = create_name($gender,1);
                    $last = $letter;
                    $name .= $letter;
                    $voc+=1;
                }else{
                    $letter = create_name($gender,2);
                    $last = $letter;
                    $name .= $letter;
                    $con+=1;
                }
            }

            if($voc!=$voc_tot){
                do{
                    $letter = create_name($gender,1);
                }while($letter==$last);
                $last = $letter;
                $name.=$letter;
                $voc+=1;
                $con=0;
            }elseif($con!=$cons_tot){
                do{
                    $letter = create_name($gender,2);
                }while($letter==$last);
                $last = $letter;
                $name.=$letter;
                $con+=1;
                $voc=0;
            }

            if($gender=="f" && $i==$length-2){ 
                if(substr($name, 0, strlen($name)-2) != "a"){
                    $name = substr($name, 0, strlen($name)-1)."a";
                }
            }
        }
        return ucfirst($name);
    }