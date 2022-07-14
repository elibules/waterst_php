window.onload = () => {
  if (!localStorage.getItem("cart")) {
    localStorage.setItem("cart", '{"cart": []}');
    localStorage.setItem("cartNumber", "0");
    localStorage.setItem("cartTotal", "0");
  }
  document.getElementById("cartNumber").innerHTML =
    localStorage.getItem("cartNumber");
};

function displayCart(status) {
  if (status == 0 && !sessionStorage.getItem("clickedModal")) {
    displayModal();
  }
  displayPaypal();
  let cart = JSON.parse(localStorage.getItem("cart"));
  if (Number(localStorage.getItem("cartNumber") == 0)) {
    document.getElementById(
      "cartContent"
    ).innerHTML = `<h2>You don't have any items in your cart.</h2>`;
  }

  let total = 0;

  for (let i = 0; i < cart.cart.length; i++) {
    let item = cart.cart[i];
    total += Number(item.price);
    localStorage.setItem("cartTotal", String(total));
    document.getElementById("cartContent").innerHTML +=
      `<div class="cartItem" id="cartItem${i}"><img src="${item.image}"><div class="cartItem-right"><p class="itemTitle">${item.title} - ${item.artist}<span class="removeCartItem" onclick="removeItem(${i}, ` +
      "`" +
      item.title +
      "`" +
      `)">X</span></p><p class="itemCondition">${item.quality_name} Condition</p><p>$${item.price}</p></div></div>`;
  }
  document.getElementById("totalPrice").innerHTML = String(total.toFixed(2));
}

function addToCart(id) {
  let xhr = new XMLHttpRequest();
  let cart = JSON.parse(localStorage.getItem("cart"));
  let cartNumber = Number(localStorage.getItem("cartNumber"));

  xhr.open(
    "GET",
    "http://localhost/n413/n413_site_bules/index.php/shop/cartItem/" +
    id,
    true
  );

  xhr.onload = () => {
    cart.cart.push(JSON.parse(xhr.responseText));
    console.log(cart);
    localStorage.setItem("cart", JSON.stringify(cart));

    cartNumber++;
    localStorage.setItem("cartNumber", String(cartNumber));
    document.getElementById("cartNumber").innerHTML = String(cartNumber);
  };

  xhr.send(null);
}

function removeItem(id, title) {
  let cart = JSON.parse(localStorage.getItem("cart"));
  localStorage.setItem(
    "cartNumber",
    String(Number(localStorage.getItem("cartNumber")) - 1)
  );

  document.getElementById("cartNumber").innerHTML =
    localStorage.getItem("cartNumber");

  let total = 0;

  for (let i = 0; i < cart.cart.length; i++) {
    total += Number(cart.cart[i].price);
  }

  for (let i = 0; i < cart.cart.length; i++) {
    if (cart.cart[i].title == title) {
      total -= Number(cart.cart[i].price);
      localStorage.setItem("cartTotal", String(total));
      cart.cart.splice(i, 1);
      break;
    }
  }

  console.log(cart);
  localStorage.setItem("cart", JSON.stringify(cart));
  document.getElementById("cartItem" + String(id)).remove();
  document.getElementById("totalPrice").innerHTML = String(total.toFixed(2));
  if (Number(localStorage.getItem("cartNumber") == 0)) {
    document.getElementById(
      "cartContent"
    ).innerHTML = `<h2>You don't have any items in your cart.</h2>`;
  }
  displayPaypal();
}

function reset() {
  localStorage.removeItem("cart");
  localStorage.removeItem("cartNumber");
  localStorage.removeItem("cartTotal");
  document.getElementById("cartNumber").innerHTML = "0";
  document.getElementById("totalPrice").innerHTML = "0";
  document.getElementById(
    "cartContent"
  ).innerHTML = `<h2>You don't have any items in your cart.</h2>`;
}

function displayPaypal() {
  document.getElementById("paypal-button-container").innerHTML = "";
  let items = JSON.parse(localStorage.getItem("cart")).cart;
  let itemsArray = [];
  for (let i = 0; i < items.length; i++) {
    itemsArray.push({
      name: items[i].title,
      unit_amount: {
        currency_code: "USD",
        value: String(items[i].price),
      },
      quantity: "1",
    });
  }
  paypal
    .Buttons({
      // Sets up the transaction when a payment button is clicked
      createOrder: function (data, actions) {
        return actions.order.create({
          purchase_units: [
            {
              amount: {
                currency_code: "USD",
                value: String(
                  Number(localStorage.getItem("cartTotal")).toFixed(2)
                ),
                breakdown: {
                  item_total: {
                    currency_code: "USD",
                    value: String(
                      Number(localStorage.getItem("cartTotal")).toFixed(2)
                    ),
                  },
                },
              },
              items: itemsArray,
            },
          ],
        });
      },

      // Finalize the transaction after payer approval
      onApprove: function (data, actions) {
        return actions.order.capture().then(function (orderData) {
          console.log(
            "Capture result",
            orderData,
            JSON.stringify(orderData, null, 2)
          );

          let xhr = new XMLHttpRequest();
          xhr.open(
            "POST",
            "https://localhost/n413/n413_site_bules/index.php/shop/checkout",
            true
          );
          xhr.setRequestHeader("Content-type", "application/json");
          xhr.send(JSON.stringify(orderData, null, 2));

          reset();

          document.getElementById("cartHeader").innerHTML =
            "Thank you for your order!";
          document.getElementById("checkoutContent").innerHTML =
            '<a href="https://localhost/n413/n413_site_bules/index.php/shop" class="goToButton">Continue Shopping</a>';
        });
      },
    })
    .render("#paypal-button-container");
}

function closeModal() {
  document.getElementById("cartModal").style.display = "none";
  sessionStorage.setItem("clickedModal", "1");
  return true;
}

function displayModal() {
  document.getElementById("cartModal").style.display = "flex";
}
