@extends('admin.layouts.app')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-0">Product Details</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="product-list">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('uploads/products/' . $product->productImg) }}" alt="products Image"
                                class="rounded" width="300" height="300" style="object-fit: cover;">
                        </div>
                        <div class="vstack gap-3 mt-4 mb-3">
                            <div class="d-flex align-items-center">
                                <h4 class="me-3">Product Name :</h4>
                                <h4>{{ $product->productName }}</h4>
                            </div>
                            <div class="d-flex align-items-center">
                                <h4 class="me-3">Category Name :</h4>
                                <h4>{{ $product->category?->catName }}</h4>
                            </div>
                            <div class="d-flex align-items-center">
                                <h4 class="me-3">Description :</h4>
                                <p class="card-subtitle">{{ $product->description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <table class="table align-middle text-nowrap mb-0 text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Sr.No</th>
                                    <th scope="col">Unit Name</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($unitPrices->isNotEmpty())
                                    @foreach ($unitPrices as $key => $un)
                                        <tr class="userRow">
                                            <td class="text-center">
                                                <h6 class="fw-semibold mb-0">
                                                    {{ $key + 1 }}
                                                </h6>
                                            </td>
                                            <td class="text-center">
                                                <h6 class="fw-semibold mb-0">{{ $un['unit'] }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6 class="fw-semibold mb-0">{{ $un['price'] }}</h6>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5"> No Data Found !</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('customJs')
    <script>
    </script>
@endsection