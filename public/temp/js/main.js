
// Tăng giảm số lượng sản phẩm

$(document).ready(function() {
    $('.form-add-to-cart').each(function () {
        var formAddToCart = $(this).attr('id');
        var numberInput = $('#' + formAddToCart + ' .numberInput');
        var decreaseButton = $('#' + formAddToCart + ' .decreaseButton');
        var increaseButton = $('#' + formAddToCart + ' .increaseButton');

        decreaseButton.on('click',function () {
            var currentValue = parseInt(numberInput.val(), 10);
            if (currentValue > 0) {
               numberInput.val(currentValue - 1);
            }
        });
        increaseButton.on('click',function () {
            var currentValue = parseInt(numberInput.val(), 10);
                numberInput.val(currentValue + 1);
        })
    })

});

// Thêm vào giỏ hàng
$(document).ready(function() {
    $('.product-infor-main').each(function() {
        var productMain = $(this).attr('id');
        var addToCart = $('#' + productMain + ' .add-to-cart');
        var checkAuth = $('.check-auth').text();

        addToCart.on('click', function(e) {
            e.preventDefault();
            if(checkAuth == 1){
                const Amount = $(this).data('quantity');
                if(Amount > 0){
                    var productId = $(this).data('product-id');
                    var userId = $(this).data('user-id');
                    var thumbProduct = $('#' + productMain + ' .thumb-product').attr("src");
                    var nameProduct = $('#' + productMain + ' .title-product').text();
                    var priceProduct = $('#' + productMain + ' .okPrice-product').text();
                    var quantity = $('#' + productMain + ' .quantity').val();
                    priceProduct =  parseFloat(priceProduct.replace(/,/g, ''))
                    var subtotal = parseInt(quantity) * priceProduct;

                        // Gửi yêu cầu Ajax
                    if(quantity > 0){
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/addToCart',
                            type: 'POST',
                            data: {
                                product_id: productId,
                                user_id: userId,
                                thumb: thumbProduct,
                                name: nameProduct,
                                price: priceProduct,
                                quantity: quantity,
                                subtotal: subtotal
                            },
                            success: function(response) {
                                toastr.success(response.message, 'Thông báo');
                                window.location.reload();
                            },
                            error: function(error) {
                                toastr.error('Lỗi thêm giỏ hàng !');
                            }
                        });
                    }else{
                        toastr.error('Vui lòng nhập số lượng sản phẩm !');
                    }
                }else{
                    toastr.error('Sản phẩm đã hết hàng !');
                }
            }else{
                window.location.href = '/login';
            }
        });
    });
});

// Cập nhật giỏ hàng
$(document).ready(function () {
    $('#updateCartButton').on('click', function (e) {
        e.preventDefault();
        var cartUpdates = [];
        var isValid = true; // Cờ kiểm tra tính hợp lệ
    
        $('.quantity').each(function () {
            var cartId = $(this).data('cart-id');
            var newQuantity = $(this).val();
            var title = $(this).closest('.single-item-list').find('.title-product h6').text(); // Lấy tên sản phẩm
    
            // Kiểm tra số lượng
            if (newQuantity < 1) {
                alert('Số lượng của sản phẩm "' + title + '" phải lớn hơn hoặc bằng 1.');
                isValid = false;
                return false; // Thoát khỏi vòng lặp
            }else if(!Number.isInteger(Number(newQuantity)) ){
                alert('Số lượng của sản phẩm "' + title + '" phải là số nguyên!');
                isValid = false;
                return false; // Thoát khỏi vòng lặp
            }
    
            cartUpdates.push({ id: cartId, quantity: newQuantity });
        });
    
        // Nếu có lỗi, không thực hiện AJAX
        if (!isValid) {
            return;
        }
    
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/carts/updateQuantities',
            data: { cart_updates: cartUpdates },
            success: function (data) {
                if (data.success) {
                    location.reload();
                }
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    errors.forEach(function (error) {
                        alert(error);
                    });
                } else {
                    console.log(xhr.responseText);
                }
            }
        });
    });
    
    
});

