<h1 class="pageHeader"><?= $message ?></h1>
<script>
let sessionStatus = <?= isset($status) ? "1" : "0" ?> + 1;
if (sessionStatus == 2) {
    document.getElementById("profileLink").remove()
    document.getElementById("loginProfileLinks").innerHTML =
        '<a href="<?= site_url() ?>/auth" id="loginLink">Login</a>';
}
</script>