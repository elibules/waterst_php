<div onclick="history.back()" class="goBack">Go Back</div>
<div class="detailContent">
    <div class="detailImg"><img src="<?= $product['image'] ?>" alt=""></div>
    <div class="detailContent-text">
        <h1><?= $product['title'] ?> - <?= $product['artist'] ?></h1>
        <p>Release Date: <?= date("M d, Y", strtotime($product['release_date'])) ?></p>
        <p>Genre: <?= $product['category_name'] ?></p>
        <p>Format: <?= $product['format_name'] ?></p>
        <p>Condition: <?= $product['quality_name'] ?></p>
        <p class="detailPrice">$<?= $product['price'] ?></p>
        <button class="addToCart goToButton" onclick="addToCart(<?= $product['item_id'] ?>)">Add to Cart</button>
    </div>
</div>