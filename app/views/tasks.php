<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
    <?php if (! isset($_SESSION['is_authorized'])) {
        echo '<a href="/login">Login</a>';
    } ?>

    <div class="form-group">
        <h1>To-Do <small>List</small></h1>
        <form method="POST">
            <input type="text" class="form-control" placeholder="Your Name" name="username" required>
            <input type="text" class="form-control" placeholder="Your Email" name="email" required>
            <input type="text" class="form-control" placeholder="Text of the task" name="content" required>
            <input type="submit" class="btn btn btn-primary">
        </form>
    </div>
    <label>
        Sort by:
        <select onchange="sort_by(this)">
            <option selected></option>
            <option value="status">Status</option>
            <option value="email">Email</option>
            <option value="username">Username</option>
        </select>
        <input type="submit" value="sort">
    </label>
    <div style="width: 1000px; margin: auto;">
    <?php foreach ($tasks as $val): ?>
        <?php if (isset($_SESSION['user'])) echo '<form method="POST" action="/update" style="width: 18rem; display: inline-block">'  ?>
    <div class="card" style="width: 18rem; display: inline-block">
        <div class="card-body">
            <h5 class="card-title"><b>Content</b></h5>
            <p class="card-text"><?php if (isset($_SESSION['user'])) {
                    echo '<input type="text" name="content" value="'.$val['content'].'">';
                } else {
                    echo $val["content"];
                }?></p>
        </div>
        <ul class="list-group list-group-flush">
            <input type="hidden" name="id" value="<?php echo $val["id"]; ?>">
            <li class="list-group-item"><b>ID:</b><?php echo $val["id"]; ?></li>
            <li class="list-group-item"><b>Username:</b><?php echo $val["username"]; ?></li>
            <li class="list-group-item"><b>Email:</b><?php echo $val["email"]; ?></li>
            <li class="list-group-item"><b>Status:</b><?php if (isset($_SESSION['user'])) {
                    echo '<input type="checkbox" name="status"';
                    echo $val["status"] == true ? 'checked>' :'>';
                } else {
                    echo $val["status"] ? "DONE" : "NOT DONE";
                }?></li>
        </ul>
        <div class="card-body">
            <?php if (isset($_SESSION['user'])) echo '<input type="submit">' ?>
        </div>
    </div>
        <?php if (isset($_SESSION['user'])) echo '</form>'  ?>
    <?php endforeach;  ?>
    </div>

    <hr>
    <div style="margin-left: 500px;">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <?php echo "<a href='?page=$i'>$i</a>" ?>
        <?php endfor; ?>
    </div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script>
    function sort_by($target) {
        let sort_form = $target.options[$target.selectedIndex].value;
        let url = new URL(window.location.href);
        let params = new URLSearchParams(url.search);
        let page = params.get('page');
        let uri = '/?'+sort_form+"=asc";
        if (page) uri+="&page="+page;

        console.log(uri);
        debugger
        window.location.replace(uri);
    }
</script>
</body>
</html>