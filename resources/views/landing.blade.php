@extends('layouts.app')
@section('content')
    {{-- Section 1 --}}
    <section
        class="relative mb-4 mx-4 flex h-[600px] flex-col items-center justify-center bg-fixed overflow-clip rounded-3xl py-6 lg:h-[min(calc(100vh-2rem),2000px)]">
        <div class="z-30 flex flex-col gap-8 px-6 lg:w-[960px] lg:px-16">
            <h1 class="heading-xl text-center font-display font">Start tracking your finances today!</h1>
            <button
                class="bg-gradient-to-r from-orange-400 to-yellow-300 hover:from-yellow-300 hover:to-orange-400 
                border-2 border-gray-600 rounded-xl 
                ">Getting
                started</button>

        </div>
        <div class="bg-spending bg-fixed bg-no-repeat bg-cover bg-center">
        </div>
        <div
            class="flex bg-home min-h-screen bg-fixed bg-no-repeat bg-cover bg-center absolute left-0 top-0 z-20 h-full w-full opacity-90 rounded-lg">
        </div>
    </section>

    {{-- section 2 --}}
    <section
        class="relative m-4 flex h-[600px] flex-col items-center justify-center overflow-clip rounded-3xl py-6 lg:h-[min(calc(100vh-2rem),2000px)]">
        <div class="z-30 flex flex-col gap-8 px-6 text-white lg:w-[960px] lg:px-16">
            <h1 class="body-l text-center font-display">Our project is designed for financial management.
                We could help you to manage your finances in order for you to achieve your goals.
                By tracking your expenses, even for a few months, you can significantly save money.</h1>
        </div>
        <div class="bg-spending bg-fixed bg-no-repeat bg-cover bg-center">
        </div>
        <div
            class="absolute left-0 top-0 z-20 h-full w-full opacity-80 [background:_radial-gradient(125.76%_77.84%_at_77.74%_0%,_rgba(0,_0,_0,_0.00)_0%,_#000_100%)]">
        </div>
    </section>
    {{-- Section 3 --}}
    <div class="flex justify-center items-center bg-income min-h-screen bg-fixed bg-no-repeat bg-cover bg-center">
        <div class="card h-1/2 w-1/2 right-6 absolute border-2 border-gray-600">
            <div class="grid grid-cols-2 gap-10">
                <div class="bg-home flex bg-fixed bg-no-repeat bg-cover bg-center h-full"></div>
                <p class="card-text"> Our project is designed for financial management.
                    We could help you to manage your finances in order for you to achieve your goals.
                    By tracking your expenses, even for a few months, you can significantly save money.</p>
            </div>
        </div>
    </div>
    {{-- Section 4 --}}
    <div class="p-10">
        <h1 class="font-black text-6xl">Section four</h1>
    </div>
    {{-- Section 5 --}}
    <div class="flex justify-center items-center bg-home min-h-screen bg-fixed bg-no-repeat bg-cover bg-center rounded-lg">
        <h1 class="font-black text-6xl">Section five</h1>
    </div>
    {{-- Section 6 --}}
    <div class="p-10">
        <h1 class="font-black">content</h1>
    </div>
    {{-- 
This will be the text and some images that i will use up:

Content number 1
                            Our project is designed for financial management.
                            We could help you to manage your finances in order for you to achieve your goals.
                            By tracking your expenses, even for a few months, you can significantly save money.
Content number 2                    
                    We offer
                    A graph img
                    Graphs and statistics by chategorys to make it easier for you to see what you spend money on.
Content number 3
                    Img of the chategory add
                    Fully customizable categorys
Content number 4
                    <img src="../storage/icons/calendarIcon.png">
                    24/7 access in order to be able to support you at any given time.
Content number 5
                    <img src="../storage/icons/globeIcon.png">
                    You can access our product from anywhere on the globe

Content number 6
                    <img src="../storage/icons/pinIcon.png">
                    Set notifications to remind you to log your finances.
                        
Content number 7
                   <img src="../storage/icons/familyIcon.png">
                    You can create a group with your family, and you can manage your finances together.
Content number 8
                    Contact us here
                    laravelmybeloved@gmail.com
--}}
@endsection
