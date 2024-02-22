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
        <div id="chart">

        </div>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
           /*  TODO:  use ajax maybe */

           //user associated finances php array to json string
            var financesData = @json($finances);
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
                },
                labels: Object.keys(categoryPrices),
                series: Object.values(categoryPrices),
            };
            /* render apexcharts */
            var chart = new ApexCharts(document.querySelector('#chart'), options)
            chart.render();
        </script>
    
    </div>
</div>
@endsection


