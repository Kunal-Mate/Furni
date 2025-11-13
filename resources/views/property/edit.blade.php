@extends('layouts.app')

@section('content')
                        <div class="container-fluid px-5">
                            <!-- Page Header -->
                            <div class="card shadow-none position-relative overflow-hidden mb-4">
                                <div class="card-body px-4 py-3">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h4 class="fw-semibold mb-0">
                                                <i class="fa-solid fa-pen-to-square me-2 text-info"></i> Edit Property
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Property Edit Card -->
                            <div class="card shadow-sm border-0">
                                <div class="card-body p-4">
                                    <form action="{{ route('property.update', $property->propertyId) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Basic Info -->
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="propertyId" class="form-label">Admin</label>
                                                <select class="form-select" aria-label="Default select example">`
                                                    <option selected>Open this select menu</option>
                                                    @foreach($admins as $admin)
                                                        <option value="{{ $admin->id }}" {{ $admin->id == $property->adminId ? 'selected' : '' }}>
                                                            {{ $admin->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Property Name</label>
                                                <input type="text" name="propertyName" class="form-control" value="{{ old('propertyName', $property->propertyName) }}">
                                                @error('propertyName')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror

                                            </div>

                                        </div>

                                        <!-- Address -->
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Address</label>
                                            <textarea name="address" class="form-control" rows="2"
                                                required>{{ old('address', $property->address) }}</textarea>
                                                @error('address')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                        </div>

                                        <!-- Map Link -->
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Map Link</label>
                                            <input type="url" name="mapLink" class="form-control"
                                                value="{{ old('mapLink', $property->mapLink) }}" placeholder="https://maps.google.com/...">
                                                   @error('mapLink')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                        </div>

                                        <!-- About Property -->
                                        <div class="mb-4">
                                            <label class="form-label fw-semibold">About Property</label>
                                            <textarea name="about" class="form-control" rows="3">{{ old('about', $property->about) }}</textarea>
                                               @error('about')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                        </div>

                                        <!-- Price, Area, Guest Capacity -->
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label fw-semibold">Price (₹)</label>
                                                <input type="number" step="0.01" name="price" class="form-control"
                                                    value="{{ old('price', $property->price) }}">
                                                       @error('price')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label fw-semibold">Area (sq ft)</label>
                                                <input type="number" name="area" class="form-control"
                                                    value="{{ old('area', $property->area) }}">
                                                       @error('area')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label fw-semibold">Guest Capacity</label>
                                                <input type="number" name="guestCapacity" class="form-control"
                                                    value="{{ old('guestCapacity', $property->guestCapacity) }}">
                                                       @error('guestCapacity')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label fw-semibold">Base Guests</label>
                                                <input type="number" name="baseGuests" class="form-control"
                                                    value="{{ old('baseGuests', $property->baseGuests) }}">
                                                       @error('baseGuests')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label fw-semibold">Extra Price Per Guest</label>
                                                <input type="number" name="extraPricePerGuest" class="form-control"
                                                    value="{{ old('extraPricePerGuest', $property->extraPricePerGuest) }}">
                                                       @error('extraPricePerGuest')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Bedrooms and Bathrooms -->
                                        <div class="row">
                                            <div class="col-md-2 mb-3">
                                                <label class="form-label fw-semibold">Bedrooms</label>
                                                <input type="number" name="numberofBedrooms" class="form-control"
                                                    value="{{ old('numberofBedrooms', $property->numberofBedrooms) }}">
                                                    @error('numberofBedrooms')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="form-label fw-semibold">Bathrooms</label>
                                                <input type="number" name="numberofBathrooms" class="form-control"
                                                    value="{{ old('numberofBathrooms', $property->numberofBathrooms) }}">
                                                    @error('numberofBathrooms')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Amenities -->
                                        <div class="mb-4">
                                            <label class="form-label fw-semibold d-block mb-2">
                                                <i class="fa-solid fa-list-check text-info me-1"></i> Select Amenities
                                            </label>

                                            <div class="row">
                                                @php
    $selectedAmenities = explode(',', $property->amenityIds ?? '');
                                                @endphp
                                                @foreach($Amenities as $amenity)
                                                    <div class="col-md-4 mb-2">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="amenityIds[]"
                                                                value="{{ $amenity->amenityId }}" {{ in_array($amenity->amenityId, $selectedAmenities) ? 'checked' : '' }}>
                                                            <label class="form-check-label">
                                                                <i class="bi {{ $amenity->icon }} me-1 text-primary"></i>
                                                                {{ $amenity->amenityName }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label fw-semibold d-block mb-2">
                                                <i class="fa-solid fa-list-check text-info me-1"></i> Select Facilities
                                            </label>
                                            <div class="row">
                                                @php
    $selectedFacilities = explode(',', $property->facilityIds ?? '');
                                                @endphp
                                                @foreach($facilities as $facility)
                                                    <div class="col-md-4 mb-2">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="facilityIds[]"
                                                                value="{{ $facility->facilityId }}" {{ in_array($facility->facilityId, $selectedFacilities) ? 'checked' : '' }}>
                                                            <label class="form-check-label">
                                                                <i class="bi {{ $facility->icon }} me-1 text-primary"></i>
                                                                {{ $facility->facilityName }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>



                                        <!-- Main Image -->
                                        <div class="mb-4">
                                            <label class="form-label fw-semibold">Thumbnail Image</label>

                                            @if($property->thumbnail)
                                                <div class="mb-2">
                                                    <img src="{{ asset($property->thumbnail) }}" class="rounded border shadow-sm"
                                                        style="max-height: 120px; object-fit: cover;">
                                                </div>
                                            @endif

                                            <input type="file" name="mainImage" class="form-control">
                                            @error('mainImage')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label fw-semibold">Images</label>
                                            @if(!empty($property->propertyAttach))
                                                <div class="d-flex flex-wrap gap-2 mb-2">
                                                    @foreach($property->propertyAttach as $thumb)
                                                        <img src="{{ asset($thumb->propertyAtt) }}" class="rounded border shadow-sm"
                                                            style="width: 80px; height: 80px; object-fit: cover;">
                                                    @endforeach
                                                </div>
                                            @endif
                                            <input type="file" name="thumbnailImages[]" class="form-control" multiple>
                                            @error('thumbnailImages.*')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="d-flex justify-content-end mt-4">
                                            <a href="{{ route('property') }}" class="btn btn-outline-secondary me-2">
                                                <i class="fa-solid fa-arrow-left me-1"></i> Cancel
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa-solid fa-floppy-disk me-1"></i> Update Property
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
@endsection
