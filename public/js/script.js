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


// const durationInput = document.getElementById('subscription_duration');
// const subscriptionTable = document.getElementById('subscription-table');

// durationInput.addEventListener('input', () => {
//     const duration = parseInt(durationInput.value);

//     if (duration > 0) {
//         subscriptionTable.classList.remove('hidden');
//         const subscriptionRows = document.getElementById('subscription-rows');
//         subscriptionRows.innerHTML = ''; // Clear existing rows

//         for (let i = 1; i <= duration; i++) {
//             const newRow = document.createElement('tr');
//             newRow.innerHTML = `
//                 <td class="px-6 py-4">${i}</td>
//                 <td class="px-6 py-4 whitespace-nowrap">
//                     <input type="text" name="sub_item_name[]" class="border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
//                 </td>
//             `;
//             subscriptionRows.appendChild(newRow);
//         }
//     } else {
//         subscriptionTable.classList.add('hidden');
//     }
// });