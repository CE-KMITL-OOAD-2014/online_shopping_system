//array which represent cart
var cookieArr;

//read cookie and store in cookieArr.
window.onload = function ()
{
  var tmpCookie = getCookie("products");
  if(tmpCookie == "") {
    cookieArr = new Array();
  } else {
    eval("cookieArr = " + tmpCookie );
  }

  for(var i=0; i < cookieArr.length; i++){
      break;
  }
}

//check if product still available.
function checkStock()
{
  for(var i=0; i<cookieArr.length; i++) {
    console.log(cookieArr[i]);
    $.get('api/product/'+cookieArr[i].id, function(result){
      checkStockCallback(JSON.parse(result));
    });
  }
}

//edit amount in cart if greater than available amount of product
function checkStockCallback(json)
{
  for(var i=0; i<cookieArr.length; i++){
    if(cookieArr[i].id == json.id){
      if(cookieArr[i].amount > json.amount){
        cookieArr[i].amount = json.amount;
        $("#"+ json.product_name +"-amount-modal").html(json.amount);
        $("#"+ json.product_name + "-buy-amount").val(json.amount);
        $("#"+ json.product_name +"-total-price").html(json.amount * json.price);
        $("#"+ json.product_name +"-total-price-modal").html(json.amount * json.price);

        $('#warning-msg').attr('style','');
        $('#warning-msg').html('มีสินค้าบางรายการที่มีจำนวนคงเหลือน้อยกว่าที่ลูกค้าต้องการสั่งซื้อ ต้องการดำเนินการต่อหรือไม่');
      }
      break;
    }
  }
  setCartToCookie();
}

function buy()
{
  $.post('buy',function(result){
    console.log("result");
    console.log(result);
    clearval();
    window.location="{{ url('/')}}";
  });
}

//read cookie
function getCookie(cname) 
{
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i=0; i<ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1);
      if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
  }
  return "";
} 

function changeAmount(amount, productname, id) {
  $("#"+ productname +"-total-price").html(amount.value * $('#' + productname + "-price").val());
  $("#"+ productname +"-total-price-modal").html(amount.value * $('#' + productname + "-price").val());
  $("#"+ productname +"-amount-modal").html(amount.value);

  //console.log(cookieArr);
  for(var i=0; i<cookieArr.length; i++){
    if(cookieArr[i].id == id){
      console.log(cookieArr[i].amount);
      console.log(amount.value);
      cookieArr[i].amount = parseInt(amount.value);
      break;
    }
  }
  setCartToCookie();
}

function productSelect()
{
  console.log($('input:checkbox:checked').val());
  if(typeof $('.table').find('input:checkbox:checked').val() != 'undefined'){
    $('#remove-btn').attr('style','');
  } else {
    $('#remove-btn').attr('style','display:none;');
  }
}

function removeFromCart()
{
  $("input:checkbox:checked").each( function () {
    //sequential search for selected product
    for(var i=0; i<cookieArr.length; i++){
      if(cookieArr[i].id == $(this).val()){
        cookieArr.splice(i,1);
        break;
      }
    }
  });
  setCartToCookie();
  window.location.reload();
}


function setCartToCookie()
{
  var expires = new Date();
  expires.setFullYear((expires.getFullYear()+5) );

  document.cookie = "products=" + JSON.stringify(cookieArr) + "; expires="
    + expires.toGMTString() + "; path=/;";
}

function clearval()
{
 $('#warning-msg').html('');
 $('#warning-msg').attr('style','display:none;');
}
