@extends('layouts.app')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif


@section('content')
    <div class="container-fluid px-5">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h4 class="fw-semibold mb-0">Add New Property</h4>
                    </div>
                </div>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Please fix the errors highlighted below.</strong>
            </div>
        @endif


        <div class="card">
            <div class="card-body">
                <form id="propertyForm" method="POST" action="{{ route('property.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="propertyId" class="form-label">Admin</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                @foreach($admins as $admin)
                                    <option value="{{ $admin->adminId }}">{{ $admin->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="propertyName" class="form-label">Property Name</label>
                        <input type="text" class="form-control" id="propertyName" name="propertyName" placeholder="Enter property name"
                            value="{{ old('propertyName') }}">
                        @error('propertyName')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="2"
                        placeholder="Enter full address">{{ old('address') }}</textarea>
                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>

                    <div class="mb-3">
                        <label for="mapLink" class="form-label">Map Link</label>
                    <input type="text" class="form-control" id="mapLink" name="mapLink" value="{{ old('mapLink') }}">
                    @error('mapLink')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>

                    <div class="mb-3">
                        <label for="about" class="form-label">About Property</label>
                        <textarea class="form-control" id="about" name="about" rows="3" placeholder="Describe the property"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}">
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="area" class="form-label">Area (sq ft)</label>
                        <input type="text" class="form-control" id="area" name="area" value="{{ old('area') }}">
                        @error('area')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="guestCapacity" class="form-label">Guest Capacity</label>
                            <input type="text" class="form-control" id="guestCapacity" name="guestCapacity" value="{{ old('guestCapacity') }}">
                            @error('guestCapacity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="baseGuests" class="form-label">Base Guests </label>
                            <input type="text" class="form-control" id="baseGuests" name="baseGuests" value="{{ old('baseGuests') }}">
                            @error('baseGuests')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="extraPricePerGuest" class="form-label">Extra Pricer Per Guest </label>
                            <input type="text" class="form-control" id="extraPricePerGuest" name="extraPricePerGuest" value="{{ old('extraPricePerGuest') }}">
                            @error('extraPricePerGuest')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="bedrooms" class="form-label">Number of Bedrooms</label>
                        <input type="text" class="form-control" id="bedrooms" name="numberofBedrooms" value="{{ old('numberofBedrooms') }}">
                        @error('numberofBedrooms')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="bathrooms" class="form-label">Number of Bathrooms</label>
                        <input type="text" class="form-control" id="bathrooms" name="numberofBathrooms" value="{{ old('numberofBathrooms') }}">
                        @error('numberofBathrooms')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        </div>
                    </div>

                    <!-- Amenities -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Amenities</label>
                        <div class="row">
                            @foreach($amenities as $amenity)
                            <div class="col-md-4 mb-2">
                                <div class="form-check form-switch">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="amenities[]"
                                        value="{{ $amenity->amenityId }}"
                                        id="amenity_{{ $amenity->amenityId }}">
                                    <label class="form-check-label" for="amenity_{{ $amenity->amenityId }}">
                                        <i class="bi {{ $amenity->icon }}"></i> {{ $amenity->amenityName }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                            @error('amenities')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Facilities</label>
                        <div class="row">
                            @foreach($facilities as $facility)
                                <div class="col-md-4 mb-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="facilities[]" value="{{ $facility->facilityId }}"
                                            id="facility_{{ $facility->facilityId }}">
                                        <label class="form-check-label" for="facility_{{ $facility->facilityId }}">
                                            <i class="bi {{ $facility->icon }}"></i> {{ $facility->facilityName }}
                                        </label>
                                    </div>
                                </div>

                            @endforeach
                            @error('facilities')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror


                        </div>
                    </div>


                    <!-- Main Image -->
                    <div class="mb-3">
                        <label for="mainImage" class="form-label fw-bold">Thumbnail Image</label>
                    <input class="form-control" type="file" id="mainImage" name="mainImage" accept="image/*">
                    <div id="mainImagePreview" class="mt-2"></div>
                    @error('mainImage')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    </div>

                    <!-- Thumbnails -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Images</label>
                        <div id="thumbnailDropzone" class="border border-2 border-secondary-subtle rounded-3 p-4 text-center bg-light"
                            style="cursor:pointer;">
                            <i class="bi bi-cloud-arrow-up fs-1 text-primary d-block"></i>
                            <p class="mb-1">Drag & Drop images here</p>
                            <small class="text-muted">or click to select multiple files</small>
                        <input type="file" id="thumbnailImages" name="thumbnailImages[]" accept="image/*" multiple hidden>
                        @error('thumbnailImages.*')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        </div>
                        <div id="thumbnailPreview" class="mt-3 d-flex flex-wrap gap-2"></div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Property</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('customJs')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropzone = document.getElementById('thumbnailDropzone');
        const thumbnailInput = document.getElementById('thumbnailImages');
        const thumbnailPreview = document.getElementById('thumbnailPreview');
        const mainImageInput = document.getElementById('mainImage');
        const mainImagePreview = document.getElementById('mainImagePreview');

        // === MAIN IMAGE PREVIEW ===
        mainImageInput.addEventListener('change', function() {
            mainImagePreview.innerHTML = '';
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    mainImagePreview.innerHTML =
                        `<img src="${e.target.result}" class="img-thumbnail mt-2" style="max-height:150px;">`;
                };
                reader.readAsDataURL(file);
            }
        });

        // === THUMBNAIL DRAG-DROP HANDLERS ===
        dropzone.addEventListener('click', () => thumbnailInput.click());
        dropzone.addEventListener('dragover', e => {
            e.preventDefault();
            dropzone.classList.add('border-primary');
            dropzone.style.backgroundColor = '#e7f1ff';
        });
        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('border-primary');
            dropzone.style.backgroundColor = '';
        });
        dropzone.addEventListener('drop', e => {
            e.preventDefault();
            dropzone.classList.remove('border-primary');
            dropzone.style.backgroundColor = '';
            handleFiles(e.dataTransfer.files);
        });

        thumbnailInput.addEventListener('change', () => handleFiles(thumbnailInput.files));

        function handleFiles(files) {
            thumbnailPreview.innerHTML = '';
            Array.from(files).forEach(file => {
                if (!file.type.startsWith('image/')) return;
                const reader = new FileReader();
                reader.onload = e => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-thumbnail';
                    img.style.maxHeight = '100px';
                    thumbnailPreview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        }
    });
</script>
@endsection
