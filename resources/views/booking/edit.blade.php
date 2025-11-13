@extends('layouts.app')

@section('content')
<div class="container-fluid px-5">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <h4 class="fw-semibold mb-0">Edit Booking</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            {{-- Validation & Flash Messages --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form id="bookingForm" method="POST" action="{{ route('booking.update', $booking->bookingId) }}">
                @csrf

                {{-- Property Details --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="propertyId" class="form-label">Property</label>
                        <select class="form-select" id="propertyId" name="propertyId" required>
                            <option value="">Select Property</option>
                            @foreach($properties as $property)
                            <option value="{{ $property->propertyId }}" {{ old('propertyId', $booking->propertyId) ==
                                $property->propertyId ? 'selected' : '' }}>
                                {{ $property->propertyName }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="checkInDate" class="form-label">Check-in Date</label>
                        <input type="datetime-local" class="form-control" id="checkInDate" name="checkInDate"
                            value="{{ old('checkInDate', $booking->checkInDate) }}" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="checkOutDate" class="form-label">Check-out Date</label>
                        <input type="datetime-local" class="form-control" id="checkOutDate" name="checkOutDate"
                            value="{{ old('checkOutDate', $booking->checkOutDate) }}" required>
                    </div>
                </div>

                {{-- Booking Info --}}
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="noOfGuests" class="form-label">No. of Guests</label>
                        <input type="number" class="form-control" id="noOfGuests" name="noOfGuests"
                            value="{{ old('noOfGuests', $booking->noOfGuests) }}" placeholder="Enter number of guests">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="bookingAmount" class="form-label">Booking Amount (₹)</label>
                        <input type="text" class="form-control" id="bookingAmount" name="bookingAmount"
                            value="{{ old('bookingAmount', $booking->bookingAmount) }}" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="paymentStatus" class="form-label">Payment Status</label>
                        <select class="form-select" id="paymentStatus" name="paymentStatus">
                            <option value="pending" {{ old('paymentStatus', $booking->paymentStatus) == 'pending' ?
                                'selected' : '' }}>Pending</option>
                            <option value="completed" {{ old('paymentStatus', $booking->paymentStatus) == 'completed' ?
                                'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="bookingStatus" class="form-label">Booking Status</label>
                        <select class="form-select" id="bookingStatus" name="bookingStatus">
                            <option value="confirmed" {{ old('bookingStatus', $booking->bookingStatus) == 'confirmed' ?
                                'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ old('bookingStatus', $booking->bookingStatus) == 'cancelled' ?
                                'selected' : '' }}>Cancelled</option>
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
                                <th>Amount (₹)</th>
                                <th>Payment Method</th>
                                <th>Payment For</th>
                                <th>Transaction ID</th>
                                <th width="60">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Existing installments (filled by JS) --}}
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
                            value="{{ old('customerName', $booking->customerName) }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="customerEmail" class="form-label">Customer Email</label>
                        <input type="email" class="form-control" id="customerEmail" name="customerEmail"
                            value="{{ old('customerEmail', $booking->customerEmail) }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="customerPhone" class="form-label">Customer Phone</label>
                        <input type="text" class="form-control" id="customerPhone" name="customerPhone"
                            value="{{ old('customerPhone', $booking->customerPhone) }}" maxlength="10" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="note" class="form-label">Notes</label>
                    <textarea class="form-control" id="note" name="note" rows="3"
                        placeholder="Any special requests">{{ old('note', $booking->note) }}</textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('booking.index') }}" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('customJs')
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const allProperties = @json($properties);
    const allBookings = @json($allBookings);
    const booking = @json($booking);
    const checkInInput = document.getElementById('checkInDate');
    const checkOutInput = document.getElementById('checkOutDate');
    const existingInstallments = @json($booking->payments ?? []);
    const paymentStatus = document.getElementById("paymentStatus");
    const tableBody = document.querySelector('#installmentTable tbody');
    const addRowBtn = document.getElementById('addInstallmentRow');
    const propertySelect = document.getElementById('propertyId');
    const bookingAmountInput = document.getElementById('bookingAmount');
    const noOfGuestsInput = document.getElementById('noOfGuests');
    let selectedProperty = allProperties.find(p => p.propertyId == propertySelect.value);
    let installmentIndex = 0;
    let previousBookingAmount = bookingAmountInput.value;
    let checkInPicker, checkOutPicker;


    function getTotalInstallmentAmount() {
        let total = 0;
        tableBody.querySelectorAll('.installment-amount').forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        return total;
    }

    function validateInstallmentsAgainstBookingAmount(newAmount, previousAmount) {
    const totalInstallments = getTotalInstallmentAmount();

    if (totalInstallments > newAmount) {
        alert(
            `⚠️ Total installment amount (₹${totalInstallments.toFixed(2)}) exceeds the new booking total (₹${newAmount.toFixed(2)}).\n\n` +
            `Please adjust installments before changing booking details.`
        );

        // Revert to old booking amount
        bookingAmountInput.value = previousAmount.toFixed(2);
        bookingAmountInput.classList.add('is-invalid');
        setTimeout(() => bookingAmountInput.classList.remove('is-invalid'), 1500);
        return false;
    }

    bookingAmountInput.classList.remove('is-invalid');
    return true;
    }

    function getRemainingAmount() {
        const bookingAmount = parseFloat(bookingAmountInput.value) || 0;
        console.log("bookingAmount");
        const totalPaid = getTotalInstallmentAmount();
        const remaining = bookingAmount - totalPaid;
        return remaining < 0 ? 0 : remaining;
    }

    // Create a new row (same logic as create page)
    function createRow(payment) {
        if (payment != 0){
            remaining = payment.amount;
        }else{
            remaining = getRemainingAmount();
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

            paymentStatus.value = "completed";
        }
        const index = installmentIndex++;
        const row = document.createElement('tr');

        row.innerHTML = `
            <td><input type="number" step="0.01" name="installments[${index}][amount]"
                class="form-control installment-amount" value="${remaining}" required></td>

            <td><select name="installments[${index}][paymentMethod]" class="form-select payment-method" required>
                <option value="">Select</option>
                <option value="cash">Cash</option>
                <option value="upi">UPI</option>
                <option value="bank_transfer">Bank Transfer</option>
                <option value="debit_card">Debit Card</option>
                <option value="credit_card">Credit Card</option>
            </select></td>

            <td><select name="installments[${index}][paymentFor]" class="form-select paymentFor" required>
                <option value="">Select</option>
                <option value="booking">Pre-Booking</option>
                <option value="checkIn">Check-In</option>
                <option value="checkOut">Check-Out</option>
            </select></td>

            <td><input type="text" name="installments[${index}][transactionId]"
                class="form-control transaction-id" value="${payment?.transactionId ?? ''}"
                ${payment && (payment.paymentMethod === 'upi' || payment.paymentMethod === 'bank_transfer') ? '' : 'disabled'}
                placeholder="Transaction ID"></td>

            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm remove-row">×</button>
            </td>
        `;

        const paymentSelect = row.querySelector('.payment-method');
        const transactionInput = row.querySelector('.transaction-id');
        const amountInput = row.querySelector('.installment-amount');

        if (payment) paymentSelect.value = payment.paymentMethod;
        if (payment) row.querySelector('.paymentFor').value = payment.paymentFor;

        paymentSelect.addEventListener('change', () => {
            const value = paymentSelect.value.toLowerCase();
            if (value === 'upi' || value === 'cash' || value === 'bank_transfer' || value === 'credit_card' || value === 'debit_card' ) {
                transactionInput.disabled = false;
                transactionInput.required = true;
            } else {
                transactionInput.disabled = true;
                transactionInput.required = false;
                transactionInput.value = '';
            }
        });

        amountInput.addEventListener('input', () => {
            const bookingAmount = parseFloat(bookingAmountInput.value) || 0;
            const newTotal = getTotalInstallmentAmount();
            const totalBefore = newTotal - (parseFloat(amountInput.value) || 0);

            if (newTotal > bookingAmount) {
                alert('Total installment amount cannot exceed booking amount.');
                const allowed = bookingAmount - totalBefore;
                amountInput.value = allowed.toFixed(2);

            }

            const total = getTotalInstallmentAmount();
            if (total >= bookingAmount) {
                paymentStatus.value = "completed";
            } else {
                paymentStatus.value = "pending";
            }

            amountInput.dataset.prev = amountInput.value;
        });

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
    function createRoww(){
        createRow(0);
    }
    addRowBtn.addEventListener('click', createRoww);

    // Prefill existing installments
    existingInstallments.forEach(payment => createRow(payment));

    // Price Calculation Logic (same as create)
    function getPriceForBooking(property, guests) {
        if (!property) return 0;
        const baseGuests = parseInt(property.baseGuests || 0);
        const guestCapacity = parseInt(property.guestCapacity || 0);
        const price = parseFloat(property.price || 0);
        const extraPrice = parseFloat(property.extraPricePerGuest || 0);

        if (guests <= baseGuests) return price;
        if (guests > guestCapacity) {
            alert(`Guests cannot exceed ${guestCapacity}`);
            noOfGuestsInput.value = guestCapacity;
            return price + (guestCapacity - baseGuests) * extraPrice;
        }
        return price + ((guests - baseGuests) * extraPrice);
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


    bookingAmountInput.addEventListener('focus', () => previousBookingAmount = bookingAmountInput.value);
    bookingAmountInput.addEventListener('change', () => {
        if (getRemainingAmount() < 0) {
            alert('Installments exceed booking amount. Adjust them.');
            bookingAmountInput.value = previousBookingAmount;
        }
    });
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

        function initFlatpickrForEdit(propertyId) {
    const propertyBookings = allBookings.filter(
        b => b.propertyId == propertyId && b.bookingId !== booking.bookingId
    );

    const disabledRanges = propertyBookings.map(b => ({
        from: b.checkInDate,
        to: b.checkOutDate
    }));

    initFlatpickr(disabledRanges, true);
}

// ✅ Run on page load
initFlatpickrForEdit(booking.propertyId);

});
</script>
@endsection
