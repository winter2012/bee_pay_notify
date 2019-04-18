$(function () {
    $("#callback").click(function () {
        var orderAmount = $("#orderAmount").val();
        var prdOrdNo = $("#prdOrdNo").val();
        var notifyUrl = $("#notifyUrl").val();
        if(orderAmount === ""){
            $("#message").show().html("请输入充值金额").css("color","red");
            return false;
        }
        if(prdOrdNo === ""){
            $("#message").show().html("请输入订单编号").css("color","red");
            return false;
        }
        if(notifyUrl === ""){
            $("#message").show().html("请输入回调地址").css("color","red");
            return false;
        }
        $.ajax({
            type: "POST",
            url: "controller/notify.php",
            beforeSend : hideMessage(),
            data: {
                orderAmount: orderAmount,
                prdOrdNo: prdOrdNo,
                notifyUrl: notifyUrl
            },success:function (res) {
                $("#message").show().html("返回信息:"+res).css("color","red");
            }
        });
    });
});
function hideMessage() {
    $("#message").hide();
}