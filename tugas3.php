<?php
function prima($n){
  
  for($i=1;$i<=$n;$i++){  
          
          $counter = 0; 
          for($j=1;$j<=$i;$j++){ 
              
         
                if($i % $j==0){ 
                    
                      $counter++;
                }
          }
        
        if($counter==2){
             
               print $i." adalah bilangan prima <br/>";
        }
 }
} 

prima(40)
?>