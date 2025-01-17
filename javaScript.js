function eCompletat(event) {
    event.preventDefault();
    const form = event.target.form;
    const inputs = form.querySelectorAll('input');
    let isValid = true;

    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.style.border = '2px solid red';
            isValid = false;
        } else {
            input.style.border = '';
        }
    });

    if (isValid) {
        form.submit();
    }
}
