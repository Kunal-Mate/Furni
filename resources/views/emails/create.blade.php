@extends('layouts.app') {{-- Make sure this includes Bootstrap --}}

@section('content')
    <div class="container-fluid py-4">
        <div class="card mb-4">
            <div class="card-body py-3">
                <h4 class="mb-0">Email</h4>
            </div>
        </div>

        <div class="card email-app">
            <div class="d-flex h-100">
                <!-- Left Sidebar -->
                <div class="email-sidebar d-none d-lg-flex flex-column">
                    <div class="p-3">
                        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#composeModal">
                            <i class="ti ti-edit me-2"></i>Compose
                        </button>
                    </div>

                    <ul class="nav flex-column flex-grow-1 overflow-auto">
                        <li class="nav-item">
                            <a class="nav-link active d-flex align-items-center" href="#">
                                <i class="ti ti-inbox me-2"></i>Inbox
                                <span class="badge bg-primary ms-auto">12</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="#">
                                <i class="ti ti-send me-2"></i>Sent
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="#">
                                <i class="ti ti-file-text me-2"></i>Drafts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="#">
                                <i class="ti ti-alert-octagon me-2"></i>Spam
                                <span class="badge bg-danger ms-auto">3</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="#">
                                <i class="ti ti-trash me-2"></i>Trash
                            </a>
                        </li>

                        <li class="px-3 my-2">
                            <hr class="my-0">
                        </li>

                        <li class="px-3 py-1 small text-uppercase text-muted fw-bold">Important</li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="#">
                                <i class="ti ti-star me-2"></i>Starred
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="#">
                                <i class="ti ti-badge me-2"></i>Important
                            </a>
                        </li>

                        <li class="px-3 my-2">
                            <hr class="my-0">
                        </li>

                        <li class="px-3 py-1 small text-uppercase text-muted fw-bold">Labels</li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="#">
                                <i class="ti ti-bookmark me-2 text-primary"></i>Promotional
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="#">
                                <i class="ti ti-bookmark me-2 text-warning"></i>Social
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="#">
                                <i class="ti ti-bookmark me-2 text-success"></i>Health
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Email List -->
                <div class="email-list d-flex flex-column">
                    <div class="p-3 border-bottom">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0">
                                <i class="ti ti-search"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" placeholder="Search emails">
                        </div>
                    </div>

                    <div class="d-flex p-3 border-bottom">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="checkbox" id="selectAll">
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="ti ti-refresh"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="ti ti-archive"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="ti ti-alert-octagon"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="ti ti-trash"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex-grow-1 overflow-auto">
                        <!-- Email Item 1 -->
                        <div class="email-item unread p-3">
                            <div class="d-flex">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox">
                                </div>
                                <div class="me-3">
                                    <button class="btn btn-sm p-0 email-star starred">
                                        <i class="ti ti-star fs-5"></i>
                                    </button>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between mb-1">
                                        <h6 class="mb-0">James Smith</h6>
                                        <small class="text-muted">10:30 AM</small>
                                    </div>
                                    <h6 class="fw-semibold mb-1">Weekly Team Meeting</h6>
                                    <p class="text-muted mb-0 text-truncate">Hi team, just a reminder about our weekly
                                        meeting tomorrow at 10 AM...</p>
                                    <div class="mt-2">
                                        <span class="badge bg-primary me-1">Work</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Email Item 2 -->
                        <div class="email-item p-3">
                            <div class="d-flex">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox">
                                </div>
                                <div class="me-3">
                                    <button class="btn btn-sm p-0 email-star">
                                        <i class="ti ti-star fs-5"></i>
                                    </button>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between mb-1">
                                        <h6 class="mb-0">Amazon</h6>
                                        <small class="text-muted">Yesterday</small>
                                    </div>
                                    <h6 class="fw-semibold mb-1">Your order has shipped</h6>
                                    <p class="text-muted mb-0 text-truncate">Your recent order #12345 has been shipped
                                        and will arrive...</p>
                                    <div class="mt-2">
                                        <span class="badge bg-success me-1">Shopping</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Email Item 3 -->
                        <div class="email-item unread p-3">
                            <div class="d-flex">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox">
                                </div>
                                <div class="me-3">
                                    <button class="btn btn-sm p-0 email-star">
                                        <i class="ti ti-star fs-5"></i>
                                    </button>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between mb-1">
                                        <h6 class="mb-0">LinkedIn</h6>
                                        <small class="text-muted">Mar 15</small>
                                    </div>
                                    <h6 class="fw-semibold mb-1">You have 5 new connections</h6>
                                    <p class="text-muted mb-0 text-truncate">Your network is growing! 5 people have
                                        accepted your connection...</p>
                                    <div class="mt-2">
                                        <span class="badge bg-warning me-1">Social</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- More email items... -->
                    </div>
                </div>

                <!-- Email Content -->
                <div class="email-content">
                    <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                        <div>
                            <button class="btn btn-sm btn-outline-secondary d-lg-none me-2 back-to-list">
                                <i class="ti ti-arrow-left"></i>
                            </button>
                            <h4 class="mb-0">Weekly Team Meeting</h4>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="ti ti-archive"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="ti ti-alert-octagon"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="ti ti-trash"></i>
                            </button>
                        </div>
                    </div>

                    <div class="p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex align-items-center">
                                <img src="https://via.placeholder.com/48" alt="User" class="rounded-circle me-3">
                                <div>
                                    <h6 class="mb-0">James Smith</h6>
                                    <p class="text-muted mb-0">james.smith@example.com</p>
                                </div>
                            </div>
                            <div class="text-muted">
                                Mar 20, 2023, 10:30 AM
                            </div>
                        </div>

                        <div class="email-body mb-4">
                            <p>Hi team,</p>
                            <p>Just a reminder about our weekly meeting tomorrow at 10 AM in the main conference room.
                            </p>
                            <p>Agenda items:</p>
                            <ul>
                                <li>Project status updates</li>
                                <li>Q2 planning discussion</li>
                                <li>Client feedback review</li>
                            </ul>
                            <p>Please come prepared with your updates and any questions you may have.</p>
                            <p>Best regards,<br>James</p>
                        </div>

                        <div class="email-attachments mb-4">
                            <h6 class="fw-semibold mb-3">Attachments (1)</h6>
                            <div class="card border">
                                <div class="card-body d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="ti ti-file-text fs-2 text-muted"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Meeting_Agenda_Mar_21.pdf</h6>
                                        <p class="text-muted small mb-0">250 KB</p>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="ti ti-download"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-3">
                            <button class="btn btn-primary me-2">
                                <i class="ti ti-arrow-back-up me-2"></i>Reply
                            </button>
                            <button class="btn btn-outline-primary">
                                <i class="ti ti-arrow-forward-up me-2"></i>Forward
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection