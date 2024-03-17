document.getElementById('birthdate').max = new Date().toISOString().split("T")[0];

$('#otherTalentInput').change(function() {
    $('#otherTalentRadio').val($(this).val());
});

function onlyAlphabet(id) {
    const element = document.getElementById(id);
    element.value = element.value.replace(/[^a-zA-Z ]*$/, '');
}

function onlyNumber(id) {
	const element = document.getElementById(id);
	element.value = element.value.replace(/[^0-9]/gi, '');
}

function submitForm() {
    if (grecaptcha.getResponse()) {
        if ($('#solo').is(':checked')) {
            $('input[name=gender]').attr('required', 'required');
            $('select[name=member]').removeAttr('required');
        }

        if ($('#group').is(':checked')) {
            $('select[name=member]').attr('required', 'required');
            $('input[name=gender]').removeAttr('required');
        }

        document.getElementById('submit').click();
    } else {
        alert('Pastikan Anda telah mencentang captcha');
    }
}
