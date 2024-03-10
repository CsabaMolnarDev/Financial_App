{{-- here we can track our spendings --}}
@extends('layouts.app')
@section('content')
<img id="regFormPicture" src="../storage/pictures/spending.jpg" alt="background" title="background">
<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8 text-center" id="financeButton">
           <button class="btn btn-outline-danger" onclick="window.location=' {{ url("/spendingCreate") }} '">Add new spending</button>
        </div>
        <div class="col-2"></div>
    </div>
</div>

<div class="container">
    <div class="row">
       {{--  @foreach($finances as $item)
        <div class="col-4">
            <div class="card bg-dark text-info text-center" id="financeCard">
                <div class="row-3">
                    <h5 class="card-title">{{$item->name}}</h5>
                </div>
                <div class="row-3">
                    <p class="card-text">{{$item->type}}</p>
                </div>
                <div class="row-3">
                    <p class="card-text">{{$item->price}}</p>
                </div>
                <div class="row-3">
                    <p class="card-text">{{$item->time}}</p>
                </div>       
            </div>         
        </div>
     
        @endforeach --}}
        @if ($finances->isNotEmpty())
        <h1 id="sum"></h1>
        <div class="graph-border">
            <div id="chart"><h1>Spending by categories</h1></div>
            <div id ="monthlyByCategories"></div>
            <h1 id="avarage"></h1>
        </div>
        @endif
       
        
        
        <script>
           /*  TODO:  use ajax maybe */

           //user associated finances php array to json string
            var financesData = @json($finances);
            console.log(financesData);
            //user associated categories php array tp json string
            var categoriesData = {!! json_encode($categories) !!};
           /*  console.log(categoriesData); */
            var categoryPrices = {};
            /* iterates over each finance record, retrieves the category name, calculates the price */
            financesData.forEach(function(finance){
                var categoryId = finance.category_id;
                var categoryName = categoriesData[categoryId];
                var price = finance.price;
                /* checks if the category has been already added */
                if (!categoryPrices[categoryName]) {
                    categoryPrices[categoryName] = price;
                }
                else{
                    categoryPrices[categoryName] += price;
                }
            });
            /* passing the data to the apexcharts */
            var seriesData = [];
            for (var categoryName in categoryPrices) {
                seriesData.push({
                    x: categoryName,
                    y: categoryPrices[categoryName]
                });
            }

            /* configure apexcharts options */
            var options = {
                chart: {
                    type: 'pie',
                    width: 300, 
                    height: 200, 
                },
                labels: Object.keys(categoryPrices),
                series: Object.values(categoryPrices),
            };
            /* render apexcharts */
            var chart = new ApexCharts(document.querySelector('#chart'), options)
            chart.render();
        </script>
         
        <script>
            var prices = financesData.map(function(item){
                return item.price;
            });
            var sum = 0;
            for (let i = 0; i < prices.length; i++) {
                sum += prices[i];
                
            }
        
            
            let avarage = 'Avarage spending: ' + Math.round(sum/prices.length) + ' ' + '{{ $currencySymbol }}';
            sum = 'Spending in total: ' + sum + ' ' + '{{ $currencySymbol }}';
            document.getElementById('sum').innerHTML = sum;
            document.getElementById('avarage').innerHTML = avarage;
            /* console.log(sum/prices.length); */
        
        </script>
        <script>
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
        
            var options = {
                chart: {
                    type: 'line',
                    width: 800,
                    height: 400,
                },
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


