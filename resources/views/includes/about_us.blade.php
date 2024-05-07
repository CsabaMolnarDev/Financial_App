@extends('layouts.app')
@section('content')
    <div class="container" style="margin-bottom: 3vh">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card bg-dark text-light">
                    <div class="card-header text-center">
                        <h3 class="card-title">The story of our project in short</h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Our little project is a web application designed for financial management.
                            We chose this idea because we wanted to create a project that we could both use in the future by
                            running it on a server and continue to develop as we please.
                            The choice of topic mainly stemmed from these aspects. On the other hand, we have always been
                            interested in finance.
                            We believe that this small project, as well as this application, even in its current state,
                            could provide a foundation for us and others in managing their finances and achieving their
                            financial goals.
                            We believe that if people are able to track their expenses even for a few months, significant
                            cost savings can be achieved.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
    <div class="container homeContainer">
        <div class="wrapper">
            <div class="carousel">
                <li class="card bg-dark text-light">
                    <div class="img"><img src="../storage/icons/calendarIcon.png"></div>
                    <div class="text-center">
                        <h4>24/7 access</h4>
                        <p>Our services are running day and night, in order to be able to support you
                            at any given time</p>
                    </div>
                </li>
                <li class="card bg-dark text-light">
                    <div class="img"><img src="../storage/icons/globeIcon.png"></div>
                    <div class="text-center">
                        <h4>Access anywere</h4>
                        <p>You can access our product from anywhere on the globe</p>
                    </div>
                </li>
                <li class="card bg-dark text-light">
                    <div class="img"><img src="../storage/icons/pinIcon.png"></div>
                    <div class="text-center">
                        <h4>Remember everything</h4>
                        <p>With the help of our product, you can easily track and manage your finances
                        </p>
                    </div>
                </li>
                <li class="card bg-dark text-light">
                    <div class="img"><img src="../storage/icons/familyIcon.png"></div>
                    <div class="text-center">
                        <h4>Family system</h4>
                        <p>You can create a group with your family, and you can manage the finances
                            together.</p>
                    </div>
                </li>
            </div>
        </div>
    </div>
    {{-- Contact us --}}
    <div class="container" style="margin-bottom: 3vh">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card bg-dark text-light">
                    <div class="card-header text-center">
                        <h3>Contact us here</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <ul>
                                    <p></p>
                                    <li>24/7 on email: laravelmybeloved@gmail.com</li>
                                </ul>
                            </div>
                            <div class="col-4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
    <script>
        const wrapper = document.querySelector(".wrapper");
        const carousel = document.querySelector(".carousel");
        const firstCardWidth = carousel.querySelector(".card").offsetWidth;
        const arrowBtns = document.querySelectorAll(".wrapper i");
        const carouselChildrens = [...carousel.children];
        let isDragging = false,
            isAutoPlay = true,
            startX, startScrollLeft, timeoutId;
        // Get the number of cards that can fit in the carousel at once
        let cardPerView = Math.round(carousel.offsetWidth / firstCardWidth);
        // Insert copies of the last few cards to beginning of carousel for infinite scrolling
        carouselChildrens.slice(-cardPerView).reverse().forEach(card => {
            carousel.insertAdjacentHTML("afterbegin", card.outerHTML);
        });
        // Insert copies of the first few cards to end of carousel for infinite scrolling
        carouselChildrens.slice(0, cardPerView).forEach(card => {
            carousel.insertAdjacentHTML("beforeend", card.outerHTML);
        });
        // Scroll the carousel at appropriate postition to hide first few duplicate cards on Firefox
        carousel.classList.add("no-transition");
        carousel.scrollLeft = carousel.offsetWidth;
        carousel.classList.remove("no-transition");
        // Add event listeners for the arrow buttons to scroll the carousel left and right
        arrowBtns.forEach(btn => {
            btn.addEventListener("click", () => {
                carousel.scrollLeft += btn.id == "left" ? -firstCardWidth : firstCardWidth;
            });
        });
        const dragStart = (e) => {
            isDragging = true;
            carousel.classList.add("dragging");
            // Records the initial cursor and scroll position of the carousel
            startX = e.pageX;
            startScrollLeft = carousel.scrollLeft;
        }
        const dragging = (e) => {
            if (!isDragging) return; // if isDragging is false return from here
            // Updates the scroll position of the carousel based on the cursor movement
            carousel.scrollLeft = startScrollLeft - (e.pageX - startX);
        }
        const dragStop = () => {
            isDragging = false;
            carousel.classList.remove("dragging");
        }
        const infiniteScroll = () => {
            // If the carousel is at the beginning, scroll to the end
            if (carousel.scrollLeft === 0) {
                carousel.classList.add("no-transition");
                carousel.scrollLeft = carousel.scrollWidth - (2 * carousel.offsetWidth);
                carousel.classList.remove("no-transition");
            }
            // If the carousel is at the end, scroll to the beginning
            else if (Math.ceil(carousel.scrollLeft) === carousel.scrollWidth - carousel.offsetWidth) {
                carousel.classList.add("no-transition");
                carousel.scrollLeft = carousel.offsetWidth;
                carousel.classList.remove("no-transition");
            }
            // Clear existing timeout & start autoplay if mouse is not hovering over carousel
            clearTimeout(timeoutId);
            if (!wrapper.matches(":hover")) autoPlay();
        }
        const autoPlay = () => {
            if (window.innerWidth < 800 || !isAutoPlay)
                return; // Return if window is smaller than 800 or isAutoPlay is false
            // Autoplay the carousel after every 2500 ms
            timeoutId = setTimeout(() => carousel.scrollLeft += firstCardWidth, 2500);
        }
        autoPlay();
        carousel.addEventListener("mousedown", dragStart);
        carousel.addEventListener("mousemove", dragging);
        document.addEventListener("mouseup", dragStop);
        carousel.addEventListener("scroll", infiniteScroll);
        wrapper.addEventListener("mouseenter", () => clearTimeout(timeoutId));
        wrapper.addEventListener("mouseleave", autoPlay);
    </script>
@endsection
