function validateForm() {
    const questions = document.querySelectorAll('.modal-body .question');
    for (let i = 0; i < questions.length; i++) {
        const question = questions[i];
        const type = question.getAttribute('data-type');

        if (type === "checkbox" || type === "radio") {
            const inputs = question.querySelectorAll('input[type="checkbox"], input[type="radio"]');
            let atLeastOneChecked = false;

            for (let j = 0; j < inputs.length; j++) {
                if (inputs[j].checked) {
                    atLeastOneChecked = true;
                    break;
                }
            }

            if (!atLeastOneChecked) {
                alert('Please select at least one option.');
                return false; // Prevent form submission
            }
        }
    }

    return true; // Allow form submission if all questions pass validation
}

$('#joinRequestForm').submit(function (event) {
    event.preventDefault(); // Prevent default form submission

    if (!validateForm()) {
        return;
    }

    var formData = $(this).serialize();
    var group_id = new URLSearchParams(formData).get('group_id');
    $.ajax({
        type: 'POST',
        url: '/submit-join-request/' + group_id,
        data: formData,
        dataType: 'json',
        success: function (response) {
            var is_direct_join = new URLSearchParams(formData).get('is_direct_join');

            var joinButton = $('[data-group_id="' + group_id + '"]');

            var groupName = $('[data-group_name="' + group_id + '"]').text();
            var message = '';
            if (is_direct_join === '1') {
                var groupLink = $('<a>', {
                    href: `/groups/${group_id}/feeds`,
                    class: `text-decoration-none`,
                    text: groupName
                });

                joinButton.parent().siblings('.card-body').find('.card-title').empty().append(groupLink);
                joinButton.removeClass('btn-primary').addClass('disabled').text('Approved');
                message = 'You are joined to the group';
            } else {
                joinButton.removeClass('btn-primary').addClass('disabled').text('Pending');
                message = 'Your join request is waiting for admin approval';
            }

            $('#joinRequestModal').modal('hide');

            toastrSuccessMessage("You Are Joined To The Group!!");
        },
        error: function (error) {
            console.error('AJAX error:', error);
        }
    });
});

// Attach event listener for join request button click
$(document).on("click", ".join-request-btn", function () {
    const groupId = $(this).data("group_id");
    // Populate and show the modal with appropriate content
    populateJoinRequestModal(groupId);
    $("#joinRequestModal").modal("show");
});
// Function to generate HTML for questions of a specific type
function generateQuestionHtmlData(type, questions, answerIndex) {
    let html = '';
    questions.forEach((question) => {
        html += `
                <div class="question mb-4" data-type="${question.type}">
                <label><span style="color: #333; font-weight: bold;">Q:</span> ${question.name}</label>
                    ${generateInputField(question.type, question, answerIndex)}
                </div>
            `;
    });

    return html;
}

// Function to generate input field based on question type
function generateInputField(type, question, index) {
    const questionId = question.id;
    const fieldName = `questions[${questionId}][${index}]`;

    let inputHtml = '';

    if (type === "select") {
        let optionsHtml = '<option value="">-- Select --</option>';
        if (question.group_question_details.is_multiple === 1) {
            // Multi-select
            optionsHtml += question.group_question_details.group_question_option.map((option) => {
                return `<option value="${option.value}">${option.value}</option>`;
            }).join('');
        } else {
            // Single select
            optionsHtml += question.group_question_details.group_question_option.map((option) => {
                return `<option value="${option.value}">${option.value}</option>`;
            }).join('');
        }

        inputHtml = `
        <select name="${fieldName}" class="form-select ${question.group_question_details.is_multiple === 1 ? 'select' : ''}" ${question.group_question_details.is_multiple === 1 ? ' multiple' : ''} required>
            ${optionsHtml}
        </select>
        `;
    } else if (type === "checkbox" || type === "radio") {
        const optionsType = type;
        const options = question.group_question_details.group_question_option.map((option) => {
            return `
            <div class="form-check" style="display: flex; flex-direction: row; align-items: flex-start;">
                <input class="" type="${optionsType}" name="${fieldName}[]" value="${option.value}" id="${optionsType}_${questionId}_${index}_${option.value}" style="margin-top: 5px; margin-right: 5px;">
                <label class="form-check-label" for="${optionsType}_${questionId}_${index}_${option.value}">
                    ${option.value}
                </label>
            </div>
                    `;
        }).join('');

        inputHtml = options;
    } else if (type === "input") {
        inputHtml = `<div style="margin-left: 20px;"><input type="text" name="${fieldName}" class="form-control" required/></div>`;
    } else if (type === "textarea") {
        inputHtml = `<div style="margin-left: 20px;"><textarea class="form-control" name="${fieldName}" required></textarea></div>`;
    }

    return inputHtml;
}


// Function to populate the modal with content based on groupId
function populateJoinRequestModal(groupId) {

    getDetails(
        "/manage-groups/" + groupId,
        (data) => {

            const modalBody = $("#joinRequestModal .modal-body");
            modalBody.empty(); // Clear existing content

            $("#group_id").val(groupId);
            $("#is_direct_join").val(data.results.is_direct_join);
            if (data.results.group_question.length > 0) {
                // questions by type
                const questionsByType = {};
                data.results.group_question.forEach((question) => {
                    if (!questionsByType.hasOwnProperty(question.type)) {
                        questionsByType[question.type] = [];
                    }
                    questionsByType[question.type].push(question);
                });
                let answerIndex = 0;

                // Generate and append content for each question type
                Object.keys(questionsByType).forEach((type) => {
                    const typeQuestions = questionsByType[type];
                    const typeHtml = generateQuestionHtmlData(type, typeQuestions, answerIndex);
                    modalBody.append(typeHtml);
                    answerIndex++;
                });
            } else {
                const group_details_html = `
                                            <div class="card text-center">
                                                <div class="card-header h4">
                                                ${data.results.name}
                                                </div>
                                                <div class="card-body">
                                                    <p class="card-text text-dark">${data.results.description}</p>
                                                </div>
                                                <div class="card-footer text-dark">${data.results.rules}</div>
                                          </div>
                                                <div class="container mt-5">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="acceptTerms" required>
                                                                    <label class="form-check-label" for="acceptTerms">I agree to the terms and conditions</label>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        `;

                modalBody.append(group_details_html);
            }
            // Show the modal
            $("#joinRequestModal").modal("show");
        },
        (error) => {

        }
    );
}
