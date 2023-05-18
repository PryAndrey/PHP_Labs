var products = new Map()
var cost = 0
var productString = ""

function addProduct(pizzaTitle, pizzaCost) {
  if (products.has(pizzaTitle)) {
    products.set(pizzaTitle, products.get(pizzaTitle) + 1)
  } else {
    products.set(pizzaTitle, 1)
  }
  cost += pizzaCost
  console.log(products)
}
function deleteProduct(pizzaTitle, pizzaCost) {
  if (products.has(pizzaTitle)) {
    if (products.get(pizzaTitle) === 1) {
      products.delete(pizzaTitle)
    } else {
      products.set(pizzaTitle, products.get(pizzaTitle) - 1)
    }
    cost -= pizzaCost
  }
  console.log(products)
}

function orderForm() {
  //document.getElementById("orderForm").classList.add('visible');
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

  var time = new Date();
  var localTime = time.toLocaleTimeString();

  order = {
    "products": productString,
    "cost": cost,
    "client": userId,
    "time": localTime,
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

  let result = await response.json();
  alert(result);
}