<footer class="footer bg-dark pb-4 py-lg-5" data-bs-theme="dark">
  <div class="container pt-5 pt-lg-4 mt-sm-2 mt-md-3">
    <div class="row pb-5">

      <!-- Subscription + Social account links -->
      <div class="col-md col-xl-8 order-md-1">
        <div class="text-center px-sm-4 mx-auto" style="max-width: 568px">
          <h3 class="pb-1 mb-2">Stay in touch with us</h3>
          <p class="fs-sm text-body pb-2 pb-sm-3">Receive the latest updates about our products &amp; promotions</p>
          <form class="needs-validation position-relative" novalidate="">
            <input type="email" class="form-control form-control-lg rounded-pill text-start" placeholder="You email"
              aria-label="Your email address" required="">
            <div class="invalid-tooltip bg-transparent p-0">Please enter you email address!</div>
            <button type="submit"
              class="btn btn-icon fs-xl btn-dark rounded-circle position-absolute top-0 end-0 mt-1 me-1"
              aria-label="Submit your email address" data-bs-theme="light">
              <i class="ci-arrow-up-right"></i>
            </button>
          </form>
          <div class="d-flex justify-content-center gap-2 pt-4 pt-md-5 mt-1 mt-md-0">
            <a class="btn btn-icon fs-base btn-outline-secondary border-0"
              href="https://www.facebook.com/share/1ASaLrpif8/" target="_blank" data-bs-toggle="tooltip"
              data-bs-template="<div class=&quot;tooltip fs-xs mb-n2&quot; role=&quot;tooltip&quot;><div class=&quot;tooltip-inner bg-transparent text-white p-0&quot;></div></div>"
              title="Facebook" aria-label="Follow us on Facebook">
              <i class="ci-facebook"></i>
            </a>
            <a class="btn btn-icon fs-base btn-outline-secondary border-0"
              href="https://www.instagram.com/sitwell_chairss?igsh=MTkxYXo4eTNydG5icQ==" target="_blank"
              data-bs-toggle="tooltip"
              data-bs-template="<div class=&quot;tooltip fs-xs mb-n2&quot; role=&quot;tooltip&quot;><div class=&quot;tooltip-inner bg-transparent text-white p-0&quot;></div></div>"
              title="Instagram" aria-label="Follow us on Instagram">
              <i class="ci-instagram"></i>
            </a>
            <a class="btn btn-icon fs-base btn-outline-secondary border-0"
              href="https://www.linkedin.com/company/sitwell-chairs/" target="_blank" data-bs-toggle="tooltip"
              data-bs-template="<div class=&quot;tooltip fs-xs mb-n2&quot; role=&quot;tooltip&quot;><div class=&quot;tooltip-inner bg-transparent text-white p-0&quot;></div></div>"
              title="Linkedin" aria-label="Follow us on Linkedin">
              <i class="ci-linkedin"></i>
            </a>
            <a class="btn btn-icon fs-base btn-outline-secondary border-0" href="mailto:info@sitwellchairs.in"
              target="_blank" data-bs-toggle="tooltip"
              data-bs-template="<div class=&quot;tooltip fs-xs mb-n2&quot; role=&quot;tooltip&quot;><div class=&quot;tooltip-inner bg-transparent text-white p-0&quot;></div></div>"
              title="Linkedin" aria-label="Contact us on Mail">
              @
            </a>
          </div>
        </div>
      </div>

      <!-- Category links -->
      <div class="col-md-auto col-xl-2 text-center order-md-2 pt-4 pt-md-0 ">
        <h6 class="mb-3">Quick Links</h6>
        <ul class="nav d-inline-flex flex-md-column justify-content-center align-items-center gap-md-2">
          <li class="animate-underline my-1 mx-2 m-md-0">
            <a class="nav-link d-inline-flex fw-normal p-0 animate-target" href="#!">Home</a>
          </li>
          <li class="animate-underline my-1 mx-2 m-md-0">
            <a class="nav-link d-inline-flex fw-normal p-0 animate-target" href="#!">About Us</a>
          </li>
          <li class="animate-underline my-1 mx-2 m-md-0">
            <a class="nav-link d-inline-flex fw-normal p-0 animate-target" href="#!" href="#" data-bs-toggle="modal"
              data-bs-target="#contactModal">Contact us</a>
          </li>
          <li class="animate-underline my-1 mx-2 m-md-0">
            <a class="nav-link d-inline-flex fw-normal p-0 animate-target" href="{{ route('location.redirect') }}"
              target="_blank">Locations</a>
          </li>
        </ul>
      </div>


      <!-- Customer links -->
      <div class="col-md-auto col-xl-2 text-center order-md-4 pt-3 pt-md-0">
        <h6 class="mb-3">Help</h6>

        <ul class="nav d-inline-flex flex-md-column justify-content-center align-items-center gap-md-2">
          <li class="animate-underline my-1 mx-2 m-md-0">
            <a class="nav-link d-inline-flex fw-normal p-0 animate-target" href="{{ route('privacy-policy') }}">Privacy
              Policy</a>
          </li>
          <li class="animate-underline my-1 mx-2 m-md-0">
            <a class="nav-link d-inline-flex fw-normal p-0 animate-target" href="{{ route('terms-of-service') }}">Terms
              and Services</a>
          </li>
          <li class="animate-underline my-1 mx-2 m-md-0">
            <a class="nav-link d-inline-flex fw-normal p-0 animate-target"
              href="{{ route('shipping-policy') }}">Shipping Policy</a>
          </li>
          <li class="animate-underline my-1 mx-2 m-md-0">
            <a class="nav-link d-inline-flex fw-normal p-0 animate-target" href="{{ route('refund-policy') }}">Return
              and Refund</a>
          </li>

        </ul>
      </div>
    </div>
    <!-- Contact Us Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 rounded-3">

          <div class="modal-header">
            <h5 class="modal-title">Contact Us</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
            <form id="contactForm" action="" method="POST">
              @csrf

              <div class="mb-3">
                <label class="form-label">Your Name</label>
                <input type="text" name="name" class="form-control" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Your Email</label>
                <input type="email" name="email" class="form-control" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Your Message</label>
                <textarea name="message" rows="4" class="form-control" required></textarea>
              </div>

              <button type="submit" class="btn btn-success w-100">
                Send Message
              </button>
            </form>

            <!-- Success Message -->
            @if(session('success'))
              <div class="alert alert-success mt-3">
                {{ session('success') }}
              </div>
            @endif
          </div>

        </div>
      </div>
    </div>


    <!-- Copyright -->
    <p class="fs-xs text-body text-center pt-lg-4 mt-n2 mt-md-0 mb-0">
      © All rights reserved. Made by <span class="animate-underline"><a
          class="animate-target text-white text-decoration-none" href="http://ourfutureinfotech.com" target="_blank"
          rel="noreferrer">Our Future Infotech</a></span>
    </p>
  </div>
</footer>