function addtocart(pid){
	var storage = window.localStorage.getItem('cart_storage');
	if (storage === null || storage === undefined)
		storage = {};
	else
		storage = JSON.parse(storage);

	if (storage[pid] === undefined)
		storage[pid] = 0;

	storage[pid] = storage[pid] + 1;
	window.localStorage.setItem('cart_storage', JSON.stringify(storage));

	// 🔥 This is the fix: fetch product data from DB
	getdata(pid);
}

function getdata(pid){
	var xhr = null;
	if (window.XMLHttpRequest) {
		xhr = new XMLHttpRequest();
	} else if (window.ActiveXObject){
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	}

	xhr.open('GET', './src/item.php?pid=' + pid, true);

	xhr.onreadystatechange = function(){
		var DONE = 4;
		var OK = 200;

		if (xhr.readyState === DONE && xhr.status === OK){
			var data = JSON.parse(xhr.responseText);
			
			// Store the item info in localStorage for later
			window.localStorage.setItem(pid, JSON.stringify(data));

			refreshcart();
		} else if (xhr.readyState === DONE) {
			console.log('Error: ' + xhr.status + ' at readyState ' + xhr.readyState);
		}
	};
	xhr.send();
}

function refreshcart(){
	var cart = document.getElementById("ajax");
	var checkout = document.getElementById("checkout");
	cart.innerHTML = 'I am empty now, please put something inside me~';
	checkout.innerHTML = '';

	var storage = window.localStorage.getItem('cart_storage');
	if (!storage) return; // Nothing in cart

	storage = JSON.parse(storage);
	var total = 0;
	var hasItems = false;

	for (let i = 1; i < 100; i++){
		if (storage[i] > 0){
			let data = window.localStorage.getItem(i);
			if (data !== null && data !== undefined){
				if (!hasItems) {
					cart.innerHTML = ''; // Clear placeholder if we’re adding the first item
					hasItems = true;
				}

				data = JSON.parse(data);

				let cartproduct = document.createElement("div");
				cart.appendChild(cartproduct);

				let name = data.name + ' x ' + storage[i] + ': $';
				let price = Math.round(storage[i] * data.price);
				name += price;

				let text = document.createTextNode(name);
				cartproduct.appendChild(text);

				let btnAdd = document.createElement("BUTTON");
				btnAdd.innerHTML = "+";
				btnAdd.id = i;
				btnAdd.className = "changed";
				btnAdd.onclick = function(){
					storage[this.id] = storage[this.id] + 1;
					window.localStorage.setItem('cart_storage', JSON.stringify(storage));
					refreshcart();
				}
				cartproduct.appendChild(btnAdd);

				let btnDrop = document.createElement("BUTTON");
				btnDrop.innerHTML = "-";
				btnDrop.id = i;
				btnDrop.className = "changed";
				btnDrop.onclick = function(){
					storage[this.id] = Math.max(0, storage[this.id] - 1);
					window.localStorage.setItem('cart_storage', JSON.stringify(storage));
					refreshcart();
				}
				cartproduct.appendChild(btnDrop);

				total += price;
			}
		}
	}

	if (hasItems) {
		checkout.innerHTML = '<h3 style="color:#ffffcc">Total price: ' + total + '$</h3>Check Out';
	}
}
