function updateSteps(step_in, step_out) {
    window.setTimeout( function () {
        if(
            0 === $('.has-error', step_out).length
            && $('input', step_out).get().reduce(function (cur, aux) { return cur && (aux.value != '');}, true)
        ) {
            step_in.addClass('in');
            step_out.removeClass('in');
        }
    }, 500);
}

$(document).ready(function () {
    $('#first-step button').click(function () {
        updateSteps($('#second-step'), $('#first-step'));
    });
    $('#second-step button').click(function () {
        updateSteps($('#third-step'), $('#second-step'));
    });
});
