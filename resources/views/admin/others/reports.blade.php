@extends('theme.layout')
@section('content')


<div class="container">
    <h2>How is employee tenure changing?</h2>
    <p>Understand changes to employee tenure.</p>

    <!-- Comparison of Average Tenure -->
    <div class="card">
        <h3>Comparison of Average Tenure by Organization</h3>
        <p>Aug 31, 2022: <strong>3.89 yrs</strong> <!-- Placeholder value --></p>
        <p>Aug 31, 2021: <strong>3.8 yrs</strong> <!-- Placeholder value --></p>
        <p>Change: <strong>+0.1 yrs</strong> <!-- Placeholder value --></p>
    </div>

    <!-- Headcount by Organization and Tenure -->
    <div class="card">
        <h3>Headcount by Organization and Tenure</h3>
        <canvas id="headcountChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('headcountChart').getContext('2d');
    
    // Placeholder data for empty chart
    const labels = ['Operations', 'Sales', 'Marketing', 'Customer Support', 'Finance', 'HR', 'E-Commerce', 'IT', 'Product', 'BlueSphere'];
    const datasets = [
        { label: '0-1 yr', data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0], backgroundColor: '#69b3a2' },
        { label: '1-2 yrs', data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0], backgroundColor: '#40739e' },
        // Add more tenure ranges with zeroed data as needed
    ];

    new Chart(ctx, {
        type: 'bar',
        data: { labels: labels, datasets: datasets },
        options: {
            responsive: true,
            scales: {
                x: { stacked: true },
                y: { stacked: true, beginAtZero: true }
            }
        }
    });
</script>



@endsection