var within_first_modal = false;
$('.btn-second-modal').on('click', function () {
    if ($(this).hasClass('within-first-modal')) {
        within_first_modal = true;
        var modal = document.getElementById('first-modal');
        if (modal) {
            modal.style.display = 'none';
        }
    }
    var modal = document.getElementById('second-modal');
    if (modal) {
        modal.style.display = 'block'; // Set it to 'block' to show the modal
    }
});

$('.btn-second-modal-close').on('click', function () {
    var secondModal = document.getElementById('second-modal');
    var firstModal = document.getElementById('first-modal');

    if (secondModal) {
        secondModal.style.display = 'none';
    }

    if (within_first_modal && firstModal) {
        firstModal.style.display = 'block';
        within_first_modal = false;
    }

});

$('.btn-toggle-fade').on('click', function () {
    if ($('.modal').hasClass('fade')) {
        $('.modal').removeClass('fade');
        $(this).removeClass('btn-success');
    } else {
        $('.modal').addClass('fade');
        $(this).addClass('btn-success');
    }
});
