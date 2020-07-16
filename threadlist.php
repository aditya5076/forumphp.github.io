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
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id = $id";
    $result = mysqli_query($conn, $sql);
    while ($rows = mysqli_fetch_assoc($result)) {
        $cat = $rows['category_name'];
        $catdesc = $rows['category_description'];
    }
    ?>
    <?php
    $method = $_SERVER['REQUEST_METHOD'];
    $showAlert = false;
    if ($method == 'POST') {
        // insert in to thread db
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        $sql = "INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `tread_user_id`) VALUES ( '$th_title', '$th_desc', '$id', '0');";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show py-3" role="alert">
                <strong>Thanks!</strong> For sharing your concern.Will soon get you a solution.
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
            <h1 class="display-4">Welcome to <?php echo $cat; ?> forum</h1>
            <p class="lead"><?php echo $catdesc; ?></p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>
    <hr class="my-4">
    <!-- form here -->
    <div class="container">
        <h3 class="py-1 text-capitalize">Clear your doubts here..</h3>
        <form action="<?php echo $_SERVER['REQUEST_URI'];  ?>" method="POST">
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Problem title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                        else.</small> -->
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">elloborate your concern</label>
                    <textarea name="desc" id="desc" cols="30" rows="3" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>

        </form>
    </div>
    <hr class="my-4">
    <!-- no result jumbotoron here -->
    <div class="container my-4" style="min-height: 433px;">
        <h1>Browse Questions Here..</h1>
        <hr class="my-4">
        <?php $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id";
        $result = mysqli_query($conn, $sql);
        $noresult = true;
        while ($rows = mysqli_fetch_assoc($result)) {
            $noresult = false;
            $tid = $rows['thread_id'];
            $title = $rows['thread_title'];
            $desc = $rows['thread_desc'];


            echo '<div class="media my-4">
            <img src="users.png" width="60px" height="60px" class="mr-3" alt="...">
            <div class="media-body">
                <h5 class="mt-0"><a class="text-dark" href="thread.php?threadid=' . $tid . '">' . $title . '</a></h5>
               ' . $desc . '
            </div>
        </div>';
        }
        if ($noresult) {
            echo '<div class="jumbotron jumbotron-fluid my-4">
  <div class="container">
    <h1 class="display-4 text-capitalize">No threads found</h1>
            <hr class="my-4">
    <p class="lead text-capitalize">be the first to ask the questions and be ready! for answers.</p>
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
