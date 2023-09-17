// Define a debounce function
function debounce(func, delay) {
  let timer;
  return function() {
      clearTimeout(timer);
      timer = setTimeout(() => {
          func.apply(this, arguments);
      }, delay);
  };
}

function removePreloaderFromElement(className) {
  const elements = document.querySelectorAll(`.${className}`);

  elements.forEach((element) => {
    const preloader = element.querySelector('#preloader');
    if (preloader) {
      element.removeChild(preloader);
    }
  });
}

function addPreloaderToElement(className) {
  const elements = document.querySelectorAll(`.${className}`);

  if (!elements.length) {
    console.error(`No elements found.`);
    return;
  }

  const preloaderHtml = `
                        <div id="preloader" class="d-flex justify-content-center">
                          <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                          </div>
                        </div>
                        `;

  elements.forEach((element) => {
    element.innerHTML = preloaderHtml;
  });
}


// Custom toaster js
function showCustomToast(type, message) {
  const toast = document.getElementById('custom-toast');
  console.log(toast);
  const toastIcon = toast.querySelector('.toast-icon');
  const toastMessage = toast.querySelector('.toast-message');

  toastMessage.textContent = message;

  switch (type) {
    case 'success':
      toastIcon.style.backgroundColor = '#3ca82c';
      break;
    case 'error':
      toastIcon.style.backgroundColor = '#f00';
      break;
    case 'warning':
      toastIcon.style.backgroundColor = '#ff9800';
      break;
    default:
      break;
  }

  toast.style.display = 'block';

  setTimeout(() => {
    toast.style.display = 'none';
  }, 3000);
}

// Form validate
function formValidate(fields) {
  var errorFields = [];
  fields.forEach(function (field) {
    var fields = $('[name="' + field.name + '"]');
    var isFieldValid = true;
    console.log(fields);

    fields.each(function () {
      var field = $(this);
      var fieldValue = field.val();

      if (typeof fieldValue === 'string') {
        fieldValue = fieldValue.trim();
      }

      if (fieldValue === '' || fieldValue === null) {
        isFieldValid = false;
        field.addClass('invalid');
      } else {
        // select2-selection--single
        field.removeClass('invalid');
      }

      // Check phone field
      if (field.attr('name') === 'phone') {
        // Validate phone number
        var phonePattern = /^\d{11}$/;
        if (!phonePattern.test(fieldValue)) {
          field.addClass('invalid');
          errorFields.push('Invalid phone number.');
        } else {
          field.removeClass('invalid');
        }
      }

      // Check level_of_education field and department_id field
      if (field.attr('name') === 'level_of_education') {
        var levelValue = fieldValue;
        var educationContainer = field.closest(".education-container");
        var departmentField = educationContainer.find('.department-field [name="department_id"]');
        var departmentFieldValue = departmentField.val();
        if (levelValue != '' && levelValue !== 'secondary' && levelValue !== 'higher_secondary') {
          if (!departmentFieldValue || departmentFieldValue === '') {
            isFieldValid = false;
            departmentField.addClass('invalid');
            errorFields.push('Department');
          } else {
            departmentField.removeClass('invalid');
          }
        } else {
          departmentField.removeClass('invalid');
          if (fieldValue == "instutute_id") {
            isFieldValid = true;
          }
        }
      }

    });

    if (!isFieldValid) {
      errorFields.push(field.label);
    }

  });

  // Phone validate
  // Retrieve is_currently_working if exist
  var isCurrentlyWorkingExists = fields.some(function (field) {
    field.name === 'phone';
  });

  flag = 1;
  // Retrieve is_currently_working if exist
  var isCurrentlyWorkingExists = fields.some(function (field) {
    return field.name === 'is_currently_working';
  });

  // Check is_currently_working exist or not
  if (isCurrentlyWorkingExists) {
    var employmentContainers = $('.sortable-employment-container');

    employmentContainers.each(function () {
      var container = $(this);
      var fromDateField = container.find('[name="from_date"]');
      var toDateField = container.find('[name="to_date"]');
      var currentlyWorkingCheckbox = container.find('[name="is_currently_working"]');

      var fromDateValue = fromDateField.val();
      var toDateValue = toDateField.val();
      var isCurrentlyWorking = currentlyWorkingCheckbox.prop('checked');

      if (!isCurrentlyWorking && (fromDateValue || toDateValue)) {
        var fromDate = new Date(fromDateValue);
        var toDate = new Date(toDateValue);

        if (toDate instanceof Date && isNaN(toDate)) {
          toDateField.addClass('invalid'); // if to_date not exist when is_currently_working is false
          flag = 0;
        } else if (fromDate > toDate) {
          fromDateField.addClass('invalid');
          toDateField.addClass('invalid');
          errorFields.push('From date must be less than to date.');
        } else {
          fromDateField.removeClass('invalid');
          toDateField.removeClass('invalid');
        }
      }

    });
  }

  if (flag == 0) {
    errorFields.push('To date');
  }
  if (errorFields.length > 0) {
    $('#error-message').text(errorFields.join(', '));
    $('#message').removeClass('invisible').addClass('visible');
    return false; // Validation failed
  }

  return true; // Validation succeeded
}


