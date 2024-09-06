<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('itemChart').getContext('2d');
    const chartData = {
        labels: ['2024-09-01', '2024-09-02', '2024-09-03'], // transaction_date
        datasets: [
            {
                label: 'Alış Fiyatı',
                data: [100, 200, 150], // total_purchase_price
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'Satış Fiyatı',
                data: [120, 220, 180], // total_sale_price
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }
        ]
    };

    const myChart = new Chart(ctx, {
        type: 'line',
        data: chartData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    getCharData();

    function getCharData() {
        var labels = [];
        $.ajax({
            url: '{{ route('transaction.chart') }}',
            type: 'GET',
            success: function (response) {
                console.log(response); // JSON verisini kontrol etmek için

                // Eğer response bir JSON nesnesiyse, JSON.parse'e gerek yok.
                var jsonData = response;

                for (var i = 0; i < jsonData.length; i++) {
                    labels.push(jsonData[i].item_name);
                }

                myChart.data.labels = labels;
                myChart.data.datasets[0].data = jsonData.map(item => item.total_purchase_price);
                myChart.data.datasets[1].data = jsonData.map(item => item.total_sale_price);
                myChart.update();
            }
        });
    }

</script>
