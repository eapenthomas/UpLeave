function enhanceReason() {
    const reasonText = document.getElementById('reason').value.trim();
    if (!reasonText) {
        alert("Please enter a reason to enhance.");
        return;
    }

    fetch('enhance_reason.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ reason: reasonText })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('reason').value = data.enhanced_reason;
        } else {
            alert("Enhancement failed. Try again later.");
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Something went wrong.");
    });
}
