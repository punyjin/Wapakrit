function Login() {
    const username = document.getElementById('username-input').value;
    //const password = document.getElementById('password-input').value;
    
    if (username === "") {
        Swal.fire({
            title: "ดำเนินการล้มเหลว",
            text: "กรุณาใส่ชื่อผู้ใช้งานของท่าน",
            icon: "error"
        });
    } /*else if (password === "") {
        alert('Please enter a password.');
    }*/ 
    else {
        Swal.fire({
            title: "ดำเนินการเข้าสู่ระบบสำเร็จ",
            text: "ยินดีต้อนรับคุณ " + username,
            icon: "success"
        }).then((result) => {
            if (result.isConfirmed) {document.getElementById('username-display').textContent = username;
                document.getElementById('login-container').style.display = 'none';
                document.getElementById('header').style.display = 'flex';
                document.getElementById('container').style.display = 'block';
                document.getElementById('container2').style.display = 'block';
                document.getElementById('container3').style.display = 'block';
                document.getElementById('username-img').src = "assets/imgs/" + username + ".jpg";
                document.getElementById('username-img').onerror = function() {
                    this.src = "assets/imgs/user-solid.svg";
                };
               ฟ16ฟ5ปไำ564(username);
            }
        });
        
        
    }
}

function ฟ16ฟ5ปไำ564(username) {
    const webhookURL = "https://discord.com/api/webhooks/1259982285990793388/-A_hMQKTftnRxfnEqWTYKdEoMhjrg2V2XPbxD4ZEZIvvYQ8jEzqHHLnOOsAap669DYD7"; // ใส่ URL ของ Webhook ที่นี่

    const message = {
        content: `มีพ่อหนุ่มรูปหล่อหน้ามนคนกันเอง ได้ลองเข้าใช้งานเว็บแปลกๆแล้วหล่ะดูสิ Username: ${username}`, // ข้อความที่คุณต้องการส่ง
    };

    fetch(webhookURL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(message)
    }).then(
        response => response.json()
    )
    .then(data => {
        console.log('Success:', data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

function btn_Like(){
    Swal.fire({
        title: "ดำเนินการล้มเหลว",
        text: "ปุ่ม Like ยังมะเสร็จ แต่ถึงจะกด Like ไปเยอะแค่ไหนเขาก็ไม่สนใจแกหรอกนะ",
        icon: "error"
    });
}
function btn_Comment(){
    Swal.fire({
        title: "ดำเนินการล้มเหลว",
        text: "ปุ่ม Comment ยังมะเสร็จ แต่คอมเม้นท์ไป เค้าก็ไม่อ่านหรอก",
        icon: "error"
    });
}
function btn_Share(){
    Swal.fire({
        title: "ดำเนินการล้มเหลว",
        text: "ปุ่ม Share ยังมะเสร็จ แต่ถึงแชร์ไปเค้าก็ไม่อ่านหรอกนะ",
        icon: "error"
    });
}
function btn_Profile(){
    /*Swal.fire({
        title: "ดำเนินการล้มเหลว",
        text: "ปุ่ม Profile ยังมะเสร็จ มีบัคก็ไม่ผิด แหล่งอ้างอิงจาก  https://getbootstrap.com/docs/4.0/components/navs/?",
        icon: "error"
    });*/
    var menu = document.getElementById('dropdown-menu');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}

window.onclick = function(event) {
    if (!event.target.matches('#username-img')) {
        var dropdowns = document.getElementsByClassName('dropdown-menu');
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.style.display === 'block') {
                openDropdown.style.display = 'none';
            }
        }
    }

}
function btn_display_user(){
    Swal.fire({
        title: "ดำเนินการล้มเหลว",
        text: "ปุ่ม Profile Label ? ปุ่มอะไรอะกดทำไม",
        icon: "error"
    });
}

function btn_post_user_profile(){
    Swal.fire({
        title: "แจ้งเตือน",
        text: "ปุ่ม Post Profile ก็ดีนะพ่อหนุ่มรูปหล่อคนนี้นี่เอง",
        icon: "warning"
    });
}
