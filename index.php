<!DOCTYPE HTML>

<!--
	Hyperspace by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>SQL Website</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">	

		<!-- Sidebar -->
			<section id="sidebar">
				<div class="inner">
					<nav>
						<ul>
							<li><a href="#intro">Welcome</a></li>
                            <li><a href="#tables">Tables</a></li>
							<li><a href="#admin">Admin Login</a></li>
						</ul>
					</nav>
				</div>
			</section>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Intro -->
                <section id="intro" class="wrapper style1 fullscreen fade-up">
                    <div class="inner">
                        <h1>SQL Website</h1>
                        <h2>By Antonio Reda</h2>                        
                    </div>
                </section>

                <script>
                    function option_changed() {
                        var index = document.getElementById('dropdown').selectedIndex;
                        var option = dropdown.options[index].text;
                        
                        var all_tables = document.getElementsByClassName("tables");
                        for (var i = 0; i < all_tables.length; i++) {
                            all_tables[i].style.display = "none";
                        }
                        document.getElementById(option).style.display = "block";

                    }
                </script>

                <?php 
                    function exec_query_to_table($query) {
                        $con=mysqli_connect("localhost","root","","database1");
                        if (mysqli_connect_errno())
                        {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        }
                        $result = mysqli_query($con, $query);

                        // Output field names
                        echo "<table><tr>";
                        for($i = 0; $i < mysqli_num_fields($result); $i++) {
                            $col_name = mysqli_fetch_field($result)->name;
                            $col_name = ucwords(str_replace("_", " ", $col_name));
                            echo "<th>{$col_name}</th>";
                        }
                        echo "</tr>";
                        // Output field values by row
                        while($row = mysqli_fetch_row($result)) {
                            echo "<tr>";
                            foreach($row as $col) {
                                echo "<td>" . htmlspecialchars($col) . "</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";

                        mysqli_close($con);
                    }
                ?>
                <?php
                      $con=mysqli_connect("localhost","root","","database1");
                    if (mysqli_connect_errno())
                    {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }

                    // Get all table names for dropdown list
                    $result = mysqli_query($con, "SHOW TABLES;");
                    $tables = array();
                    
                    echo "<section id='tables' class='wrapper style3'><div class='inner' style='padding-bottom:0px;'><h2>Tables</h2><select id='dropdown' onchange='option_changed()'>";
                    echo "<option></option>";
                    while($row = mysqli_fetch_row($result)) {
                        foreach($row as $col) {
                            echo "<option>{$col}</option>";
                            array_push($tables, $col);
                        }
                    }
                    echo "</select></div></section>";
                    mysqli_close($con);

                    // Select * from each table
                    foreach($tables as $table) {
                        echo "<div id='{$table}' class='tables wrapper style3 fade-up' style='display: none; padding-top:0px;'><div class='inner'><h3>{$table}</h3>";
                        exec_query_to_table("SELECT * FROM {$table}");
                        echo "</div></div>";
                    }
                    

                ?>
                
				<!-- Queries -->
				<section id="queries" class="wrapper style3 fade-up">
					<div class="inner">
						
                            <script>                                
                                function activate_query(n) {
                                    var current_query = document.getElementById(n);
                                    var all_queries = document.getElementsByClassName("queries");
                                    for (var i = 0; i < all_queries.length; i++) {
                                        all_queries[i].style.display = "none";
                                    }
                                    current_query.style.display = "block";
                                }
                            </script>                            
                            
                            <div class="queries" id="1" style="display: none">
                                <?php
                                echo "<h2>Query 1</h2>";
                                echo "<h3><i>Explanation</i></h3>";

                                // Execute query 1
                                $query = "SELECT Facility.province, Facility.name, Facility.capacity, SUM(CASE WHEN start_date IS NOT NULL AND end_date IS NULL THEN 1 ELSE 0 END) as total
                                    FROM Facility LEFT JOIN EmployedHistory
                                    ON Facility.id = EmployedHistory.facility_id
                                    GROUP BY Facility.name";
                                exec_query_to_table($query);
                                ?>
                            </div>

                            <div class="queries" id="2" style="display: none">
                                <?php
                                echo "<h2>Query 2</h2>";
                                echo "<h3><i>Explanation</i></h3>";
                                // Execute query 2
                                $query = "SELECT Facility.province, FacilityType.name, COUNT(*) as total
                                    FROM Facility, FacilityType
                                    WHERE Facility.facilitytype_id = FacilityType.id
                                    GROUP BY Facility.province, FacilityType.name  
                                    ORDER BY Facility.province ASC, total ASC";
                                exec_query_to_table($query);
                                ?>
                            </div>

                            <div class="queries" id="3" style="display: none">
                                <?php
                                echo "<h2>Query 3</h2>";
                                echo "<h3><i>Explanation</i></h3>";
                                // Execute query 3
                                $query = "SELECT Employee.first_name, Employee.last_name, EmployeeRole.role, Employee.medicare, Employee.phone, Employee.email, Was_Infected.date
                                    FROM Employee, EmployedHistory, EmployeeRole, Facility, Was_Infected, Infection
                                    WHERE Employee.id = EmployedHistory.employee_id
                                        AND EmployedHistory.employeerole_id = EmployeeRole.id
                                        AND EmployedHistory.facility_id = Facility.id
                                        AND EmployedHistory.end_date IS NULL
                                        AND Employee.id = Was_Infected.employee_id
                                        AND Was_Infected.infection_id = Infection.id
                                        AND Facility.name = 'Hospital Maisonneuve Rosemont'
                                        AND EmployeeRole.role IN ('Nurse','Doctor')
                                    ORDER BY Was_Infected.date DESC, first_name ASC, last_name ASC";
                                exec_query_to_table($query);
                                ?>
                            </div>

                            <div class="queries" id="4" style="display: none">
                                <?php
                                echo "<h2>Query 4</h2>";
                                echo "<h3><i>Explanation</i></h3>";
                                // Execute query 4
                                $query = "SELECT Employee.id, Employee.first_name, Employee.last_name, EmployeeRole.role, Employee.medicare, Employee.phone, Employee.email
                                    FROM Employee, EmployedHistory, EmployeeRole, Facility
                                    WHERE Employee.id = EmployedHistory.employee_id
                                        AND EmployedHistory.employeerole_id = EmployeeRole.id
                                        AND EmployedHistory.facility_id = Facility.id
                                        AND EmployedHistory.end_date IS NULL
                                        AND Facility.name = 'Hospital Maisonneuve Rosemont'
                                        AND Employee.id NOT IN (SELECT employee_id FROM Was_Vaccinated)
                                        AND Employee.id NOT IN (SELECT employee_id 
                                                                FROM Was_Infected, Infection 
                                                                WHERE Was_Infected.infection_id = Infection.id
                                                                    AND Infection.type = 'COVID-19')";
                                exec_query_to_table($query);
                                ?>
                            </div>

                            <div class="queries" id="5" style="display: none">
                                <?php
                                echo "<h2>Query 5</h2>";
                                echo "<h3><i>Explanation</i></h3>";
                                // Execute query 5
                                $query = "SELECT Employee.first_name, Employee.last_name, EmployedHistory.start_date, EmployedHistory.end_date, Facility.name, EmployeeRole.role, Employee.medicare, Employee.phone, Employee.email
                                    FROM Employee, EmployedHistory, Facility, EmployeeRole
                                    WHERE Employee.id in (SELECT employee_id
                                                        FROM EmployedHistory
                                                        GROUP BY employee_id
                                                        HAVING COUNT(DISTINCT facility_id) > 1)
                                        AND Employee.id = EmployedHistory.employee_id
                                        AND EmployedHistory.facility_id = Facility.id
                                        AND EmployedHistory.employeerole_id = EmployeeRole.id
                                    ORDER BY Employee.first_name, Employee.last_name, EmployedHistory.start_date;";
                                exec_query_to_table($query);
                                ?>
                            </div>

                            <div class="queries" id="6" style="display: none">
                                <?php
                                echo "<h2>Query 6</h2>";
                                echo "<h3><i>Explanation</i></h3>";
                                // Execute query 6
                                $query = "SELECT Was_Vaccinated.vaccination_id, Vaccination.type, COUNT(*) 
                                    FROM Was_Vaccinated, Vaccination 
                                    WHERE Was_Vaccinated.vaccination_id = Vaccination.id
                                    GROUP BY Was_Vaccinated.vaccination_id 
                                    ORDER BY COUNT(*) DESC;";
                                exec_query_to_table($query);
                                ?>
                            </div>
                            
                            <div class="queries" id="7" style="display: none">
                                <?php
                                echo "<h2>Query 7</h2>";
                                echo "<h3><i>Explanation</i></h3>";
                                // Execute query 7
                                $query = "SELECT Infection.type as 'Infection type', COUNT(DISTINCT Employee.id) as 'Number of employees infected', Employee.province 
                                FROM Infection, Employee, Was_Infected 
                                WHERE Infection.id = Was_Infected.infection_id 
                                    AND Was_Infected.employee_id = Employee.id
                                GROUP BY Infection.type, Employee.province
                                ORDER BY Infection.type ASC, COUNT(DISTINCT Employee.id) DESC";
                                exec_query_to_table($query);
                                ?>
                            </div>

                            <div class="queries" id="8" style="display: none">
                                <?php
                                echo "<h2>Query 8</h2>";
                                echo "<h3><i>Explanation</i></h3>";
                                // Execute query 8
                                $query = "SELECT Employee.first_name , Employee.last_name , EmployedHistory.start_date, 
                                Facility.name as 'Facility', EmployeeRole.`role` , Employee.medicare, 
                                Employee.phone as 'Telephone number', Employee.email, 
                                COUNT(Employee.id) as 'Number of times infected'
                                FROM Employee, Facility, EmployedHistory, EmployeeRole, Was_Infected 
                                WHERE Employee.id = EmployedHistory.employee_id 
                                AND EmployedHistory.facility_id = Facility.id 
                                AND EmployedHistory.employeerole_id = EmployeeRole.id 
                                AND Employee.id = Was_Infected.employee_id
                                AND EmployedHistory.end_date IS NULL 
                                GROUP BY Employee.id 
                                HAVING  COUNT(Employee.id) > 2
                                ORDER BY COUNT(Employee.id) DESC, Employee.first_name DESC, Employee.last_name DESC";
                                exec_query_to_table($query);
                                ?>
                            </div>
					</div>
				</section>

				<!--Admin -->
				<section id="admin" class="wrapper style3 fade-up">
					<div class="inner">
					<button  onclick="window.location.href='Login.php'" > Admin Log In </button>
					</div>
				</section>
			</div>

		<!-- Footer -->
			<footer id="footer" class="wrapper style1-alt">
				<div class="inner">
					<ul class="menu">
						<li>&copy; All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>