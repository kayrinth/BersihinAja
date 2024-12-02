<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BersihinAja</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f9f9f9;
        }

        .logo {
            margin-bottom: 20px;
        }

        .card {
            padding: 80px;
            border: 1px solid #e5e5e5;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .btn-choice {
            height: 100px;
            width: 150px;
            margin: 10px;
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: bold;
        }

        .btn-choice:first-child {
            background-color: #8dc3b6;
        }

        .btn-choice:last-child {
            background-color: #a8d5c4;
        }

        .btn-choice:hover {
            opacity: 0.5;
        }
    </style>
</head>

<body>
    <div class="text-center mb-4 d-flex align-items-center justify-content-center">
        <img src="/BersihinAja/user/assets/wind.svg" alt="Logo" width="50" height="50" class="me-2">
        <h2 class="text-bold m-0">BersihinAja</h2>
    </div>
    <!-- Card -->
    <div class="card text-center">
        <h5 class="mb-4">Siapa kamu?</h5>
        <div class="d-flex justify-content-around mb-4">
            <button class="btn-choice font-extrabold text-white" onclick="location.href='auth/registCustomer';">customer</button>
            <button class="btn-choice font-extrabold text-white" onclick="location.href='auth/registPekerja';">pekerja</button>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>