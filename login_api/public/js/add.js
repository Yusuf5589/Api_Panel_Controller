document.getElementById('createForm').addEventListener('submit', function (event) {
  event.preventDefault();
  const form = event.target;
  const formData = new FormData(form);
  var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  fetch("http://127.0.0.1:8000/api/create-product", {
    method: 'POST',
    body: formData,
    headers: {
        'Authorization': 'Bearer ' + token
    }
})
  .then(response => response.json())
  .then(data => {
      if (data.errors) {
          for (const fieldName in data.errors) {
              const errorMessages = data.errors[fieldName].join(', ');
              const errorElement = document.getElementById('input' + fieldName + 'error2');
              if (errorElement) {
                  errorElement.textContent = errorMessages;
              }
          }
      } else {
          form.submit();
      }
  })
  .catch(error => {
      console.error('Error occurred:', error);
  });
});
  

function close3(){
  let inputnameerror2 = document.getElementById("inputnameerror2");
  let inputdescriptionerror2 = document.getElementById("inputdescriptionerror2");
  let inputpieceerror2 = document.getElementById("inputpieceerror2");
  let inputpriceerror2 = document.getElementById("inputpriceerror2");

  inputnameerror2.textContent = "";
  inputdescriptionerror2.textContent = ""; 
  inputpieceerror2.textContent = "";
  inputpriceerror2.textContent = "";
}
