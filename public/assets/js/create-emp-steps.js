//resources\js\create-emp-steps.js
$(document).ready(function () {
    let currentStep = 1;
    const totalSteps = $(".wizard-step").length;
    updateButtons();

    $("#dob").on("change", function () {
        const dob = new Date($(this).val());
        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const m = today.getMonth() - dob.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
            age--;
        }
        $("#age").val(age);
    });

    function calculateSalary() {
        const annualCTC = parseFloat($("#annual_ctc").val()) || 0;
        // console.log(annualCTC);

        // BASIC
        let basicType, basicAmount;

        const $select = $("#basicErnContainer select");

        if ($select.length > 0) {
            const basicOption = $select.find("option:selected");
            basicType = basicOption.data("type");
            basicAmount = parseFloat(basicOption.data("amount")) || 0;
        } else {
            const $input = $("input[name='basicEarningId']");
            basicType = $input.data("type");
            basicAmount = parseFloat($input.data("amount")) || 0;
        }
        let basicMonthly = 0;
        if (basicType === "percentage") {
            const percent = parseFloat($(".basic-percent").val()) || 0;
            basicMonthly = (annualCTC * percent) / 100 / 12;
        } else {
            basicMonthly = basicAmount;
        }
        $(".basic-monthly").val(Math.round(basicMonthly));
        $(".basic-annual span").text(Math.round(basicMonthly) * 12);

        // HRA
        let hraType, hraAmount;
        const $hraSelect = $("#HRAContainer select");
        if ($hraSelect.length > 0) {
            const hraOption = $hraSelect.find("option:selected");
            hraType = hraOption.data("type");
            hraAmount = parseFloat(hraOption.data("amount")) || 0;
        } else {
            const $input = $("input[name='hraEarningId']");
            hraType = $input.data("type");
            hraAmount = parseFloat($input.data("amount")) || 0;
        }
        let hraMonthly = 0;
        if (hraType === "percentage") {
            const percent = parseFloat($(".hra-percent").val()) || 0;
            hraMonthly = (basicMonthly * percent) / 100;
        } else {
            hraMonthly = hraAmount;
        }
        $(".hra-monthly").val(Math.round(hraMonthly));
        $(".hra-annual span").text(Math.round(hraMonthly) * 12);

        // CA
        let caType, caAmount;
        const $caSelect = $("#CAContainer select");
        if ($caSelect.length > 0) {
            const caOption = $caSelect.find("option:selected");
            caType = caOption.data("type");
            caAmount = parseFloat(caOption.data("amount")) || 0;
        } else {
            const $input = $("input[name='caEarningId']");
            caType = $input.data("type");
            caAmount = parseFloat($input.data("amount")) || 0;
        }
        let caMonthly = 0;
        if (caType === "percentage") {
            const percent = parseFloat($(".ca-percent").val()) || 0;
            caMonthly = (basicMonthly * percent) / 100;
        } else {
            caMonthly = caAmount;
        }
        $(".ca-monthly").val(Math.round(caMonthly));
        $(".ca-annual span").text(Math.round(caMonthly) * 12);

        const fixedAllowanceMonthly =
            annualCTC / 12 - (basicMonthly + hraMonthly + caMonthly);
        const fixedAllowanceAnnual = fixedAllowanceMonthly * 12;
        const $fixedMonthlyEl = $(".fixed-allowance-monthly");
        const $fixedAnnualEl = $(".fixed-allowance-annual span");

        $fixedMonthlyEl.text(Math.round(fixedAllowanceMonthly));
        $fixedAnnualEl.text(Math.round(fixedAllowanceAnnual));

        if (fixedAllowanceMonthly < 0) {
            $fixedMonthlyEl.addClass("text-danger");
            $fixedMonthlyEl.removeClass("text-dark");
            $fixedAnnualEl.addClass("text-danger");
            $fixedAnnualEl.removeClass("text-dark");
        } else {
            $fixedMonthlyEl.removeClass("text-danger");
            $fixedAnnualEl.removeClass("text-danger");
        }
        $(".monthly-ctc strong").text("₹ " + annualCTC / 12);
        $(".annual-ctc strong").text("₹ " + annualCTC);
    }

    function checkfinal() {
        let basicMonthly = parseFloat($(".basic-monthly").val()) || 0;
        let hraMonthly = parseFloat($(".hra-monthly").val()) || 0;
        let caMonthly = parseFloat($(".ca-monthly").val()) || 0;

        let annualCTC = parseFloat($("#annual_ctc").val()) || 0;
        let monthlyCTC = annualCTC / 12;

        let otherMonthly = basicMonthly + hraMonthly + caMonthly;
        let fixedAllowanceMonthly = monthlyCTC - otherMonthly;
        let fixedAllowanceAnnual = fixedAllowanceMonthly * 12;

        const $fixedMonthlyEl = $(".fixed-allowance-monthly");
        const $fixedAnnualEl = $(".fixed-allowance-annual span");

        $fixedMonthlyEl.text(Math.round(fixedAllowanceMonthly));
        $fixedAnnualEl.text(Math.round(fixedAllowanceAnnual));

        // Apply text-danger if negative
        if (fixedAllowanceMonthly < 0) {
            $fixedMonthlyEl.addClass("text-danger").removeClass("text-dark");
            $fixedAnnualEl.addClass("text-danger").removeClass("text-dark");
        } else {
            $fixedMonthlyEl.removeClass("text-danger");
            $fixedAnnualEl.removeClass("text-danger");
        }

        // Also update total summary
        $(".monthly-ctc strong").text("₹ " + monthlyCTC);
        $(".annual-ctc strong").text("₹ " + annualCTC);
    }

    $(document).on(
        "change input",
        "#basicErnContainer select, .basic-percent, .hra-percent, .ca-percent, #annual_ctc",
        calculateSalary
    );
    console.log("abc");
    $(document).on("input", ".basic-monthly", function () {
        const monthly = parseFloat($(this).val()) || 0;
        $(".basic-annual span").text(monthly * 12);
        checkfinal();
    });

    $(document).on("input", ".hra-monthly", function () {
        const monthly = parseFloat($(this).val()) || 0;
        $(".hra-annual span").text(monthly * 12);
        checkfinal();
    });

    $(document).on("input", ".ca-monthly", function () {
        const monthly = parseFloat($(this).val()) || 0;
        $(".ca-annual span").text(monthly * 12);
        checkfinal();
    });

    $(document).ready(function () {
        $.ajax({
            url: window.getEarnings,
            type: "GET",
            dataType: "json",
            success: function (response) {
                console.log(response);

                setupEarning(
                    "basicErnContainer",
                    "calcBasicContainer",
                    "valContainer",
                    "basicEarningId",
                    response,
                    1,
                    "basic-percent"
                );

                setupEarning(
                    "HRAContainer",
                    "calcHRAContainer",
                    "valHRAContainer",
                    "hraEarningId",
                    response,
                    2,
                    "hra-percent"
                );

                setupEarning(
                    "CAContainer",
                    "calcCAContainer",
                    "valCAContainer",
                    "caEarningId",
                    response,
                    3,
                    "ca-percent"
                ); // for ca
            },
        });
    });

    function setupEarning(
        containerId,
        calcContainerId,
        valContainerId,
        fieldPrefix,
        groupedEarnings,
        earningType,
        percentClass
    ) {
        const container = $(`#${containerId}`);
        const calContainer = $(`#${calcContainerId}`);
        const valContainer = $(`#${valContainerId}`);

        container.empty();
        const earnings = groupedEarnings[earningType] || [];

        if (earnings.length > 1) {
            const select = $("<select>", {
                class: "form-select select2",
                name: fieldPrefix,
            });

            earnings.forEach((earning) => {
                select.append(
                    $("<option>", {
                        value: earning.earningId,
                        text: earning.earningName,
                        "data-type": earning.calculationType,
                        "data-amount":
                            earning.calculationType === "fixed"
                                ? earning.amount
                                : earning.percentage,
                    })
                );
            });

            container.append(select);
            select.select2();

            applyCalcUI(
                earnings[0],
                calContainer,
                valContainer,
                percentClass,
                earningType == 1 ? "% of CTC" : "% of Basic"
            );
            calculateSalary();

            select.on("change", function () {
                const selected = $(this).find("option:selected");
                applyCalcUI(
                    {
                        calculationType: selected.data("type"),
                        amount: selected.data("amount"),
                        percentage: selected.data("amount"),
                    },
                    calContainer,
                    valContainer,
                    percentClass,
                    earningType == 1 ? "% of CTC" : "% of Basic"
                );

                calculateSalary();
            });
        } else if (earnings.length === 1) {
            const single = earnings[0];

            container.html(`
        <div><label class="form-label text-dark fw-normal">${
            single.earningName
        }</label></div>
        <input type="hidden" name="${fieldPrefix}"
            value="${single.earningId}"
            data-type="${single.calculationType}"
            data-amount="${
                single.calculationType === "fixed"
                    ? single.amount
                    : single.percentage
            }">
    `);

            applyCalcUI(
                single,
                calContainer,
                valContainer,
                percentClass,
                earningType == 1 ? "% of CTC" : "% of Basic"
            );
            calculateSalary();
        } else {
            container.html(
                `<span class="text-danger">No earnings available</span>`
            );
        }
    }
    function applyCalcUI(
        earning,
        calContainer,
        valContainer,
        percentClass,
        label
    ) {
        if (earning.calculationType === "percentage") {
            calContainer.html(`
            <input type="number" class="form-control ${percentClass}" value="${earning.percentage}" name="${percentClass}" step="0.01" placeholder="%">
            <span class="input-group-text">${label}</span>
        `);

            valContainer.prop("readonly", true);
        } else {
            calContainer.addClass(`text-dark`);
            calContainer.html(`Fixed amount`);
            valContainer.removeAttr("readonly");
        }

        valContainer.val(earning.amount);
    }

    // Navigation buttons

    $("#nextBtn").click(function () {
        submitStep(currentStep);
    });

    $("#prevBtn").click(function () {
        showStep(currentStep - 1);
    });

    $("#employeeForm").on("submit", function (e) {
        e.preventDefault();
        submitStep(currentStep, true);
    });

    function showStep(step) {
        $(`.wizard-step[data-step="${currentStep}"]`).removeClass("active");
        $(`.step-indicator .step[data-step="${currentStep}"]`).removeClass(
            "active"
        );

        currentStep = step;

        $(`.wizard-step[data-step="${currentStep}"]`).addClass("active");
        $(`.step-indicator .step[data-step="${currentStep}"]`).addClass(
            "active"
        );

        updateButtons();

        if (currentStep === 2) {
            calculateSalary();
        }
    }

    function submitStep(step, isFinal = false) {
        const formData = new FormData($("#employeeForm")[0]);
        formData.append("step", step);
        $.ajax({
            url: window.employeeStoreUrl,
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                if (response.status === true) {
                    alert(response.message);
                    $("#employeeForm")[0].reset();
                    $("#empId").val(response.employeeId);
                    console.log(currentStep);

                    if (currentStep == 4) {
                        window.location.href = "/employees";
                    } else {
                        showStep(step + 1);
                    }
                } else {
                    showStep(1);
                    $("#employeeForm .form-control").removeClass("is-invalid");
                    $("#employeeForm .invalid-feedback").remove();
                    if (response.errors) {
                        $.each(response.errors, function (field, messages) {
                            const input = $(`[name="${field}"]`);
                            input.addClass("is-invalid");
                            input.siblings("p").remove();
                            input.after(
                                `<p class="invalid-feedback">${messages[0]}</p>`
                            );
                        });
                    }
                }
            },
            error: function (jqXHR, exception) {
                console.log("something went wrong.");
                Swal.fire(
                    "Error!",
                    "AJAX request failed. Please try again.",
                    "error"
                );
            },
        });
    }

    function updateButtons() {
        $("#prevBtn").toggle(currentStep > 1);
        $("#nextBtn").toggle(currentStep < totalSteps);
        $("#submitBtn").toggle(currentStep === totalSteps);
    }
});
