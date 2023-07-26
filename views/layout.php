<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "segoe ui", roboto, oxygen, ubuntu, cantarell, "fira sans", "droid sans", "helvetica neue", Arial, sans-serif;
            font-size: 16px;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            background-color: #FFFFFF;
            margin: 0;
        }

        textarea {
            width: 100%;
            height: 150px;
            padding: 12px 20px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8f8;
            font-size: 16px;
            resize: none;
        }

        .navtop {
            background-color: blue;
            height: 60px;
            width: 100%;
            border: 0;
        }

        .navtop div {
            display: flex;
            margin: 0 auto;
            width: 1000px;
            height: 100%;
        }

        .navtop div h1,
        .navtop div a {
            display: inline-flex;
            align-items: center;
        }

        .navtop div h1 {
            flex: 1;
            font-size: 24px;
            padding: 0;
            margin: 0;
            color: #ecf0f6;
            font-weight: normal;
        }

        .navtop div a {
            padding: 0 20px;
            text-decoration: none;
            color: #c5d2e5;
            font-weight: bold;
        }

        .navtop div a i {
            padding: 2px 8px 0 0;
        }

        .navtop div a:hover {
            color: #ecf0f6;
        }

        .content {
            width: 1000px;
            margin: 0 auto;
        }

        .content h2 {
            margin: 0;
            padding: 25px 0;
            font-size: 22px;
            border-bottom: 1px solid #ebebeb;
            color: #666666;
        }

        .read .create-contact {
            display: inline-block;
            text-decoration: none;
            background-color: blue;
            font-weight: bold;
            font-size: 14px;
            color: #FFFFFF;
            padding: 10px 15px;
            margin: 15px 0;
        }

        .read .create-contact:hover {
            background-color: #ee6937;
        }

        .read .pagination {
            display: flex;
            justify-content: flex-end;
        }

        .read .pagination a {
            display: inline-block;
            text-decoration: none;
            background-color: #a5a7a9;
            font-weight: bold;
            color: #FFFFFF;
            padding: 5px 10px;
            margin: 15px 0 15px 5px;
        }

        .read .pagination a:hover {
            background-color: #999b9d;
        }

        .read table {
            width: 100%;
            padding-top: 30px;
            border-collapse: collapse;
        }

        .read table thead {
            background-color: #ebeef1;
            border-bottom: 1px solid #d3dae0;
        }

        .read table thead td {
            padding: 10px;
            font-weight: bold;
            color: #767779;
            font-size: 14px;
        }

        .read table tbody tr {
            border-bottom: 1px solid #d3dae0;
        }

        .read table tbody tr:nth-child(even) {
            background-color: #fbfcfc;
        }

        .read table tbody tr:hover {
            background-color: #376ab7;
        }

        .read table tbody tr:hover td {
            color: #FFFFFF;
        }

        .read table tbody tr:hover td:nth-child(1) {
            color: #FFFFFF;
        }

        .read table tbody tr td {
            padding: 10px;
        }

        .read table tbody tr td:nth-child(1) {
            color: #a5a7a9;
        }

        .read table tbody tr td.actions {
            padding: 8px;
            text-align: right;
        }

        .read table tbody tr td.actions .edit,
        .read table tbody tr td.actions .trash {
            display: inline-flex;
            text-align: right;
            text-decoration: none;
            color: #FFFFFF;
            padding: 10px 12px;
        }

        .read table tbody tr td.actions .trash {
            background-color: #b73737;
        }

        .read table tbody tr td.actions .trash:hover {
            background-color: #a33131;
        }

        .read table tbody tr td.actions .edit {
            background-color: #37afb7;
        }

        .read table tbody tr td.actions .edit:hover {
            background-color: #319ca3;
        }

        .update form {
            padding: 15px 0;
            display: flex;
            flex-flow: wrap;
        }

        .update form label {
            display: inline-flex;
            width: 400px;
            padding: 10px 0;
            margin-right: 25px;
        }

        .update form input {
            padding: 10px;
            width: 400px;
            margin-right: 25px;
            margin-bottom: 15px;
            border: 1px solid #cccccc;
        }

        .update form input[type="submit"] {
            display: block;
            background-color: #38b673;
            border: 0;
            font-weight: bold;
            font-size: 14px;
            color: #FFFFFF;
            cursor: pointer;
            width: 200px;
            margin-top: 15px;
        }

        .update form input[type="submit"]:hover {
            background-color: #32a367;
        }

        .delete .yesno {
            display: flex;
        }

        .delete .yesno a {
            display: inline-block;
            text-decoration: none;
            background-color: #38b673;
            font-weight: bold;
            color: #FFFFFF;
            padding: 10px 15px;
            margin: 15px 10px 15px 0;
        }

        .delete .yesno a:hover {
            background-color: #32a367;
        }

        .card {
            margin-bottom: 30px;
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, .1);
        }

        .card-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #eeecec;
            padding: 20px;
            border-bottom: 0.5px solid;
            border-radius: 10px 10px 0 0;
        }

        .card-title span {
            font-size: 18px;
            font-weight: 600;
            font-family: math;
        }

        .wisdom-content {
            display: block;
            position: relative;
            height: fit-content;
            background: gainsboro;
            padding: 30px;
            text-align: center;
            border-radius: 0 0 10px 10px;
        }

        .actions {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .actions i {
            cursor: pointer;
        }

        * {
            transition: all 0.6s;
        }

        #main {
            display: table;
            width: 100%;
            height: 100vh;
            text-align: center;
        }

        .fof {
            display: table-cell;
            vertical-align: middle;
        }

        .fof h1 {
            font-size: 50px;
            display: inline-block;
            padding-right: 12px;
            animation: type .5s alternate infinite;
        }

        .error {
            border: 1px solid red;
        }

        .wisdom-input {
            outline: none;
        }

        @keyframes type {
            from {
                box-shadow: inset -3px 0px 0px #888;
            }

            to {
                box-shadow: inset -3px 0px 0px transparent;
            }
        }
    </style>
    <script defer>
        function submit(button) {
            button.extElementSibling.submit();
        }
    </script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

    <title><?= APP_NAME ?></title>
</head>

<body>
    <nav class="navtop">
        <div>
            <h1>Wisdoms</h1>
            <a href="/"><i class="fas fa-home"></i>Home</a>
            <a href="/wisdoms"><i class="fas fa-address-book"></i>Wisdoms</a>
        </div>
    </nav>

    <?= view($page, $data) ?>

    <script>
        function deleteWisdom(button) {
            button.nextElementSibling.submit();
        }
    </script>
</body>

</html>