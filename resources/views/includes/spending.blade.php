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
                <button class="btn btn-outline-success" onclick="window.location=' {{ url('/spendingCreate') }} '">Add new
                    spending</button>
            </div>
            <div class="col-3"></div>
        </div>
        @if ($finances->isNotEmpty())
            <div class="card bg-dark " id="financeCard">
                {{-- Header --}}
                <div class="card-header">
                    <div class="col-12 text-light">
                        <h1>Spendings by categories</h1>
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
                <div class="card-footer text-light">
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
    </div>
    @if ($finances->isNotEmpty())
        <div class="container text-center">
            <div class="row">
                <div class="card bg-dark text-light" id="financeCard">
                    <div class="table-responsive">
                        <table class="table table-info" id="spendingTable" data-page-length='10'>
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($finances as $item)
                                    <tr>
                                        <td>{{ $item->time }}</td>
                                        <td>{{ $item->category_id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>
                                            <form action="{{ route('deleteFinance', ['id' => $item->id]) }}" method="GET">
                                                @csrf
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script>
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
        /* Graphs: */
        /* Pie graph */
        var options = {
            chart: {
                type: 'pie',
                width: 400,
                height: 400,
                /* Fontcolor */
                foreColor: '#FBFBFB',
            },
            /* Sets the color of the pie slices */
            /* fill: {
                colors: ['#F44336', '#E91E63', '#9C27B0']
            }, */
            dataLabels: {
                style: {
                    colors: ['#F44336', '#E91E63', '#9C27B0']
                }
            },
            plotOptions: {
                bar: {
                    horizontal: true
                }
            },
            /* % on the pie */
            dataLabels: {
                enabled: true
            },
            /* Size of the border between the pie slices */
            stroke: {
                width: 2,
                colors: ["#fff"]
            },
            /* Categories list */
            legend: {
                position: "right",
                verticalAlign: "top",
                containerMargin: {
                    left: 35,
                    right: 35,
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
        /* Line graph */
        var options = {
            chart: {
                type: 'line',
                width: 700,
                height: 400,
                /* Font color */
                foreColor: '#FBFBFB',
            },
            dataLabels: {
                enabled: false
            },
            /* Theme */
            /* theme: {
                mode:'light',
            }, */
            /* toolbar */
            chart: {
                toolbar: {
                    show: true,
                    offsetX: 0,
                    offsetY: 0,
                    tools: {
                        download: true,
                        selection: true,
                        zoom: true,
                        zoomin: true,
                        zoomout: true,
                        pan: true,
                        reset: true | '<img src="/static/icons/reset.png" width="20">',
                        customIcons: []
                    },
                    export: {
                        csv: {
                            filename: "finances",
                            columnDelimiter: ',',
                            headerCategory: 'category',
                            headerValue: 'value',
                            dateFormatter(timestamp) {
                                return new Date(timestamp).toDateString()
                            }
                        },
                        svg: {
                            filename: "finances",
                        },
                        png: {
                            filename: "finances",
                        }
                    },
                    autoSelected: 'zoom'
                },
            },
            /* Mouse hower over data - pop-up informtion window color */
            tooltip: {
                theme: 'dark',
            },
            /* X line (bottom of the graphicon) */
            xaxis: {
                type: 'datetime',
                labels: {
                    show: true,
                    datetimeFormatter: {
                        year: 'yyyy',
                        month: 'MMM yyyy',
                        day: 'dd MMM',
                        hour: 'HH:mm',
                    }
                }
            },
            /* Y line (left of the graphicon) */
            yaxis: {
                labels: {
                    show: true,
                    formatter: function(value) {
                        return value + ' ' + '{{ $currencySymbol }}';
                    }
                }
            },
            /* The data that we gain from DB */
            series: seriesData
        };
        /* Create the chart */
        var chart = new ApexCharts(document.querySelector('#monthlyByCategories'), options);
        chart.render();
        /* JQUERRY Table */
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#spendingTable').DataTable({
                scrollY: 400, // Makes the table scrollable
                search: {
                    caseInsensitive: false // Sets the search to be case-sensitive
                }
            });

            // Event handler for double-clicking on table cells for editing
            $('#spendingTable tbody').on('dblclick', 'td:not(:last-child)', function() {
                var cell = $(this);
                var oldValue = cell.text();
                cell.html('<input type="text" class="form-control" value="' + oldValue + '">');
                cell.find('input').focus();
            });

            // Event handler for detecting Enter key press while editing cells
            $('#spendingTable tbody').on('keydown', 'input', function(event) {
                var cell = $(this).closest('td');
                var keyCode = event.keyCode || event.which;
                if (keyCode === 13) { // Enter key pressed
                    saveCellEdit(cell); // Call function to save cell edit
                }
            });

            // Event handler for detecting blur event on input fields (cell editing finished)
            $('#spendingTable tbody').on('blur', 'input', function() {
                var cell = $(this).closest('td');
                saveCellEdit(cell); // Call function to save cell edit
            });

            // Function to save edited cell data
            function saveCellEdit(cell) {
                var newValue = cell.find('input').val(); // Get new value from input field
                cell.text(newValue); // Update cell text with new value

                // Get row data and cell index for sending to server
                var rowData = table.row(cell.closest('tr')).data();
                var rowId = rowData.id;
                var columnIndex = cell.index();

                // Send edited data to server via AJAX
                sendEditData(rowId, columnIndex, newValue);
            }

            // Function to send edited data to server via AJAX
            function sendEditData(rowId, columnIndex, newValue) {
                $.ajax({
                    url: '/editSpendingValue', // Replace with your route URL
                    method: 'POST',
                    data: {
                        id: rowId,
                        column: columnIndex,
                        value: newValue,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        console.log(response);
                        // Handle success response from server if needed
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle error response from server if needed
                    }
                });
            }

            // Event handler to prevent button click event from propagating
            $('#spendingTable tbody').on('click', 'button', function(event) {
                event.stopPropagation();
            });
        });
    </script>
@endsection
