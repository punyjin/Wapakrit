document.getElementById("Formcat").addEventListener("submit", function(event) {
    event.preventDefault();
    
    if (document.getElementById("name").value == "" || document.getElementById("email").value == "" || document.getElementById("age").value == "") {
        alert("กรุณากรอกข้อมูลให้ครบ !")
    } 
    else{
        let formdata = new FormData(this);
        let result = "Name : "  + 
        formdata.get("name")    +"<br>" +"Email : "     +
        formdata.get("email")   +"<br>" +"Age : "       +
        formdata.get("age")     +"<br>" +"Gender : "    +
        formdata.get("gender")  +"<br>" +"Comment : "   +
        formdata.get("comments");
        document.getElementById("mamu").innerHTML = "<h1> Your result : </h1>" + result;
    }
})