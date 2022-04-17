<!-- Freedom Fun USA Comic Con Registration App -->

<!-- Index Page -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact Form</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>

        <!-- Container Begin -->

        <div class="container my-5">

            <!-- Title Begin -->

            <div class="row justify-content-center">
                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-1">
                    <h1 class="display-4 fw-bold">Contact Us</h1>
                </div>
            </div>

            <!-- Title End -->

            <!-- Contact Form Begin -->

            <div class="row justify-content-start">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8 col-sm-12 bg-white mt-1 px-4 py-4">

                    <form id="contactForm" name="contactForm" method="POST" enctype="multipart/form-data" action="./process.php">
                        <div class="form-group my-3">
                            <label class="form-label" for="contactName">Name</label>
                            <input type="text" class="form-control" id="contactName" name="contactName" placeholder="Your Name">
                        </div>
                        <div class="form-group my-3">
                            <label class="form-label" for="contactEmail">Email Address</label>
                            <input type="email" class="form-control" id="contactEmail" name="contactEmail" placeholder="Your Email Address">
                        </div>
                        <div class="form-group my-3">
                            <label class="form-label" for="contactPhone">Phone Number</label>
                            <input type="text" class="form-control" id="contactPhone" name="contactPhone" placeholder="Your Phone Number">
                        </div>
                        <div class="form-group my-3">
                            <label class="form-label" for="contactMessage">Message</label>
                            <textarea class="form-control" id="contactMessage" name="contactMessage" rows="3" placeholder="Your Message"></textarea>
                        </div>

                        <div class="form-group my-3">
                            <label class="form-label" for="contactFile">Upload File</label>
                            <input class="form-control" type="file" name="contactFile" id="contactFile">
                        </div>
                        <div><p id="contactFileError"></p></div>

                        <div class="form-group my-3">
                            <?php
                                $capNumFirst = rand(1, 9);
                                $capNumSecond = rand(1, 9);
                                $capSum = (int) $capNumFirst + (int) $capNumSecond;
                                $capSumStr = strval($capSum);
                            ?>
                            <label class="form-label" for="contactCaptcha">Resolve</label>
                            <small class="form-text">What is <?php echo strval($capNumFirst); ?> + <?php echo strval($capNumSecond); ?>?</small>
                            <input type="text" class="form-control" id="contactCaptcha" name="contactCaptcha" placeholder="Answer">
                            <input class="form-control" type="hidden" id="contactCaptchaVal" name="contactCaptchaVal" value="<?php echo strval($capSumStr); ?>" readonly>
                        </div>
                        <div class="form-check my-3">
                            <input type="checkbox" class="form-check-input" id="contactTerms" name="contactTerms">
                            <label class="form-check-label" for="contactTerms">Agree to our Terms &amp; Conditions - <span><a href="./about.php">Read our Terms</a></span></label>
                        </div>
                        <div><p id="contactTermsError"></p></div>
                        <input type="submit" class="btn btn-primary btn-lg" name="contactFormSend" id="contactFormSend" value="Send" />
                    </form>
    
                </div>
            </div>

            <!-- Registration Form End -->

        </div>

        <!-- Container End -->

        <!-- Footer Begin -->

        <footer class="bg-white">
            <div class="container-fluid mt-3 pb-5">
                <div class="row justify-content-center">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 text-center rounded-3 p-5 border-top">
                        <p class="py-0 my-0 text-muted">&copy Copyrights <?php echo date('Y'); ?> | Contact Form | All rights Reserved</p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Footer End -->
        <script src="./assets/js/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="./assets/js/jquery.validate.min.js"></script>
		<script src="./assets/js/additional-methods.min.js"></script>
		<script src="./assets/js/main.js"></script>
    </body>
</html>