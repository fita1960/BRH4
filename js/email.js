function sendMail() {

    var params = {
        from_name: document.getElementById("full_name").value,
        email_id: document.getElementById("email").value,
        mobile_no: document.getElementById("mobileno").value,
        message: document.getElementById("message").value,
    }
        emailjs.send("service_vmu145d", "template_ni4r66p", params).then(function (res) {
            alert("Message Successfully Sent! ");
        })
}