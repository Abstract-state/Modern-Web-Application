function validateForm() {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const participants = document.getElementById('participants').value.trim();

    if (name === "" || email === "" || phone === "" || participants === "") {
        alert("Please fill in all the fields.");
        return false;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    const phonePattern = /^[0-9]{10}$/;
    if (!phonePattern.test(phone)) {
        alert("Please enter a valid 10-digit mobile number.");
        return false;
    }

    displayConfirmation(name, phone, participants);
    return false; // Prevent form submission to demonstrate the confirmation
}

function displayConfirmation(name, phone, participants) {
    const prizePerTicket = 500;
    const totalPrize = participants * prizePerTicket;

    const confirmationMessage = `
        <h2>Registration Successful</h2>
        <p><strong>Name:</strong> ${name}</p>
        <p><strong>Phone Number:</strong> ${phone}</p>
        <p><strong>Number of Participants:</strong> ${participants}</p>
        <p><strong>Total Prize:</strong> Rs ${totalPrize}</p>
    `;

    document.getElementById('confirmation').innerHTML = confirmationMessage;
    document.getElementById('registrationForm').reset();
}
