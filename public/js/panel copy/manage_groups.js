let coverPhoto = "";

// Show/hide the options container based on the selected question type
$(document).on("change", ".type", function () {
    var selectedType = $(this).val();
    if (selectedType === 'select' || selectedType === 'checkbox' || selectedType === 'radio') {
        $(this).closest(".row").find(".add_option_btn").show();
    } else {
        $(this).closest(".row").find(".add_option_btn").hide();
    }
    var optionHtml = `
            <div class="form-group option-item mt-2">
                <div class="">
                    <div class="input-group option-item">
                        <input type="text" class="form-control option_value" name="options[]" placeholder="Option" required>
                    </div>
                </div>
            </div>
        `;
    if (selectedType == 'select') {
        $(this).closest(".row").find(".is_multiple_option").show();
    } else {
        $(this).closest(".row").find(".is_multiple").prop("checked", false);
        $(this).closest(".row").find(".is_multiple_option").hide();
    }

    if (selectedType == '' || selectedType == 'input' || selectedType == 'textarea') {
        $(this).closest(".row").find(".options_container").html('');
    } else {
        $(this).closest(".row").find(".options_container").html(optionHtml);
    }
});

// Add option on "Add Option" button click
$(document).on("click", ".add_option_btn", function () {
    var optionHtml = `
            <div class="form-group col-md-6 option-item mt-2">
                <div class="">
                    <div class="input-group option-item">
                        <input type="text" class="form-control option_value" name="options[]" placeholder="Option" required>
                        <button type="button" class="btn btn-danger remove-option-btn">Remove</button>
                    </div>
                </div>
            </div>
        `;

    $(this).closest(".row").find(".options_container").append(optionHtml);

});

// Remove option on "Remove" button click
$(document).on("click", ".remove-option-btn", function () {
    option_id = $(this).data('option_id');
    if (option_id != undefined) {
        //Delete
        deleteAction(
            '/group-question-options/' + option_id,
            (data) => {
                $(this).closest(".option-item").remove();
                // Success callback
                toastrSuccessMessage(data.message);
            },
            (error) => {
                // Error callback
                toastrErrorMessage(error.responseJSON.message);
            }
        );
    } else {
        $(this).closest(".option-item").remove();
    }

});

// Add initial question
function addInitialQuestion() {
    html = generateQuestionHtml();
    $("#question_container").append(html);
}

function removeQuestionBank(button) {
    question_id = $(button).data('question_id');

    if (question_id != '') {
        //Delete
        deleteAction(
            '/group-questions/' + question_id,
            (data) => {
                $(button).parents('.question_bank').remove();
                // Success callback
                toastrSuccessMessage(data.message);
            },
            (error) => {
                // Error callback
                toastrErrorMessage(error.responseJSON.message);
            }
        );
    } else {
        $(button).parents('.question_bank').remove();
    }
}

// Attach click event handler to the delete link
$(document).on("click", ".delete-group", function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    //Get Group I'd
    const groupId = $(this).data("id");

    //Delete
    deleteAction(
        '/manage-groups/' + groupId,
        (data) => {
            table.clear().draw();

            // Success callback
            toastrSuccessMessage(data.message);
        },
        (error) => {
            // Error callback
            toastrErrorMessage(error.responseJSON.message);
        }
    );
});

$('#cover_photo').on('change', function() {
    var img = this.files[0]; // Use 'this' to refer to the input element
    var reader = new FileReader();

    reader.onloadend = function() {
        coverPhoto = reader.result;
        $("#base64Img").attr("src", reader.result);
    }

    reader.readAsDataURL(img);
});

// Attach event listener for form submission
$("#group_form").submit(function (event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    //get group id
    const id = $("#group_form #group_id").val();
    const isDirectJoinValue = $("#group_form #is_direct_join").prop("checked") ? 1 : 0;

    // Load the selected group details and submit the form
    const group = {
        name: $("#group_form #name").val(),
        description: $("#group_form #description").val(),
        rules: $("#group_form #rules").val(),
        is_direct_join: isDirectJoinValue,
        photo: coverPhoto
    };
    // Validate the form data
    const isValid = validateGroupForm(group);


    // If the form is valid, submit it
    if (isValid) {
    disableSubmitButton();

        // Gather question data
        const questions = [];

        $(".question_bank").each(function () {
            const questionTitle = $(this).find(".form-control[name='title']").val();
            const questionType = $(this).find(".form-control[name='type']").val();
            const questionIsMultiple = $(this).find(".form-check-input[name='is_multiple']").is(':checked') ? 1 : 0;
            const questionId = $(this).find(".form-control[name='question_id']").val();

            const options = [];
            $(this).find(".option_value").each(function () {
                const optionValue = $(this).val();
                option_id = $(this).data('option_id') ?? null;
                options.push({
                    option_id: option_id,
                    option_value: optionValue,
                });
            });

            questions.push({
                question_id: questionId,
                title: questionTitle,
                type: questionType,
                is_multiple: questionIsMultiple,
                options: options
            });
        });

        group.questions = questions; // Add questions to the group object
        // Submit the form
        submitGroupForm(group, id);
    }
});

