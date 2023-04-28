var data;

function initialize() {

  const xhttp = new XMLHttpRequest();

  xhttp.onload = function () {
    data = JSON.parse(this.responseText);
    if (data.length > 0) {
      renderCart(data);
    }
    updateCheckout();
  }
  xhttp.open("GET", "services/getCartProducts.php", true);
  xhttp.send();
}

function renderCart(data) {
  const insertPosition = document.getElementById('insert-position');

  data.forEach(product => {
    const html = `<tr id="${product['product_id']}">
    <td class="thumbnail-img">
      <a href="#">
        <img class="img-fluid" src="${product['img_url']}" alt="${product['product_name']}" />
      </a>
    </td>
    <td class="name-pr">
      <a href="#">
        ${product.product_name + ' / ' + product.unit_quantity}
      </a>
    </td>
    <td class="price-pr">
      <p>$ ${product['unit_price']}</p>
    </td>
    <td class="quantity-box"><input type="number" size="4" value="${product['quantity']}" min="1" max="20" step="1"
      class="c-input-text qty text"></td>
    <td class="total-pr">
      <p>$ ${(product['unit_price'] * product['quantity']).toFixed(2)}</p>
    </td>
    <td class="remove-pr">
      <a href="#">
        <i class="fas fa-times"></i>
      </a>
    </td>
  </tr>`;
    insertPosition.insertAdjacentHTML("afterbegin", html);
  });
  setListeners();
  calculateGrandTotal();
}

// Set the total price of each item change based on the quantity, also change the quantity in cookie
function setListeners() {
  const quantityInputs = document.querySelectorAll('.qty');
  quantityInputs.forEach(quantityInput => {
    quantityInput.addEventListener('input', () => {
      const quantity = parseInt(quantityInput.value);
      const unitPrice = parseFloat(quantityInput.closest('tr').querySelector('.price-pr p').textContent.slice(2));
      const totalPrice = unitPrice * quantity;
      quantityInput.closest('tr').querySelector('.total-pr').textContent = '$' + totalPrice.toFixed(2);;
      quantityInput.closest('tr').querySelector('.total-pr').classList.add('updated');
    })
    quantityInput.addEventListener('change', () => {
      const quantity = parseInt(quantityInput.value);
      const row = quantityInput.closest('tr');
      const product_id = row.id;
      updateCartItem(product_id, quantity);
    });
  });

  // Set the remove buttons
  const removeBtns = document.querySelectorAll('.remove-pr a');
  removeBtns.forEach(button => {
    button.addEventListener('click', (event) => {
      event.preventDefault();
      const row = button.closest('tr');
      removeFromCart(row.id);
      button.closest('tr').remove();
      calculateGrandTotal();
    });
  });
}

// Update the quantity of an item in the cart
function updateCartItem(product_id, quantity) {
  const cartItems = retrieveCartItemsFromCookie();
  cartItems.forEach(item => {
    if (item.product_id === product_id) {
      item.quantity = quantity;
    }
  });
  document.cookie = "cart=" + JSON.stringify(cartItems);
  calculateGrandTotal();
}

// Delet Item from cookie and update the cookie
function removeFromCart(product_id) {
  const cartItems = retrieveCartItemsFromCookie();
  const updatedCartItems = cartItems.filter(item => item.product_id !== product_id);
  document.cookie = 'cart=' + JSON.stringify(updatedCartItems);
  updateCheckout();
}
// Empyt the cart by removing all table rows and reset the cookie to empty
function emptyCart() {
  const updatedCartItems = [];
  document.cookie = 'cart=' + JSON.stringify(updatedCartItems);
  const rows = document.querySelectorAll('tbody tr');
  rows.forEach(row => {
    row.remove();
  });;
  calculateGrandTotal();
  updateCheckout();
}

// Calculate the total price of the cart
function calculateGrandTotal() {
  const grandTotalElement = document.getElementById('grand-total');
  grandTotalElement.innerHTML = '$ 0';
  const rows = document.querySelectorAll('tbody tr');
  if (rows.length > 0) {
    let grandTotal = 0;
    rows.forEach(row => {
      const quantity = parseInt(row.querySelector('.qty').value);
      const unitPrice = parseFloat(row.querySelector('.price-pr p').textContent.slice(2));
      const totalPrice = unitPrice * quantity;
      grandTotal += totalPrice;
    });
    grandTotalElement.innerHTML = '$ ' + grandTotal.toFixed(2);
  }
}

// Check if the cart contains any items, if not, disable the checkout button
function updateCheckout() {
  const checkoutButton = document.getElementById('checkout');
  const cartItems = retrieveCartItemsFromCookie();
  if (cartItems && cartItems.length > 0) {
    checkoutButton.classList.remove('disabled-link');
    checkoutButton.removeAttribute('disabled');
  } else {
    checkoutButton.classList.add('disabled-link');
    checkoutButton.setAttribute('disabled', true);
  }
}

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