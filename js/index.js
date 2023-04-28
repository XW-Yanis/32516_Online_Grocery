// To be called when DOM is ready
function initialize() {

  getData('services/getProducts.php', function (data) {
    const indices = getRandomIndices(data, 6);
    renderProducts(data, indices);
    setClick();
  });
  const viewAll = document.getElementById('view-all');
  viewAll.addEventListener('click', function () {
    getData('services/getProducts.php', function (data) {
      const products = document.getElementsByClassName('col-md-4');
      document.getElementById('the-heading').innerHTML = 'Our Products';
      while (products.length > 0) {
        products[0].parentNode.removeChild(products[0]);
      }

      renderProducts(data, Array.from(Array(data.length).keys()));
      setClick();
    });
  });
}
// Parse the data from the result of getProdcuts.php to JSON 
function getData(url, callback) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    const data = JSON.parse(xhttp.responseText);
    callback(data);
  }
  xhttp.open('get', url);
  xhttp.send();
}

// Display 6 products that are randomly chosed on index.php 
function renderProducts(data, indices) {
  const insertPosition = document.getElementById('latest-products');
  indices.forEach(index => {
    const product = data[index];
    const status = product.in_stock > 0 ? 'In stock' : 'Out of stock';
    const html = `
      <div class="col-md-4">
        <div class="product-item"  id="${product.product_id}">
          <a class="detail" href="#"><img class="animated-image" src="${product.img_url}" alt="${product.product_name}"></a>
          <div class="down-content">
            <a class="detail" href="#">
              <h4>${product.product_name + ' / ' + product.unit_quantity}</h4>
            </a>
            <h6>$${product.unit_price}</h6>
            <p class="ellipsis">${product.description}</p>
            <div class="status-addtocart">
              <h4 style="display: inline-block;" class="status">${status}</h4>
               ${product.in_stock > 0
        ? `<a style="display: inline-block;" href="#">
         <i class="fa-solid fa-cart-shopping fa-xs add-to-cart" style="color: #f2a154;">Add to Cart</i>
       </a>`
        : `<i class="fa-solid fa-cart-shopping fa-xs" style="color: #ccc;" disabled>Unavailable</i>`
      }
            </div>
          </div>
        </div>
      </div>
    `;
    insertPosition.insertAdjacentHTML("afterend", html);
  });

  // Make some animations for the images
  const images = document.querySelectorAll('img');
  images.forEach((image) => {
    image.addEventListener('load', () => {
      image.classList.add('loaded');
    });
  });
}

// Get number of num random indices
function getRandomIndices(data, num) {
  const indices = new Set();
  while (indices.size < num) {
    const index = Math.floor(Math.random() * data.length);
    indices.add(index);
  }
  return Array.from(indices);
}

// Set the click event for the add to cart buttons, the images, and the name of the product.
function setClick() {
  const addToCartBtns = Array.from(document.querySelectorAll('.add-to-cart'));
  const hyperlinks = Array.from(document.querySelectorAll('.detail'));

  addToCartBtns.forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      addToCart(e.target.closest('.product-item').id);
    });
  });

  hyperlinks.forEach(hyperlink => {
    hyperlink.addEventListener('click', function (e) {
      e.preventDefault();
      seeDetails(e.target.closest('.product-item').id);
    });
  })
}

function addToCart(product_id) {
  const cart = retrieveCartItemsFromCookie();
  const targetItem = cart.find(item => item.product_id === product_id);

  if (targetItem) {
    targetItem.quantity++;
  } else {
    cart.push({ product_id, quantity: 1 });
  }
  document.cookie = "cart=" + JSON.stringify(cart);
  alert("Product has added successfully.");
}
// Retrieve items from cookie, and if the cart is empty, return an empty array
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

function seeDetails(product_id) {
  window.location.href = `details.php?product_id=${product_id}`;
}