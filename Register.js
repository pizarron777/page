
const form = document.getElementById('formRegistro');

form.addEventListener('submit', function(e) {
  e.preventDefault(); 
  
  const nombre = form.name.value.trim();
  const email = form.email.value.trim();
  const password = form.password.value;

  
  if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ]{3,15}$/.test(nombre)) {
    alert("El nombre debe tener entre 3 y 15 letras, sin números ni símbolos.");
    return;
  }

  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    alert("Correo electrónico no válido.");
    return;
  }

  if (password.length < 6 || password.length > 16) {
    alert("La contraseña debe tener entre 6 y 12 caracteres.");
    return;
  }


  alert("¡Registro exitoso!");
  form.reset(); 
});
