function addRow() {
    const tbody = document.getElementById('room-rows');
    const newRow = tbody.rows[0].cloneNode(true); // Clone the first row

    // Reset input values in the new row
    newRow.querySelectorAll('input[type="text"], input[type="number"], textarea, input[type="file"]').forEach(input => {
        input.value = '';
    });

    tbody.appendChild(newRow);
}

function removeRow(button) {
    const row = button.closest('tr');
    row.parentNode.removeChild(row);
}

function addRow2() {
    const tbody = document.getElementById('menu-rows');
    const newRow = tbody.rows[0].cloneNode(true);

    newRow.querySelectorAll('input[type="text"], input[type="number"]').forEach(input => {
        input.value = '';
    });

    tbody.appendChild(newRow);
}

function removeRow2(button) {
    const row = button.closest('tr');
    row.parentNode.removeChild(row);
}


function incrementQuantity(shopId, itemName) {
    var input = document.getElementById('quantity_' + shopId + '_' + itemName);
    input.value = parseInt(input.value) + 1;
}

function decrementQuantity(shopId, itemName) {
    var input = document.getElementById('quantity_' + shopId + '_' + itemName);
    if (parseInt(input.value) > 0) {
        input.value = parseInt(input.value) - 1;
    }
}