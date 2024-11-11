
   function toggleForm(form) {
      document.getElementById('login-form').style.display = form === 'login' ? 'block' : 'none';
      document.getElementById('register-form').style.display = form === 'register' ? 'block' : 'none';
   }

   function togglePasswordVisibility(fieldId, eyeIcon) {
      const field = document.getElementById(fieldId);
      const isPassword = field.type === 'password';
      field.type = isPassword ? 'text' : 'password';
      eyeIcon.classList.toggle('ri-eye-off-line', !isPassword);
      eyeIcon.classList.toggle('ri-eye-line', isPassword);
   }

   function submitForm(type) {
      const formId = type === 'login' ? 'login-form' : 'register-form';
      $(`#${formId}`).submit();
   }
