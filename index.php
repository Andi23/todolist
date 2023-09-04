<?php
$conn = mysqli_connect("localhost", "root", "", "todo");
$no = 1;
if (isset($_GET['status'])) {
    if ($_GET['status'] == 1) {
        $query =  "UPDATE tugas SET status = 'On Progress' WHERE id = $_GET[id]";
    } elseif ($_GET['status'] == 2) {
        $query =  "UPDATE tugas SET status = 'Cancelled' WHERE id = $_GET[id]";
    } elseif ($_GET['status'] == 3) {
        $query =  "UPDATE tugas SET status = 'Done' WHERE id = $_GET[id]";
    } else {
        $query =  "DELETE FROM tugas WHERE id = $_GET[id]";
    }
    mysqli_query($conn, $query);
}

if (isset($_POST['submit'])) {
    $tugas = htmlspecialchars($_POST['tugas']);
    $priority = htmlspecialchars($_POST['priority']);

    $query = "INSERT INTO tugas set priority = '$priority',
    tugas = '$tugas',
    status = 'No Status'
    ";
    mysqli_query($conn, $query);
}
$result = mysqli_query($conn, "SELECT * FROM tugas");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TodoList</title>
</head>

<body>
    <h1>to Do List</h1>
    <form action="" method="post">
        <label>new to do : </label>
        <input type="text" name="tugas" required autocomplete="off">
        <select name="priority">
            <option value="High">High</option>
            <option value="Medium">Medium</option>
            <option value="Low">Low</option>
        </select>
        <button type="submit" name="submit">ADD</button>
    </form>

    <br>
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>No</th>
            <th>Priority</th>
            <th>Tugas</th>
            <th>Progress</th>
            <th>Aksi</th>
        </tr>
        <?php while ($data = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['priority']; ?></td>
                <td><?= $data['tugas']; ?></td>
                <td><?= $data['status']; ?></td>
                <td>
                    <a href="index.php?status=1&id=<?= $data['id']; ?>">Start</a> |
                    <a href="index.php?status=2&id=<?= $data['id']; ?>">Cancel</a> |
                    <a href="index.php?status=3&id=<?= $data['id']; ?>">Done</a> |
                    <a href="index.php?status=4&id=<?= $data['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endwhile ?>
        <?php mysqli_free_result($result); ?>
    </table>

</body>

</html>
<!-- <script>
    //menggunakan ajax (livesearch)
    // const container = document.getElementById('container');
    // const keyword = document.getElementById('keyword');
    // keyword.addEventListener('keyup', function() {
    //     const xhr = new XMLHttpRequest();
    //     xhr.onreadystatechange = function() {
    //         if (xhr.readyState == 4 && xhr.status == 200) {
    //             container.innerHTML = xhr.responseText;
    //         }
    //     }
    //     xhr.open('ajax/mahasiswa.php?keyword = ' + keyword.value(), true);
    //     xhr.send();
    // })

    //menggunakan jqurey (livesearch)
    $(document).ready(function() {
        $('#keyword').on('keyup', function() {
            //menggunakan load
            // $('#container').load('ajax/mahasiswa.php?keyword = ' + $('#keyword').val())

            //menggunakan get
            $.get('ajax/mahasiwa.php?keyword=' + $('#keyword').val(), function(data) {
                $('#container').html(data);
            })
        })


    });
</script> -->