// Checkout - lấy Session
$(document).ready(function () {
    $('#buy-products').click(function(e) {
        e.preventDefault();

        // Lấy thông tin cần lưu vào sessionStorage
        var productInfos = [];
        var cartItems = $('.single-item-list');
        var hasError = false; // Biến để kiểm tra lỗi
        
        cartItems.each(function() {
            var thumb = $(this).find('.thumb-product').attr('src');
            var title = $(this).find('.title-product').text();
            var slug = $(this).find('.title-product').attr('href');
            var price = $(this).find('.price-product').text();
            var quantity = parseInt($(this).find('.quantity').val()); // Chuyển quantity thành số nguyên
            var subtotal = $(this).find('.subtotal').text();
            var size_color = $(this).find('.size_color').text();

            // Kiểm tra nếu quantity < 1
            if (quantity < 1) {
                alert('Số lượng của sản phẩm "' + title + '" phải lớn hơn hoặc bằng 1.');
                hasError = true; // Đánh dấu rằng có lỗi
                return false; // Thoát khỏi vòng lặp each
            }else if(!Number.isInteger(Number(quantity)) ){
                alert('Số lượng của sản phẩm "' + title + '" phải là số nguyên!');
                isValid = false;
                return false; // Thoát khỏi vòng lặp
            }

            productInfos.push({ 
                thumb: thumb, 
                title: title, 
                slug: slug, 
                price: price, 
                quantity: quantity, 
                subtotal: subtotal, 
                size_color: size_color 
            });
        });

        // Nếu có lỗi, không thực hiện chuyển trang
        if (hasError) {
            return;
        }

        // Lưu thông tin vào sessionStorage
        sessionStorage.setItem('productInfos', JSON.stringify(productInfos));
        window.location.href = '/checkout';
    });
});


// Hiển thị các sản phẩm ở session lên html
$(document).ready(function () {
    var total = 0;
    // Kiểm tra xem có dữ liệu trong sessionStorage hay không
    var productInfos = sessionStorage.getItem('productInfos');
    if (productInfos) {
        // Chuyển dữ liệu từ JSON về đối tượng JavaScript
        productInfos = JSON.parse(productInfos);
        // Lặp qua mỗi phần tử trong mảng và thêm vào bảng
        productInfos.forEach(function (product,index) {
            var subtotal =  parseFloat(product.subtotal.replace(/,/g, ''))
            total += subtotal;
            var row='<div class="single-item-list text-center border-bottom py-2">'+
                        '<div class="row align-items-center">'+
                            '<div class="col-1">'+index+'</div>'+
                            '<div class="col-md-1 col-12">'+
                                '<img class="w-100" src="' + product.thumb + '" alt="' + product.title + '">'+
                                '</div>'+
                                '<div class="col-md-4 col-12">'+
                                '<a href="'+product.slug+'"><h6 class="title text-start text-primary">' + product.title + '</h6></a>'+
                            '</div>'+
                            '<div class="col-md-2 col-12">'+
                                '<span class="price">'+product.size_color +'</span>'+
                            '</div>'+
                            '<div class="col-md-2 col-12 product-infor form-add-to-cart" >'+
                                '<p class="mb-0">'+product.quantity+'</p>'+
                            '</div>'+
                            '<div class="col-md-2 col-12">'+
                                '<span class="subtotal">'+product.subtotal+'</span>'+
                            '</div>'+
                        '</div>'+
                    '</div>'
            ;
            $('.infor-product-session').append(row);
        });
        $('.total').append(formatNumber(total) + ' VNĐ')
        $('#total-amount').val(total);
        var input_total = '<input type="text" name="total" hidden class="total-input" value="'+formatNumber(total) + ' VNĐ'+'">'
        var input_total2 = '<input type="text" name="total2" hidden class="total-input" value="' + total + '">'
        $('#total-price').append(input_total)
        $('#total-price2').append(input_total2);

        // Kiểm tra các trường nhập địa chỉ trước khi mở modal thanh toán
        $(".btn-thanhtoan").on("click", function (event) {
            event.preventDefault(); // Chặn hành động mặc định ngay lập tức

            let isValid = true;
            $(".input-field").each(function () {
                if ($(this).val().trim() === "") {
                    isValid = false;
                    return false; // Dừng vòng lặp ngay khi có trường trống
                }
            });
    
            if (!isValid) {
                console.log("Nhập đầy đủ thông tin địa chỉ");
            } else {
                $("#exampleModal").modal("show"); // Chỉ hiển thị modal nếu nhập đầy đủ
            }
        });

        // Xử lý thanh toán VNPAY
        $("#vnpay-payment-btn").on("click", function (event) {
            event.preventDefault();
            let sdt = $(".input-sdt").val();
            let name = $(".input-name").val();
            let country = $(".input-country").val();
            let province = $(".input-province").val();
            let district = $(".input-district").val();
            let wards = $(".input-wards").val();
            let address = $(".input-address").val();
            let form = $('<form>', {
                action: "/checkout/Payment",
                method: "POST"
            });

            form.append($('<input>', { type: 'hidden', name: '_token', value: $('meta[name="csrf-token"]').attr("content") }));
            form.append($('<input>', { type: 'hidden', name: 'amount_money', value: total }));
            form.append($('<input>', { type: 'hidden', name: 'bank_code', value: $("select[name='bank_code']").val() }));
            form.append($('<input>', { type: 'hidden', name: 'sdt', value: sdt }));
            form.append($('<input>', { type: 'hidden', name: 'name', value: name }));
            form.append($('<input>', { type: 'hidden', name: 'Country', value: country }));
            form.append($('<input>', { type: 'hidden', name: 'province', value: province }));
            form.append($('<input>', { type: 'hidden', name: 'district', value: district }));
            form.append($('<input>', { type: 'hidden', name: 'wards', value: wards }));
            form.append($('<input>', { type: 'hidden', name: 'address', value: address }));

            $("body").append(form);
            form.submit();
        });
    }
});

