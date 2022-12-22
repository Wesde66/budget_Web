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
if (isset($_POST['submit']) and !empty($_POST['submit']) and $_POST['submit']==='Fetchftexp'){
    $year = "";
    $month = "";
    $error = 0;
    if (isset($_POST['Month_Forcast_Fortnightly']) and !empty($_POST['Month_Forcast_Fortnightly'])){
        $month = $_POST['Month_Forcast_Fortnightly'];
    }else{
        echo "Cant find month";
        $error++;
    }
    if (isset($_POST['Year_Forcast_Fortnightly']) and !empty($_POST['Year_Forcast_Fortnightly'])){
        $year = $_POST['Year_Forcast_Fortnightly'];
    }else{
        echo "Cant find year";
        $error++;
    }

    if ($error === 0){
        $query = "SELECT * FROM fortnightly WHERE fortnightmonth = '$month' AND fortnightyear = '$year'";
        $result = mysqli_query($DBC, $query);
        $rowcount = mysqli_num_rows($result);

    }
}
?>
<section id="fortnight_budget_forecast">
    <div class="container-fluid">
        <h1>Fortnightly budget planner</h1>
    </div>
    <div class="container text-start">
        <form method="post" name="Fortnightly_forcast_budget" >

            <div class="container row">
                <button type="submit" name="submit" id="submit" value="Fetchftexp" >Fetch records</button>
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


    </table>
</section>

<?php
include "../reused_PHP_files/footer.php";