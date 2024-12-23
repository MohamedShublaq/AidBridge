<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&#038;display=swap" rel="stylesheet" />
    <!-- style -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    <!-- Font Awesome-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Aid Bridge</title>
</head>

<body>

    <div id="loader" class="loader">
        <div class="spinner"></div>
    </div>

    <a class="up" href="#header"><i class="fas fa-angle-double-up"></i></a>

    <!-- Start Header Section -->
    <div class="header" id="header">
        <div class="container">
            <div class="website-logo">
                <img src="{{ asset('img/logo.jpg') }}" class="professional-logo" alt="Logo">
            </div>
            <nav>
                <i class="fas fa-bars toggle-menu"></i>
                <ul class="">
                    <li><a class="active">Home</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
            <a href="#register" class="register-bttn">Login As</a>
        </div>
    </div>
    <!-- End Header Section -->

    <!-- Start Landing Section -->
    <div class="landing" id="home">
        <div class="overlay"></div>
        <div class="text">
            <div class="content">
                <h2>
                    Hello World!<br />
                    We Are Humanitarian Aid Windows.
                </h2>
                <p>
                    We are a platform dedicated to enhancing humanitarian efforts by providing innovative solutions for
                    efficient charity operations and data management. Our mission is to connect resources with those in
                    need and foster collaboration between local and international institutions, creating a lasting
                    positive impact.
                </p>
            </div>
        </div>
    </div>
    <!-- End Landing Section -->

    <!-- Start Services Section -->
    <div class="services" id="services">
        <div class="container">
            <div class="special-heading">
                <h3>SERVICES</h3>
                <p>Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Mauris blandit aliquet elit, eget
                    tincidunt.</p>
            </div>
            <div class="services-content">
                <div class="serv">
                    <i class="fas fa-desktop fa-3x"></i>
                    <div class="text">
                        <h4>SERVICE 1</h4>
                        <p>Curabitur arcu erat, accumsan id imperdiet et,
                            porttitor at sem. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur
                            aliquet quam.</p>
                    </div>
                </div>
                <div class="serv">
                    <i class="fas fa-pencil-ruler fa-3x"></i>
                    <div class="text">
                        <h4>SERVICE 2</h4>
                        <p>Curabitur arcu erat, accumsan id imperdiet et,
                            porttitor at sem. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur
                            aliquet quam.</p>
                    </div>
                </div>
                <div class="serv">
                    <i class="fas fa-cog fa-3x"></i>
                    <div class="text">
                        <h4>SERVICE 3</h4>
                        <p>Curabitur arcu erat, accumsan id imperdiet et,
                            porttitor at sem. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur
                            aliquet quam.</p>
                    </div>
                </div>
                <div class="serv">
                    <i class="fas fa-camera fa-3x"></i>
                    <div class="text">
                        <h4>SERVICE 4</h4>
                        <p>Curabitur arcu erat, accumsan id imperdiet et,
                            porttitor at sem. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur
                            aliquet quam.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Services Section -->

    <!-- Start Design Features Section -->
    <div class="design-features">
        <div class="overlay"></div>
        <div class="text">
            <div class="content">
                <h3>OUR DESIGN COMES WITH...</h3>
                <ul>
                    <li><i class="fas fa-desktop"></i>
                        <p>Responsive Design</p>
                    </li>
                    <li><i class="fas fa-desktop"></i>
                        <p>Modern And Clean Design</p>
                    </li>
                    <li><i class="fas fa-desktop"></i>
                        <p>Clean Code</p>
                    </li>
                    <li><i class="fas fa-desktop"></i>
                        <p>Browser Friendly</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Design Features Section -->

    <!-- Start About Section  -->
    <div class="about" id="about">
        <div class="container">
            <div class="special-heading">
                <h3>ABOUT US</h3>
                <p>We are a platform dedicated to enhancing humanitarian contributions by leveraging technology to
                    support charitable organizations and individuals in need. We offer innovative solutions for
                    efficient and transparent data management and charity operations. Our mission is to connect
                    resources with deserving communities, fostering collaboration between local and international
                    institutions. Our vision is to create a sustainable positive impact that improves quality of life.
                    We strive to be a trusted partner for everyone committed to serving humanity.</p>
            </div>
        </div>
    </div>
    <!-- Start End Section  -->

    <!-- Start Stats Section -->
    <div class="stats">
        <div class="overlay"></div>
        <div class="container">
            <div class="box">
                <i class="fas fa-mug-hot"></i>
                <div class="number">{{ $aidsCount }}</div>
                <p>Aids</p>
            </div>
            <div class="box">
                <i class="far fa-folder"></i>
                <div class="number">{{ $civiliansCount }}</div>
                <p>Civilians</p>
            </div>
            <div class="box">
                <i class="far fa-envelope"></i>
                <div class="number">{{ $donorsCount }}</div>
                <p>Donors</p>
            </div>
            <div class="box">
                <i class="fas fa-trophy"></i>
                <div class="number">{{ $ngosCount }}</div>
                <p>NGOs</p>
            </div>
        </div>
    </div>
    <!-- End Stats Section  -->




    {{-- Login As Section  --}}
    <div class="register" id="register" style="margin-bottom: 30px">
        <div class="container">
            <div class="special-heading">
                <h3>Login As</h3>
                <p>Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.
                    Mauris blandit aliquet elit, eget tincidunt.</p>
            </div>
            <div class="content">

                <div class="features-imgs">
                    <a href="{{route('showLogin' , 'civilian')}}" class="feature">
                        <h5>Civilian</h5>
                        <img src="{{ asset('img/civilian.jpg') }}" alt="Civilian" />
                    </a>
                    <a href="{{route('showLogin' , 'donor')}}" class="feature">
                        <h5>Donor</h5>
                        <img src="{{ asset('img/donor.jpeg') }}" alt="Donor" />
                    </a>
                    <a href="{{route('showLogin' , 'ngo')}}" class="feature">
                        <h5>NGO</h5>
                        <img src="{{ asset('img/ngo.jpg') }}" alt="NGO" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- End Register As Section  --}}


    <!-- Start subscribe Section -->
    <div class="subscribe">
        <div class="overlay"></div>
        <div class="container">
            <form>
                <i class="far fa-envelope fa-lg"></i>
                <input type="email" name="" id="" placeholder="Your Email">
                <input type="button" value="subscribe">
            </form>
            <p>Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Mauris blan dit aliquet elit, eget
                tincidunt.</p>
        </div>
    </div>
    <!-- End subscribe Section -->

    <!-- Start Contact Section -->
    <div class="contact" id="contact">
        <div class="container">
            <div class="special-heading">
                <h3>CONTACT US</h3>
                <p>Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.
                    Mauris blandit aliquet elit, eget tincidunt.</p>
            </div>
            <div class="content">
                <form action="{{ route('contact') }}" method="POST">
                    @csrf
                    <input class="main-input" type="text" name="name" id="name" placeholder="Your Name" required>
                    <input class="main-input" type="email" name="email" id="email" placeholder="Your Email" required>
                    <input class="main-input" type="text" name="phone" id="phone" placeholder="Your Phone" required>
                    <textarea class="main-input" name="body" id="body" cols="30" rows="10"
                        placeholder="Your Message" required></textarea>
                    <input type="submit" value="SEND MESSAGE">
                </form>
                <div class="info">
                    <h5>GET IN TOUCH</h5>
                    <span class="phone">{{ $setting->email }}</span>
                    <span class="phone">{{ $setting->phone }}</span>
                    <h5>WHERE WE ARE</h5>
                    <address>
                        {{ $setting->street }}
                        <br>
                        {{ $setting->city }}
                        <br>
                        {{ $setting->country }}
                    </address>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact Section -->

    <!-- Start Footer Section -->
    <div class="footer">
        <div class="overlay"></div>
        <div class="container">
            <div class="website-logo">
                <img src="{{ asset('img/logo.jpg') }}" class="professional-logo" alt="Logo">
            </div>
            <p>WE ARE SOCIAL</p>
            <div class="social-icons">
                <a href="{{ $setting->facebook }}"><i class="fab fa-facebook-f"></i></a>
                <a href="{{ $setting->twitter }}"><i class="fab fa-twitter"></i></a>
                <a href="{{ $setting->instagram }}"><i class="fab fa-instagram"></i></a>
                <a href="{{ $setting->linkedin }}"><i class="fab fa-linkedin"></i></a>
            </div>
            <p class="copyright">
                © 2025 <span>{{ config('app.name') }} </span>All Right Reserved
            </p>
        </div>
    </div>
    <!-- End Footer Section -->
</body>
</html>
<script>
    window.onload = function () {
        // Hide the loader once the page has fully loaded
        document.getElementById('loader').style.display = 'none';
    };
</script>

