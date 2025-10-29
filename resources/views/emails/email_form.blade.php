<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">
    <style>
        .email-app {
            height: calc(100vh - 180px);
            border-radius: 0.5rem;
            overflow: hidden;
            border: 1px solid #dee2e6;
        }

        .email-body {
            line-height: 1.8;
            font-size: 1.05rem;
            color: #333;
            white-space: pre-wrap;
        }

        .email-body p {
            margin-bottom: 1.2rem;
        }

        .email-attachments .card {
            transition: all 0.2s;
            border: 1px solid #dee2e6;
        }

        .email-attachments .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .sender-avatar {
            width: 48px;
            height: 48px;
            object-fit: cover;
        }

        .reply-modal .modal-content {
            border-radius: 0.5rem;
        }

        .reply-modal .modal-header {
            border-bottom: 1px solid #dee2e6;
        }

        .reply-modal .modal-body textarea {
            border-radius: 0.5rem;
            border: 1px solid #dee2e6;
            padding: 1rem;
            min-height: 200px;
            width: 100%;
        }

        .reply-modal .modal-body textarea:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1100;
        }
    </style>
</head>

<body>
    <div class="container-fluid py-4">
        <div class="card mb-4">
            <div class="card-body py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Email</h4>
                    <div>
                        <a href="#" class="btn btn-outline-secondary">
                            <i class="ti ti-arrow-left me-2"></i>Back to Inbox
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card email-app">
            <div class="d-flex h-100">
                <!-- Email Content Area -->
                <div class="flex-grow-1 d-flex flex-column">
                    <!-- Email Header -->
                    <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                        <div>
                            <h3 class="mb-0">Weekly Team Meeting Reminder</h3>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-secondary" title="Archive">
                                <i class="ti ti-archive"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary" title="Report spam">
                                <i class="ti ti-alert-octagon"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary" title="Delete">
                                <i class="ti ti-trash"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Email Meta -->
                    <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                        <div class="d-flex align-items-center">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="John Smith"
                                class="rounded-circle sender-avatar me-3">
                            <div>
                                <h6 class="mb-0">John Smith</h6>
                                <p class="text-muted mb-0">john.smith@company.com</p>
                            </div>
                        </div>
                        <div class="text-muted">
                            May 15, 2023, 10:30 AM
                            <button class="btn btn-sm btn-outline-secondary ms-3" data-bs-toggle="modal"
                                data-bs-target="#replyModal">
                                <i class="ti ti-arrow-back-up me-1"></i>Reply
                            </button>
                        </div>
                    </div>

                    <!-- Email Body -->
                    <div class="p-4 flex-grow-1 overflow-auto">
                        <div class="email-body mb-4">
                            Hi Team,

                            Just a reminder about our weekly meeting tomorrow at 10 AM in Conference Room B.

                            Agenda Items:
                            1. Project status updates
                            2. Q2 planning discussion
                            3. Client feedback review

                            Please come prepared with:
                            - Your current project status
                            - Any blockers you're facing
                            - Suggestions for process improvements

                            Looking forward to seeing everyone there!

                            Best regards,
                            John Smith
                        </div>

                        <!-- Attachments -->
                        <div class="email-attachments mb-4">
                            <h6 class="fw-semibold mb-3">Attachments (2)</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body d-flex align-items-center">
                                            <div class="me-3">
                                                <i class="ti ti-file-text fs-2 text-muted"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Meeting_Agenda.pdf</h6>
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
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body d-flex align-items-center">
                                            <div class="me-3">
                                                <i class="ti ti-file-spreadsheet fs-2 text-muted"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Project_Timeline.xlsx</h6>
                                                <p class="text-muted small mb-0">480 KB</p>
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-outline-primary">
                                                    <i class="ti ti-download"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reply Modal -->
    <div class="modal fade reply-modal" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel">Reply to Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="replyForm" action="{{ route('sendEmail') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="to_email" class="form-label">To</label>
                            <input type="email" class="form-control" id="to_email" name="to_email" value="">
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject"
                                value="Re: Weekly Team Meeting Reminder" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="8"
                                placeholder="Type your reply here..." required></textarea>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="senderEmail" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="senderEmail" name="senderEmail" required placeholder="your@email.com">
                        </div> -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <div>
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-sm btn-outline-secondary me-2">
                                <i class="ti ti-paperclip"></i> Attach File
                            </button>
                            <button type="submit" class="btn btn-primary" id="">
                                <i class="ti ti-send me-2"></i>Send Reply
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast-container">
        <div id="successToast" class="toast align-items-center text-white bg-success" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Email sent successfully!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
        <div id="errorToast" class="toast align-items-center text-white bg-danger" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Error sending email. Please try again.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('replyForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const form = e.target;
            const submitButton = form.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;

            // Show loading state
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';

            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message
                        alert(data.message);
                        // Close modal if needed
                        bootstrap.Modal.getInstance(document.getElementById('replyModal')).hide();
                    } else {
                        // Show error message
                        alert(data.message);
                    }
                })
                .catch(error => {
                    alert('An error occurred: ' + error.message);
                })
                .finally(() => {
                    // Reset button state
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalText;
                });
        });
    </script>
</body>

</html>