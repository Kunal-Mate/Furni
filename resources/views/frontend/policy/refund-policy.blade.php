@extends('frontend.layout.app')
@section('content')
    <!-- Breadcrumb -->
    <!-- Page title -->
    <div class="container py-5 mb-2 mb-sm-3 mb-lg-4 mb-xl-5">
        <h1 class="h2 position-relative pb-sm-2 pb-md-3 text-center mt-4" style="z-index: 1021">Refund Policy</h1>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="policy-content">
                    <div class="highlight-box">
                        <h4 class="mb-3">10-Day Return Policy</h4>
                        <p class="mb-0">We offer a 10-Day Return Policy for our products. <strong>Terms and Conditions Applied</strong></p>
                    </div>


                    <h4 class=" mt-3">What Are Your Options?</h4>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="step-box h-100">
                                <h5 class="text-muted"><i class="bi bi-arrow-repeat text-primary me-2"></i> Parts Replacement</h5>
                                <p class="mb-0">If any part is damaged during transit or has a manufacturing defect, we'll send you a replacement free of cost.</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="step-box h-100">
                                <h5 class="text-muted"><i class="bi bi-currency-exchange text-primary me-2"></i> Return & Refund</h5>
                                <ul class="mb-0 ps-3">
                                    <li>Reverse pickup happens in 3–4 days (Shipping charges may apply based on locations)</li>
                                    <li>Refund is processed within 2–3 days once we receive our product to the warehouse, to your original payment method</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <h4 class="text-muted mt-4">How to Return a Product</h4>

                    <div class="step-box">
                        <p class="mb-2"><span class="step-number">1</span> Dismantle and securely pack the product in its original packaging.</p>
                    </div>

                    <div class="step-box">
                        <p class="mb-2"><span class="step-number">2</span> Share clear photos of the packed product with us.</p>
                    </div>

                    <div class="step-box">
                        <p class="mb-2"><span class="step-number">3</span> Our team will send you the return shipping label – just print and paste it on the box.</p>
                    </div>

                    <div class="warning-box">
                        <p class="mb-0"><strong>Important:</strong> Returns may be cancelled if proper photos aren't provided.</p>
                    </div>

                    <h4 class="text-muted mt-4">Returns Will Not Be Accepted For The Following Cases:</h4>
                    <ul>
                        <li>Comfort issues</li>
                        <li>Product doesn't meet expectations</li>
                        <li>Slight color differences (due to lighting or screen settings)</li>
                        <li>Minor size differences</li>
                        <li>Wrong color, product, size, or ordering during price changes/sales</li>
                    </ul>

                    <div class="highlight-box">
                        <h4 class="text-muted mt-4">Return Under Special Circumstances</h4>
                        <p>If you still wish to return under these conditions:</p>
                        <ul>
                            <li>Return shipping charges (up to ₹1000 per unit based on locations) will apply</li>
                            <li>Product must be packed securely in original packaging</li>
                            <li>Photo proof is mandatory</li>
                            <li>Our team will share shipping labels</li>
                            <li>Once a product has reached our warehouse and verified, refunds are processed within 2–3 days</li>
                        </ul>
                    </div>

                    <h4 class="text-muted mt-4">Order Cancellation Policy</h4>
                    <p>We understand that plans can change — here's how order cancellations work:</p>

                    <div class="step-box">
                        <p class="mb-2"><strong>Orders can only be cancelled before they are shipped from our warehouse.</strong></p>
                        <p class="mb-0">To request a cancellation, please reach out to our customer care team as soon as possible:</p>
                    </div>

                    <div class="contact-info text-center my-3">
                        <h5 class=" text-muted"><i class="fa-solid fa-phone me-2"></i> Call Us: +91 8433667509</h5>
                    </div>

                    <div class="warning-box">
                        <h4>Important Guidelines:</h4>
                        <ul class="mb-0">
                            <li>Once your order is processed or dispatched, we won't be able to cancel it or make any changes — including modifications to the product, color, or shipping address</li>
                            <li>If the order is refused at the time of delivery, return logistics charges (₹800–₹1500 based on locations) will be deducted from your refund, depending on your location and the platform used (Amazon, Flipkart, etc.)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
@endsection