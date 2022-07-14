<h1 class="pageHeader">Your profile, <?= $this->session->full_name ?></h1>
<div class="profileWrapper">
    <div class="profileButtons"><a class="goToButton" href="<?= site_url() ?>/auth/logout">Logout</a>
        <a class="goToButton" href="<?= site_url() ?>/auth/reset">Reset your password</a>
    </div>
    <details title="Orders" id="ordersDetails">
        <summary>
            Orders
        </summary>
        <?php
        if (!empty($orders)) {
            foreach ($orders as $key => $order) {
                $orderObject = json_decode($order["order_info"]);
        ?>
        <p style="margin-bottom: 5px;">
            Date: <?= date("F j, Y, g:i a", strtotime($order["date"])) ?> <br>
            # of Items: <?= count($orders) ?> <br>
            <?php
                    foreach ($orderObject->purchase_units[0]->items as $key => $item) {
                        if ($key != 0) {
                            echo '<span> / </span>';
                        }
                        echo '<span>' . $item->name . '</span>';
                    }
                    ?>
        </p>
        Total: $<?= $orderObject->purchase_units[0]->amount->value ?> <br>

        <?php
                if ($key != count($orders) - 1) echo '<hr>';
            }
        } else {
            ?>
        <p>You have no orders</p>
        <?php
        }
        ?>

    </details>
</div>