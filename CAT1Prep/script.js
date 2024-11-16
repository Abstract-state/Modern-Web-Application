document.getElementById("registrationForm").addEventListener("submit", function (e) {
    e.preventDefault();  // Prevent the form from submitting and refreshing the page

    var name = document.getElementById("Name").value.trim();
    var age = document.getElementById("Age").value.trim();
    var resultElement = document.getElementById("result");

    // Determine the price based on age
    let cost = "";
    if (age <= 10) {
        cost = 300;
    } else {
        cost = 700;
    }

    // Display the result
    resultElement.innerHTML = `Thank you, ${name}, aged ${age}, for registering for the event. Your ticket price is Rs-${cost}.`;
});
