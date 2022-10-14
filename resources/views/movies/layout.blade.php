<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awosme links -->
    <link rel="stylesheet" href="font-awsome/css/all.min.css">
    <!-- bootstrap links -->
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/bootstrap.bundle.min.js"></script>
    <!-- custom needed stylying for dashboar -->
    <style>
        .checked {
            color: orange;
        }

    </style>
    <!-- title -->
    @yield('title')

</head>

<body class="container" style="background-color: #e8c39e;">
    @yield('page')
</body>

</html>
