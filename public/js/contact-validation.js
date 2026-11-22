document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contactForm');
    if (!form) return;

    const fields = ['name', 'email', 'subject', 'message'];
    const successMessage = document.getElementById('contactClientSuccess');
    const messageField = form.elements.message;
    const characterCounter = document.getElementById('messageCharacterCounter');
    const maxMessageLength = Number(messageField?.getAttribute('maxlength')) || 5000;

    const updateMessageCounter = () => {
        if (!messageField || !characterCounter) return;
        const length = messageField.value.length;
        characterCounter.textContent = `${length} / ${maxMessageLength} characters`;
        characterCounter.classList.toggle('is-near-limit', length >= maxMessageLength * 0.9);
        characterCounter.classList.toggle('is-too-short', length > 0 && length < 10);
    };

    updateMessageCounter();
    if (messageField) messageField.addEventListener('input', updateMessageCounter);
    const submitButton = form.querySelector('button[type="submit"]');
    const defaultButtonText = submitButton ? submitButton.textContent : '';

    const showError = (name, message) => {
        const field = form.elements[name];
        const error = form.querySelector(`[data-error-for="${name}"]`);
        if (error) error.textContent = message;
        if (field) field.setAttribute('aria-invalid', message ? 'true' : 'false');
    };

    form.addEventListener('submit', (event) => {
        let valid = true;

        // Clear any previous client-side success state before validating again.
        if (successMessage) {
            successMessage.hidden = true;
            successMessage.textContent = '';
        }
        if (submitButton) {
            submitButton.disabled = false;
            submitButton.textContent = defaultButtonText;
        }

        fields.forEach((name) => {
            const field = form.elements[name];
            const value = field.value.trim();
            let message = '';

            if (!value) {
                message = 'This field is required.';
            } else if (name === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(value)) {
                message = 'Please enter a valid email address.';
            } else if (name === 'message' && value.length < 10) {
                message = 'Please enter at least 10 characters.';
            }

            showError(name, message);
            if (message) valid = false;
        });

        if (!valid) {
            event.preventDefault();
            const firstInvalid = form.querySelector('[aria-invalid="true"]');
            if (firstInvalid) firstInvalid.focus();
            return;
        }

        // This confirms client-side validation. Laravel still validates and stores
        // the message, then displays the final server-confirmed success message.
        if (successMessage) {
            successMessage.textContent = 'Your form is valid! Sending your message securely...';
            successMessage.hidden = false;
        }
        if (submitButton) {
            submitButton.disabled = true;
            submitButton.textContent = 'SENDING...';
        }
    });

    fields.forEach((name) => {
        const field = form.elements[name];
        field.addEventListener('input', () => {
            showError(name, '');
            if (successMessage) {
                successMessage.hidden = true;
                successMessage.textContent = '';
            }
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.textContent = defaultButtonText;
            }
        });
    });
});
