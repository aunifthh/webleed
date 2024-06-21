document.getElementById('eligibilityForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const age = parseInt(document.getElementById('age').value);
    const weight = parseInt(document.getElementById('weight').value);
    const lastDonation = document.getElementById('lastDonation').value;
    const healthIssues = document.getElementById('healthIssues').value.toLowerCase();

    let result = '';
    let isEligible = true;

    // Check age
    if (age < 18 || age > 65) {
        result += 'You must be between 18 and 65 years old to donate blood.<br>';
        isEligible = false;
    }

    // Check weight
    if (weight < 50) {
        result += 'You must weigh at least 50 kg to donate blood.<br>';
        isEligible = false;
    }

    // Check last donation date
    if (lastDonation) {
        const lastDonationDate = new Date(lastDonation);
        const today = new Date();
        const timeDiff = Math.abs(today - lastDonationDate);
        const daysDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
        
        if (daysDiff < 90) {
            result += 'You must wait at least 90 days between donations.<br>';
            isEligible = false;
        }
    }

    // Check health issues
    if (healthIssues === 'yes') {
        result += 'You may not be eligible to donate blood due to health issues.<br>';
        isEligible = false;
    }

    // Display result
    if (result === '') {
        result = 'You are eligible to donate blood!';
    }

    document.getElementById('result').innerHTML = result;

    // Send eligibility status to the server
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "update_eligibility.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.send("donAge=" + age + "&donWeight=" + weight + "&isEligible=" + (isEligible ? 'Y' : 'N'));
});
