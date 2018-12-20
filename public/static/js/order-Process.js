
function saveStatus(orderID){
    var val = $('input[name="sex"]:checked').val();
    window.location.href = "savestate?orderID=" + orderID + "&state=" + val;
}
