import './bootstrap';
import toastr from 'toastr';

// Cấu hình toastr (tuỳ chọn)
toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: 'toast-top-right',
    showDuration: '300',
    hideDuration: '1000',
    timeOut: '5000',
    extendedTimeOut: '1000',
};
