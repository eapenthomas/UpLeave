document.addEventListener("DOMContentLoaded", function () {
    // ==== PIE CHART ====
    const pieCanvas = document.getElementById('leavePieChart');
    if (pieCanvas) {
        const ctxPie = pieCanvas.getContext('2d');

        const leavePieData = {
            labels: ['Approved', 'Rejected', 'Pending'],
            datasets: [{
                label: 'Leave Status Distribution',
                data: [
                    parseInt(pieCanvas.dataset.approved) || 0,
                    parseInt(pieCanvas.dataset.rejected) || 0,
                    parseInt(pieCanvas.dataset.pending) || 0
                ],
                backgroundColor: ['#4CAF50', '#F44336', '#FFC107'],
                borderWidth: 1
            }]
        };

        new Chart(ctxPie, {
            type: 'pie',
            data: leavePieData
        });
    }

    // ==== BAR CHART ====
    const barCanvas = document.getElementById('leaveBarChart');
    if (barCanvas) {
        const ctxBar = barCanvas.getContext('2d');

        const leaveBarData = {
            labels: ['Sick Leave', 'Casual Leave', 'Maternity Leave', 'Paternity Leave'],
            datasets: [{
                label: 'Leave Type Count',
                data: [
                    parseInt(barCanvas.dataset.sick) || 0,
                    parseInt(barCanvas.dataset.casual) || 0,
                    parseInt(barCanvas.dataset.maternity) || 0,
                    parseInt(barCanvas.dataset.paternity) || 0
                ],
                backgroundColor: '#2196F3',
                borderColor: '#1976D2',
                borderWidth: 1
            }]
        };

        new Chart(ctxBar, {
            type: 'bar',
            data: leaveBarData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }
});
