@extends('layouts.app')
@section('content')
    {{-- Image --}}
    <script>
        document.body.style.backgroundImage = "url('../storage/pictures/incomePic.jpg')";
    </script>
    <div class="container">
        {{-- Add new button --}}
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 text-center" id="financeButton">
                <button class="btn btn-success" onclick="window.location=' {{ url('/incomeCreate') }} '">Add new
                    income</button>
            </div>
            <div class="col-lg-3"></div>
        </div>
        @if ($finances->isNotEmpty())
            <div class="card bg-dark " id="financeCard">
                {{-- Header --}}
                <div class="card-header">
                    <div class="col-lg-12 text-light">
                        <h1>Incomes by categories</h1>
                    </div>
                </div>
                {{-- Body --}}
                <div class="card-body">
                    {{-- graphs --}}
                    <div class="row">
                        {{-- Pie --}}
                        <div class="col-lg-4">
                            <div id="chart"></div>
                        </div>
                        {{-- Line --}}
                        <div class="col-lg-8">
                            <div id ="monthlyByCategories"></div>
                        </div>
                    </div>
                </div>
                {{-- Footer --}}
                <div class="card-footer text-light">
                    <div class="row">
                        <div class="col-lg-6">
                            <h1 id="avarage"></h1>
                        </div>
                        <div class="col-lg-6">
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
                        <table class="table table-info" id="incomeTable" data-page-length='10'>
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Monthly</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($finances as $item)
                                    <tr>
                                        {{-- @dd($categories[$item->category_id]) --}}
                                        <td id="date" item_id="{{ $item->id }}">{{ $item->time }}</td>
                                        <td id="category_id" item_id="{{ $item->id }}">{{ $item->category->name }}</td>
                                        <td id="name" item_id="{{ $item->id }}">{{ $item->name }}</td>
                                        <td id="price" item_id="{{ $item->id }}">{{ $item->price }}</td>
                                        <td>
                                            @if ($item->monthly)
                                                <form id="monthlyForm{{ $item->id }}"
                                                    action="{{ route('deleteMonthly', ['id' => $item->id]) }}"
                                                    method="GET">
                                                    @csrf
                                                    <input type="checkbox" name="monthly" id="monthly" checked
                                                        onchange="submitForm({{ $item->id }})">
                                                </form>
                                            @else
                                                <form id="monthlyForm{{ $item->id }}"
                                                    action="{{ route('createMonthly', ['id' => $item->id]) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="checkbox" name="monthly" id="monthly"
                                                        onchange="submitForm({{ $item->id }})">
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!$item->monthly)
                                                <form action="{{ route('deleteFinance', ['id' => $item->id]) }}"
                                                    method="GET">
                                                    @csrf
                                                    <button class="btn btn-danger" type="submit">Delete</button>
                                                </form>
                                            @endif
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
        var categoryPrices = {};
        for (let i = 0; i < financesData.length; i++) {
            const element = financesData[i];
            var categoryName = element.category.name;
            var price = element.price;
            /* checks if the category has been already added */
            if (!categoryPrices[categoryName]) {
                categoryPrices[categoryName] = price;
            } else {
                categoryPrices[categoryName] += price;
            }
        };
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
        /* Avg income */
        let avarage = 'Avarage income: ' + Math.round(sum / prices.length) + ' ' + '{{ $currencySymbol }}';
        /* Sum income */
        sum = 'income in total: ' + sum + ' ' + '{{ $currencySymbol }}';
        document.getElementById('sum').innerHTML = sum;
        document.getElementById('avarage').innerHTML = avarage;
        /* console.log(sum/prices.length); */
        var monthlyCategoryPrices = {};
        financesData.forEach(function(finance) {
            var categoryName = finance.category.name;
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
                show: false
            },
            labels: Object.keys(categoryPrices),
            series: Object.values(categoryPrices),
            /* Here we can adjust the setting to make it responsive */
            responsive: [{
                // breakepoint in px.... when the window size goes under this, the graph changes
                breakpoint: 1200,
                // options for the changed responsive graph
                options: {
                    plotOptions: {
                        chart: {
                            horizontal: false
                        }
                    },
                    chart: {
                        type: 'pie',
                        width: 300,
                        height: 300,
                    },
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
                        if (value != null) {
                            return value + ' ' + '{{ $currencySymbol }}';
                        } else {
                            return '0 ' + '{{ $currencySymbol }}';
                        }
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
            var table = $('#incomeTable').DataTable({
                scrollY: 400, // Makes the table scrollable
                search: {
                    caseInsensitive: false // Sets the search to be case-sensitive
                }
            });

            // Event handler for double-clicking on table cells for editing
            $('#incomeTable tbody').on('dblclick', 'td:not(:last-child)', function(obj) {
                var cell = $(this);
                //console.log(obj.target.id);
                var oldValue = cell.text();
                console.log(obj.target)
                if (obj.target.id == "name") {
                    cell.html('<input type="text" class="form-control" value="' + oldValue + '" item_id="' +
                        obj.target.item_id + '">');
                    cell.find('input').focus();
                } else if (obj.target.id == "price") {
                    cell.html('<input type="number" class="form-control" value="' + oldValue +
                        '" item_id="' + obj.target.item_id + '">');
                    cell.find('input').focus();
                } else if (obj.target.id == "category_id") {
                    cell.html('<select class="form-control" item_id="' + obj.target.item_id + '">' +
                        '@for ($i = 0; $i < count($categories); $i++)' +
                        '<option value="{{ $i }}" id="{{ $categories[$i]->id }}">{{ $categories[$i]->name }}</option>' +
                        '@endfor' +
                        '</select>');
                    cell.find('select').focus();
                } else if (obj.target.id == "date") {
                    cell.html('<input type="date" class="form-control" value="' + oldValue + '" item_id="' +
                        obj.target.item_id + '">');
                    cell.find('input').focus();
                }
            });

            // Event handler for detecting Enter key press while editing cells
            $('#incomeTable tbody').on('keydown', 'input', function(event) {
                var cell = $(this).closest('td');
                var keyCode = event.keyCode || event.which;
                console.log(cell)
                console.log(cell[0].attributes.item_id.value)
                if (keyCode === 13) { // Enter key pressed
                    saveCellEdit(cell); // Call function to save cell edit
                }
            });
            $('#incomeTable tbody').on('keydown', 'select', function(event) {
                var cell = $(this).closest('td');
                var keyCode = event.keyCode || event.which;
                if (keyCode === 13) { // Enter key pressed
                    saveEditedCell(cell); // Call function to save cell edit
                }
            });

            // Event handler for detecting blur event on input fields (cell editing finished)
            $('#incomeTable tbody').on('blur', 'input', function() {
                var cell = $(this).closest('td');
                if (cell.prevObject[0].type != "checkbox") {
                    saveCellEdit(cell); // Call function to save cell edit
                }
            });
            $('#incomeTable tbody').on('blur', 'select', function() {
                var cell = $(this).closest('td');
                saveEditedCell(cell); // Call function to save cell edit
            });

            // Function to save edited cell data
            function saveCellEdit(cell) {
                var newValue = cell.find('input').val(); // Get new value from input field
                cell.text(newValue); // Update cell text with new value

                // Get row data and cell index for sending to server
                var rowData = table.row(cell.closest('tr')).data();
                var rowId = cell[0].attributes.item_id.value;
                var columnIndex = cell[0].attributes.id.value;
                console.log(rowData);
                // Send edited data to server via AJAX
                sendEditData(rowId, columnIndex, newValue);
            }

            function saveEditedCell(cell) {
                var newValue = cell.find('select').val(); // Get new value from input field
                var categories = {!! json_encode($categories->toArray()) !!};
                //console.log(categories[newValue]);
                cell.text(categories[newValue].name); // Update cell text with new value

                // Get row data and cell index for sending to server
                var rowData = table.row(cell.closest('tr')).data();
                var rowId = cell[0].attributes.item_id.value;
                console.log(financesData[0].id)
                var columnIndex = cell[0].attributes.id.value;
                console.log(categories[newValue].id);
                // Send edited data to server via AJAX
                sendEditData(rowId, columnIndex, categories[newValue].id);
            }


            // Function to send edited data to server via AJAX
            function sendEditData(rowId, columnIndex, newValue) {
                $.ajax({
                    url: '/editIncomeValue', // Replace with your route URL
                    method: 'POST',
                    data: {
                        "row": rowId,
                        "column": columnIndex,
                        "value": newValue,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.refresh) {
                                location.reload();
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error({
                            xhr,
                            status,
                            error
                        });
                        // Handle error response from server if needed
                    }
                });
            }


            // Event handler to prevent button click event from propagating
            $('#incomeTable tbody').on('click', 'button', function(event) {
                event.stopPropagation();
            });
        });

        function submitForm(id) {
            var monthly_id = 'monthlyForm' + id;
            console.log(monthly_id);
            document.getElementById(monthly_id).submit();
        }
    </script>
@endsection
