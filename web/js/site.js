$(document).ready(function () {
        $('#main-form input').change(function (e) {
            $.ajax('/wunderwaffel/updateform', {
                'data' : {
                    'value' : this.value,
                    'name' : /WunderWaffelForm\[(\w+)\]/.exec(this.name)[1]
                }
            });
        });
    }
);