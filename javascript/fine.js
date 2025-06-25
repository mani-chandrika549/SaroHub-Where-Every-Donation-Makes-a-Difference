// scripts.js

// Define fine amounts
const fineAmounts = {
    1: 100,
    2: 200,
    3: 500,
};

// Update fine amount when a reason is selected
function updateFineAmount() {
    const reason = document.getElementById("fine-reason").value;
    const amountContainer = document.getElementById("fine-amount-container");
    const payButton = document.getElementById("pay-now");
    const fineAmountDisplay = document.getElementById("fine-amount");

    if (reason !== "0") {
        fineAmountDisplay.innerText = fineAmounts[reason];
        amountContainer.style.display = "block";
        payButton.style.display = "inline-block";
    } else {
        amountContainer.style.display = "none";
        payButton.style.display = "none";
    }
}

// Razorpay integration
function redirectToRazorpay() {
    const amount = document.getElementById("fine-amount").innerText * 100;

    const options = {
        key: 'your-razorpay-key', 
        amount: amount,
        currency: "INR",
        name: "Saro Connect",
        description: "Fine Payment",
        handler: function (response) {
            alert("Payment successful!");

            // Save transaction details
            fetch('save_transaction.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    paymentId: response.razorpay_payment_id,
                    amount: amount / 100,
                    reason: document.getElementById("fine-reason").options[document.getElementById("fine-reason").selectedIndex].text,
                }),
            })
            .then(res => res.json())
            .then(data => console.log(data));
        },
        prefill: { name: "John Doe", email: "john@example.com", contact: "9876543210" },
        theme: { color: "#F37254" },
    };

    const rzp1 = new Razorpay(options);
    rzp1.open();
}
