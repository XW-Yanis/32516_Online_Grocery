var data;
var grandTotal = 0;

function initialize() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    data = JSON.parse(this.responseText)
    renderCart(data);
  }
  xhttp.open("GET", "getCartProducts.php", true);
  xhttp.send();
  checkoutBtnAction();
}

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

function updateGrandTotal() {
  document.getElementById('grand-total').innerHTML = '$ ' + grandTotal.toFixed(2);;
};

function checkoutBtnAction() {
  const checkoutBtn = document.getElementById('checkoutBtn');
  checkoutBtn.addEventListener('click', function handleClick() {
    // advoid sending multiple emails
    checkoutBtn.removeEventListener('click', handleClick);

    const emailInfo = renderEmailContent();
    const emailAddress = emailInfo.emailAddress;
    const emailBody = emailInfo.body;
    const data = `email=${emailAddress}&body=${emailBody}`;
    const xhttp = new XMLHttpRequest();

    const url = "sendEmail.php";
    xhttp.open("POST", url, true);
    xhttp.onload = function () {
      console.log(xhttp.responseText);
      checkoutBtn.addEventListener('click', handleClick);
    };
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send(data);
  });
}



// Generate Email Content based on user input
function renderEmailContent() {
  const name = document.getElementById('firstName').value + " " + document.getElementById('lastName').value;
  const address = document.getElementById('address').value;
  const emailAddress = document.getElementById('email').value;
  const country = document.getElementById('country').value;
  const state = document.getElementById('state').value;
  const suburb = document.getElementById('suburb').value;
  const orderTime = new Date().toLocaleString();
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

  const emailBody = `Hi ${name},<br><br>Thank you for shopping at Daily Fresh! Below is your order details.<br><br>
    Order Time: ${orderTime}<br><br>
    Shipping Address: ${address}, ${suburb}, ${state}, ${country}<br><br>
    Your Order Items:<br>${itemsDetail}<br><br>
    Grand total: $ ${grandTotal.toFixed(2)}<br><br>`
  return { emailAddress: emailAddress, body: emailBody };
}