<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once('head.php'); ?>
</head>

<body id="body">


  <!--==========================
    Header
  ============================-->
  <?php include_once('header.php');?>
  <!-- #header -->

  <main id="main">
    <section id="contact" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Contact Us</h2>
          <p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>POSTAL ADDRESS</h3>
              <address>Karond – Gandhi Nagar By Pass Road, Bhopal, Madhya Pradesh 462038</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>Phone Number</h3>
              <p><a href="tel:+ 91 – 755 – 2734690">+ 91 – 755 – 2734690</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>Email</h3>
              <p><a href="mailto:info@trubainstitute.ac.in">info@trubainstitute.ac.in</a></p>
            </div>
          </div>

        </div>
      </div>

      <div class="container mb-4">
        <iframe  width="100%" height="380" frameborder="0" style="border:0" allowfullscreen src="https://maps.google.com/maps?q=truba&amp;t=m&amp;z=12&amp;output=embed&amp;iwloc=near" aria-label="truba" data-rocket-lazyload="fitvidscompatible" data-lazy-src="https://maps.google.com/maps?q=truba&amp;t=m&amp;z=12&amp;output=embed&amp;iwloc=near" class="lazyloaded" data-was-processed="true"></iframe>
      </div>

      <div class="container">
        <div class="form">
          <div id="sendmessage">Your message has been sent. Thank you!</div>
          <div id="errormessage"></div>
          <form action="" method="post" role="form" class="contactForm">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validation"></div>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
              <div class="validation"></div>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
              <div class="validation"></div>
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
          </form>
        </div>

      </div>
    </section><!-- #contact -->

  </main>

  <!--==========================
    Footer
  ============================-->
  <?php include_once('footer.php'); ?>
<!-- #footer -->

</body>
</html>
