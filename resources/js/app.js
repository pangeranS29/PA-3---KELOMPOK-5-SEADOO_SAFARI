import './bootstrap';


document.addEventListener('DOMContentLoaded', function() {
    const emailField = document.getElementById('email');
    if (emailField) {
        emailField.addEventListener('blur', function() {
            const email = this.value;
            const domain = email.split('@')[1];
            const googleDomains = ['gmail.com', 'googlemail.com'];

            if (domain && !googleDomains.includes(domain.toLowerCase())) {
                // Show error message without alert
                const errorElement = document.createElement('p');
                errorElement.className = 'mt-1 text-sm text-red-600';
                errorElement.textContent = 'Please use a Google email (Gmail or Google Workspace account).';

                // Remove previous error if exists
                const existingError = this.nextElementSibling;
                if (existingError && existingError.classList.contains('text-red-600')) {
                    existingError.remove();
                }

                this.insertAdjacentElement('afterend', errorElement);
            }
        });
    }
});
