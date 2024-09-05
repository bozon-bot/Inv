document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    const searchPhone = document.getElementById('searchPhone');
    const userTableContainer = document.getElementById('userTableContainer');

    searchForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const phone = searchPhone.value;
        fetchUserData(phone);
    });

    function fetchUserData(phone) {
        fetch('admin.php?phone=' + encodeURIComponent(phone))
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    userTableContainer.innerHTML = '<p>No user found</p>';
                } else {
                    displayUserTable(data);
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    function displayUserTable(users) {
        let tableHtml = `
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Phone</th>
                        <th>Balance</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
        `;

        users.forEach(user => {
            tableHtml += `
                <tr>
                    <td>${user.id}</td>
                    <td>${user.fullname}</td>
                    <td>${user.phone}</td>
                    <td>
                        <input type="number" value="${user.balance}" id="balance-${user.id}" />
                    </td>
                    <td>
                        <button onclick="updateBalance(${user.id})">Update</button>
                    </td>
                </tr>
            `;
        });

        tableHtml += '</tbody></table>';
        userTableContainer.innerHTML = tableHtml;
    }

    window.updateBalance = function(userId) {
        const balanceInput = document.getElementById(`balance-${userId}`);
        const newBalance = balanceInput.value;

        fetch('update_balance.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${userId}&balance=${newBalance}`
        })
        .then(response => response.text())
        .then(result => {
            alert(result);
        })
        .catch(error => console.error('Error updating balance:', error));
    };
});