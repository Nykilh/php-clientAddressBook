<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client Address Book</title>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Client Address Book</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <?php
                if(isset($_SESSION['logged_user'])){
            ?>
            <ul class="nav navbar-nav">
                <li><a href="clients.php">My Clients</a></li>
                <li><a href="addclient.php">Add Client</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a id="hello">Hi, <?php echo $_SESSION['logged_user']; ?> </a></li>
                <li role="separator" class="divider"></li>
                <li><a href="includes/logout.php">Log out</a></li>
            </ul>
            <?php
                } else {
                    ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="registration.php">Register</a></li>
                        <li><a href="index.php">Log in</a></li>
                    </ul>
                    <?php
                }
            ?>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<noscript class="lead center-block text-center text-info">JavaScript is off. Please enable to view full site.</noscript>
