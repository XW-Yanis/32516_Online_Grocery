
var data;
var product_id;
// Call getProductDetails.php to fetch data, and render the page with the data
function initialize() {
  xhttp = new XMLHttpRequest();
  const url = new URL(window.location.href);

  // get product_id
  const searchParams = new URLSearchParams(url.search);
  product_id = searchParams.get('product_id');

  xhttp.onload = function () {
    data = JSON.parse(this.response);
    renderProductDetails(data);
    setClick();
  }
  xhttp.open("get", `services/getProductDetails.php?product_id=${product_id}`, true);
  xhttp.send();
}
// Render Product Details
function renderProductDetails(data) {
  const insertPosition = document.getElementById('insertPosition');
  let html = `<div class="col-xl-5 col-lg-5 col-md-6">
          <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active"> <img class="d-block w-100" src="${data['img_url']}" 
              alt="${data['product_name'] + data['unit_quantity']}">
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-7 col-lg-7 col-md-6">
          <div class="single-product-details">
            <h2>${data.product_name + ' / ' + data.unit_quantity}</h2>
            <h5> $ ${data.unit_price}</h5>
            <p>
            <h4>Short Description:</h4>
            <p class="description">${data.description}</p>
            <div class="form-group quantity-box">
              <label class="control-label">Quantity</label>
              <input id="quantity" class="form-control" value="1" min="1" max="20" type="number">
              <div class="cart-and-bay-btn">
                <a class="btn hvr-hover" onclick="detailAddToCart();" id="add-to-cart" data-fancybox-close="" href="#">Add to cart</a>
              </div>
            </div>

          </div>
        </div>`;
  insertPosition.insertAdjacentHTML("afterbegin", html);
}

function addToCart(product_id) {
  const cart = retrieveCartItemsFromCookie();
  const targetItem = cart.find(item => item.product_id === product_id);
  const quantityInput = document.getElementById('quantity');
  let quantity;

  quantity = quantityInput.value;
  if (targetItem) {
    targetItem.quantity += parseInt(quantity);;
  } else {
    cart.push({ product_id, quantity: parseInt(quantity) });
  }
  document.cookie = "cart=" + JSON.stringify(cart);
  alert("Product has been added successfully.");
}

function setClick() {
  const btn = document.getElementById('add-to-cart');
  btn.addEventListener('click', (e) => {
    e.preventDefault();
    addToCart(product_id);
  })
}

// Retrieve items from cookie
function retrieveCartItemsFromCookie() {
  const cookies = Object.fromEntries(document.cookie.split('; ').map(c => {
    const [key, value] = c.split('=');
    if (key === 'cart') {
      return [key, JSON.parse(value)];
    }
    return [key, value];
  }));
  return cookies['cart'] || []; // return empty array if cart is undefined
}