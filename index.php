<?php

//import file php
require './lib/JSONReader.php';
require './lib/searchFunctions.php';
$taskList = JSONReader('./dataset/TaskList.json');


if (isset($_GET['searchText'])) {
    $searchText = trim(filter_var($_GET['searchText'], FILTER_SANITIZE_STRING));
    $taskList = array_filter($taskList, searchText($searchText));
}

if ((isset($_GET['status']))) {
    $status = $_GET['status'];
    $taskList = array_filter($taskList, searchStatus($status));
}

// if (isset($_GET['expireDate']) && trim($_GET['expireDate']) !== '') {
//     $expire = $_GET['expireDate'];
//     $taskList = array_filter($taskList, searchDate($expire));
// }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Taklist</title>
</head>

<body>

    <div class="container-fluid bg-secondary py-3 mb-3 text-light">
        <div class="container">
            <h1 class="display-1">Tasklist</h1>
        </div>
    </div>
    <form action="./index.php">
        <div class="container">
            <div class="input-group pb-3 my-1">
                <label class="w-100 pb-1 fw-bold" for="searchText">Cerca</label>
                <input id="searchText" name="searchText" value="<?php if (isset($searchText)) {
                                                                    echo $searchText;
                                                                } else {
                                                                    echo "";
                                                                }; ?>" type="text" class="form-control" placeholder="attività da cercare">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Invia</button>
                </div>
            </div>

            <div id="status" class=" mb-3">
                <div class="fw-bold pe-2 w-100">Stato attività</div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="all" id="all" <?php if (isset($_GET['status']) && $_GET['status'] == 'all') {
                                                                                                        echo "checked";
                                                                                                    }; ?>>
                    <label class="form-check-label" for="all">Tutti</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="todo" id="todo" <?php if (isset($_GET['status']) && $_GET['status'] == 'todo') {
                                                                                                            echo "checked";
                                                                                                        }; ?>>
                    <label class="form-check-label" for="todo">Da fare</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="progress" id="progress" <?php if (isset($_GET['status']) && $_GET['status'] == 'progress') {
                                                                                                                    echo "checked";
                                                                                                                }; ?>>
                    <label class="form-check-label" for="progress">In corso</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="done" id="done" <?php if (isset($_GET['status']) && $_GET['status'] == 'done') {
                                                                                                            echo "checked";
                                                                                                        }; ?>>
                    <label class="form-check-label" for="done">Fatto</label>
                </div>
            </div>

            <section class="tasklist mt-3">
                <h1 class="fw-bold fs-6">Elenco delle attività</h1>
                <table class="table">
                    <tr>
                        <th class="w-100">nome</th>
                        <th class="text-center">stato</th>
                        <th class="text-center">data</th>
                    </tr>
                    <?php foreach ($taskList as $task) {
                        $taskName = $task['taskName'];
                        $status = $task['status'];
                        $expireDate = $task['expirationDate'];
                    ?>
                        <tr>
                            <td><?= $taskName ?></td>
                            <td class="text-center">
                                <span class="badge bg-<?php echo getColor($status); ?> text-uppercase"><?= $status ?></span>
                            </td>
                            <td class="text-nowrap">
                                <?= $expireDate ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <!-- <tr>
                        <td>Comprare la farina</td>
                        <td class="text-center">
                            <span class="badge bg-secondary text-uppercase">done</span>
                        </td>
                        <td class="text-nowrap">
                            20 Settembre
                        </td>
                    </tr>
                    <tr>
                        <td>Comprare la farina</td>
                        <td class="text-center">
                            <span class="badge bg-primary text-uppercase">progress</span>
                        </td>
                        <td class="text-nowrap">
                            18 Settembre
                        </td>
                    </tr> -->

                </table>

            </section>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>