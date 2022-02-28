<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/cms/">Home</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                $query = "SELECT * FROM categories";
                $select_all_categories = mysqli_query($connection, $query) or die("Query Failed");

                while ($category = mysqli_fetch_assoc($select_all_categories)) {
                    echo "<li><a href='search.php?topic={$category['cat_title']}'>{$category['cat_title']}</a></li>";
                }

                if (isset($_SESSION['role'])) {
                    if (strcmp($_SESSION['role'], "Admin")  == 0) {
                        echo "<li><a href='/cms/admin'>Admin</a></li>";
                    }
                }
                ?>

            </ul>
            <div id="google_translate_element"></div>

            <script type="text/javascript">
                function googleTranslateElementInit() {
                    new google.translate.TranslateElement({
                        pageLanguage: 'en'
                    }, 'google_translate_element');
                }
            </script>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>