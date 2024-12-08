let register_form = document.getElementById('register-form');

register_form.addEventListener('submit', (e) => {
    e.preventDefault(); // Prevent default form submission

    let data = new FormData(register_form);
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'ajax/signup.php', true); 
    xhr.onload = function () {
        if (this.status === 200) {
            let response = JSON.parse(this.responseText);
            if (response.status === 'success') {
                alert('Signup successful! Please log in to continue.');
                register_form.reset(); // Clear the form
            } else {
                alert('Signup failed: ' + response.message);
            }
        } else {
            alert('Server error. Please try again later.');
        }
    };
    xhr.send(data);
});