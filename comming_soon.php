

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="./css/bootstrap.css">
     <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="icon" type="image/x-icon" href="./assets/favicon.png">
    <title>Sanakin.lk - Commining Soon</title>
</head>
<style>
    *{
        margin: 0px !important;
        padding: 0px;
        box-sizing: border-box;
        font-family: "Raleway", sans-serif;
        /* width: 1920px; */
        /* font-size: 18px; */
        box-sizing: border-box;
    }
    body{
        width: 100%;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .error-panel{
        width: 100%;
        height: fit-content;
        display: flex;
        flex-direction: column;
         justify-items: center;
        align-items: center;
        margin-top: 5%;
        margin-bottom: 5%;
    }
    .error-panel img{
        width: 30%;
    }
    .error-panel .error-page-logo{
        width: 20%;
        margin-top:20px;

    }
    .error-panel .title{
        font-size: 36px;
        font-weight: bold;
    }
</style>
<body>
    <div class="error-panel">
        <img id="nav-logo" class="error-page-logo" src="./assets/sanakin-logo.png" alt="">

        <img src="./assets/error.gif" alt="">
        <p class="title">this in building progress </p>
        <P>This function is not able in this moment.</P>
        <p>It will be able to you ASAP.</p>
        <br>
        <input type="button" class="primary btn" value="Back to Sign in" onclick='window.location.href="./index.php"'>
    </div>
    <script src="https://kit.fontawesome.com/878c14d828.js" crossorigin="anonymous"></script>
</body>

</html>