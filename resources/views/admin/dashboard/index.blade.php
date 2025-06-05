@extends('theme.layout')
@section('content')
    <div class="nk-content" style="position: relative; min-height: 100vh;">
        <!-- Large Background Image -->
        <div class="background-overlay" style="
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), 
                              url('TCC.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            z-index: -1;
        "></div>

        <div class="container-fluid" style="position: relative; z-index: 1;">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <!-- Header Section -->
                    <div class="nk-block-head nk-block-head-sm" style="padding: 2rem 0;">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title" style="color: white; font-size: 2.5rem; font-weight: 700; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                                    Employee Management Dashboard
                                </h3>
                                <div class="nk-block-des text-soft">
                                    <p style="color: rgba(255,255,255,0.9); font-size: 1.1rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">
                                        Comprehensive overview of your organization's workforce
                                    </p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" 
                                       data-target="pageMenu" style="background: rgba(255,255,255,0.2); color: white; backdrop-filter: blur(10px);">
                                        <em class="icon ni ni-menu-alt-r"></em>
                                    </a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <!-- Additional tools can be added here -->
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dashboard Stats -->
                    <div class="nk-block" style="padding: 2rem 0;">
                        <div class="row g-4">
                            
                            <!-- Total Employees -->
                            <div class="col-xxl-3 col-lg-6 col-sm-6">
                                <a href="/masterlist" style="text-decoration: none;">
                                    <div class="card dashboard-card" style="
                                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                        color: white; 
                                        cursor: pointer; 
                                        border: none;
                                        border-radius: 15px;
                                        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                                        transform: translateY(0);
                                        transition: all 0.3s ease;
                                        backdrop-filter: blur(10px);
                                        position: relative;
                                        overflow: hidden;
                                    " onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.4)';" 
                                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.3)';">
                                        
                                        <!-- Card Shine Effect -->
                                        <div style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent); transform: rotate(45deg); transition: all 0.6s;"></div>
                                        
                                        <div class="card-inner text-center" style="padding: 2rem;">
                                            <div style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.8;">
                                                <i class="ni ni-users" style="color: rgba(255,255,255,0.9);"></i>
                                            </div>
                                            <h6 class="title" style="font-weight: 600; font-size: 1.1rem; margin-bottom: 1rem; letter-spacing: 0.5px;">
                                                Total Employees
                                            </h6>
                                            <div class="data">
                                                <span class="amount" style="font-size: 2.8rem; font-weight: 700; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                                                    {{ $totalemployeescount }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Total Faculties -->                           
                            <div class="col-xxl-3 col-lg-6 col-sm-6">
                                <a href="/faculty" style="text-decoration: none;">
                                    <div class="card dashboard-card" style="
                                        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
                                        color: white; 
                                        cursor: pointer; 
                                        border: none;
                                        border-radius: 15px;
                                        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                                        transform: translateY(0);
                                        transition: all 0.3s ease;
                                        backdrop-filter: blur(10px);
                                        position: relative;
                                        overflow: hidden;
                                    " onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.4)';" 
                                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.3)';">
                                        
                                        <div style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent); transform: rotate(45deg); transition: all 0.6s;"></div>
                                        
                                        <div class="card-inner text-center" style="padding: 2rem;">
                                            <div style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.8;">
                                                <i class="ni ni-book" style="color: rgba(255,255,255,0.9);"></i>
                                            </div>
                                            <h6 class="title" style="font-weight: 600; font-size: 1.1rem; margin-bottom: 1rem; letter-spacing: 0.5px;">
                                                Total Faculties
                                            </h6>
                                            <div class="data">
                                                <span class="amount" style="font-size: 2.8rem; font-weight: 700; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                                                    {{ $totalfacultycount }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Total Staffs -->
                            <div class="col-xxl-3 col-lg-6 col-sm-6">
                                <a href="/staff" style="text-decoration: none;">
                                    <div class="card dashboard-card" style="
                                        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
                                        color: white; 
                                        cursor: pointer; 
                                        border: none;
                                        border-radius: 15px;
                                        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                                        transform: translateY(0);
                                        transition: all 0.3s ease;
                                        backdrop-filter: blur(10px);
                                        position: relative;
                                        overflow: hidden;
                                    " onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.4)';" 
                                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.3)';">
                                        
                                        <div style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent); transform: rotate(45deg); transition: all 0.6s;"></div>
                                        
                                        <div class="card-inner text-center" style="padding: 2rem;">
                                            <div style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.8;">
                                                <i class="ni ni-user-list" style="color: rgba(255,255,255,0.9);"></i>
                                            </div>
                                            <h6 class="title" style="font-weight: 600; font-size: 1.1rem; margin-bottom: 1rem; letter-spacing: 0.5px;">
                                                Total Staffs
                                            </h6>
                                            <div class="data">
                                                <span class="amount" style="font-size: 2.8rem; font-weight: 700; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                                                    {{ $totalstaffcount }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Pending Request COE -->
                            <div class="col-xxl-3 col-lg-6 col-sm-6">
                                <a href="/others/request" style="text-decoration: none;">
                                    <div class="card dashboard-card" style="
                                        background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
                                        color: #333; 
                                        cursor: pointer; 
                                        border: none;
                                        border-radius: 15px;
                                        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                                        transform: translateY(0);
                                        transition: all 0.3s ease;
                                        backdrop-filter: blur(10px);
                                        position: relative;
                                        overflow: hidden;
                                    " onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.4)';" 
                                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.3)';">
                                        
                                        <div style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: linear-gradient(45deg, transparent, rgba(255,255,255,0.2), transparent); transform: rotate(45deg); transition: all 0.6s;"></div>
                                        
                                        <div class="card-inner text-center" style="padding: 2rem;">
                                            <div style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.8;">
                                                <i class="ni ni-file-docs" style="color: rgba(51,51,51,0.8);"></i>
                                            </div>
                                            <h6 class="title" style="font-weight: 600; font-size: 1.1rem; margin-bottom: 1rem; letter-spacing: 0.5px;">
                                                Pending Request COE
                                            </h6>
                                            <div class="data">
                                                <span class="amount" style="font-size: 2.8rem; font-weight: 700; text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">
                                                    {{ $totalcoereqcount }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Monthly Employee Statistics Chart -->
                            <div class="col-md-12" style="margin-top: 2rem;">
                                <div class="card" style="
                                    background: rgba(255, 255, 255, 0.95);
                                    backdrop-filter: blur(15px);
                                    border: 1px solid rgba(255, 255, 255, 0.2);
                                    border-radius: 15px;
                                    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
                                    padding: 2rem;
                                ">
                                    <div class="card-header" style="background: transparent; border: none; padding-bottom: 1rem;">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h2 style="font-size: 1.5rem; font-weight: 600; color: #1f2937; margin: 0;">
                                                    Monthly Employee Statistics - This Year
                                                </h2>
                                                <p style="color: #6b7280; font-size: 0.9rem; margin: 0.5rem 0 0 0;">
                                                    Faculty vs Staff Distribution
                                                </p>
                                            </div>
                                            <div style="display: flex; gap: 1rem;">
                                                <div style="display: flex; align-items: center; gap: 0.5rem;">
                                                    <div style="width: 16px; height: 16px; background: #3b82f6; border-radius: 3px;"></div>
                                                    <span style="color: #374151; font-size: 0.9rem;">Total Faculty</span>
                                                </div>
                                                <div style="display: flex; align-items: center; gap: 0.5rem;">
                                                    <div style="width: 16px; height: 16px; background: #93c5fd; border-radius: 3px;"></div>
                                                    <span style="color: #374151; font-size: 0.9rem;">Total Staff</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-body" style="padding: 0;">
                                        <div style="height: 400px; position: relative;">
                                            <canvas id="employeeStatsChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Monthly Breakdown Table -->
                            <div class="col-md-12" style="margin-top: 2rem;">
                                <div class="card" style="
                                    background: rgba(255, 255, 255, 0.95);
                                    backdrop-filter: blur(15px);
                                    border: 1px solid rgba(255, 255, 255, 0.2);
                                    border-radius: 15px;
                                    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
                                    padding: 2rem;
                                ">
                                    <div class="card-header" style="background: transparent; border: none; padding-bottom: 1rem;">
                                        <h2 style="font-size: 1.5rem; font-weight: 600; color: #1f2937; margin: 0;">
                                            Monthly Breakdown - This Year
                                        </h2>
                                    </div>
                                    
                                    <div class="card-body" style="padding: 0;">
                                        <div class="table-responsive">
                                            <table class="table" style="margin: 0;">
                                                <thead style="background: #f9fafb;">
                                                    <tr>
                                                        <th style="padding: 1rem; color: #374151; font-weight: 600; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em;">Month</th>
                                                        <th style="padding: 1rem; color: #374151; font-weight: 600; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em;">Faculty</th>
                                                        <th style="padding: 1rem; color: #374151; font-weight: 600; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em;">Staff</th>
                                                        <th style="padding: 1rem; color: #374151; font-weight: 600; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em;">Total</th>
                                                        <th style="padding: 1rem; color: #374151; font-weight: 600; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em;">Growth</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="background: transparent;">
                                                    @php
                                                        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                                        
                                                        // Use the existing variables passed to the view
                                                        // These should be arrays with monthly data or you can distribute the totals
                                                        $facultyData = [];
                                                        $staffData = [];
                                                        
                                                        // If $totalFacultyCount and $totalStaffCount are totals, distribute them across months
                                                        // Or replace this with actual monthly data arrays
                                                        $monthlyFacultyAvg = round($totalfacultycount / 12);
                                                        $monthlyStaffAvg = round($totalstaffcount / 12);
                                                        
                                                        for ($i = 0; $i < 12; $i++) {
                                                            $facultyData[$i] = $monthlyFacultyAvg;
                                                            $staffData[$i] = $monthlyStaffAvg;
                                                        }
                                                        
                                                        // Adjust last month to match exact totals
                                                        $facultyData[11] += $totalfacultycount - (array_sum($facultyData));
                                                        $staffData[11] += $totalstaffcount - (array_sum($staffData));
                                                        
                                                        // Reset totals for recalculation
                                                        $calculatedFacultyTotal = 0;
                                                        $calculatedStaffTotal = 0;
                                                    @endphp

                                                    @foreach($months as $index => $month)
                                                        @php
                                                            $faculty = $facultyData[$index];
                                                            $staff = $staffData[$index];
                                                            $total = $faculty + $staff;
                                                            
                                                            // Calculate growth compared to previous month
                                                            if ($index > 0) {
                                                                $prevTotal = $facultyData[$index-1] + $staffData[$index-1];
                                                                $growth = $total - $prevTotal;
                                                                $growthPercent = $prevTotal > 0 ? round(($growth / $prevTotal) * 100, 1) : 0;
                                                            } else {
                                                                $growth = 0;
                                                                $growthPercent = 0;
                                                            }

                                                            // Add to running totals
                                                            $calculatedFacultyTotal += $faculty;
                                                            $calculatedStaffTotal += $staff;
                                                        @endphp
                                                        
                                                        <tr style="border-bottom: 1px solid #e5e7eb;">
                                                            <td style="padding: 1rem; font-weight: 500; color: #111827;">{{ $month }}</td>
                                                            <td style="padding: 1rem; font-weight: 600; color: #2563eb;">{{ $faculty }}</td>
                                                            <td style="padding: 1rem; font-weight: 600; color: #7c3aed;">{{ $staff }}</td>
                                                            <td style="padding: 1rem; font-weight: 700; color: #059669;">{{ $total }}</td>
                                                            <td style="padding: 1rem;">
                                                                @if($growth > 0)
                                                                    <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500; background: #dcfce7; color: #166534;">
                                                                        +{{ $growth }} (+{{ $growthPercent }}%)
                                                                    </span>
                                                                @elseif($growth < 0)
                                                                    <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500; background: #fee2e2; color: #991b1b;">
                                                                        {{ $growth }} ({{ $growthPercent }}%)
                                                                    </span>
                                                                @else
                                                                    <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500; background: #f3f4f6; color: #374151;">
                                                                        0 (0%)
                                                                    </span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    <!-- Summary Row -->
                                                    <tr style="border-top: 2px solid #d1d5db; font-weight: bold;">
                                                        <td style="padding: 1rem; color: #111827;">Total</td>
                                                        <td style="padding: 1rem; color: #2563eb;">{{ $totalfacultycount }}</td>
                                                        <td style="padding: 1rem; color: #7c3aed;">{{ $totalstaffcount }}</td>
                                                        <td style="padding: 1rem; color: #059669;">{{ $totalfacultycount + $totalstaffcount }}</td>
                                                        <td style="padding: 1rem;">
                                                            <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500; background: #f3f4f6; color: #374151;">
                                                                Annual Total
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    
    <!-- Enhanced Chart Script -->
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('employeeStatsChart').getContext('2d');
    
    // Data from Laravel backend - passed via Blade syntax
    const facultyData = @json($totalfacultycount);
    const staffData = @json($totalstaffcount);
    
    // Monthly labels
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    
    // Ensure we have data for all 12 months (pad with zeros if needed)
    const facultyCount = Array.isArray(facultyData) ? facultyData : [facultyData];
    const staffCount = Array.isArray(staffData) ? staffData : [staffData];
    
    // Pad arrays to 12 months if needed
    while (facultyCount.length < 12) facultyCount.push(0);
    while (staffCount.length < 12) staffCount.push(0);
    
    // Calculate totals and percentages for each month
    const monthlyTotals = facultyCount.map((faculty, index) => faculty + staffCount[index]);
    
    const facultyPercentages = facultyCount.map((faculty, index) => {
        const total = monthlyTotals[index];
        return total > 0 ? Math.round((faculty / total) * 100) : 0;
    });
    
    const staffPercentages = staffCount.map((staff, index) => {
        const total = monthlyTotals[index];
        return total > 0 ? Math.round((staff / total) * 100) : 0;
    });
    
    // Create the chart
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Faculty',
                    data: facultyPercentages,
                    backgroundColor: '#3b82f6',
                    borderColor: '#2563eb',
                    borderRadius: 6,
                    borderSkipped: false,
                },
                {
                    label: 'Staff', 
                    data: staffPercentages,
                    backgroundColor: '#93c5fd',
                    borderColor: '#60a5fa',
                    borderRadius: 6,
                    borderSkipped: false,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false // Custom legend in header
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: 'white',
                    bodyColor: 'white',
                    borderColor: 'rgba(255, 255, 255, 0.2)',
                    borderWidth: 1,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            const datasetLabel = context.dataset.label;
                            const percentage = context.parsed.y;
                            const monthIndex = context.dataIndex;
                            const actualCount = datasetLabel === 'Faculty' ? 
                                facultyCount[monthIndex] : 
                                staffCount[monthIndex];
                            return `${datasetLabel}: ${actualCount} (${percentage}%)`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    stacked: true,
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#6b7280',
                        font: {
                            size: 12,
                            weight: '500'
                        }
                    }
                },
                y: {
                    stacked: true,
                    beginAtZero: true,
                    max: 100,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)',
                        lineWidth: 1
                    },
                    ticks: {
                        color: '#6b7280',
                        font: {
                            size: 12,
                            weight: '500'
                        },
                        callback: function(value) {
                            return value + '%';
                        }
                    }
                }
            },
            interaction: {
                mode: 'index',
                intersect: false
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuart'
            }
        }
    });
});
</script>

    <!-- Additional CSS for enhanced effects -->
    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .dashboard-card:hover .card-inner > div:first-child {
            animation: float 2s ease-in-out infinite;
        }

        .dashboard-card:hover > div:first-child {
            left: 100%;
            transition: left 0.6s;
        }

        /* Table hover effects */
        tbody tr:hover {
            background-color: #f8fafc !important;
            transition: background-color 0.2s ease;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .background-overlay {
                background-attachment: scroll !important;
            }
            
            .nk-block-title {
                font-size: 2rem !important;
            }
            
            .card-inner {
                padding: 1.5rem !important;
            }
            
            .amount {
                font-size: 2rem !important;
            }
            
            .table-responsive {
                font-size: 0.85rem;
            }
            
            .card {
                padding: 1rem !important;
            }
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.5);
        }

        /* Chart container enhancements */
        #employeeStatsChart {
            border-radius: 8px;
        }
    </style>

@endsection