function formatNumber(number) {
    // Sử dụng hàm toLocaleString để thực hiện định dạng số
    return number.toLocaleString('en-US');
}

// Lấy địa chỉ đã có
$('.address-exist').each(function () {
    var addressExist = $(this);
    addressExist.click(function () {
        var sdt = addressExist.find('.sdt').text();
        var name = addressExist.find('.name').text();
        var country = addressExist.find('.country').text();
        var district = addressExist.find('.district').text();
        var province = addressExist.find('.province').text();
        var wards = addressExist.find('.wards').text();
        var address = addressExist.find('.address').text();

        $('#form-process-checkout .input-sdt').val(sdt)
        $('#form-process-checkout .input-name').val(name)
        $('#form-process-checkout .input-country').val(country)
        $('#form-process-checkout .input-province').val(province)
        $('#form-process-checkout .input-district').val(district)
        $('#form-process-checkout .input-wards').val(wards)
        $('#form-process-checkout .input-address').val(address)
    })
})

// Đưa đỉa chỉ vào session và thanh toán thành công
$('.btn-checkout').click(function () {
    var sdt = $('#form-process-checkout .input-sdt').val();
    var name = $('#form-process-checkout .input-name').val();
    var country = $('#form-process-checkout .input-country').val();
    var province = $('#form-process-checkout .input-province').val();
    var district = $('#form-process-checkout .input-district').val();
    var wards = $('#form-process-checkout .input-wards').val();
    var address = $('#form-process-checkout .input-address').val();
    var addressInfors = [];
    addressInfors.push({ sdt: sdt, name: name, country: country, province: province, district: district, wards:wards, address:address });
    sessionStorage.setItem('addressInfors', JSON.stringify(addressInfors));
})

// Hiển thị địa chỉ lên HTML khi thanh toán thành công
$(document).ready(function () {
    // Kiểm tra xem có dữ liệu trong sessionStorage hay không
    var addressInfors = sessionStorage.getItem('addressInfors');
    if (addressInfors) {
        // Chuyển dữ liệu từ JSON về đối tượng JavaScript
        addressInfors = JSON.parse(addressInfors);
        // Lặp qua mỗi phần tử trong mảng và thêm vào bảng
        addressInfors.forEach(function (address,index) {
            var row='<h6>' + address.sdt +',' + address.name + address.address + address.wards + address.district + address.province + address.country +    '</h6>';
            $('.infor-address-session').append(row);
        });
    }
});







