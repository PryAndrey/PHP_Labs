let products = new Map()
let cost = 0
let productString = ""
let basketString = ""

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

function addHiddenInput(orderForm, name, value) {
  let input = document.createElement("input");
  input.type = "hidden";
  input.name = name;
  input.value = value;
  orderForm.appendChild(input);
}

function orderForm(userId) {
  if (products.size > 0) {

    document.getElementById("orderFormContainer").classList.remove('unVisible');
    productString = "";
    for (let pair of products.entries()) {
      productString += `${pair[0]} x${pair[1]}`;
    }
    document.getElementById("products").innerHTML = showBasket();
    document.getElementById("cost").innerHTML = "Цена: " + cost + "Руб";
    let orderForm = document.getElementById("sendOrderForm");
    addHiddenInput(orderForm, 'products', productString)
    addHiddenInput(orderForm, 'cost', cost)
    addHiddenInput(orderForm, 'client', userId)
    console.log(orderForm)
  }
}

