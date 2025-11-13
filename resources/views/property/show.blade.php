@extends('layouts.app')

@section('content')
    <div class="container-fluid px-5">
        <!-- Page Header -->
        <div class="card  shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h4 class="fw-semibold mb-0">
                            <i class="fa-solid fa-building me-2 "></i> Property Details
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Property Card -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                <!-- Header Info -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <h3 class="fw-bold text-primary mb-1">{{ $property->propertyName }}</h3>
                        <p class="text-muted mb-1"><i class="fa-solid fa-location-dot me-1"></i> {{ $property->address }}
                        </p>
                        @if($property->mapLink)
                            <a href="{{ $property->mapLink }}" target="_blank" class="text-decoration-none small">
                                <i class="fa-solid fa-map me-1"></i> View on Map
                            </a>
                        @endif
                    </div>
                </div>

                <!-- About -->
                <div class="mb-4">
                    <h5 class="fw-semibold text-primary border-bottom pb-1 mb-2">About Property</h5>
                    <p class="mb-0">{{ $property->about ?? 'No description available.' }}</p>
                </div>

                <!-- Details Section -->
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="border rounded p-3 bg-light">
                            <h6 class="fw-semibold text-muted mb-1">Price</h6>
                            <p class="fw-bold text-success fs-5 mb-0">₹ {{ number_format($property->price, 2) }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3 bg-light">
                            <h6 class="fw-semibold text-muted mb-1">Area</h6>
                            <p class="fw-bold mb-0">{{ $property->area }} sq ft</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3 bg-light">
                            <h6 class="fw-semibold text-muted mb-1">Guest Capacity</h6>
                            <p class="fw-bold mb-0">{{ $property->guestCapacity ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3 bg-light">
                            <h6 class="fw-semibold text-muted mb-1">Base Guests</h6>
                            <p class="fw-bold mb-0">{{ $property->baseGuests ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3 bg-light">
                            <h6 class="fw-semibold text-muted mb-1">Extra Price Per Guest</h6>
                            <p class="fw-bold mb-0">{{ $property->extraPricePerGuest ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-2">
                        <div class="border rounded p-3 bg-light">
                            <h6 class="fw-semibold text-muted mb-1">Bedrooms</h6>
                            <p class="fw-bold mb-0">{{ $property->numberofBedrooms ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="border rounded p-3 bg-light">
                            <h6 class="fw-semibold text-muted mb-1">Bathrooms</h6>
                            <p class="fw-bold mb-0">{{ $property->numberofBathrooms ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Amenities -->
                <div class="mt-5">
                    <h5 class="fw-semibold text-primary border-bottom pb-2 mb-3">
                        <i class="fa-solid fa-list-check me-1 text-primary"></i> Amenities
                    </h5>
                    @if($amenities->count() > 0)
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($amenities as $amenity)
                                <span class="badge bg-light border text-dark px-3 py-2">
                                    <i class="fa-solid fa-check text-success me-1"></i> {{ $amenity->amenityName }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No amenities found.</p>
                    @endif
                </div>

                <div class="mt-5">
                    <h5 class="fw-semibold text-primary border-bottom pb-2 mb-3">
                        <i class="fa-solid fa-list-check me-1 text-primary"></i> Facilities
                    </h5>
                    @if($facilities->count() > 0)
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($facilities as $facility)
                                <span class="badge bg-light border text-dark px-3 py-2">
                                    <i class="fa-solid fa-check text-success me-1"></i> {{ $facility->facilityName }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No facilities found.</p>
                    @endif
                </div>

                <!-- Images -->
                @if($property->thumbnail)
                    <div class="mt-5">
                        <h5 class="fw-semibold text-primary border-bottom pb-2 mb-3">
                            <i class="fa-solid fa-image me-1 text-info"></i> Thumbnail Image
                        </h5>
                        <img src="{{ asset($property->thumbnail) }}" alt="Main Image" class="img-fluid rounded shadow-sm"
                            style="max-height: 300px; object-fit: cover;">
                    </div>
                @endif
                @if(!empty($property->propertyAttach))
                    <div class="mt-4">
                        <h6 class="fw-semibold text-primary mb-3">Images</h6>
                        <div class="d-flex flex-wrap gap-3">
                            @foreach($property->propertyAttach as $thumb)
                                <img src="{{ asset($thumb->propertyAtt) }}" alt="Thumbnail" class="rounded shadow-sm border"
                                    style="width: 100px; height: 100px; object-fit: cover;">
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="d-flex justify-content-end mt-5">
                    <a href="{{ route('property') }}" class="btn btn-outline-secondary me-2">
                        <i class="fa-solid fa-arrow-left me-1"></i> Back
                    </a>
                    <a href="{{ route('property.edit', $property->propertyId) }}" class="btn btn-primary">
                        <i class="fa-solid fa-pen-to-square me-1"></i> Edit Property
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
