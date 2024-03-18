{{-- TODO: fix graphs coloring, font color, font size, font family, graphs responsivity, add border to card --}}
@extends('layouts.app')
@section('content')
    {{-- Image --}}
    <script>
        document.body.style.backgroundImage = "url('../storage/pictures/spending.jpg')";
    </script>
    <div class="container">
        {{-- Add new button --}}
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 text-center" id="financeButton">
                <button class="btn btn-outline-warning" onclick="window.location=' {{ url('/spendingCreate') }} '">Add new
                    spending</button>
            </div>
            <div class="col-3"></div>
        </div>
        @if ($finances->isNotEmpty())
            <div class="card bg-dark text-warning">
                {{-- Header --}}
                <div class="card-header">
                    <div class="col-12">
                        <h1>Spendings by chategories</h1>
                    </div>
                </div>
                {{-- Body --}}
                <div class="card-body">
                    {{-- graphs --}}
                    <div class="row">
                        {{-- Pie --}}
                        <div class="col-4">
                            <div id="chart"></div>
                        </div>
                        {{-- Line --}}
                        <div class="col-8">
                            <div id ="monthlyByCategories"></div>
                        </div>
                    </div>
                </div>
                {{-- Footer --}}
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <h1 id="avarage"></h1>
                        </div>
                        <div class="col-6">
                            <h1 id="sum"></h1>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <script>
            /*  TODO:  use ajax maybe */
            /* Functions: */
            //user associated finances php array to json string
            var financesData = @json($finances);
            //user associated categories php array to json string
            var categoriesData = {!! json_encode($categories) !!};
            var categoryPrices = {};
            /* iterates over each finance record, retrieves the category name, calculates the price */
            financesData.forEach(function(finance) {
                var categoryId = finance.category_id;
                var categoryName = categoriesData[categoryId];
                var price = finance.price;
                /* checks if the category has been already added */
                if (!categoryPrices[categoryName]) {
                    categoryPrices[categoryName] = price;
                } else {
                    categoryPrices[categoryName] += price;
                }
            });
            /* passing the data to the apexcharts */
            /* The date inside the graphs */
            var seriesData = [];
            for (var categoryName in categoryPrices) {
                seriesData.push({
                    x: categoryName,
                    y: categoryPrices[categoryName]
                });
            }


            /* Graphs: */
            /* Pie graph */
            var options = {
                chart: {
                    type: 'pie',
                    width: 400,
                    height: 400,
                    foreColor: '#FBFBFB',
                },
                plotOptions: {
                    bar: {
                        horizontal: true
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 1,
                    colors: ["#fff"]
                },
                legend: {
                    position: "right",
                    verticalAlign: "top",
                    containerMargin: {
                        left: 35,
                        right: 60
                    }
                },
                labels: Object.keys(categoryPrices),
                series: Object.values(categoryPrices),
                /* Here we can adjust the setting to make it responsive */
                responsive: [{
                    // breakepoint in px.... when the window size goes under this, the graph changes 
                    breakpoint: 1000,
                    // options for the changed responsive graph 
                    options: {
                        plotOptions: {
                            chart: {
                                horizontal: false
                            }
                        },
                        legend: {
                            position: "top"
                        }
                    }
                }]
            };
            /* render apexcharts */
            var chart = new ApexCharts(document.querySelector('#chart'), options)
            chart.render();
            var prices = financesData.map(function(item) {
                return item.price;
            });
            var sum = 0;
            for (let i = 0; i < prices.length; i++) {
                sum += prices[i];

            }

            /* Avg spending */
            let avarage = 'Avarage spending: ' + Math.round(sum / prices.length) + ' ' + '{{ $currencySymbol }}';
            /* Sum spending */
            sum = 'Spending in total: ' + sum + ' ' + '{{ $currencySymbol }}';
            document.getElementById('sum').innerHTML = sum;
            document.getElementById('avarage').innerHTML = avarage;
            /* console.log(sum/prices.length); */
            var financesData = @json($finances);
            var categoriesData = {!! json_encode($categories) !!};

            var monthlyCategoryPrices = {};

            financesData.forEach(function(finance) {
                var categoryId = finance.category_id;
                var categoryName = categoriesData[categoryId];
                var dateParts = finance.time.split('-'); // Split the date string into parts
                var year = parseInt(dateParts[0]); // Get year
                var month = parseInt(dateParts[1]); // Get month
                var key = categoryName + '-' + year + '-' + month; // Unique key for each category and month

                if (!monthlyCategoryPrices[key]) {
                    monthlyCategoryPrices[key] = finance.price;
                } else {
                    monthlyCategoryPrices[key] += finance.price;
                }
            });

            var categories = {};
            var seriesData = [];

            for (var key in monthlyCategoryPrices) {
                var parts = key.split('-');
                var categoryName = parts[0];
                var year = parseInt(parts[1]);
                var month = parseInt(parts[2]);
                var value = monthlyCategoryPrices[key];

                if (!categories[categoryName]) {
                    categories[categoryName] = [];
                }


                categories[categoryName].push([Date.UTC(year, month - 1), value]);
            }

            for (var categoryName in categories) {
                seriesData.push({
                    name: categoryName,
                    data: categories[categoryName]
                });
            }
            /* Line graph */
            var options = {
                chart: {
                    type: 'line',
                    width: 800,
                    height: 400,
                    foreColor: '#FBFBFB',
                    
                },
                /* Responsivity */
                /* responsive: [{
                    // breakepoint in px.... when the window size goes under this, the graph changes 
                    breakpoint: 1000,
                    // options for the changed responsive graph 
                    options: {
                        plotOptions: {
                            chart: {
                                horizontal: false;
                            }
                        },
                        legend: {
                            position: "bottom"
                        }
                    }
                }] */
                /*  */
                xaxis: {
                    type: 'datetime',
                    labels: {
                        datetimeFormatter: {
                            year: 'yyyy',
                            month: 'MMM yyyy',
                            day: 'dd MMM',
                            hour: 'HH:mm',
                        }
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return value + ' ' + '{{ $currencySymbol }}';
                        }
                    }
                },
                series: seriesData
            };

            var chart = new ApexCharts(document.querySelector('#monthlyByCategories'), options);
            chart.render();
        </script>
    </div>
    </div>
@endsection
