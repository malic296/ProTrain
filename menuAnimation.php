<?php   

      if(isset($_POST["dashboard"])){
        echo 1;
        echo "<style>
              .fill1{
                background-color: #0CBB67;                
              }
              .fill1:hover{
                animation: none;
              } 
              .content1{background-color:transparent;}     
              </style>";
      }
      else if(isset($_POST["newRec"])){
        include "recordForm.php";
        echo "<style>
              .fill2{
                background-color: #0CBB67;                
              }
              .fill2:hover{
                animation: none;
              }      
              </style>";
      }
      else if(isset($_POST["allRecs"])){
        include "recordTable.php";
        echo "<style>
              .fill3{
                background-color: #0CBB67;                
              }
              .fill3:hover{
                animation: none;
              }      
              </style>";
      }
      else if(isset($_POST["profile"])){
        echo 2;
        echo "<style>
              .fill4{
                background-color: #0CBB67;                
              }
              .fill4:hover{
                animation: none;
              }      
              </style>";
      }
      else{
      
      } 
      ?>