var products = new Map()
var cost = 0
var productString = ""

function addProduct(pizzaTitle, pizzaCost) {
  if (products.has(pizzaTitle)) {
    products.set(pizzaTitle, products.get(pizzaTitle) + 1)
  } else {
    products.set(pizzaTitle, 1)
  }
  document.getElementById(pizzaTitle).innerHTML = "В корзине: " + products.get(pizzaTitle)
  cost += pizzaCost
  console.log(products)
}
function deleteProduct(pizzaTitle, pizzaCost) {
  if (products.has(pizzaTitle)) {
    if (products.get(pizzaTitle) === 1) {
      products.delete(pizzaTitle)
      document.getElementById(pizzaTitle).innerHTML = "В корзине: 0"
    } else {
      products.set(pizzaTitle, products.get(pizzaTitle) - 1)
      document.getElementById(pizzaTitle).innerHTML = "В корзине: " + products.get(pizzaTitle)
    }
    cost -= pizzaCost
  }
  console.log(products)
}

function orderForm() {
  document.getElementById("orderForm").classList.remove('unVisible');
  productString = ""
  for (let pair of products.entries()) {
    productString += `${pair[0]} x${pair[1]} \n`
  }
  document.getElementById("products").innerHTML = "Продукты: " + productString
  document.getElementById("cost").innerHTML = "Цена: " + cost + "Руб"
}

async function sendOrder(userId) {
  let adress = document.getElementById("orderAddress").value;

  order = {
    "products": productString,
    "cost": cost,
    "client": userId,
    "address": adress,
  }
  console.log(order)
  let response = await fetch('http://localhost:8000/order/create', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json;charset=utf-8'
    },
    body: JSON.stringify(order)
  });
  // window.location.replace(
  //   "http://localhost:8000/order/thank"
  // );
  document.getElementById("orderForm").classList.add('unVisible');
  document.getElementById("products").innerHTML = "Продукты:"
  document.getElementById("cost").innerHTML = "Цена: 0Руб"
  document.getElementById("orderAddress").value = ""
  for (let pair of products.entries()) {
    document.getElementById(pair[0]).innerHTML = "В корзине: 0"
  }
  productString = ""
  products.clear()
  cost = 0
  alert("Спасибо за заказ!")
}