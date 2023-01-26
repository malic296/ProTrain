<?php 

include("DBconnection.php");

$DBuserID = $_SESSION["userID"];
$sql = "SELECT  dailyGoal from users WHERE ID_users = '$DBuserID';";
$result = $connection->query($sql);
$result = $result->fetch_assoc();
$dailyGoal = $result["dailyGoal"];


$sql = "SELECT * from Kategorie WHERE ID_users = '$DBuserID';";
$result = $connection->query($sql);
$nameList = [];
$colorList = [];
$popisList = [];
$index = 0;
while ($row = $result->fetch_assoc()) {
    $nameList[$index] = $row["nazev"];
    $colorList[$index] = $row["barva"];
    $popisList[$index] = $row["popis"];
    $index++;
}


?>

<div class="settings">
    <div class="settingh"><h1>SETTINGS</h1></div>
    <div>dark mode work in progress</div>
    <div class="settingLight">
        <div class="dark">Dark</div>
        <div class="switchDiv">
            <label class="switch">
            <input type="checkbox" name = "switch">
            <span class="slider round"></span>
            </label>           
        </div>
        
        <div class="light">Light</div>
        
    </div>
    
    <div class="settingCategory">
        <div>Add Category</div>
        <div><button type='button' class='setCategory' id='setCategory' data-toggle='modal2' data-target='#studentaddmodal2'>Add</button></div>
        <div>Your Categories</div>
        <select>
        <?php 
        foreach($nameList as $oneName){
            $key = array_search($oneName, $nameList);

            echo "<option style='color: $colorList[$key]'>$oneName - $popisList[$key]</option>";
        }
        ?>
        </select>
    </div>



    <div class="settingGoal">
        <div>Daily Goal: <?php echo "$dailyGoal"; ?></div>
        <div><button type='button' class='alter' data-toggle='modal' data-target='#studentaddmodal'>Edit</button></div>
    </div>

</div> 

<!-- Modal -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="DailyGoalUpdate.php" method="POST">

                    <div class="modal-body">
                        <input class = "input" type="hidden" name="recordID" id="ID_zaznamy">

                        <div class="">
                            <label> New daily goal </label>
                            <input class = "input" type="number" name="dailyGoal" id="dailyGoal" placeholder="Enter your new daily goal" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="submitProf" data-dismiss="modal">Close</button>
                        <button type="submit" name="updateGoal" class="submitProf">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {

            $('.alter').on('click', function () {

                $('#editmodal').modal('show');

            });
        });
    </script>

<div class="modal fade" id="editmodal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    
                </div>
                
                <form action="addCategory.php" method="POST">

                    <div class="modal-body">
                        <input class = "input" type="hidden" name="recordID" id="ID_zaznamy">

                        <div class="">
                            <label> Name </label>
                            <input class = "input" type="text" name="nameCategory" required>
                        </div>
                        <div class="">
                            <label> Color </label>
                            <input class = "input" type="color" name="colorCategory" required>
                        </div>
                        <div class="">
                            <label> Description </label>
                            <input class = "input" type="text" name="descriptionCategory" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="submitProf" data-dismiss="modal">Close</button>
                        <button type="submit" name="addCategorySubmit" class="submitProf">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            $('.setCategory').on('click', function () {

                $('#editmodal2').modal('show');

            });
        });
    </script>