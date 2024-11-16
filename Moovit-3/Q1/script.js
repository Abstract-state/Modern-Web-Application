function calculateEligibility() {
    let income = document.getElementById('annualIncome').value;
    let score = document.getElementById('creditScore').value;
    let age = document.getElementById('age').value;
    let salary = document.getElementById('monthlySalary').value;
    let emi = document.getElementById('currentEmi').value || 0;

    let minIncome = 20000;
    let minScore = 700;
    let minAge = 18;
    let maxAge = 65;
    let emiLimit = salary * 0.6;
    let loanAmount = salary * 10;

    let message = '';

    if (income >= minIncome && score >= minScore && age >= minAge && age <= maxAge && emi <= emiLimit) {
        message = 'Eligible for loan.<br>';
        message += 'Eligible Loan Amount: Rs. ' + loanAmount + '<br>';
        message += 'Maximum EMI you can pay: Rs. ' + emiLimit + '<br>';

        if (loanAmount >= emi * 12) {
            message += 'You are eligible for additional loan benefits.';
        } else {
            message += 'You are not eligible for additional loan benefits.';
        }
    } else {
        message = 'Not eligible for loan.<br>';
        if (income < minIncome) message += 'Your annual income must be at least Rs. ' + minIncome + '<br>';
        if (score < minScore) message += 'Your credit score must be at least ' + minScore + '<br>';
        if (age < minAge || age > maxAge) message += 'Your age must be between ' + minAge + ' and ' + maxAge + '<br>';
        if (emi > emiLimit) message += 'Your EMI should not exceed Rs. ' + emiLimit + '<br>';
    }

    document.getElementById('output').innerHTML = message;
}
