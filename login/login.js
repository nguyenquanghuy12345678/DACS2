


/*=============== SHOW HIDDEN - PASSWORD ===============*/
const showHiddenPass = () => {
    const togglePasswordIcons = document.querySelectorAll('.toggle-password');
 
    togglePasswordIcons.forEach(icon => {
        const inputId = icon.getAttribute('data-toggle');
        const inputElement = document.getElementById(inputId);
 
        icon.addEventListener('click', () => {
            // Change password to text
            if (inputElement.type === 'password') {
                // Switch to text
                inputElement.type = 'text';
 
                // Icon change
                icon.classList.add('ri-eye-line');
                icon.classList.remove('ri-eye-off-line');
            } else {
                // Change to password
                inputElement.type = 'password';
 
                // Icon change
                icon.classList.remove('ri-eye-line');
                icon.classList.add('ri-eye-off-line');
            }
        });
    });
 };
 
 showHiddenPass();
 
 /*=============== FORM TOGGLE ===============*/
 const toggleForm = (formType) => {
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
 
    if (formType === 'register') {
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
    } else {
        loginForm.style.display = 'block';
        registerForm.style.display = 'none';
    }
 };
 
 // CÁI CHUYỂN TRANG // 
 function submitForm(formType) {
     if (formType === 'login') {
        // Validate form inputs (optional)
        const email = document.getElementById('login-email').value;
        const password = document.getElementById('login-pass').value;
 
        if (email && password) {
           // If validation passes, redirect to index.html
           window.location.href = "file:///D:/xampp/htdocs/Do_An_Co_So_2/home.php";
        } else {
           // Handle validation failure (optional)
           alert('Please enter both email and password.');
        }
     } else if (formType === 'register') {
        // Handle registration form submission
        // For this example, we'll just log the values
        const email = document.getElementById('register-email').value;
        const password = document.getElementById('register-pass').value;
        console.log('Register:', email, password);
        // Optionally, redirect to a different page after registration
     }
  }
 
 
 
 
 
 
 
 
 
 
 
 
