var viewing = document.querySelectorAll('#viewinglist')[0];
var popupadd = document.getElementById('viewpopupadd');

viewing.addEventListener('click', poppupcreate);

function poppupcreate(event){
    if(event.target.id == "viewing"){
        let valueget = event.target;
        let valueid = valueget.parentNode.parentNode.querySelector("#id").value;
        let valuename = valueget.parentNode.parentNode.querySelector("#name").textContent;
        let valuedescription = valueget.parentNode.parentNode.querySelector("#description").textContent;
        let valuepiece = valueget.parentNode.parentNode.querySelector("#piece").textContent;
        let valueprice = valueget.parentNode.parentNode.querySelector("#price").textContent;
        popupadd.innerHTML = `
        <div id="viewpopup" class="w-100 h-100 position-absolute d-flex justify-content-center align-items-center left-0 top-0 row m-0 p-0">
              <div class="col-10 col-md-8 col-lg-8 col-xl-6 border border-bottom d-flex justify-content-center rounded-4 shadow m-0 p-0 flex-column" style="background-color: white;">
              <table class="table p-0 m-0">
                <tr class="row p-0 m-0 mt-3">
                  <td class="col-5 text-center m-0 p-0" style="font-size: 20px; font-weight: bold;">Id</td>
                  <td class="col-7 text-center m-0 p-0" style="font-size: 20px;">${valueid}</td>
                </tr>
                <tr class="row container-fluid p-0 mt-3 m-0">
                  <td class="col-5 text-center m-0 p-0" style="font-size: 20px; font-weight: bold;">Name</td>
                  <td class="col-7 text-center m-0 p-0" style="font-size: 20px;">${valuename}</td>
                </tr>
                <tr class="row container-fluid p-0 mt-3 m-0">
                  <td class="col-5 text-center m-0 p-0" style="font-size: 20px; font-weight: bold;">Description</td>
                  <td class="col-7 text-center m-0 p-0" style="font-size: 20px;">${valuedescription}</td>
                </tr>
                <tr class="row container-fluid p-0 mt-3 m-0">
                  <td class="col-5 text-center m-0 p-0" style="font-size: 20px; font-weight: bold;">Piece</td>
                  <td class="col-7 text-center m-0 p-0" style="font-size: 20px;">${valuepiece}</td>
                </tr>
                <tr class="row container-fluid p-0 mt-3 m-0">
                  <td class="col-5 text-center m-0 p-0" style="font-size: 20px; font-weight: bold;">Price</td>
                  <td class="col-7 text-center m-0 p-0" style="font-size: 20px;">${valueprice}</td>
                </tr>
              </table>
              <div class="w-100 d-flex justify-content-center">
                <button id="viewpopupclose" class="w-25 py-2 mt-3 mb-2 border border-bottom rounded-4 shadow bg-danger text-white delete-btn">Close</button>
              </div>
              </div>
          </div>
        `;
        var popupclose = document.getElementById('viewpopupclose');
        popupclose.addEventListener('click', poppupclose2);
    }
}


function poppupclose2() {
    var popup = document.getElementById('viewpopup');
    popup.remove();
  }




