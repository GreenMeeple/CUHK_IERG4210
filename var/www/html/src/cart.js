function addtocart(pid){
	var storage = window.localStorage.getItem('cart_storage');
	if (storage == undefined)
		storage = {};

	else
		storage = JSON.parse(storage);

	if (storage[pid] == undefined)
		storage[pid] = 0;

	storage[pid] = storage[pid] + 1;
	window.localStorage.setItem('cart_storage', JSON.stringify(storage));
	refreshcart();
};

function getdata(pid){
	var xhr = null;
	if (window.XMLHttpRequest) {
		xhr = new XMLHttpRequest();
	}
  else if (window.ActiveXObject){
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xhr.open('GET', '/src/item.php?pid=' + pid, true);

	xhr.onreadystatechange = function(){
		var DONE = 4;
		var OK = 200;

		if (xhr.readyState === DONE && xhr.status === OK){
			var data = JSON.parse(xhr.responseText);
			refreshcart();
		}

		else {
			console.log('Error:' + xhr.status + xhr.readyState);
		};
	}
	xhr.send();
};

function refreshcart(){
	var cart = document.getElementById("ajax");
	var checkout = document.getElementById("checkout");
	cart.innerHTML = 'I am empty now, please put something inside me~';
	checkout.innerHTML = '';

	var storage = window.localStorage.getItem('cart_storage');
	storage = JSON.parse(storage);
	var data;
	var total = 0;

	for (i = 1; i < 100; i++){
		if (storage[i] > 0){
			cart.innerHTML = '';
			data = window.localStorage.getItem(i);

			if (data != undefined){
				var cartproduct = document.createElement("div");
				cart.appendChild(cartproduct);
				data = JSON.parse(data);

				var name = data.name + ' x ' + storage[i] + ': $';
				var price = Math.round(storage[i] * data.price);
				name = name + price;

				text = document.createTextNode(name);
				cartproduct.appendChild(text);

				var btnAdd = document.createElement("BUTTON");
				btnAdd.innerHTML = "+";
				btnAdd.id = i;
				btnAdd.className = "changed";
				btnAdd.onclick = function(){
					storage[this.id] = storage[this.id] + 1;
					window.localStorage.setItem('cart_storage', JSON.stringify(storage));
					refreshcart();
				}
				cartproduct.appendChild(btnAdd);

				var btnDrop = document.createElement("BUTTON");
				btnDrop.innerHTML = "-";
				btnDrop.id = i;
				btnDrop.className = "changed";
				btnDrop.onclick = function(){
					storage[this.id] = storage[this.id] - 1;
					window.localStorage.setItem('cart_storage', JSON.stringify(storage));
					refreshcart();
				}
			cartproduct.appendChild(btnDrop);
			}

			total = total + price;
			checkout.innerHTML = '<h3 style="color:#ffffcc">Total price: ' +total+ '$</h3>Check Out';
		}
	}
}
