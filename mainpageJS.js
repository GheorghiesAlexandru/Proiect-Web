function adaugaCos(nume, pret) {
    var listItem = document.createElement('li');
    listItem.textContent = nume; 
    
    var cartItems = document.getElementById('cart-items');
    cartItems.appendChild(listItem);
    
    var total = document.getElementById('total-price');
    var currentTotal = parseFloat(total.textContent.split('€')[1]);
    var newTotal = currentTotal + pret; 
    total.textContent = 'Total: €' + newTotal.toFixed(2); 
}

function openCart(){
    var cartbox = document.querySelector('.cartbox');
    if (cartbox.style.display === 'none') {
        cartbox.style.display = 'block';
        console.log("deschis");
    } else {
        cartbox.style.display = 'none';
        console.log("inchis");
    }
}


