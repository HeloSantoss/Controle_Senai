document.getElementById('menu-icon').onclick = () => {
    document.querySelector('.navbar').classList.toggle('active');
};

function adicionarItem() {
    const itemName = document.getElementById('item-name').value;
    const itemQuantity = document.getElementById('item-quantity').value;
    if (itemName && itemQuantity) {
        const item = document.createElement('li');
        item.textContent = `${itemName} - Quantidade: ${itemQuantity}`;
        document.getElementById('item-list').appendChild(item);
        document.getElementById('item-name').value = '';
        document.getElementById('item-quantity').value = '';
    }
}

function transferirItem() {
    const itemName = document.getElementById('transfer-item-name').value;
    const itemQuantity = document.getElementById('transfer-quantity').value;
    const destination = document.getElementById('destination').value;
    if (itemName && itemQuantity && destination) {
        const item = document.createElement('li');
        item.textContent = `${itemName} - Quantidade: ${itemQuantity} - Destino: ${destination}`;
        document.getElementById('almoxarifado-list').appendChild(item);
        document.getElementById('transfer-item-name').value = '';
        document.getElementById('transfer-quantity').value = '';
        document.getElementById('destination').value = '';
    }
}

function adicionarSala() {
    const bloco = document.getElementById('bloco-select').value;
    const salaName = document.getElementById('sala-name').value;
    if (salaName) {
        const sala = document.createElement('li');
        sala.textContent = salaName;
        document.querySelector(`#bloco${bloco} ul`).appendChild(sala);
        document.getElementById('sala-name').value = '';
    }
}
