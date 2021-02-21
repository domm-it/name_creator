<?php
    function create_name($gender="m",$letter=false){

        /*=======================================================
        # LETTERS
        =======================================================*/
        $vowels = array("a","e","i","o","u");
        $consonants = array("b","c","d","f","g","h","j","k","l","m","n","p","q","r","s","t","v","w","x","z");
        
        /*=======================================================
        # GET LETTERS (ONLY ON RECURSION)
        =======================================================*/
        if($letter=="v"){
            return $vowels[rand(0,count($vowels)-1)];
        }elseif($letter=="c"){
            return $consonants[rand(0,count($consonants)-1)];
        }

        /*=======================================================
        # GET DIMENSION OF NAME RANDOM
        =======================================================*/
        $length = rand(3,8);
        $cons_tot = 2;
        $vow_tot = 1;
        $con=0;
        $vow=0;
        $last = "";
        $name = "";

        /*=======================================================
        # ITERATION TO CREATE WORD
        =======================================================*/
        for($i=0; $i<$length-1; $i++){
            if($i==0){
                /*=======================================================
                # RANDOM VOWELS OR CONSONANTS (ON RECURSION)
                =======================================================*/
                if(rand(0,1000)%2==0){
                    $letter = create_name($gender,1);
                    $last = $letter;
                    $name .= $letter;
                    $vow+=1;
                }else{
                    $letter = create_name($gender,2);
                    $last = $letter;
                    $name .= $letter;
                    $con+=1;
                }
            }

            /*=======================================================
            # CONTROL TOO MUCH VOWELS OR CONSONANTS
            =======================================================*/
            if($vow!=$vow_tot){
                do{
                    $letter = create_name($gender,1);
                }while($letter==$last);
                $last = $letter;
                $name.=$letter;
                $vow+=1;
                $con=0;
            }elseif($con!=$cons_tot){
                do{
                    $letter = create_name($gender,2);
                }while($letter==$last);
                $last = $letter;
                $name.=$letter;
                $con+=1;
                $vow=0;
            }

            /*=======================================================
            # INSERT LAST LETTER "A" ON FEMALE NAMES - itaFix
            =======================================================*/
            if($gender=="f" && $i==$length-2){ 
                if(substr($name, 0, strlen($name)-2) != "a"){
                    $name = substr($name, 0, strlen($name)-1)."a";
                }
            }
        }

        /*=======================================================
        # PRINT NAME
        =======================================================*/
        return ucfirst($name);
    }