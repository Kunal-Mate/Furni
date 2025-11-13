@extends('layouts.app') {{-- Make sure this includes Bootstrap --}}

@section('content')
   <div class="container-fluid px-5">
      <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
         <div class="card-body px-4 py-3">
            <div class="row align-items-center">
               <div class="col-9">
                  <h4 class="fw-semibold mb-0">Properties</h4>
               </div>
               <div class="col-3">
                  <div class="text-center">
                     <a class="btn btn-primary" href="{{ route('property.create') }}">
                        <i class="bi bi-plus-circle"></i> Add New Property
                     </a>

                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="property-list">
         <div class="card">
            <div class="card-body p-3">
               <div class="table-responsive">
                  <table class="table align-middle text-nowrap mb-0">
                     <thead>
                        <tr>
                           <th scope="col">Sr. No</th>
                           <th scope="col">Property Name</th>
                           <th scope="col">Address</th>
                           <th scope="col">Price</th>
                           <th scope="col">Area</th>
                           <th scope="col">Status</th>
                           <th scope="col">Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        @if ($properties->isNotEmpty())
                           @foreach($properties as $key => $property)
                              <tr class="userRow">
                                 <td class="text-center">
                                    <h6 class="fw-semibold mb-0">
                                       {{ ($properties->currentPage() - 1) * $properties->perPage() + $key + 1 }}
                                    </h6>
                                 </td>
                                 <td>{{ $property->propertyName }}</td>
                                 <td>{{ $property->address }}</td>
                                 <td>{{ $property->price }}</td>
                                 <td>{{ $property->area }}</td>
                                 <td>
                                    <span class="badge bg-success rounded-3 fw-semibold">
                                       {{ $property->isAvailable ? 'Active' : 'Inactive' }}
                                    </span>
                                 </td>
                                 <td class="text-center">
                                    <div class="dropdown">
                                       <button class="btn btn-sm btn-light" id="dropdownMenuButton{{ $property->propertyId }}"
                                          type="button" data-bs-toggle="dropdown">
                                          <i class="ti ti-menu"></i>
                                       </button>
                                       <ul class="dropdown-menu dropdown-menu-end"
                                          aria-labelledby="dropdownMenuButton{{ $property->propertyId }}">
                                          <li>
                                             <a class="dropdown-item" href="{{ route('property.show', $property->propertyId) }}">
                                                <i class="ti ti-eye text-primary "></i> Show
                                             </a>
                                          </li>
                                          <li>
                                             <a class="dropdown-item" href="{{ route('property.edit', $property->propertyId) }}">
                                                <i class="ti ti-pencil text-primary"></i> Edit
                                             </a>
                                          </li>
                                          <li>
                                             <a class="dropdown-item text-danger sa-confirm"
                                                data-id="{{ $property->propertyId }}"
                                                data-name="{{ $property->propertyName }}"><i class="ti ti-trash"></i> Delete</a>
                                          </li>

                                       </ul>
                                    </div>
                                 </td>
                                 <td class="d-none">
                                    <a href="{{ route('property.edit', $property->propertyId) }}"
                                       class="btn btn-sm btn-outline-primary">
                                       <i class="ti ti-pencil"></i>
                                    </a>
                                    <a class="dropdown-item text-danger sa-confirm" data-id="{{ $property->propertyId }}"
                                       data-name="{{ $property->propertyName }}"><i class="ti ti-trash"></i> Delete</a>
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
            <div class="card-footer text-body-secondary pb-0">
               <!-- Pagination would go here -->
            </div>
         </div>
      </div>
   </div>
@endsection

@section('customJs')
   <script>
      $(document).on("click", ".sa-confirm", function () {
         const Id = $(this).data("id");
         const Name = $(this).data("name");
         Swal.fire({
            title: "Are you sure?",
            text: `You want to delete '${Name}' Property!`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
         }).then((result) => {
            if (result.isConfirmed) {
               $.ajax({
                  url: "{{ route('property.delete') }}",
                  type: "POST",
                  dataType: "json",
                  data: {
                     id: Id,
                  },
                  success: function (response) {
                     if (response.status) {
                        Swal.fire("Deleted!", response.message, "success").then(() => {
                           $(`.sa-confirm[data-id='${Id}']`).closest(".userRow").remove();
                           setTimeout(function () {
                              location.reload();
                           }, 1000);
                        });
                     } else {
                        Swal.fire("Error!", "Something went wrong. Please try again.", "error");
                     }
                  },
                  error: function (xhr, status, error) {
                     Swal.fire("Error!", "Something went wrong. Please try again.", "error");
                     console.error("AJAX Error:", error);
                  },
               });
            }
         });
      });
   </script>
@endsection