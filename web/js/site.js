$(document).ready(function () {
        $('#main-form input').change(function (e) {
            window.setTimeout(
                function () {
                    if (!$(this.parentElement).hasClass('has-error')) {
                        $.ajax('/wunderwaffel/updateform', {
                            'data': {
                                'value': this.value,
                                'name': /WunderWaffelForm\[(\w+)\]/.exec(this.name)[1]
                            }
                        });
                    }
                }.bind(this),
                500);
        });
    }
);