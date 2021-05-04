let errors = [];

class FormValidator {
    constructor(form, fields) {
        this.form = form;
        this.fields = fields;
    }

    initialize() {
        this.validateOnEntry();
        this.validateOnSubmit();
    }

    validateOnSubmit() {
        let self = this;

        this.form.addEventListener('submit', e => {
            e.preventDefault();
            self.fields.forEach(field => {
                const input = document.querySelector(`#${field}`);
                self.validateFields(input);
            });
        })
    }

    validateOnEntry() {
        let self = this;
        this.fields.forEach(field => {
            const input = document.querySelector(`#${field}`);

            input.addEventListener('input', event => {
                self.validateFields(input);
            });

            input.addEventListener('blur', event => {
                self.validateFields(input);
            });
        })
    }

    validateFields(field) {
        if (field.value.trim() === "") {
            this.setStatus(field, `${field.previousElementSibling.innerText} nie może być puste`, "error");
            errors.push(field.name);
        } else {
            this.element = field.getAttribute('data-name');
            this.element = true;
            this.setStatus(field, null, "success");
            errors.splice(errors.indexOf(field.name), 1);
        }

        if (field.type === "email") {
            const re = /\S+@\S+\.\S+/;
            if (re.test(field.value)) {
                this.setStatus(field, null, "success");
                errors.splice(errors.indexOf(field.name), 1);
            } else {
                this.setStatus(field, "Proszę wprowadzić prawidłowy adres email", "error");
                errors.push(field.name);
            }
        }

        if (field.type === "checkbox") {
            if (field.checked) {
                this.setStatus(field, null, "success");
                errors.splice(errors.indexOf(field.name), 1);
            } else {
                this.setStatus(field, "Proszę zaakceptować warunki", "error");
                errors.push(field.name);
            }
        }
    }

    setStatus(field, message, status) {
        const successIcon = field.parentElement.querySelector('.icon-success');
        const errorIcon = field.parentElement.querySelector('.icon-error');
        const errorMessage = field.parentElement.querySelector('.error-message');

        if (status === "success") {
            if (errorIcon) {
                errorIcon.classList.add('hidden');
            }
            if (errorMessage) {
                errorMessage.innerText = "";
            }
            successIcon.classList.remove('hidden');
            field.classList.remove('input-error');
        }

        if (status === "error") {
            if (successIcon) {
                successIcon.classList.add('hidden');
            }
            field.parentElement.querySelector('.error-message').innerText = message;
            errorIcon.classList.remove('hidden');
            field.classList.add('input-error');
        }
    }
}

const form = document.querySelector('.form');
const fields = ["first-name", "last-name", "login", "email", "city", "agreement"];

const validator = new FormValidator(form, fields);
validator.initialize();

;(function ($) {
    $('form').on('submit', function (e) {
        e.preventDefault();
        if(errors.length === 0) {
            const firstName = document.getElementById('first-name');
            const lastName = document.getElementById('last-name');
            const login = document.getElementById('login');
            const email = document.getElementById('email');
            const city = document.getElementById('city');
            const agreement = document.getElementById('agreement');
            const url = document.getElementById('url');

            let jsonObject = {
                firstName: firstName.value,
                lastName: lastName.value,
                login: login.value,
                email: email.value,
                city: city.value,
                agreement: agreement.checked,
            }
            $.ajax({
                url: url.value + "/form.php",
                type: "post",
                data: {customForm: jsonObject},
                dataType: "json",
                success: function (data) {
                    alert(data);
                },
            });
        }
    });
})(jQuery);