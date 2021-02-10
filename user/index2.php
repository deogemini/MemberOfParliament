<?php include 'layouts/main.php'; ?>

<?php
session_start();
if (isset($_SESSION["firstname"])) {
    echo '<p>Login Success, Welcome.. ' . $_SESSION["firstname"] . '</p>';
} else {
    header("location:login.php");
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <?php
            include 'db.php';
            if (isset($_SESSION["firstname"])) {
                $firstname = $_SESSION["firstname"];
                $sql = "SELECT jimbo FROM users WHERE firstname = '$firstname'";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(["firstname" => $firstname]);
                while ($row = $stmt->fetch())
                    echo '<h1> <b>Karibu Jimbo la .... </b><span style="text-transform:uppercase"> <b>' . $row->jimbo . "</span></b></h1>";
            }
            ?>
        </div>
        <div class="col-md-2">
            <form action="logout.php" method="POST">
                <button type="submit" class="btn btn-danger" name="logout">Logout here</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4" style="background-color: #bddacc;;">
            <div class="wrapper">
                <h4><strong>Post your Compliment here</strong></h4>
                <form action="posting.php" method="POST">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" class="form-control" id="category" class="js-example-basic-single form-control" required>
                            <option value="maji">Maji</option>
                            <option value="ardhi">Ardhi</option>
                            <option value="kilimo">Kilimo</option>
                            <option value="afya">Afya</option>
                            <option value="elimu">Elimu</option>
                            <option value="biashara">Biashara</option>
                            <option value="miundombinu">miundombinu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="body">Description</label>
                        <textarea type="text" class="form-control" name="body" placeholder="write full decsription here" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-info" name="submit">Post your Comment</button>
                </form>
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-7">
            <marquee>
                <h2 style="background-color:#b4dabf;"><b>Latest comments from other citizens</b></h3>
            </marquee>
            <div class="wrapper">
                <?php
                include('db.php');
                $stmt = $pdo->query('SELECT * FROM post');
                while ($row = $stmt->fetch()) {
                    $title = $row->title;
                    $category = $row->category;
                    $body = $row->body; ?>

                    <div class="card_item border rounded" style="background-color: #a4c3f5;">
                        <div class="card_inner">
                            <div class="card_top">
                                <?php echo '<h4 style="text-align: center"> <b>' . $title;
                                '</b> </h4>'  ?>
                            </div>
                            <div class="card_bottom">
                                <div class="card_category">
                                    <?php echo '<h3><span>' . $category;
                                    '</span></h3>' ?>
                                </div>
                                <div class="card_info">
                                    <p><?php echo '<p style="text-align:center">' . $body;
                                        '</p>' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>


                <?php } ?>

            </div>

        </div>
    </div>
</div>

<?php include 'layouts/common_base.php'; ?>