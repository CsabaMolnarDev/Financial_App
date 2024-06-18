@extends('layouts.app')
@section('content')
    {{-- Section 1 --}}
    <section
        class="relative mb-4 mx-4 flex h-[600px] flex-col items-center justify-center 
        overflow-clip rounded-3xl py-6 lg:h-[min(calc(100vh-2rem),2000px)] border-2 border-gray-600">
        <div class="flex flex-col z-10 gap-8 px-6 lg:w-[960px] lg:px-16">
            <h1 class="text-center font-display font-slogen text-teal-500">Start tracking your finances today!
            </h1>
            <button
                class="bg-gradient-to-r from-orange-400 to-yellow-300 hover:from-yellow-300 hover:to-orange-400 
                border-2 border-gray-600 rounded-xl">
                Getting started</button>
        </div>
        <video class="flex absolute z-0 w-full h-full overflow-hidden bg-no-repeat bg-cover object-cover opacity-90"
            autoplay="" loop="" playsinline="" disablepictureinpicture muted preload
            src="../storage/videos/welcome.mp4">
        </video>
    </section>

    {{-- section 2 --}}
    <section
        class="relative mb-4 mx-4 flex h-[600px] flex-col items-center justify-center 
        overflow-clip rounded-3xl py-6 lg:h-[min(calc(100vh-2rem),2000px)] border-2 border-gray-600">
        <div class="flex z-10 flex-col gap-8 px-6 lg:w-[960px] lg:px-16">
            <h1 class="heading-xl text-center font-display font text-light">
                Our project is designed for financial management.
                We could help you to manage your finances in order for you to achieve your goals.
                By tracking your expenses, even for a few months, you can significantly save money.
            </h1>
        </div>
        <div
            class="flex z-0 bg-income min-h-screen bg-fixed bg-no-repeat bg-cover bg-center absolute left-0 top-0 h-full w-full opacity-90">
        </div>
    </section>
    {{-- section 3 --}}
    <section
        class="relative mb-4 mx-4 flex h-[600px] flex-col items-center justify-center 
        overflow-clip rounded-3xl py-6 lg:h-[min(calc(100vh-2rem),2000px)] border-2 border-gray-600">
        <div class="z-10 flex flex-col gap-8 px-6 lg:w-[960px] lg:px-16">
            <h1 class="heading-xl text-center font-display font text-light">
                We provide
            </h1>
            <h1 class="heading-xl text-center font-display font text-light">
                Graphs, a table and a calendar, to make it easier to track and manage finances.
            </h1>
            <h1 class="heading-xl text-center font-display font text-light">
                Statistics by categories to make it easier for you to track where your money is going.
            </h1>
            <h1 class="heading-xl text-center font-display font text-light">
                Fully customizable categories on top of our basic ones.
            </h1>
            <h1 class="heading-xl text-center font-display font text-light">
                Safety for your data.
            </h1>
        </div>
        <div
            class="flex bg-spending min-h-screen bg-fixed bg-no-repeat bg-cover bg-center absolute left-0 top-0 z-0 h-full w-full opacity-90">
        </div>
    </section>
    {{-- section 4 --}}
    <section
        class="relative mb-4 mx-4 flex h-[600px] flex-col items-center justify-center 
        overflow-clip rounded-3xl py-6 lg:h-[min(calc(100vh-2rem),2000px)] border-2 border-gray-600">
        <div class="z-10 flex flex-col gap-8 px-6 lg:w-[960px] lg:px-16">
            <h1 class="heading-xl text-center font-display font text-light">
                With us you can
            </h1>
            <h1 class="heading-xl text-center font-display font text-light">
                Log and track your finances at any given time from anywhere on the globe.
            </h1>
            <h1 class="heading-xl text-center font-display font text-light">
                Set notifications to remind you to log your finances.
            </h1>
            <h1 class="heading-xl text-center font-display font text-light">
                Create a group with your family, to log and track your finances together.
            </h1>
        </div>
        <div
            class="flex bg-settings min-h-screen bg-fixed bg-no-repeat bg-cover bg-center absolute left-0 top-0 z-0 h-full w-full opacity-90">
        </div>
    </section>
    {{-- footer --}}
    <div
        class="bg-dark bg-cover bg-center relative mx-4 flex h-[200px] flex-col items-center justify-center 
        overflow-clip rounded-3xl py-6 lg:h-[min(calc(30vh-2rem),2000px)] border-2 border-gray-600">
        <div class="flex flex-col gap-8 text-center justify-center align-center">
            <h1 class="heading-xl text-center font-display font text-light">
                Contact us here
            </h1>
            <h1 class="heading-xl text-center font-display font text-light">
                laravelmybeloved@gmail.com
            </h1>
            <p class="heading-xl text-center font-display font text-gray-400">Copyright @</p>
        </div>
    </div>
@endsection
