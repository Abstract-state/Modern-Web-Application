document.getElementById('age').addEventListener('input', function () {
    const age = parseInt(this.value);
    const benefitsDiv = document.getElementById('benefits');

    if (age) {
        let benefitsText = '';
        if (age < 18) {
            benefitsText = 'You will receive: Free T-shirt and Meal Vouchers.';
        } else {
            benefitsText = 'You will receive: Free T-shirt, Meal Vouchers, and a Festival Pass.';
        }
        benefitsDiv.style.display = 'block';
        benefitsDiv.textContent = benefitsText;
    } else {
        benefitsDiv.style.display = 'none';
    }
});

document.getElementById('registrationForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const name = document.getElementById('name').value.trim();
    const role = document.getElementById('role').value.trim();
    const age = parseInt(document.getElementById('age').value.trim());
    const tshirt = document.getElementById('tshirt').value.trim();

    if (!name || !role || isNaN(age) || !tshirt) {
        alert("Please fill out all fields before submitting.");
        return;
    }

    let benefitsMessage = '';
    if (age < 18) {
        benefitsMessage = 'Free T-shirt and Meal Vouchers.';
    } else {
        benefitsMessage = 'Free T-shirt, Meal Vouchers, and a Festival Pass.';
    }

    // Disable the form fields to prevent further input
    const formElements = document.getElementById('registrationForm').elements;
    for (let i = 0; i < formElements.length; i++) {
        formElements[i].disabled = true;
    }

    // Show confirmation message
    const confirmationMessage = document.getElementById('confirmationMessage');
    confirmationMessage.style.display = 'block';
    confirmationMessage.textContent = `Thank you, ${name}! Your assigned role is: ${role}. You will receive ${benefitsMessage}. Please pick up your T-shirt size (${tshirt}) at the registration desk.`;
});

