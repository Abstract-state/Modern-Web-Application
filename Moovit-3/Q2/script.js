function calculateAge(dob) {
    let today = new Date();
    let birthDate = new Date(dob);
    let age = today.getFullYear() - birthDate.getFullYear();
    let monthDifference = today.getMonth() - birthDate.getMonth();
    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}

function validateForm() {
    let name = document.getElementById('fullName').value;
    let dob = document.getElementById('dob').value;
    let email = document.getElementById('email').value;
    let qualification = document.getElementById('qualification').value;
    let experience = document.getElementById('experience').value;
    let output = document.getElementById('output');

    let age = calculateAge(dob);

    let qualificationRegex = /bachelor'?s\s*degree.*(computer\s*science|cs|it|information\s*technology|software\s*engineering|related\s*field)/i

    if (age < 21) {
        output.innerHTML = "Applicant must be at least 21 years old.";
    } else if (qualificationRegex.test(qualification)) {
        output.innerHTML = "Applicant must have a bachelor's degree in computer science or a related field.";
    } else if (experience < 2) {
        output.innerHTML = "Applicant must have at least 2 years of relevant work experience.";
    } else {
        output.innerHTML = "Application submitted successfully!";
    }
}
