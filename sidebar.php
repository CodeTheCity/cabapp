
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="index.php">
                        Get started
                    </a>
                </li>
                <li>
                    <a href="login.php">login</a>
                </li>
                <li>
                    <a href="account.php">account</a>
                </li>
                <li>
                   <a href="create.php">create</a>
                </li>
                <li>
                     <a href="search.php">search</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
	
	<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>