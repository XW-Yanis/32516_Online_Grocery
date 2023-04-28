
var data;

$(document).ready(function () {
  $('select').niceSelect();
});

function headerInitialize() {
  setClick();
}
// Set the behaviour of the search button
function searchBtnOnClick() {
  const form = document.getElementById('search-form');
  const searchBtn = document.getElementById('search');
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    searchBtn.disabled = true;

    var param = [];
    // Replace all commas and space with a space
    const searchField = document.getElementById('product-name').value.replace(/,|\s/g, ' ');

    const price = document.getElementById('floatingSelect').value;
    if (searchField != '' && price === 'Cancel') {
      param.push({
        productNames: searchField
      });
    } else if (price != 'Cancel' && searchField == '') {
      param.push({ price: price });
    } else {
      alert("Please use either product name or price to search.");
      searchBtn.disabled = false;
      return;
    }
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
      data = JSON.parse(xhttp.responseText);
      document.getElementById('the-heading').innerHTML = 'Search Results ' + data.length + ' in total';
      const products = document.getElementsByClassName('col-md-4');
      while (products.length > 0) {
        products[0].parentNode.removeChild(products[0]);
      }
      renderProducts(data, Array.from(Array(data.length).keys()));
      searchBtn.disabled = false;
    };
    xhttp.open('post', 'services/getSearchProducts.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send('param=' + encodeURIComponent(JSON.stringify(param)));
  });
}

function setClick() {
  const dropdownItems = document.querySelectorAll('.dropdown-item');
  dropdownItems.forEach(function (dropdownItem) {
    dropdownItem.addEventListener('click', function (e) {
      e.preventDefault();
      const mainCategory = e.target.closest('.dropdown').querySelector('.dropdown-toggle').getAttribute('id').replace('-', ' ');
      const subCategory = this.id.replace('-', ' ');
      clickEvent(mainCategory, subCategory);
    });
  });
}

function clickEvent(mainCategory, subCategory) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    const products = document.getElementsByClassName('col-md-4');

    while (products.length > 0) {
      products[0].parentNode.removeChild(products[0]);
    }
    data = JSON.parse(xhttp.responseText);
    document.getElementById('the-heading').innerHTML = data[0].category + ' ' + data[0].sub_category + ' ' +
      + data.length + ' products in total';

    renderSubcategories(data, Array.from(Array(data.length).keys()));
  };

  xhttp.open('get', `services/getNumberOfProducts.php?main_category=${mainCategory}&sub_category=${subCategory}`, true);
  xhttp.send();
}

function renderSubcategories(data, indices) {
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
    // Make some animations for the images
    const images = document.querySelectorAll('img');
    images.forEach((image) => {
      image.addEventListener('load', () => {
        image.classList.add('loaded');
      });
    });
  });
}