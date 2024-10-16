/**
 * @team: CaseThemes Team
 * @since: 1.0.0
 * @author: CaseThemes
 */
(function ($) {
    $(document).on('click', '.button-primary.create-demo', function (e) {
        e.preventDefault();
        if ($('#swa-ie-id').val() === '') {
            $('#swa-ie-id').focus();
        } else {
            $('.swa-export-contents').submit();
        }
    });
    $(document).on('click', '.swa-import-btn.swa-import-submit', function (e) {
        e.preventDefault();
        var _form = $(this).parents('form.swa-ie-demo-item');
        if (confirm('Are you sure you want to install this demo data?')) {
            _form.find(".swa-loading").css('display','block');
            _form.submit();
        } else {
            return;
        }
    });
    $(document).on('click', '.swa-delete-demo', function (e) {
        e.preventDefault();
        var _this = $(this);
        var _validate = prompt("Type \"reset\" in the confirmation field to confirm the reset and then click the OK button");
        if (_validate === "reset") {
            if (confirm('Are you sure you want to reset site?')) {
                _this.parents('form.swa-ie-demo-item').find('input[name="action"]').val('swa-reset');
                _this.parents('form.swa-ie-demo-item').submit();
            } else {
                return;
            }
        } else {
            if(_validate !== null){
                alert('Invalid confirmation. Please type \'reset\' in the confirmation field.');
            }else{
               return;
            }
        }
    });
})(jQuery);
