<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css"/>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <title>Retirement Planner</title>

        <center><h1>Retirement Planner</h1><center>

                <?php if (session()->get('isLoggedIn')): ?>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dashboard ?>">
                            <a class="nav-link"  href="./dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item dashboard ?>">
                            <a class="nav-link"  href="./div_info">Enter Stock Info</a>
                        </li>
                        <li class="nav-item dashboard ?>">
                            <a class="nav-link"  href="./div_manager">Enter Dividend Info</a>
                        </li>
                        <li class="nav-item dashboard ?>">
                            <a class="nav-link"  href="./div_income">Dividend Income Analyzer</a>
                        </li>
                        <li class="nav-item dashboard ?>">
                            <a class="nav-link"  href="./recurring_purchases">Recurring Purchases</a>
                        </li>
                        <li class="nav-item dashboard ?>">
                            <a class="nav-link"  href="./recurring_income">Recurring Income</a>
                        <li class="nav-item dashboard ?>">
                            <a class="nav-link"  href="./one_time_purchases">One Time Payments</a>
                        </li>
                        <li class="nav-item dashboard ?>">
                            <a class="nav-link"  href="./one_time_income">One Time Income</a>
                        </li>
                        <li class="nav-item profile' ?>">
                            <a class="nav-link" href="./profile">Profile</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav my-2 my-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="./logout">Logout</a>
                        </li>
                    </ul>
                <?php endif; ?>

                <!--(SELECT *, ROUND((DATEDIFF(date_received, date_purchased) / 365) + 1) years from dividends NATURAL JOIN stocks WHERE user_id=2)-->
    </head>
<body>