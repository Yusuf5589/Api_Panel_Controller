var editclick = document.querySelectorAll('#viewinglist')[0];
var editadd = document.getElementById('viewpopupadd');
var viewpopup = document.getElementById('viewpopup2');

editclick.addEventListener('click', createeditform);

function createeditform(event) {
    if (event.target.id == "edit") {
          let valueget = event.target;
          let valueid = valueget.parentNode.parentNode.querySelector("#id").value;
          let valuename = valueget.parentNode.parentNode.querySelector("#name").textContent;
          let valuedescription = valueget.parentNode.parentNode.querySelector("#description").textContent;
          let valuepiece = valueget.parentNode.parentNode.querySelector("#piece").textContent;
          let valueprice = valueget.parentNode.parentNode.querySelector("#price").textContent;
          
        let inputid = document.getElementById("inputid");
        let inputname = document.getElementById("inputname");
        let inputdescription = document.getElementById("inputdescription");
        let inputpiece = document.getElementById("inputpiece");
        let inputprice = document.getElementById("inputprice");
        inputid.value = valueid;
        inputname.value = valuename;
        inputdescription.value = valuedescription;
        inputpiece.value = valuepiece;
        inputprice.value = valueprice;

    }
}













function createeditform(event) {
    if (event.target.id == "edit") {
          let valueget = event.target;
          let valueid = valueget.parentNode.parentNode.querySelector("#id").value;
          let valuename = valueget.parentNode.parentNode.querySelector("#name").textContent;
          let valuedescription = valueget.parentNode.parentNode.querySelector("#description").textContent;
          let valuepiece = valueget.parentNode.parentNode.querySelector("#piece").textContent;
          let valueprice = valueget.parentNode.parentNode.querySelector("#price").textContent;
          
        let inputid = document.getElementById("inputid");
        let inputname = document.getElementById("inputname");
        let inputdescription = document.getElementById("inputdescription");
        let inputpiece = document.getElementById("inputpiece");
        let inputprice = document.getElementById("inputprice");
        inputname.setAttribute("data-prev-value", valuename);
        inputdescription.setAttribute("data-prev-value", valuedescription);
        inputpiece.setAttribute("data-prev-value", valuepiece);
        inputprice.setAttribute("data-prev-value", valueprice);
        inputid.value = valueid;
        inputname.value = valuename;
        inputdescription.value = valuedescription;
        inputpiece.value = valuepiece;
        inputprice.value = valueprice;

    }
}


function update(e) {
  let inputname = document.getElementById("inputname");
  let inputdescription = document.getElementById("inputdescription");
  let inputpiece = document.getElementById("inputpiece");
  let inputprice = document.getElementById("inputprice");

  let inputnameerror = document.getElementById("inputnameerror");
  let inputdescriptionerror = document.getElementById("inputdescriptionerror");
  let inputpieceerror = document.getElementById("inputpieceerror");
  let inputpriceerror = document.getElementById("inputpriceerror");

  let prevName = inputname.getAttribute("data-prev-value");
  let prevDescription = inputdescription.getAttribute("data-prev-value");
  let prevPiece = inputpiece.getAttribute("data-prev-value");
  let prevPrice = inputprice.getAttribute("data-prev-value");



  


  if (
    inputname.value === prevName &&
    inputdescription.value === prevDescription &&
    inputpiece.value === prevPiece &&
    inputprice.value === prevPrice
  ) {
    if (inputname.value === prevName) {
      inputnameerror.textContent = "You didn't change anything";
      e.preventDefault();
    } 
  
    if(inputdescription.value === prevDescription){
      inputdescriptionerror.textContent = "You didn't change anything";
      e.preventDefault();
    }
  
    if(inputpiece.value === prevPiece){
      inputpieceerror.textContent = "You didn't change anything";
      e.preventDefault();
    }
  
    if(inputprice.value === prevPrice){
      inputpriceerror.textContent = "You didn't change anything";
      e.preventDefault();
    }
  }else{
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);
  
    fetch("http://localhost:8000/api/update-product/", {
      method: "POST",
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
          const errorElement = document.getElementById('input' + fieldName + 'error');
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
  }
}




function close2(){
  let inputnameerror = document.getElementById("inputnameerror");
  let inputdescriptionerror = document.getElementById("inputdescriptionerror");
  let inputpieceerror = document.getElementById("inputpieceerror");
  let inputpriceerror = document.getElementById("inputpriceerror");

  inputnameerror.textContent = "";
  inputdescriptionerror.textContent = ""; 
  inputpieceerror.textContent = "";
  inputpriceerror.textContent = "";
}