// Validation Function
function validateGroupForm(formData) {
    // Clear previous error messages
    $(".invalid-feedback").removeClass('d-block').text('');

    const errors = {};

    if (!formData.name) {
        errors.name = "Name is required.";
    }

    if (!formData.description) {
        errors.description = "Description is required.";
    } else if (formData.description.length > 180) {
        errors.description = "Description cannot exceed 180 characters.";
    }

    if (!formData.rules) {
        errors.rules = "Rules are required.";
    } else if (formData.rules.length > 180) {
        errors.rules = "Rules cannot exceed 180 characters.";
    }

    // Validate each question bank
    const questionBanks = $(".question_bank");
     if (questionBanks.length > 0) {
        questionBanks.each(function (index) {
            const questionBank = $(this);
            const title = questionBank.find(".title").val();
            const type = questionBank.find(".type").val();

            if (!title) {
                errors[`title_${index}`] = "Question title is required.";
            }

            if (!type) {
                errors[`type_${index}`] = "Question type is required.";
            }

            const options = questionBank.find(".option-item .option_value");
            options.each(function (i) {
                const optionValue = $(this).val();
                if (!optionValue) {
                    errors[`option_${index}_${i}`] = "Option value is required.";
                }
            });
        });
    }
    console.log(errors);
    // Display error messages if any
    for (const key in errors) {
        $("#" + key + "Error").addClass('d-block').text(errors[key]);
    }

    return Object.keys(errors).length === 0;
}

// Function to handle form submission
function submitGroupForm(formData, selectedId = "") {
    saveAction(
        selectedId.trim() !== "" ? "update" : "store",
        "/manage-groups",
        formData,
        selectedId,
        (data) => {
            toastrSuccessMessage(data.message);
            redirectUrl('/manage-groups');
        },
        (error) => {
            toastrErrorMessage(error.responseJSON.message);
        }
    ).always(() => {
        enableSubmitButton();
    });
}

//Set the selected parent ID
function setGroupSelectedId(group) {
    $("#group_form #group_id").val(group['id']);
    $("#group_form #name").val(group['name']);
    $("#group_form #description").summernote ('code', group['description']);
    $("#group_form #rules").summernote ('code', group['rules']);
    $("#group_form #is_direct_join").prop("checked", group['is_direct_join'] === 1);
    $("#group_form #base64Img").attr("src", group?.cover_photo?.file_path);
    group.group_question.forEach(function (question) {
        var questionHtml = generateQuestionHtml(question['id'], question['name'], question['type'], question['group_question_details']['is_multiple'], question['group_question_details']['group_question_option']);
        $("#question_container").append(questionHtml);
    });
}

//Load Details View
function loadGroupDetailsView(group) {
    if (group.length != 0) {
        getDetails(
            "/manage-groups/" + group['id'],
            (data) => {
                setGroupSelectedId(data.results);
            },
            (error) => {

            }
        );

    }
}

//Load Data Tables
function loadGroupDataTable() {
    initializeDataTable(
        `/manage-groups/lists`,
        [
            generateColumn('name', (data, type, row) => {
                if (type == 'display' && data.length > 30) {
                    return data.substr(0, 30) + '...';
                }
                return data;
            }, 'name'),
            generateColumn('code', (data, type, row) => `<span class="group_code" style="cursor: pointer;">${data}</span>`, 'code'), // Wrap code in a <span> for click event
            generateColumn('join_request_counts.approved', null, 'active_member'),
            generateColumn('join_request_counts.pending', null, 'join_request'),
            generateColumn('group_posts.approved', null, 'group_approved_posts'),
            generateColumn('group_posts.pending', null, 'group_pending_posts'),
            generateColumn('created_at', null, 'created_at'),
            generateColumn('action', (data, type, row) => linkableActions(row.id), 'name'),
        ]
    );

    // Add a click event listener
    $(document).on('click', '.group_code', function () {
        // Get the text
        const codeText = $(this).text();
        // Copy the code
        const tempInput = $('<input>');
        $('body').append(tempInput);
        tempInput.val(codeText).select();
        document.execCommand('copy');
        tempInput.remove();

        // Code copied msg
        toastrSuccessMessage('Code copied to clipboard');
    });
}


//Generates linkable text for a department with an ID and text.
function linkableActions(id, text) {
    return `
                <a class="btn btn-sm btn-primary" href="/manage-groups/${id}/posts" title="View">Posts</a>
                <a class="btn btn-sm btn-success" href="/manage-groups/${id}/members" title="View">Members</a>
                <a class="btn btn-sm btn-info" href="/manage-groups/${id}/edit" title="Update">Update</a>
                <a class="delete-group btn btn-sm btn-danger" data-id="${id}" title="Delete">Delete</a>
           `;
}
