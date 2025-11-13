@extends('layouts.app')

@section('content')
<div class="container-fluid px-5">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <h4 class="fw-semibold mb-0">Add New Booking</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form id="bookingForm" method="POST" action="{{ route('booking.store') }}">
                @csrf

                {{-- Error handling --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Property Details --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="propertyId" class="form-label">Property</label>
                        <select class="form-select" id="propertyId" name="propertyId" required>
                            <option value="">Select Property</option>
                            @foreach($properties as $property)
                            <option value="{{ $property->propertyId }}">{{ $property->propertyName }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="checkInDate" class="form-label">Check-In Date & Time</label>
                        <input type="text" name="checkInDate" id="checkInDate" class="form-control"
                            placeholder="Select Check-In Date & Time">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="checkOutDate" class="form-label">Check-Out Date & Time</label>
                        <input type="text" name="checkOutDate" id="checkOutDate" class="form-control"
                            placeholder="Select Check-Out Date & Time">
                    </div>
                </div>

                {{-- Booking Info --}}
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="noOfGuests" class="form-label">No. of Guests</label>
                        <input type="number" class="form-control" id="noOfGuests" name="noOfGuests"
                            placeholder="Enter number of guests">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="bookingAmount" class="form-label">Booking Amount (₹)</label>
                        <input type="text" class="form-control" id="bookingAmount" name="bookingAmount"
                            placeholder="0.00" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="paymentStatus" class="form-label">Payment Status</label>
                        <select class="form-select" id="paymentStatus" name="paymentStatus">
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>

                <hr>

                {{-- Installments Section --}}
                <h5 class="mb-3">Installments</h5>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle" id="installmentTable">
                        <thead class="table-light">
                            <tr>
                                <th>Installment Amount (₹)</th>
                                <th>Payment Method</th>
                                <th>Payment Received At</th>
                                <th>Transaction ID</th>
                                <th width="60">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Rows added dynamically --}}
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-outline-primary mb-4" id="addInstallmentRow">
                    + Add Installment
                </button>

                <hr>

                {{-- Customer Info --}}
                <h5>Customer Information</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="customerName" class="form-label">Customer Name</label>
                        <input type="text" class="form-control" id="customerName" name="customerName"
                            placeholder="Enter customer name" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="customerEmail" class="form-label">Customer Email</label>
                        <input type="email" class="form-control" id="customerEmail" name="customerEmail"
                            placeholder="Enter customer email" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="customerPhone" class="form-label">Customer Phone</label>
                        <input type="text" class="form-control" id="customerPhone" name="customerPhone"
                            placeholder="Enter 10-digit phone" maxlength="10" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="note" class="form-label">Notes</label>
                    <textarea class="form-control" id="note" name="note" rows="3"
                        placeholder="Any special requests or comments"></textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('booking.index') }}" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('customJs')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const allBookings = @json($bookings);
        const allProperties = @json($properties);

        let selectedProperty = null;
        const paymentStatus = document.getElementById("paymentStatus");
        const checkInInput = document.getElementById('checkInDate');
        const checkOutInput = document.getElementById('checkOutDate');
        const propertySelect = document.getElementById('propertyId');
        const noOfGuestsInput = document.getElementById('noOfGuests');
        const bookingAmountInput = document.getElementById('bookingAmount');
        let previousBookingAmount = bookingAmountInput.value; // store initial
        let checkInPicker, checkOutPicker;

        // ========== INSTALLMENT LOGIC ==========
        const tableBody = document.querySelector('#installmentTable tbody');
        const addRowBtn = document.getElementById('addInstallmentRow');

        function getTotalInstallmentAmount() {
            let total = 0;
            tableBody.querySelectorAll('.installment-amount').forEach(input => {
                const val = parseFloat(input.value) || 0;
                total += val;
            });
            return total;
        }

        function getRemainingAmount() {
            const bookingAmount = parseFloat(bookingAmountInput.value) || 0;
            const totalPaid = getTotalInstallmentAmount();
            const remaining = bookingAmount - totalPaid;
            return remaining < 0 ? 0 : remaining;
        }
        let installmentIndex = 0; // global counter

        function createRow() {
            const remaining = getRemainingAmount();
            if (remaining <= 0) {
                Swal.fire({
                    icon: "info",
                    title: "All Installments Added!",
                    text: "Total installments already cover the full booking amount.",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK",
                    customClass: {
                        popup: 'swal-wide'
                    }
                });
                return;
            }

            const index = installmentIndex++; // use this as the index
            // Prevent creating more rows if full amount already covered
            paymentStatus.value = "completed";

            const row = document.createElement('tr');

           row.innerHTML = `
        <td>
            <input type="number" step="0.01"
                name="installments[${index}][amount]"
                class="form-control installment-amount"
                placeholder="Amount" value="${remaining.toFixed(2)}" required>
        </td>
        <td>
            <select name="installments[${index}][paymentMethod]"
                class="form-select payment-method" required>
                <option value="">Select</option>
                <option value="cash">Cash</option>
                <option value="upi">UPI</option>
                <option value="bank_transfer">Bank Transfer</option>
                <option value="debit_card">Debit Card</option>
                <option value="credit_card">Credit Card</option>
            </select>
        </td>
        <td>
            <select name="installments[${index}][paymentFor]"
                class="form-select paymentFor" required>
                <option value="">Select</option>
                <option value="booking">Pre-Booking</option>
                <option value="checkIn">Check-In</option>
                <option value="checkOut">Check-Out</option>
            </select>
        </td>
        <td>
            <input type="text"
                name="installments[${index}][transactionId]"
                class="form-control transaction-id"
                placeholder="Enter Transaction ID" disabled>
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-danger btn-sm remove-row">×</button>
        </td>
    `;

            const paymentSelect = row.querySelector('.payment-method');
            const transactionInput = row.querySelector('.transaction-id');
            const amountInput = row.querySelector('.installment-amount');

            // Enable/disable transaction ID
            paymentSelect.addEventListener('change', () => {
                const value = paymentSelect.value.toLowerCase();
                if (value === 'upi' || value === 'bank_transfer' || value === 'credit_card' || value === 'debit_card' ) {
                    transactionInput.disabled = false;
                    transactionInput.required = true;
                } else {
                    transactionInput.disabled = true;
                    transactionInput.required = false;
                    transactionInput.value = '';
                }
            });

            // Prevent total installments from exceeding booking amount
            amountInput.addEventListener('input', () => {
                const bookingAmount = parseFloat(bookingAmountInput.value) || 0;
                const totalBefore = getTotalInstallmentAmount() - (parseFloat(amountInput.value || 0));
                const newTotal = totalBefore + (parseFloat(amountInput.value) || 0);

                if (newTotal > bookingAmount) {
                    alert('Total installment amount cannot exceed the booking amount.');
                    const allowed = bookingAmount - totalBefore;
                    amountInput.value = allowed.toFixed(2);
                }

                if (newTotal >= bookingAmount){
                    paymentStatus.value = "completed";
                }else{
                    paymentStatus.value = "pending";
                }

                amountInput.dataset.prev = amountInput.value; // track last value
            });

            // Remove row
            row.querySelector('.remove-row').addEventListener('click', () => {
    Swal.fire({
        title: "Are you sure?",
        text: "This installment will be permanently removed.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, remove it!",
        cancelButtonText: "Cancel",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            row.remove();
            const remaining = getRemainingAmount();
            if (remaining > 0) {
                paymentStatus.value = "pending";
            }

            // Optional: show success feedback
            Swal.fire({
                title: "Removed!",
                text: "The installment has been deleted.",
                icon: "success",
                timer: 1200,
                showConfirmButton: false
            });
        }
    });
});


            tableBody.appendChild(row);
        }

        addRowBtn.addEventListener('click', createRow);

        // ========== PRICE CALCULATION LOGIC ==========
        function getPriceForBooking(property, guests) {
            if (!property || !property.price) return 0;

            const baseGuests = parseInt(property.baseGuests || 0);
            const guestCapacity = parseInt(property.guestCapacity || 0);
            const price = parseFloat(property.price || 0);
            const extraPrice = parseFloat(property.extraPricePerGuest || 0);

            if (guests <= baseGuests) {
                return price;
            } else if (guests > guestCapacity) {
                alert(`Guests cannot be more than ${guestCapacity}`);
                noOfGuestsInput.value = guestCapacity; // auto-adjust if needed
                return price + (guestCapacity - baseGuests) * extraPrice;
            } else {
                const extraGuests = guests - baseGuests;
                return price + (extraGuests * extraPrice);
            }
        }
        let previousNoOfGuests = noOfGuestsInput.value; // initial selection

        // Store the old value before change
        noOfGuestsInput.addEventListener('focus', function () {
            previousNoOfGuests = this.value;
        });
        // When noOfGuests changes → update price
        noOfGuestsInput.addEventListener('input', () => {
            const guests = parseInt(noOfGuestsInput.value);
            if (selectedProperty && guests) {
                const totalPrice = getPriceForBooking(selectedProperty, guests);
                const totalAmount = getTotalInstallmentAmount();

        if (totalAmount > totalPrice) {
            Swal.fire({
                icon: "warning",
                title: "Installments exceed new price!",
                text: "Please adjust installments before changing no of guests.",
                confirmButtonColor: "#3085d6",
            }).then(() => {
                // 👇 revert dropdown value
                noOfGuestsInput.value = previousNoOfGuests;
                // 👇 manually trigger 'change' to reapply old data
            });
            return;
        }

        bookingAmountInput.value = totalPrice.toFixed(2);
    }

    // ✅ Update previous value after successful change
    previousNoOfGuests = noOfGuestsInput.value;
        });
        let previousPropertyValue = propertySelect.value; // initial selection

