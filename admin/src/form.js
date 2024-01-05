jQuery(document).ready(function ($) {


    const form = document.getElementById('editForm');
    function trackChanges(event) {
        const changedFieldId = event.target.id;
        const changedValue = event.target.value;
    }
    const inputFields = form.querySelectorAll('input');
    inputFields.forEach(inputField => {
        inputField.addEventListener('input', trackChanges);
    });



    $('.edit').on('click', function (e) {

        console.log("i am editing :", $(this).attr('data-id'));
        document.getElementById('hidden_id').value = $(this).attr('data-id');
        document.getElementById('name').value = $(this).attr('data-name');
        document.getElementById('email').value = $(this).attr('data-email');
        document.getElementById('phone').value = $(this).attr('data-phone');
        document.getElementById('message').value = $(this).attr('data-message');

        document.getElementById("editForm").style.display = "block";

    });



    ///DELETE FUNCTION
    $('.delete').on('click', function (e) {
        let ID = $(this).attr('row-id');
        console.log("i am deleting the element with id :", ID);
        var dataToSend = {
            'action': 'delete_item',
            "nonce": senpai_ajax_actions_params.nonce,
            "id": ID,
        };

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: dataToSend,
            success: function (response) {
                console.log(response);
            },
            error: function (errorThrown) {
                console.error('Error:', errorThrown);
            }
        });
        window.location.reload();

    });

    // Save Button behavior
    var saveButton = document.getElementById('saveButton');
    saveButton.addEventListener('click', function (e) {
        e.preventDefault();
        document.getElementById("editForm").style.display = "none";
        var dataToSend = {
            "nonce": senpai_ajax_actions_params.nonce,
            "action": "edit_item",
            "id": document.getElementById('hidden_id').value,
            "new_name": document.getElementById('name').value,
            "new_email": document.getElementById('email').value,
            "new_phone": document.getElementById('phone').value,
            "new_message": document.getElementById('message').value,
        };
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: dataToSend,
            success: function (response) {
                console.log(response);
            },
            error: function (errorThrown) {
                console.error('Error:', errorThrown);
            }
        });

        document.getElementById('myForm').reset();
        window.location.reload();

    });

});