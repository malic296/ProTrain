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
              .content1{
                width:100%;
                display:flex;
                flex-direction:row;
                border-radius:0px;
                background-color: #DEDDDD;
                box-shadow:none;
              }

              .filtrace{
                display:flex;
                justify-content:center;
                align-items:center;
                box-shadow: 3px 3px 13px #878787;
                margin-left: 10px;
                border-radius:10px;
                background-color:white;

              }
              .vysledky{
                box-shadow: 3px 3px 13px #878787;
                border-radius:10px;
                background-color:white;
              }
              
              </style>";
      }
      else if(isset($_POST["profile"])){
        include "userProfile.php";
        echo "<style>
              #tab4{
                background-color: #0CBB67;                
              }
              .content1{
                display:flex;
                flex-direction: column;
                
              }
               
              </style>";
      }
      else if(isset($_POST["settings"])){
          include "settings.php";
          echo "<style>
              .test2{
                background-color: #0CBB67;                
              }
              </style>";
      }
      else{
        include "dashboard.php";
        echo "<style>
              .content1{
                background-color: transparent;  
                box-shadow: none;  
                         
              }
               
              </style>";
        } 
      ?>