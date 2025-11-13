@extends('layouts.app')

@section("customCss")
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

@endsection
@section('content')
    <div class="container-fluid px-5">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-0">Bookings</h4>
                    </div>
                    <div class="col-3 text-center">
                        <a class="btn btn-primary" href="{{ route('booking.create') }}">
                            <i class="bi bi-plus-circle"></i> Add New Booking
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>There were some errors with your submission:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        <div class="property-list">
            <div class="card">

                <div class="card-body p-3">
                    <div class="d-flex justify-content-end mb-3">
                        <div class="col-8">
                            <form class="d-flex mb-3" role="search" method="GET" action="{{ route('booking.index') }}">
                                <div class="input-group">
                                    <!-- Search by name -->
                                    <input type="text" class="form-control border-primary" placeholder="Enter Name" name="q"
                                        value="{{ request('q') }}">

                                    <!-- Status filter -->
                                    <select name="status" class="form-control border-primary">
                                        <option value="" disabled selected>Filter By</option>
                                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>
                                            Booking Confirmed</option>
                                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                                            Booking Cancelled</option>
                                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                                            Payment Completed</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Payment
                                            Pending</option>
                                    </select>

                                    <!-- Property select (needed for enabling date picker) -->
                                    {{--
                                    <select id="propertyId" name="property_id" class="form-control border-primary">
                                        <option value="" selected disabled>Select Property</option>
                                        @foreach($properties as $property)
                                        <option value="{{ $property->id }}" {{ request('property_id')==$property->id ?
                                            'selected' : '' }}>
                                            {{ $property->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    --}}

                                    <!-- Check-in / Check-out picker -->
                                    <input type="text" id="checkInOutDate" name="checkin_checkout"
                                        class="form-control border-primary"
                                        placeholder="Select check-in and check-out date & time"
                                        value="{{ request('checkin_checkout') ?? '' }}">
                                    <button class="btn btn-outline-primary text-primary font-medium"
                                        type="submit">Search</button>
                                    <a href="{{ route('booking.index') }}"
                                        class="btn btn-outline-warning text-warning font-medium">Clear</a>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="table-responsive" style="overflow: visible;">
                        <table class="table align-middle text-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">Sr No</th>
                                    <th scope="col" class="text-center">Name</th>
                                    <th scope="col" class="text-center">Mobile</th>
                                    <th scope="col" class="text-center">CheckIn - CheckOut</th>
                                    <th scope="col" class="text-center">Booking</th>
                                    <th scope="col" class="text-center">Payment</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $index => $booking)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $booking->customerName }}</td>
                                        <td class="text-center">{{ $booking->customerPhone }}</td>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($booking->checkInDate)->format('d M Y, h:i A') }}
                                            <br>
                                            <strong>-</strong>
                                            {{ \Carbon\Carbon::parse($booking->checkOutDate)->format('d M Y, h:i A') }}
                                        </td>
                                        <td class="text-center">
                                            @if($booking->bookingStatus === 'confirmed')
                                                <span class="badge bg-success">Confirmed</span>
                                            @else
                                                <span class="badge bg-danger">Cancelled</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($booking->paymentStatus === 'completed')
                                                <span class="badge bg-success">Completed</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-light"
                                                    id="dropdownMenuButton{{ $booking->bookingId }}" type="button"
                                                    data-bs-toggle="dropdown">
                                                    <i class="ti ti-menu"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="dropdownMenuButton{{ $booking->bookingId }}">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('booking.edit', $booking->bookingId) }}">
                                                            <i class="fa fa-pen me-2 text-primary"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('booking.delete', $booking->bookingId) }}"
                                                            method="POST" class="delete-form m-0"
                                                            data-customer-name="{{ $booking->customerName }}">
                                                            @csrf
                                                            <button type="button" class="dropdown-item text-danger delete-btn">
                                                                <i class="fa fa-trash me-2"></i> Delete
                                                            </button>
                                                        </form>
                                                    </li>

                                                    <li>
                                                        <button type="button"
                                                            class="dropdown-item text-success send-notification-btn"
                                                            data-customer-name="{{ $booking->customerName }}"
                                                            data-customer-phone="{{ $booking->customerPhone }}"
                                                            data-customer-email="{{ $booking->customerEmail }}"
                                                            data-booking-id="{{ $booking->bookingId }}">
                                                            <i class="fa fa-bell me-2 text-success"></i> Send Notification
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            No bookings found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-body-secondary pb-0">
                    {{-- Pagination --}}
                    {{ $bookings->links() ?? '' }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJs')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const allBookings = @json($bookings || []);
            const propertySelect = document.getElementById('propertyId');
            const checkInOutInput = document.getElementById('checkInOutDate');

            let flatpickrInstance;

            function initFlatpickr(disabledRanges = [], enabled = false) {
                if (flatpickrInstance) flatpickrInstance.destroy();

                const formattedRanges = disabledRanges.map(range => ({
                    from: new Date(range.from),
                    to: new Date(range.to)
                }));

                flatpickrInstance = flatpickr("#checkInOutDate", {
                    mode: "range",
                    dateFormat: "d-m-Y",
                    minDate: "today",
                    disable: formattedRanges,
                    clickOpens: enabled,
                    onChange: function (selectedDates) {
                        if (selectedDates.length === 2) {
                            const checkIn = selectedDates[0];
                            const checkOut = selectedDates[1];

                            if (checkOut <= checkIn) {
                                alert('Check-out must be after check-in');
                                flatpickrInstance.clear();
                            }
                        }
                    }
                });

                checkInOutInput.disabled = !enabled;
            }

            // Initially disabled
            initFlatpickr([], true);

            if (propertySelect) {
                propertySelect.addEventListener('change', function () {
                    const selectedProperty = this.value;
                    if (!selectedProperty) {
                        initFlatpickr([], false);
                        return;
                    }

                    // Filter bookings for selected property
                    const propertyBookings = allBookings.filter(b => b.propertyId == selectedProperty);

                    const disabledRanges = propertyBookings.map(b => ({
                        from: b.checkInDate,
                        to: b.checkOutDate
                    }));

                    initFlatpickr(disabledRanges, true);
                });
            }
        });
    </script>

    @if($whatsappUrl)
        <script>
            // Open WhatsApp immediately when page loads
            window.open("{{ $whatsappUrl }}", '_blank');

            // Optional: Clean URL by removing the query parameter
            if (window.history.replaceState) {
                const url = new URL(window.location);
                url.searchParams.delete('openWhatsApp');
                window.history.replaceState({}, document.title, url);
            }
        </script>
    @endif
    <script>
        // Handle send notification button
        document.querySelectorAll('.send-notification-btn').forEach(button => {
            button.addEventListener('click', function () {
                const name = this.dataset.customerName;
                const bookingId = this.dataset.bookingId;

                Swal.fire({
                    title: `Send notification to ${name}`,
                    html: `
                                                                                                                                                                                                                                                                                                        <div class="text-center">
                                                                                                                                                                                                                                                                                                            <p class="mb-3">Choose how you'd like to notify:</p>
                                                                                                                                                                                                                                                                                                            <div style="display: flex; justify-content: center; gap: 25px;">
                                                                                                                                                                                                                                                                                                                <button id="whatsappBtn" class="btn btn-success" style="display:flex; align-items:center; gap:8px; padding:10px 20px;">
                                                                                                                                                                                                                                                                                                                    Whatsapp
                                                                                                                                                                                                                                                                                                                </button>
                                                                                                                                                                                                                                                                                                                <button id="emailBtn" class="btn btn-danger" style="display:flex; align-items:center; gap:8px; padding:10px 20px;">
                                                                                                                                                                                                                                                                                                                   Gmail
                                                                                                                                                                                                                                                                                                                </button>
                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                        <button id="swalCloseBtn" class="btn-close position-absolute top-0 end-0 m-3" aria-label="Close"></button>
                                                                                                                                                                                                                                                                                                    `,
                    showConfirmButton: false,
                    showCancelButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        // Handle WhatsApp click
                        document.getElementById('whatsappBtn').addEventListener('click', () => {
                            Swal.close();
                            window.open(`/booking/send-whatsapp/${bookingId}`, '_blank');
                        });

                        // Handle Email click
                        document.getElementById('emailBtn').addEventListener('click', () => {
                            Swal.close();
                            window.open(`/booking/send-email/${bookingId}`, '_blank');
                        });

                        // Handle custom close button
                        document.getElementById('swalCloseBtn').addEventListener('click', () => {
                            Swal.close();
                        });
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Handle delete button clicks
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const form = this.closest('.delete-form');
                    const customerName = form.dataset.customerName;

                    Swal.fire({
                        title: 'Are you sure?',
                        html: `You are about to delete the booking for <strong>${customerName}</strong>.<br>This action cannot be undone!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Show success message if exists
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            // Show error message if exists
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#d33'
                });
            @endif
                                                                                                                                                                                                                                                            });

    </script>

@endsection