<!DOCTYPE html>
<html>
<head>
    <title><?= $title; ?></title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .delete-button {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
        .back-button {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    color: white;
    background-color: #007BFF;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    text-align: center;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
    </style>
    
</head>
<body>
    <h1><?= $title; ?></h1>
    <table>
        <thead>
            <tr>
                
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?= $tbody; ?>
        </tbody>
    </table>
    <a href='/registro_evento' class='back-button'>Volver</a>
</body>
</html>
