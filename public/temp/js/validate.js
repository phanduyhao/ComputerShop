// Click để xóa các thông báo đỏ của check dữ liệu
$('form .input-field').each(function () {
    $(this).click(function () {
        $(this).parent().find('.helper').remove();
        $(this).removeClass('input-error'); //
    })
})

// Prevent click events within the form from triggering the body click event
$('body form').on('click', function(e) {
    e.stopPropagation();
});

// Kiểm tra dữ liệu đầu vào đã nhập hay chưa ?

    // --------------------------- COMMENT ------------------------ //

    $(' form button[type="submit"]').on('click', function(e){
        e.preventDefault();
        let form = $(this).closest('form');
        let formID = form.attr('id');
        let formAction = form.data('action'); // Lấy route action từ thuộc tính data-action
        if(validateForm(`#${formID}`)) {
            let formData = form.serialize(); // được sử dụng khi bạn muốn gửi dữ liệu của form dưới dạng chuỗi để thực hiện các yêu cầu HTTP như POST hoặc GET.
            $.ajax({
                type: "POST",
                url: formAction, // Sử dụng route action tương ứng của form
                data: formData,
                success: function(response) {
                    alert('Đã gửi thành công !');
                    // Xóa Các Dữ liệu cũ trong các ô Input
                    $(`#${formID} input[type=text], #${formID} input[type=email], #${formID} textarea`).val('');
                    // Gọi hàm hiển thị Comment ra HTML
                    var dataId = $('#'+formID+' .boxCommentFormReplyID ').attr('id');
                    if (formID === 'boxCommentForm') {
                        appendNewComment(response, 'comment-list');
                    } else if (formID === 'boxCommentFormReply_'+dataId) {
                        appendNewComment(response, 'comment-list__child-'+dataId);
                    }
                },
                error: function() {
                    console.log("An error occurred.");
                }
            });
        }
    });

// Add click event listener to the entire body
    $('body').on('click', function(e) {
        $('.helper').remove(); // Remove error helpers
        $('.input-error').removeClass('input-error'); // Remove input-error class
    });

// Kiểm tra dữ liệu đầu vào đã nhập hay chưa ?
function validateForm(formID) {
    let checkValid = true;
    $(formID).find('.input-field').each(function(){
        let value = $(this).val();
        let fieldType = $(this).attr('type'); // Get input field type
        $(this).removeClass('input-error'); // Remove input-error class
        // Check if the field is an email input and validate the format
        if (fieldType == 'email' && value !== '') {
            if (!isValidEmail(value)) {
                checkValid = false;
                $(this).addClass('input-error');
                let emailAlert = `<span class="helper text-danger" style="z-index: 999;margin-top: 75px;">Chưa nhập đúng kiểu email</span>`;
                $(this).parent().append(emailAlert);
            }
        }
        if(value == null || value == '' || value == undefined) {
            checkValid = false;
            $(this).addClass('input-error');
            let htmlAlert = `<span class="helper text-danger" style="z-index: 999;margin-top: 75px;">${$(this).data('require')}</span>`;
            $(this).parent().append(htmlAlert);
        }
    });
    return checkValid;
}

// Check xem có đúng kiểu Email khi nhập vào không ?
    function isValidEmail(email) {
        // Basic email format validation using regular expression
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }

//    HIỂN THỊ COMMENT
    function appendNewComment(commentData, targetList) {
        var newComment = $('<div class="comment-user">' +
            '<p class="id_user d-none" >commentData.id</p>'+
            '<div class="d-flex" style="align-items: flex-start;">'+
            '<img src="temp/images/Accountcircle.png" class="comment-user__img" alt="">'+
            '<div class="comment-user__infor">'+
            '<p class="name">' + commentData.user_name + '</p>'+
            '<p class="type">' + commentData.comment + '</p>'+
            '</div>'+
            '</div>'+
            '<div class="reply">'+
            '</div>');
        // Thêm bình luận vào thể có class " comment-list "
        $(`.${targetList}`).prepend(newComment);
    }


// Chức năng Bấm vào " Trả lời " thì hiển form bình luận
    $('.reply-text__link').on('click', function(event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết
        // Ẩn tất cả các form trả lời hiện có
        $('.comment-box.child').addClass('d-none');

        // Hiển thị form trả lời tương ứng với liên kết được click
        var commentBox = $(this).closest('.comment-user').find('.comment-box.child');
        commentBox.removeClass('d-none');
    });
