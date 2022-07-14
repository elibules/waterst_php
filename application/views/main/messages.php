<?php
if (empty($_SESSION['role']) || $_SESSION['role'] == '0') header("Location: " . site_url());
?>
<h1 class="pageHeader">User Messages</h1>
<div class="messages-content">
    <?php
    foreach ($messages as $key => $message) {
    ?>
    <div class="message">
        <h5>Name: <?= $message['name'] ?></h5>
        <h5>Email: <?= $message['email'] ?></h5>
        <h5>Timestamp: <?= date("M j, Y h:m:s a", strtotime($message['timestamp'])) ?></h5>
        <p><strong>Message: </strong><?= $message['message_body'] ?></p>
        <?php if ($key != count($messages) - 1) {
                echo '<hr>';
            } ?>
    </div>
    <?php
    }
    ?>
</div>