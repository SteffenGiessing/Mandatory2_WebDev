$(document).ready(function() { 
    $(".createInvoice").click(function(){
        console.log("Clicked purchase");
        createInvoice();
    });
    let apiUrl = setApiUrl("purchase", "getUser");
    $.ajax({
        url: apiUrl,
        type: GET,
        success: function(data){
            console.log(data);
            setupPurchaseInfo(data);
        }
    })
});
function setupPurchaseInfo(data){
    $("#billingAddress").val(data.Address);
    $("#billingCity").val(data.City);
    $("#billingState").val(data.State);
    $("#billingCountry").val(data.Country);
    $("#billingPostalCode").val(data.PostalCode);

}
function createInvoice(){
    let billingAddress = $("#billingAddress").val();
    let billingCity = $("#billingCity").val();
    let billingState = $("#billingState").val();
    let billingCountry = $("#billingCountry").val();
    let billingPostalCode = $("#billingPostalCode").val();
    
    //var today = new DATE().ToLocaleString();
   // var dateTime = today.getFullYear()+"-"+(today.getMonth()+1)+"-"+today.getDate();
    let price = $("#finalPrice").val();
    console.log(billingAddress, billingCity, billingCountry, billingPostalCode, billingState,  price);
    let apiUrl = setApiUrl("purchase", "createInvoice");
    $.ajax({
        url: apiUrl,
        type: POST,
        data: JSON.stringify( {
            billingAddress: billingAddress,
            billingCity: billingCity,
            billingState: billingState,
            billingCountry: billingCountry,
            billingPostalCode: billingPostalCode,
            price: price
        }),
        success: function(data) {
            console.log(data);
        }
    })
}