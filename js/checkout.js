var data;
var grandTotal = 0;

function initialize() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    data = JSON.parse(this.responseText)
    renderCart(data);
  }
  xhttp.open("GET", "services/getCartProducts.php", true);
  xhttp.send();
  checkoutBtnAction();
}
// SHow a list of the products in the cart
function renderCart(data) {
  const insertPosition = document.getElementById('insert-position');
  data.forEach(product => {
    const html = `<div class="rounded p-2 bg-light">
                <div class="media mb-2">
                  <div class="media-body"> <a href="#">${product.product_name + ' / ' + product.unit_quantity}</a>
                    <div class="small text-muted">Price: $ ${product.unit_price} <span class="mx-2">|</span> Qty:
                      ${product.quantity} 
                      <span class="mx-2">|</span> Subtotal: $ ${(product['unit_price'] * product['quantity']).toFixed(2)}</div>
                  </div>
                </div>
              </div>`;
    insertPosition.insertAdjacentHTML("afterend", html);
    grandTotal += product['unit_price'] * product['quantity'];
  });
  updateGrandTotal();
}
// REtrieve the cart items from cookie and parse them into an array
function retrieveCartItemsFromCookie() {
  const cookies = Object.fromEntries(document.cookie.split('; ').map(c => {
    const [key, value] = c.split('=');
    if (key === 'cart') {
      return [key, JSON.parse(value)];
    }
    return [key, value];
  }));
  const cartItems = cookies['cart'];
  return cartItems;
}
// Set up the grand total
function updateGrandTotal() {
  document.getElementById('grand-total').innerHTML = '$ ' + grandTotal.toFixed(2);;
};

// submit the data to the server
function checkoutBtnAction() {
  const checkoutBtn = document.getElementById('checkoutBtn');
  checkoutBtn.addEventListener('click', function (event) {
    event.preventDefault();
    if (validateForm() && validateEmail()) {
      renderEmailContent();
      document.querySelector('.needs-validation').submit();
    }
    else { alert("Please enter all fields") }
  })

}

// Generate Email Content of items and grand total
function renderEmailContent() {

  var items = [];
  data.forEach(product => {
    items.push({
      product_name: product.product_name + " / " + product.unit_quantity,
      quantity: product.quantity,
      sub_total: product['unit_price'] * product['quantity']
    });
  });
  var itemsDetail = "";
  items.forEach(item => {
    itemsDetail += item.product_name + " x " + item.quantity + " = $ " + item.sub_total.toFixed(2) + "<br>";
  });
  document.getElementById('items-detail-text').value = itemsDetail;
  document.getElementById('grand-total-text').value = grandTotal.toFixed(2);
}


// Validate the form. False will be returned if there is any empyt field 
function validateForm() {
  var elements = document.querySelectorAll('.needs-validation input[required], .needs-validation textarea[required], .needs-validation select[required]');
  var isValid = true;

  for (var i = 0; i < elements.length; i++) {
    if (elements[i].value.trim() === '' || elements[i].value === elements[i].getAttribute('placeholder')) {
      elements[i].classList.add('is-invalid');
      isValid = false;
    } else {
      elements[i].classList.remove('is-invalid');
    }
  }
  return isValid;
}

// Check if email is valid
// The email should contain one or more letters, numbers, dots, dashes, underscores, percent, plus and minus,
// followed by a @, and then one or more small characters, numbers, dot and minus, followed by a dot, 
// and then 2 or more small characters.
function validateEmail() {
  var emailInput = document.getElementById("email");
  var emailValue = emailInput.value.trim();
  var pattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
  if (pattern.test(emailValue)) {
    emailInput.classList.remove("is-invalid");
    return true;
  } else {
    emailInput.classList.add("is-invalid");
    return false;
  }
}

