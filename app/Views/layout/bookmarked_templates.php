<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/font-awesome/css/all.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/playlist.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</head>

<body>
    <?= $this->include("layout/navbar.php"); ?>

    <?= $this->renderSection("content"); ?>

    <script src="<?= base_url() ?>/assets/bootstrap/js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <script>
        function toggleScroll() {
            document.getElementById("content-list").classList.toggle("scroll-active");
        };

        function delete_bookmark(id) {
            var csrfName = $("#protection_token").attr("name");
            var csrfHash = $("#protection_token").val();

            $.ajax({
                url: "<?= base_url() ?>/delete-bookmark/" + id,
                method: "post",
                data: { [csrfName]: csrfHash },
                dataType: "json",
                success: function(response) {
                    $("#protection_token").val(response.token);

                    if (response.success) {
                        const el = document.getElementById("book-" + id);
                        el.style.transition = "opacity 0.2s ease";
                        el.style.opacity = 0;
                        setTimeout(function() {
                            el.parentNode.removeChild(el);
                        }, 200);
                    }
                    else {
                        alert("Delete from bookmarked failed");
                    }
                }
            });
        }
    </script>

</body>

</html>