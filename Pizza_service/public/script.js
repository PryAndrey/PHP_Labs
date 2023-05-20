var products = new Map()
var cost = 0
var productString = ""
var basketString = ""

function showBasket() {
  basketString = "";
  for (let pair of products.entries()) {
    basketString += `${pair[0]} x${pair[1]}<br/>`
  }
  return basketString
}

function addProduct(pizzaTitle, pizzaCost) {
  if (products.has(pizzaTitle)) {
    products.set(pizzaTitle, products.get(pizzaTitle) + 1);
  } else {
    products.set(pizzaTitle, 1);
  }
  document.getElementById(pizzaTitle).innerHTML = "В корзине: " + products.get(pizzaTitle);
  cost += pizzaCost;
  document.getElementById('basket').innerHTML = showBasket();

  document.getElementById("orderBtn").classList.remove('unVisibleDisplay');
}

function deleteProduct(pizzaTitle, pizzaCost) {
  if (products.has(pizzaTitle)) {
    if (products.get(pizzaTitle) === 1) {
      products.delete(pizzaTitle);
      document.getElementById(pizzaTitle).innerHTML = "В корзине: 0";
    } else {
      products.set(pizzaTitle, products.get(pizzaTitle) - 1);
      document.getElementById(pizzaTitle).innerHTML = "В корзине: " + products.get(pizzaTitle);
    }
    cost -= pizzaCost;
    document.getElementById('basket').innerHTML = showBasket();

    if (products.size <= 0) {
      document.getElementById("orderBtn").classList.add('unVisibleDisplay');
    }
  }
}

function setUnvisible() {
  document.getElementById("orderFormContainer").classList.add('unVisible');
}

function orderForm() {
  if (products.size > 0) {

    document.getElementById("orderFormContainer").classList.remove('unVisible');
    productString = "";
    for (let pair of products.entries()) {
      productString += `${pair[0]} x${pair[1]}`;
    }
    document.getElementById("products").innerHTML = showBasket();
    document.getElementById("cost").innerHTML = "Цена: " + cost + "Руб";
  }
}

async function sendOrder(userId) {
  let address = document.getElementById("orderAddress").value;
  console.log(address.includes(' ', 0))
  if (!address.includes(' ', 0) && address !== '') {
    order = {
      "products": productString,
      "cost": cost,
      "client": userId,
      "address": address,
    }
    let response = await fetch('http://localhost:8000/order/create', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json;charset=utf-8'
      },
      body: JSON.stringify(order)
    });
    window.location.replace(response.url); // через контроллер не работает, поэтому переадресация здесь (спросить и исправить)
  }
}