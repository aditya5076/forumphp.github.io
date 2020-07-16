<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <?php include 'partials/_navbar.php'; ?>
    <?php include 'partials/db_connect.php'; ?>
    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
    $result = mysqli_query($conn, $sql);
    while ($rows = mysqli_fetch_assoc($result)) {
        $title = $rows['thread_title'];
        $desc = $rows['thread_desc'];
    }
    ?>
    <?php
    $method = $_SERVER['REQUEST_METHOD'];
    $showAlert = false;
    if ($method == 'POST') {
        // insert in to thread db
        // $th_title = $_POST['title'];
        $comment = $_POST['comment'];
        $sql = "INSERT INTO `comments` (`comment_id`, `comment_content`, `thread_id`, `cmt_time`) VALUES (NULL, '$comment', '$id', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show py-3" role="alert">
                <strong>Thanks!</strong> your comment has been added successfully
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>';
        }
    }
    ?>

    <!-- category starts here -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title; ?></h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>
    <div class="container">
        <h3 class="py-1 text-capitalize">post comments</h3>
        <form action="<?php echo $_SERVER['REQUEST_URI'];  ?>" method="POST">
            <div class="modal-body">

                <div class="form-group">
                    <label for="exampleInputPassword1">mention your comments here..</label>
                    <textarea name="comment" id="comment" cols="30" rows="3" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Post Comments</button>
            </div>

        </form>
    </div>
    <div class="container my-4" style="min-height: 433px;">
        <h1>Discussions</h1>
        <hr class="my-4">
        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id = $id";
        $result = mysqli_query($conn, $sql);
        while ($rows = mysqli_fetch_assoc($result)) {
            $id = $rows['comment_id'];
            $content = $rows['comment_content'];
            $time = $rows['cmt_time'];



            echo '<div class="media my-3">
            <img src="users.png" width="60px" height="70px" class="mr-3" alt="...">
            <div class="media-body">
            <b class="text-weight-bold">anonynymus user</b> at ' . $time . '</br>
               ' . $content . '
            </div>
        </div>';
        }
        ?>
        <!-- <div class="media my-4">
            <img src="users.png" width="60px" height="70px" class="mr-3" alt="...">
            <div class="media-body">
                <h5 class="mt-0">Media heading</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus
                odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate
                fringilla. Donec lacinia congue felis in faucibus.
            </div>
        </div> -->
        <!-- <div class="media my-4">
            <img src="users.png" width="60px" height="70px" class="mr-3" alt="...">
            <div class="media-body">
                <h5 class="mt-0">Media heading</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus
                odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate
                fringilla. Donec lacinia congue felis in faucibus.
            </div>
        </div> -->
    </div>
    <?php include 'partials/footer.php'; ?>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
<script src="bootstrap.min.js"></script>

</html>
