<!DOCTYPE html>
<html>
<head>
    <title>Streams List</title>
</head>
<body>
    <h1>Streams List</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Film ID</th>
            <th>Adherent ID</th>
            <th>Expiration Date</th>
            <th>Purchase Date</th>
        </tr>
        <?php foreach ($streams as $stream): ?>
        <tr>
            <td><?php echo $stream['id']; ?></td>
            <td><?php echo $stream['id_film']; ?></td>
            <td><?php echo $stream['id_adherent']; ?></td>
            <td><?php echo date('Y-m-d H:i:s', $stream['date_expiration']); ?></td>
            <td><?php echo date('Y-m-d H:i:s', $stream['date_achat']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <form action="create_stream.php" method="post">
        <label for="id_film">Film ID:</label><br>
        <input type="text" id="id_film" name="id_film"><br>
        <label for="id_adherent">Adherent ID:</label><br>
        <input type="text" id="id_adherent" name="id_adherent"><br>
        <label for="date_expiration">Expiration Date:</label><br>
        <input type="text" id="date_expiration" name="date_expiration"><br>
        <label for="date_achat">Purchase Date:</label><br>
        <input type="text" id="date_achat" name="date_achat"><br><br>
        <input type="submit" value="Create Stream">
    </form>
</body>
</html>
