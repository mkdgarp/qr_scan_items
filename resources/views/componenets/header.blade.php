<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Form</title>
    <!-- Bootstrap CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="//cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css" rel="stylesheet"> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="//cdn.datatables.net/2.0.1/js/dataTables.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.bootstrap5.js" type="text/javascript"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
</head>

<style>
    * {
        font-family: "Sarabun", sans-serif;
        font-style: normal;
    }

    body {
        background-color: #f3f4f6;
    }

    .card {
        border: none;
        padding: 10px;
        border-radius: 20px;
        box-shadow: 15px 9px 20px 0px #00000008;
    }

    .box-menu {
        background: #0b336e;
        width: 100%;
        position: fixed;
        bottom: 0;
        height: 65px;
        z-index: 100;
    }

    .box-menu>ul>a {
        color: white;
        text-decoration: none;
        list-style: none;
        /* background: red; */
        width: 100%;
        text-align: center;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
    }

    .box-menu>ul {
        display: flex;
        justify-content: space-evenly;
        padding: 0;
        height: 100%;
        align-items: center;
    }

    .box-menu>ul>a:hover {
        background: #1f56a8;
    }
</style>

<body>
