<?php   

      if(isset($_POST["dashboard"])){
        include "dashboard.php";
        echo "<style>
              #tab1{
                background-color: #0CBB67;                
              }
              .content1{
                background-color:transparent;
                box-shadow: none;
              }     
              </style>";
      }
      else if(isset($_POST["newRec"])){
        include "recordForm.php";
        echo "<style>
              #tab2{
                background-color: #0CBB67;                
              }
              
              </style>";
      }
      else if(isset($_POST["allRecs"])){
        include "recordTable.php";
        echo "<style>
              #tab3{
                background-color: #0CBB67;                
              }
              
              </style>";
      }
      else if(isset($_POST["profile"])){
        echo 2;
        echo "<style>
              #tab4{
                background-color: #0CBB67;                
              }
               
              </style>";
      }
      else{
      
      } 
      ?>