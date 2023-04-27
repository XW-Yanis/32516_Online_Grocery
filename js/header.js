$(document).ready(function () {
  $('select').niceSelect();
});
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
      const products = document.getElementsByClassName('col-md-4');
      document.getElementById('the-heading').innerHTML = 'Search Results';
      while (products.length > 0) {
        products[0].parentNode.removeChild(products[0]);
      }
      const data = JSON.parse(xhttp.responseText);
      renderProducts(data, Array.from(Array(data.length).keys()));
      searchBtn.disabled = false;
    };
    xhttp.open('post', 'getSearchProducts.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send('param=' + encodeURIComponent(JSON.stringify(param)));
  });
}