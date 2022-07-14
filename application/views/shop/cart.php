<h1 class="pageHeader" id="cartHeader">Your Cart</h1>
<div class="cartWrapper">
    <div id="cartContent"></div>
    <div class="checkoutContent" id="checkoutContent">
        <div class="totalPriceDiv">Total Price: $<span id="totalPrice">0</span></div>
        <div id="paypal-button-container"></div>
        <div id="cartModal" style="display: none;" onclick="closeModal()">
            <div class="cartModal-content">
                <h3>Do you want to login or make an account?</h3>
                <a href="<?= site_url() ?>/auth">Yes</a>
                <a href="#" onclick="closeModal()">Continue as Guest</a>
            </div>
        </div>

        <script>
        displayCart(<?= isset($_SESSION["user_id"]) ? "1" : "0" ?>)
        </script>
        <div id="resetCart" onclick="reset()">Empty Cart</div>
    </div>
</div>