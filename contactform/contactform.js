var form = document.getElementById("contactForm");

async function handleSubmit(event) {
  event.preventDefault();
  var status = document.getElementById("my-form-status");
  var data = new FormData(event.target);
  fetch(event.target.action, {
    method: form.method,
    body: data,
    headers: {
      'Accept': 'application/json'
    }
  }).then(response => {
    if (response.ok) {
      // Si la respuesta es exitosa, aplicamos la clase de éxito
      status.innerHTML = "Tu mensaje fue enviado, Gracias!";
      status.classList.remove("error-message");
      status.classList.add("success-message");
      form.reset();
    } else {
      // Si hay errores, aplicamos la clase de error
      response.json().then(data => {
        if (Object.hasOwnProperty(data, 'errors')) {
          status.innerHTML = data["errors"].map(error => error["message"]).join(", ");
        } else {
          status.innerHTML = "Error al enviar el mensaje";
        }
        status.classList.remove("success-message");
        status.classList.add("error-message");
      });
    }
  }).catch(error => {
    // Si hay un error en la solicitud, aplicamos la clase de error
    status.innerHTML = "Error al enviar el mensaje";
    status.classList.remove("success-message");
    status.classList.add("error-message");
  });
}

form.addEventListener("submit", handleSubmit);