document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("register-form");
    const message = document.getElementById("message");

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        const name = form.name.value.trim();
        const surname = form.surname.value.trim();
        const phone = form.phone.value.trim();
        const email = form.email.value.trim();
        const password = form.password.value.trim();
        const confirmPassword = form['confirm-password'].value.trim();
        const birthdate = form.birthdate.value;

        if (name === "" || surname === "" || phone === "" || email === "" || password === "" || confirmPassword === "" || birthdate === "") {
            message.textContent = "All fields are required!";
            return;
        }

        if (password !== confirmPassword) {
            message.textContent = "Passwords do not match!";
            return;
        }

        // Simulate successful registration
        message.textContent = "Registration successful!";
        message.style.color = "green";
        form.reset();
    });
});
