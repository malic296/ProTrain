<div class="vysledky">
<?php

//printing from table zaznamy
include("DBconnection.php");
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}
$sql = "select * from zaznamy where ID_users = $DBuserID "; //prikaz pro SQL
$result = $connection->query($sql);
echo "<table>";
echo "<tr class = 'zaznamy white top'><td class = 'first'>id</td><td class = 'small'><b><i class='fa-solid fa-calendar'></i>Date</b></td><td class = 'small'><b><i class='fa-solid fa-code'></i>Language</b></td><td class = 'small'><b><i class='fa-solid fa-clock'></i>Spent Time</b></td><td class = 'small'><b><i class='fa-solid fa-star'></i>Rating</b></td><td><b><i class='fa-solid fa-comment-dots'></i>Note</b></td><td class = 'last'><b><i class='fa-solid fa-wrench'></i>Actions</b></td'></tr>";
$help = 1;
if ($result->num_rows > 0) {
 
  while ($row = $result->fetch_assoc()) {
    $DBzaznamID = $row["ID_zaznamy"];
    if($help % 2 == 1){echo "<tr class = 'zaznamy grey'>";}
    else{echo "<tr class = 'zaznamy white'>";}
    $help ++;
    echo "  <td class = 'first'>".$row["ID_zaznamy"]."</td> 
            <td class = 'small'>".$row["Datum"]."</td> 
            <td class = 'small'>".$row["ProgramJazyk"]."</td> 
            <td class = 'small'>".$row["CasMin"]."</td> 
            <td class = 'small'>".$row["Hodnoceni"]."</td> 
            
            <td>".$row["Poznamka"]."</td>". 

            "<td class='last'>
              <a href='recordDelete.php?id=$DBzaznamID' class='delete'>Delete</a> 
              <button type='button' class='alter' id=$DBzaznamID data-toggle='modal' data-target='#studentaddmodal'>Edit</button>
              
            </td>
          </tr>";
  }
} else {
  echo "You don't have any records";
}
// Co uvidí user



echo "</table>";
$connection->close();

?>
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

                <form action="recordUpdate.php" method="POST">

                    <div class="modal-body">
                        <input type="hidden" name="recordID" id="ID_zaznamy">
                        
                        <div class="">
                            <label> Date</label>
                            <input type="date" name="date" id="Datum" class="" placeholder="Enter date">
                        </div>

                        <div class="">
                            <label> Language </label>
                            <select name="language" id="ProgramJazyk" class="" placeholder="Select language">
                              <option value="C++">C++</option>
                              <option value="C">C</option>
                              <option value="C#">C#</option>
                              <option value="Python">Python</option>
                              <option value="HTML">HTML</option>
                              <option value="CSS">CSS</option>
                              <option value="SQL">SQL</option>
                              <option value="Rust">Rust</option>
                              <option value="JavaScript">JavaScript</option>
                          </select>
                        </div>

                        <div class="">
                            <label> Spent Time </label>
                            <input type="number" name="spentTime" id="CasMin" class="" placeholder="Enter time">
                        </div>

                        <div class="">
                            <label> Rating </label>
                            <input type="number" name="rating" id="Hodnoceni" class="" placeholder="Enter rating">
                        </div>

                        <div class="">
                            <label> Note </label>
                            <input type="text" name="note" id="Poznamka" class="" placeholder="Write note">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="">Save</button>
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

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#ID_zaznamy').val(data[0]);
                $('#Datum').val(data[1]);
                $('#ProgramJazyk').val(data[2]);
                $('#CasMin').val(data[3]);
                $('#Hodnoceni').val(data[4]);
                $('#Poznamka').val(data[5]);
            });
        });
    </script>