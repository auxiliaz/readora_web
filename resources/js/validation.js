/**
 * Client-side validation utilities for Readora
 */

class ValidationHelper {
    constructor() {
        this.rules = {
            required: (value) => value !== null && value !== undefined && value.toString().trim() !== '',
            email: (value) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value),
            min: (value, min) => value.toString().length >= min,
            max: (value, max) => value.toString().length <= max,
            numeric: (value) => !isNaN(value) && !isNaN(parseFloat(value)),
            integer: (value) => Number.isInteger(Number(value)),
            phone: (value) => /^[\+]?[0-9\-\(\)\s]+$/.test(value),
            password: (value) => {
                // At least 8 characters, 1 uppercase, 1 lowercase, 1 number, 1 symbol
                return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value);
            }
        };
        
        this.messages = {
            required: 'This field is required.',
            email: 'Please enter a valid email address.',
            min: 'This field must be at least {min} characters.',
            max: 'This field cannot exceed {max} characters.',
            numeric: 'This field must be a number.',
            integer: 'This field must be a whole number.',
            phone: 'Please enter a valid phone number.',
            password: 'Password must be at least 8 characters with uppercase, lowercase, number and symbol.'
        };
    }

    /**
     * Validate a single field
     */
    validateField(value, rules, fieldName = 'Field') {
        const errors = [];
        
        for (const rule of rules) {
            if (typeof rule === 'string') {
                if (!this.rules[rule](value)) {
                    errors.push(this.messages[rule]);
                }
            } else if (typeof rule === 'object') {
                const ruleName = Object.keys(rule)[0];
                const ruleValue = rule[ruleName];
                
                if (!this.rules[ruleName](value, ruleValue)) {
                    errors.push(this.messages[ruleName].replace(`{${ruleName}}`, ruleValue));
                }
            }
        }
        
        return errors;
    }

    /**
     * Validate an entire form
     */
    validateForm(formData, validationRules) {
        const errors = {};
        let isValid = true;
        
        for (const [field, rules] of Object.entries(validationRules)) {
            const fieldErrors = this.validateField(formData[field], rules, field);
            if (fieldErrors.length > 0) {
                errors[field] = fieldErrors;
                isValid = false;
            }
        }
        
        return { isValid, errors };
    }

    /**
     * Display validation errors in the UI
     */
    displayErrors(errors, container = null) {
        // Clear existing errors
        document.querySelectorAll('.is-invalid').forEach(el => {
            el.classList.remove('is-invalid');
        });
        document.querySelectorAll('.invalid-feedback').forEach(el => {
            el.remove();
        });

        // Display new errors
        for (const [field, fieldErrors] of Object.entries(errors)) {
            const input = document.querySelector(`[name="${field}"]`);
            if (input) {
                input.classList.add('is-invalid');
                
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback';
                errorDiv.innerHTML = fieldErrors.join('<br>');
                
                input.parentNode.appendChild(errorDiv);
            }
        }
    }

    /**
     * Clear all validation errors
     */
    clearErrors() {
        document.querySelectorAll('.is-invalid').forEach(el => {
            el.classList.remove('is-invalid');
        });
        document.querySelectorAll('.invalid-feedback').forEach(el => {
            el.remove();
        });
    }

    /**
     * Real-time validation for form fields
     */
    setupRealTimeValidation(formSelector, validationRules) {
        const form = document.querySelector(formSelector);
        if (!form) return;

        for (const fieldName of Object.keys(validationRules)) {
            const field = form.querySelector(`[name="${fieldName}"]`);
            if (field) {
                field.addEventListener('blur', () => {
                    const errors = this.validateField(field.value, validationRules[fieldName]);
                    this.displayFieldError(field, errors);
                });

                field.addEventListener('input', () => {
                    // Clear errors on input to provide immediate feedback
                    if (field.classList.contains('is-invalid')) {
                        field.classList.remove('is-invalid');
                        const errorDiv = field.parentNode.querySelector('.invalid-feedback');
                        if (errorDiv) errorDiv.remove();
                    }
                });
            }
        }
    }

    /**
     * Display error for a specific field
     */
    displayFieldError(field, errors) {
        // Clear existing error
        field.classList.remove('is-invalid');
        const existingError = field.parentNode.querySelector('.invalid-feedback');
        if (existingError) existingError.remove();

        // Display new error if any
        if (errors.length > 0) {
            field.classList.add('is-invalid');
            const errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback';
            errorDiv.innerHTML = errors.join('<br>');
            field.parentNode.appendChild(errorDiv);
        }
    }
}

// Global validation helper instance
window.ValidationHelper = new ValidationHelper();

// Form validation rules for different forms
window.ValidationRules = {
    profile: {
        name: ['required', { min: 2 }, { max: 255 }],
        email: ['required', 'email', { max: 255 }],
        phone: [{ max: 20 }, 'phone'],
        address: [{ max: 500 }]
    },
    
    password: {
        current_password: ['required'],
        password: ['required', 'password'],
        password_confirmation: ['required']
    },
    
    review: {
        rating: ['required', 'integer'],
        review: [{ min: 10 }, { max: 1000 }]
    },
    
    note: {
        content: ['required', { min: 1 }, { max: 2000 }],
        page_number: ['required', 'integer']
    },
    
    cart: {
        book_id: ['required'],
        quantity: ['required', 'integer']
    }
};

// Auto-setup validation for common forms
document.addEventListener('DOMContentLoaded', function() {
    // Setup real-time validation for profile forms
    ValidationHelper.setupRealTimeValidation('#profileForm', ValidationRules.profile);
    ValidationHelper.setupRealTimeValidation('#passwordForm', ValidationRules.password);
    
    // Password confirmation validation
    const passwordField = document.querySelector('[name="password"]');
    const confirmField = document.querySelector('[name="password_confirmation"]');
    
    if (passwordField && confirmField) {
        confirmField.addEventListener('blur', function() {
            if (this.value && this.value !== passwordField.value) {
                ValidationHelper.displayFieldError(this, ['Password confirmation does not match.']);
            }
        });
    }
});

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
    module.exports = ValidationHelper;
}
