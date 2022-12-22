<?php
include "../reused_PHP_files/header.php";
include "../reused_PHP_files/top_nav_bar.php";

include "../reused_PHP_files/config.php";
$DBC  = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
//insert DB code from here onwards
//check if the connection was good
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. " . mysqli_connect_error();
    exit; //stop processing the page further
}
if (isset($_POST['submit']) and !empty($_POST['submit']) and $_POST['submit']==='Fetchftexp') {
    $year = "";
    $month = "";
    $error = 0;
    if (isset($_POST['Month_Forcast_Fortnightly']) and !empty($_POST['Month_Forcast_Fortnightly'])) {
        $month = $_POST['Month_Forcast_Fortnightly'];
    } else {
        echo "Cant find month";
        $error++;
    }
    if (isset($_POST['Year_Forcast_Fortnightly']) and !empty($_POST['Year_Forcast_Fortnightly'])) {
        $year = $_POST['Year_Forcast_Fortnightly'];
    } else {
        echo "Cant find year";
        $error++;
    }

    if ($error === 0) {
        $query = "SELECT * FROM fortnightly WHERE fortnightmonth = '$month' AND fortnightyear = '$year'";
        $query2 = "SELECT SUM(`ft1`) FROM fortnightly WHERE fortnightmonth = '$month' AND fortnightyear = '$year'";
        $query3 = "SELECT SUM(`ft2`) FROM fortnightly WHERE fortnightmonth = '$month' AND fortnightyear = '$year'";
        $query4 = "SELECT SUM(`ft3`) FROM fortnightly WHERE fortnightmonth = '$month' AND fortnightyear = '$year'";
        $result = mysqli_query($DBC, $query);
        $result2 = mysqli_query($DBC, $query2);
        $result3 = mysqli_query($DBC, $query3);
        $result4 = mysqli_query($DBC, $query4);
        $sum = mysqli_fetch_array($result2);
        $sum2 = mysqli_fetch_array($result3);
        $sum3 = mysqli_fetch_array($result4);
        $rowcount = mysqli_num_rows($result);

    }
}

if (isset($_POST['submit']) and !empty($_POST['submit']) and $_POST['submit']==='addExpFortnight'){
    $addMonth = "";
    $addYear = "";
    $addCompany = "";
    $addFt1 = 0;
    $addFt2 = 0;
    $addFt3 = 0;
    $addError = 0;

    if (isset($_POST['addMonthExp']) and !empty($_POST['addMonthExp'])){
        $addMonth = $_POST['addMonthExp'];
    }else{
        $addError++;
    }
    if (isset($_POST['addYear']) and !empty($_POST['addYear'])){
        $addYear = $_POST['addYear'];
    }else{
        $addError++;
    }
    if (isset($_POST['addCompany']) and !empty($_POST['addCompany'])){
        $addCompany =$_POST['addCompany'];
    }else{
        $addError++;
    }
    if (isset($_POST['addf1Exp']) and !empty($_POST['addf1Exp'])){
        $addFt1 = $_POST['addf1Exp'];
    }
    if (isset($_POST['addf2Exp']) and !empty($_POST['addf2Exp'])){
        $addFt2 = $_POST['addf2Exp'];
    }
    if (isset($_POST['addf3Exp']) and !empty($_POST['addf3Exp'])){
        $addFt3 = $_POST['addf3Exp'];
    }

    if ($addError === 0){
        $addQuery = "INSERT INTO fortnightly (fortnightyear, fortnightmonth, company, ft1, ft2, ft3) 
                    VALUES ('$addYear', '$addMonth', '$addCompany', '$addFt1', '$addFt2','$addFt3' )";
        mysqli_query($DBC, $addQuery);
    }
}
?>

<section id="modal_for_add_fortnightly_expense">
    <!-- Modal -->
    <div class="modal fade" id="addExpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a fortnightly expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" name="addExp" method="post" class="form-control">
                        <div class="container row">

                            <label class="form-label" for="addMonthExp"><strong>Please select month: </strong></label>
                            <select class="form-select" name="addMonthExp" id="addMonthExp">
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </div>
                        <div class="container row">
                            <label class="form-label" for="Year_Forcast_Fortnightly"><strong>Please select year: </strong></label>
                            <select class="form-select" name="addYear" id="addYear">
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="company" class="form-label">Company:</label>
                            <input type="text" class="form-control" id="company" name="addCompany" placeholder="Enter company">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="addf1Exp" class="form-label">First fortnight:</label>
                            <input type="number" min="1" step="any" class="form-control" name="addf1Exp" id="addf1Exp" placeholder="Pay on first fortnight">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="addf2Exp" class="form-label">Second fortnight:</label>
                            <input type="number" min="1" step="any" class="form-control" id="addf2Exp" name="addf2Exp" placeholder="Pay on second fortnight">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="addf3Exp" class="form-label">Third fortnight:</label>
                            <input type="number" min="1" step="any" class="form-control" id="addf3Exp" name="addf3Exp"  placeholder="Pay on third fortnight">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" id="submit" value="addExpFortnight" class="btn btn-outline-dark btn-light">Save changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>
<section id="fortnight_budget_forecast">
    <div class="container-fluid">
        <h1>Fortnightly budget planner</h1>
    </div>
    <div class="container-fluid">

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-light float-end" data-bs-toggle="modal" data-bs-target="#addExpModal">
            Add expense to file
        </button>
    </div>
    <div class="container text-start">
        <form method="post" name="Fortnightly_forcast_budget" >

            <div class="container row">
                <button type="submit" name="submit" id="submit" value="Fetchftexp" class="btn btn-outline-light" >Fetch records</button>
                <label class="col-2" for="Month_Forcast_Fortnightly"><strong>Please select month: </strong></label>
                <select class="col-2" name="Month_Forcast_Fortnightly" id="Month_Forcast_Fortnightly">
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>
            </div>
            <div class="container row">
                <label class="col-2" for="Year_Forcast_Fortnightly"><strong>Please select year: </strong></label>
                <select class="col-2" name="Year_Forcast_Fortnightly" id="Year_Forcast_Fortnightly">
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                </select>
            </div>

        </form>
    </div>
</section>
<section id="Table_Fortnight_display">
    <table class="table table-striped table-responsive">
        <thead>
        <tr>
            <th>Company</th>
            <th>First payment</th>
            <th>Second payment</th>
            <th>Third payment</th>
            <th>Action events</th>
        </tr>
        </thead>
        <tbody>

        <?php
        if (isset($rowcount)) {


            if ($rowcount > 0) {

                while ($row = mysqli_fetch_assoc($result)) {

                    $id = $row['fornightlypaymentID'];
                    echo '<tr><td>' . $row['company'] . '</td><td>' . $row['ft1'] . '</td><td>' . $row['ft2'] . '</td><td>' . $row['ft3'] . '</td>';
                    echo '<td><a href=".php?id=' . $id . '">[view]</a>';
                    echo '<a href=".php?id=' . $id . '">[edit]</a>';
                    echo '<a href=".php?id=' . $id . '">[delete]</a></td>';
                }
                echo '</tr>';

                echo '<tr><td></td><td>' . $sum[0] . '</td><td>' . $sum2[0] . '</td><td>' . $sum3[0] . '</td>';
                echo '</tr>';
            } else {
                echo '<tr><td><h3>No records found for this month and year</h3></td>';
            }
        }
        ?>

        </tbody>
    </table>
</section>


<?php
include "../reused_PHP_files/footer.php";
