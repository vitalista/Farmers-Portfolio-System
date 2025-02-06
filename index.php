<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baliwag Agriculture</title>
    <link href="assets/img/agri-logo.png" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
    <link rel="shortcut icon" href="Agri Logo.png">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Akshar:300,400,500,600,700&amp;subset=devanagari,latin-ext&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alfa+Slab+One&amp;display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Bevan:400,400i&amp;subset=latin-ext,vietnamese&amp;display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>
<?php include 'backend/functions.php' ?>

<body>
    <nav class="navbar navbar-expand-md bg-body pt-3" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="./login/">
                <img src="assets/img/agri-logo.png" alt="Logo" style="height: 50px;">
                <span style="font-family: 'Roboto' , 'serif';">Baliwag Agriculture</span>
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navcol-2">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol-2">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#announcement">Announcement</a></li>
                    <li class="nav-item"><a class="nav-link" href="#aboutus">About Us</a></li>
                    <?php
                    if(is_dir('registration/')){
                    ?>
                    <li class="nav-item"><a class="nav-link" href="registration/">Registration</a></li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="text-center">
        <div class="slideshow">
            <div class="slide" style="background-image:url('assets/img/agri%20bg1.1.jpg');"></div>
            <div class="slide" style="background-image:url('assets/img/agri%20bg2.1.jpg');"></div>
            <div class="slide" style="background-image:url('assets/img/agri%20bg3.1.jpg');"></div>
            <div class="slide" style="background-image:url('assets/img/agri%20bg4.1.jpg');"></div>
            <div class="slide" style="background-image:url('assets/img/agri%20bg5.1.jpg');"></div>
            <div class="slide" style="background-image:url('assets/img/agri%20bg6.1.jpg');"></div>
        </div>
    </div>
    <div class="header-title">
        <h1 data-aos="" data-aos-duration="500" data-aos-delay="100"
            style="font-family: 'Alfa Slab One', serif;letter-spacing: 4px;">City Agricultural Office of Baliwag
        </h1>
        <p data-aos="" data-aos-duration="450" data-aos-delay="100" style="font-size:15px;"><span
                class="btn-close-white"
                style="color: var(--bs-body-bg);text-shadow: 2px 1px 12px var(--bs-emphasis-color);">The City
                Agriculture Office is the lead agency of the Local Government of Baliwag City that responsible for
                the community agricultural growth and development in terms of rice and vegetable farming, fishery,
                and livestock raising.</span></p><a class="btn btn-success btns" role="button" data-aos=""
            data-aos-duration="500" data-aos-delay="200" href="#mission">Learn More</a>
    </div>
    </div>

    <div class="container my-5">
        <div class="row text-center">
            <div class="col"><img src="assets/img/baliwag_Gov_logo-removebg-preview.png" style="width: 70px;"></div>
            <div class="col"><img src="assets/img/CICT_baliwag_logo-removebg-preview.png" style="width: 70px;"></div>
            <div class="col"><img src="assets/img/Agri%20Logo.png" style="width: 70px;"></div>
            <div class="col"><img src="assets/img/ani_at_kita_logo-removebg-preview.png" style="width: 70px;"></div>
            <div class="col"><img src="assets/img/DOA_logo-removebg-preview.png" style="width: 70px;"></div>
        </div>
        <div class="row">

            <div class="text-center col-md-6 mt-5" id="mission">
                <h1>Mission</h1>
                <p>The Local Government of Baliwag shall implement policies and
                    programs that will promote a fully functional e-government, a business-friendly environment,
                    competitive quality of education, and active people participation through a professional
                    bureaucracy with government personnel willing to go the extra mile in public
                    service.</p>
            </div>

            <div class="text-center col-md-6 mt-5">
                <h1>Vision</h1>
                <p>The City of Baliwag is the center for trade and commerce,
                    education, and technological advancement within the region with God-centered, empowered, and
                    healthy people living in a sustainable environment under pro-active governance.</p>
            </div>

        </div>
    </div>

    <h3 class="text-center" data-aos="" data-aos-duration="500" data-aos-delay="200" id="aboutus"
        style="margin-top: 70px;margin-bottom: 85px;background: #99e7cf;margin-left: 10px;margin-right: 10px;padding: 6px;border-top-right-radius: 100px;border-bottom-left-radius: 100px;">
        Service</h3>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 mt-2">
                <div><img data-aos="t" data-aos-duration="500" data-aos-delay="100"
                        src="assets/img/Screenshot_2024-11-15_165354-removebg-preview.png" style="width: 70px;">
                    <h5 data-aos="t" data-aos-duration="500" data-aos-delay="100">Resources Assistance</h5>
                    <p data-aos="t" data-aos-duration="500" data-aos-delay="100">Providing farmers with essential
                        tools like seeds, fertilizers, and livestock to boost productivity and sustainability.</p>
                </div>
            </div>
            <div class="col-md-3 mt-2">
                <div><img data-aos="t" data-aos-duration="500" data-aos-delay="200"
                        src="assets/img/Screenshot_2024-11-15_170215-removebg-preview.png" style="width: 70px;">
                    <h5 data-aos="t" data-aos-duration="500" data-aos-delay="200">Farmers Support</h5>
                    <p data-aos="t" data-aos-duration="500" data-aos-delay="200">Providing expert advice,
                        hands-on training, and seminars to help farmers adopt modern techniques and improve their
                        practices for better productivity and sustainability.</p>
                </div>
            </div>
            <div class="col-md-3 mt-2">
                <div><img data-aos="t" data-aos-duration="500" data-aos-delay="300"
                        src="assets/img/Screenshot_2024-11-15_170616-removebg-preview.png" style="width: 70px;">
                    <h5 data-aos="t" data-aos-duration="500" data-aos-delay="300">Financial Aid</h5>
                    <p data-aos="t" data-aos-duration="500" data-aos-delay="300">Offering programs such as cash
                        assistance to help farmers manage production costs and improve their livelihoods.</p>
                </div>
            </div>
            <div class="col-md-3 mt-2">
                <div><img data-aos="t" data-aos-duration="500" data-aos-delay="400"
                        src="assets/img/Screenshot_2024-11-15_170822-removebg-preview.png" style="width: 70px;">
                    <h5 data-aos="t" data-aos-duration="500" data-aos-delay="400">Community Development</h5>
                    <p data-aos="t" data-aos-duration="500" data-aos-delay="400">Promoting agricultural programs
                        and partnerships to strengthen rural communities and ensure food security.</p>
                </div>
            </div>
        </div>
    </div>

    <h3 class="text-center" id="programs-header" data-aos="" data-aos-duration="500" data-aos-delay="200">
        Our Programs&nbsp;
    </h3>

    <div class="container" data-aos="" data-aos-duration="500" data-aos-delay="200">
        <div class="row">
            <div class="col hover-card" id="program-card">
                <div>
                    <div class="card hover-card" id="seeds-card">
                        <div class="gradient-overlay"></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="seeds-image"></div>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-center align-items-center">
                                    <div>
                                        <h1 id="seeds-title">Seeds Distribution</h1>
                                        <p class="text-center">The Seeds Distribution Program delivers high-quality
                                            seeds to farmers, enhancing crop diversity and boosting yields for better
                                            harvests. This initiative directly contributes to agricultural productivity
                                            and supports food security within the community.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" data-aos="" data-aos-duration="500" data-aos-delay="200">
        <div class="row">
            <div class="col hover-card" id="program-card">
                <div>
                    <div class="card hover-card" id="cash-assistance-card">
                        <div class="gradient-overlay"></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 d-flex justify-content-center align-items-center">
                                    <div>
                                        <h1 id="cash-assistance-title">Cash Assistance</h1>
                                        <p class="text-center">The Cash Assistance Program of the Agricultural Office of
                                            Baliwag provides farmers with financial support to help cover production
                                            costs and stabilize their income during challenging times. This aid empowers
                                            farmers to invest in their farms and promotes economic resilience in the
                                            agricultural sector.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div id="cash-assistance-image"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" data-aos="" data-aos-duration="500" data-aos-delay="200">
        <div class="row">
            <div class="col hover-card" id="program-card">
                <div>
                    <div class="card hover-card" id="livestock-card">
                        <div class="gradient-overlay"></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="livestock-image"></div>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-center align-items-center">
                                    <div>
                                        <h1 id="livestock-title">Livestock Distribution</h1>
                                        <p class="text-center">The livestock distribution program of the Agricultural
                                            Office of Baliwag greatly supports farmers by providing them with essential
                                            resources to improve productivity and boost their livelihoods. This
                                            initiative not only enhances farm income but also strengthens food security
                                            within the community.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container" data-aos="" data-aos-duration="500" data-aos-delay="200">
        <div class="row">
            <div class="col hover-card" id="program-card">
                <div>
                    <div class="card hover-card" id="fertilizer-card">
                        <div class="gradient-overlay"></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 d-flex justify-content-center align-items-center">
                                    <div>
                                        <h1 id="fertilizer-title">Fertilizer Distribution</h1>
                                        <p class="text-center">The Fertilizer Distribution Program ensures farmers have
                                            access to essential nutrients for their crops, promoting healthier growth
                                            and increased yield. By supporting soil health, this program strengthens
                                            sustainable farming practices and improves overall harvest quality.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div id="fertilizer-image"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container" data-aos="" data-aos-duration="500" data-aos-delay="200">
        <div class="row">
            <div class="col hover-card" id="program-card">
                <div>
                    <div class="card hover-card" id="machine-distribution-card">
                        <div class="gradient-overlay"></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="machine-distribution-image"></div>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-center align-items-center">
                                    <div>
                                        <h1 id="machine-distribution-title">Machine Distribution</h1>
                                        <p class="text-center">The Machine Distribution Program provides farmers with
                                            modern agricultural equipment, enabling them to increase efficiency and
                                            reduce manual labor. Access to these machines allows farmers to work more
                                            productively, ultimately enhancing their farm outputs and livelihoods.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h3 class="text-center" data-aos="" id="announcement"
        style="margin-top: 70px;margin-bottom: 30px;background: #99e7cf;margin-left: 10px;margin-right: 10px;padding: 6px;border-top-right-radius: 100px;border-bottom-left-radius: 100px;">
        Announcement</h3>

    <div class="container">
        <div class="bg-white shadow p-3 rounded mb-5">
            <ul id="myTab1" class="nav nav-tabs text-center flex-column flex-sm-row nav-pills with-arrow"
                role="tablist">
                <li class="nav-item flex-sm-fill" role="presentation">
                    <a id="home1-tab" class="nav-link active text-uppercase font-weight-bold mr-sm-3 rounded-0 border"
                        role="tab" data-bs-toggle="tab" aria-controls="home1" aria-selected="true" href="#home1">
                        Eligibility
                    </a>
                </li>
                <li class="nav-item flex-sm-fill" role="presentation">
                    <a id="profile1-tab" class="nav-link text-uppercase font-weight-bold mr-sm-3 rounded-0 border"
                        role="tab" data-bs-toggle="tab" aria-controls="profile1" aria-selected="false" href="#profile1">
                        Upcoming Programs
                    </a>
                </li>
                <li class="nav-item flex-sm-fill" role="presentation">
                    <a id="contact1-tab" class="nav-link text-uppercase font-weight-bold rounded-0 border" role="tab"
                        data-bs-toggle="tab" aria-controls="contact1" aria-selected="false" href="#contact1">
                        History
                    </a>
                </li>
            </ul>

            <div id="myTab1Content" class="tab-content">
                <!-- Eligibility Tab Content -->
                <div id="home1" class="tab-pane active fade px-4 py-5 show" role="tabpanel" aria-labelledby="home1-tab">
                    <div class="row">
                        <div class="col">
                            <section style="margin-top: -44px;">
                                <div class="container mt-5">
                                    <form>
                                        <div class="row mb-3">

                                            <style>
                                                .select2-container .select2-selection--single {
                                                    padding-bottom: 40px;
                                                }

                                                .select2-container--default .select2-selection--single .select2-selection__rendered {
                                                    line-height: 40px;
                                                }
                                            </style>
                                            <form method="get">
                                                <!-- Select Program Input -->
                                                <div class="col-md-6">
                                                    <label for="programs">Programs</label>
                                                    <select id="programs" class="mySelect" name="program">
                                                        <option selected disabled>-- Select Program --</option>
                                                        <?php
                                                        $programs = getAll('programs');
                                                        if (mysqli_num_rows($programs) > 0) {
                                                            foreach ($programs as $item) {
                                                        ?>
                                                                <option value="<?= $item['id'] ?>"><?= $item['program_name'] ?> -
                                                                    <?= $item['program_type'] ?>
                                                                </option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <!-- Select Barangay Input -->
                                                <div class="col-md-6">
                                                    <label for="brgys">Barangays</label>
                                                    <select id="brgys" class="mySelect" name="brgy">
                                                        <option selected disabled>-- Select Barangay --</option>
                                                        <?php
                                                        $barangays = getAll('barangays');
                                                        if (mysqli_num_rows($barangays) > 0) {
                                                            foreach ($barangays as $item) {
                                                        ?>
                                                                <option value="<?= $item['brgy'] ?>"><?= $item['brgy'] ?>
                                                            <?php
                                                            }
                                                        }
                                                            ?>
                                                    </select>
                                                </div>
                                            </form>
                                            <!-- Search Button -->
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>

                    <!-- Results Table -->
                    <div class="row">
                        <div class="col">
                            <h4 class="card-header mb-2"><?= isset($_GET['brgy']) ? "Barangay: " . $_GET['brgy'] : "Barangay Name"; ?></h4>
                            <div class="table-responsive card" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>FFRS Code</th>
                                            <th>Farmer's Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_GET['program']) || isset($_GET['brgy'])) {

                                            $distributions = getAll('distributions', $_GET['program'], $_GET['brgy']);
                                            if (mysqli_num_rows($distributions) > 0) {
                                                foreach ($distributions as $item) {
                                        ?>
                                                    <tr>
                                                        <td><?= $item['ffrs_system_gen']; ?></td>
                                                        <td><?= $item['first_name']; ?> <?= $item['middle_name']; ?> <?= $item['last_name']; ?></td>
                                                    </tr>
                                        <?php
                                                }
                                            }
                                        } else {
                                            // Assuming the table has 5 columns, set the colspan to 5
                                            echo "<tr>
                                                    <td colspan='2' style='text-align: center;'>No Information Available</td>
                                                  </tr>";
                                        }                                        
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Programs Tab Content -->
                <div id="profile1" class="tab-pane fade px-4 py-5" role="tabpanel" aria-labelledby="profile1-tab">

                    <div class="row">
                        <div class="col">
                            <div class="table-responsive card" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Program Name</th>
                                            <th>Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $programs = getPrograms('pending_programs');
                                            if (mysqli_num_rows($programs) > 0) {
                                                foreach ($programs as $item) {
                                            ?>
                                           <tr>
                                           <td><?= $item['program_name'];?></td>
                                           <td><?= $item['program_type'];?></td>
                                           </tr>
                                            <?php
                                                }
                                            }else{
                                                // Assuming the table has 5 columns, set the colspan to 5
                                                echo "<tr>
                                                        <td colspan='2' style='text-align: center;'>No Information Available</td>
                                                      </tr>";
                                            }  
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- History Tab Content -->
                <div id="contact1" class="tab-pane fade px-4 py-5" role="tabpanel" aria-labelledby="contact1-tab">
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive card" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Program Name</th>
                                            <th>Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            $programs = getPrograms('expired_programs');
                                            if (mysqli_num_rows($programs) > 0) {
                                                foreach ($programs as $item) {
                                            ?>
                                           <tr>
                                           <td><?= $item['program_name'];?></td>
                                           <td><?= $item['program_type'];?></td>
                                           </tr>
                                            <?php
                                                }
                                            }else {
                                                // Assuming the table has 5 columns, set the colspan to 5
                                                echo "<tr>
                                                        <td colspan='2' style='text-align: center;'>No Information Available</td>
                                                      </tr>";
                                            }  
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="card bg-light">
        <div class="card-body">
            <div class="container" id="contact">
                <div class="row">

                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                        <iframe style="width: 100%; height: 100%;"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1831.9475178017026!2d120.88828377229225!3d14.958342100000007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3396fff8d6a424cb%3A0x17eda8bc86055bb3!2sBaliwag%20Municipal%20Agriculture%20Office!5e1!3m2!1sen!2sph!4v1731513512990!5m2!1sen!2sph"
                            style="border:0;" allowfullscreen=""></iframe>
                    </div>
                    <div class="col-md-6">
                        <form method="post">
                            <h3 class="text-center">Contact us</h3>
                            <div class="mb-3"><input class="form-control" type="text" name="name" placeholder="Name"
                                    required></div>
                            <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Email"
                                    required></div>
                            <div class="mb-3"><textarea class="form-control" name="message" placeholder="Message"
                                    rows="6" required></textarea></div>
                            <div class="d-flex justify-content-end mb-3"><button class="btn btn-primary" type="submit">Send</button></div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="col d-flex"> -->
                    <div class="col-md-3">
                        <span>Additional Contact Information</span>
                        <div class="d-grid mt-2">
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    viewBox="0 0 20 20" fill="none">
                                    <path
                                        d="M2 3C2 2.44772 2.44772 2 3 2H5.15287C5.64171 2 6.0589 2.35341 6.13927 2.8356L6.87858 7.27147C6.95075 7.70451 6.73206 8.13397 6.3394 8.3303L4.79126 9.10437C5.90756 11.8783 8.12168 14.0924 10.8956 15.2087L11.6697 13.6606C11.866 13.2679 12.2955 13.0492 12.7285 13.1214L17.1644 13.8607C17.6466 13.9411 18 14.3583 18 14.8471V17C18 17.5523 17.5523 18 17 18H15C7.8203 18 2 12.1797 2 5V3Z"
                                        fill="currentColor"></path>
                                </svg> 09-123-4567-89</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <span>Social Media</span>
                        <ul class="list-inline mt-2">
                            <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container py-4">
            <div class="row justify-content-center" style="background: rgba(25,135,84,0.15); padding: 30px;">
                <div class="col-md-4 text-center">
                    <h3>Partners With</h3>
                    <div>
                        <img src="assets/img/baliwag_Gov_logo-removebg-preview.png" style="width: 50px;">
                        <img src="assets/img/ani_at_kita_logo-removebg-preview.png" style="width: 60px;">
                        <img src="assets/img/DOA_logo-removebg-preview.png" style="width: 50px;">
                        <img src="assets/img/CICT_baliwag_logo-removebg-preview.png" style="width: 60px;">
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <h3>About</h3>
                    <ul class="list-unstyled">
                        <li><a class="link-secondary" href="#">Baliwag Official Website</a></li>
                    </ul>
                </div>
                <div class="col-md-4 text-center">
                    <img src="assets/img/agri-logo.png" style="height: 50px;">
                    <p class="text-muted">City Agricultural Office Of Baliwag</p>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p class="text-muted mb-0">Copyright © 2024</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="assets/js/script.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.mySelect').select2({
                width: '100%'
            });

        });
    </script>
</body>

</html>