// Store the old value before change
propertySelect.addEventListener('focus', function () {
    previousPropertyValue = this.value;
});

// Handle the change
propertySelect.addEventListener('change', function () {
    const selectedPropertyId = this.value;

    if (!selectedPropertyId) {
        selectedProperty = null;
        initFlatpickr([], false);
        bookingAmountInput.value = '';
        return;
    }

    // Get selected property
    selectedProperty = allProperties.find(p => p.propertyId == selectedPropertyId);

    // Check booking conflicts
    const propertyBookings = allBookings.filter(b => b.propertyId == selectedPropertyId);
    const disabledRanges = propertyBookings.map(b => ({
        from: b.checkInDate,
        to: b.checkOutDate
    }));

    initFlatpickr(disabledRanges, true);

    const guests = parseInt(noOfGuestsInput.value);
    if (guests) {
        const totalPrice = getPriceForBooking(selectedProperty, guests);
        const totalAmount = getTotalInstallmentAmount();

        if (totalAmount > totalPrice) {
            Swal.fire({
                icon: "warning",
                title: "Installments exceed new price!",
                text: "Please adjust installments before changing property.",
                confirmButtonColor: "#3085d6",
            }).then(() => {
                // 👇 revert dropdown value
                propertySelect.value = previousPropertyValue;
                // 👇 manually trigger 'change' to reapply old data
                propertySelect.dispatchEvent(new Event('change'));
            });
            return;
        }

        bookingAmountInput.value = totalPrice.toFixed(2);
    }

    // ✅ Update previous value after successful change
    previousPropertyValue = selectedPropertyId;
});


        // ========== DATE PICKER LOGIC ==========
        function initFlatpickr(disabledRanges = [], enabled = false) {
            const formattedRanges = disabledRanges.map(range => {
                const fromDate = new Date(range.from.replace(' ', 'T'));
                const toDate = new Date(range.to.replace(' ', 'T'));
                const dates = [];
                let currentDate = new Date(fromDate);
                while (currentDate <= toDate) {
                    dates.push(new Date(currentDate));
                    currentDate.setDate(currentDate.getDate() + 1);
                }
                return dates;
            }).flat();

            if (checkInPicker) checkInPicker.destroy();
            if (checkOutPicker) checkOutPicker.destroy();

            checkInPicker = flatpickr("#checkInDate", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                minDate: "today",
                disable: formattedRanges,
                clickOpens: enabled,
                onChange: function (selectedDates) {
                    if (selectedDates.length) {
                        const selected = selectedDates[0];
                        const minCheckout = new Date(selected);
                        minCheckout.setHours(selected.getHours() + 1);
                        checkOutPicker.set('minDate', minCheckout);
                        checkOutPicker.setDate(null);
                        checkInPicker.close();
                        checkOutPicker.open();
                    }
                }
            });

            checkOutPicker = flatpickr("#checkOutDate", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                minDate: "today",
                disable: formattedRanges,
                clickOpens: enabled,
                onChange: function (selectedDates) {
                    if (selectedDates.length) {
                        const checkInDate = checkInPicker.selectedDates[0];
                        const checkOutDate = selectedDates[0];
                        if (checkInDate && checkOutDate <= checkInDate) {
                            alert('Check-out date must be after check-in date');
                            checkOutPicker.setDate(null);
                        }
                    }
                }
            });

            checkInInput.disabled = !enabled;
            checkOutInput.disabled = !enabled;
        }

        initFlatpickr([], false);
    });



</script>
@endsection
