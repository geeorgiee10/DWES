
    <?php 
    
        if(!is_dir("assets/img")){
            echo "No tenemos imágenes";
        }
        else{
            foreach($mazo as $carta){
                $image = "./assets/img/" . $carta->getPalo()."_".$carta->getNumero().".jpg";
                    if(file_exists($image)){
                        echo "<img src='$image'/>";
                    }
                    else{
                        echo "No tenemos la imagen de esta carta";
                    }
            }
        }
    
    ?>