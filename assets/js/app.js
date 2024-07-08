document.getElementById("Formcat").addEventListener("submit", function(event) {
    event.preventDefault();
    if (document.getElementById("name").value == "" || document.getElementById("email").value == "" || document.getElementById("age").value == "") {
        Swal.fire({
            title: "ไม่สามารถดำเนินการได้",
            text: "กรุณากรอกข้อมูลให้ครบ !",
            icon: "error",
            
        }); 
    } 
    
    else if (!document.getElementById("male").checked && !document.getElementById("female").checked) {
        
        Swal.fire({
            title: "ไม่สามารถดำเนินการได้",
            text: "กรุณาเลือกเพศ !",
            icon: "error"
        });
    }
    else{
        let formdata = new FormData(this);
        let result = "Name : "  + 
        formdata.get("name")    +"<br>" +"Email : "     +
        formdata.get("email")   +"<br>" +"Age : "       +
        formdata.get("age")     +"<br>" +"Gender : "    +
        formdata.get("gender")  +"<br>" +"Comment : "   +
        formdata.get("comment");                //อยากเพิ่ม ใส่ + หน้า = 
        document.getElementById("mamu").innerHTML = "<h1> Your result : </h1>" + result;
        Swal.fire({
            title: "ดำเนินการสำเร็จ",
            text: "ระบบจะแสดงผลลัพธ์ของท่านด้านล่างนี้",
            icon: "success"
        });
    }
})

function TeacherSaidRemove_E(evt) {
    const maxLength = 3; //กำหนดจำนวนหลักสูงสุดที่อนุญาตให้ผู้ใช้ป้อน
    const minAge = 0; //กำหนดจำนวนอายุต่ำสุดของผู้ใช้
    const maxAge = 150; //กำหนดจำนวนอายุสูงสุดของผู้ใช้
    const input = evt.target; //เก็บค่า Input ที่ผู้ใช้ป้อน
    const keycode = evt.keyCode; //เพิ่มไว้เพื่อแปรจาก event.keyCode เป็น keycode เพื่อเรียกใช้ง่ายๆ (ทำให้โค้ดยาวขึ้นเฉยๆไม่มีอะไร)
    const Array01 = 69; //ตัว E
    const Array02 = 109; //นี่คือ -
    const Array03 = 107; //นี่คือ +
    //const Array04 = 51; // นื่คือ - 3

    // ตรวจสอบการอนุญาตคีย์ลัดและปุ่มสำคัญ
    if ((evt.ctrlKey && ['a', 'c', 'v', 'x'].includes(evt.key)) || evt.metaKey || evt.shiftKey ||
        ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab'].includes(evt.key)) return;

    // ตรวจสอบว่าจำนวนหลักไม่เกิน 3 หน่วย และอนุญาตให้ใช้ปุ่ม Backspace และ Delete
    if (input.value.length >= maxLength && evt.key !== "Backspace" && evt.key !== "Delete") {
        // ลบค่าที่เกิน 3 หลัก
        if (evt.key >= '0' && evt.key <= '9') {
            // ให้กรอกตัวเลขใหม่ถ้าป้อนตัวเลขที่ยังไม่ครบ 3 หลัก
            if (evt.key.length === 1) {
                input.value = evt.key;
            } else {
                evt.preventDefault();
            }
        } else {
            evt.preventDefault();
        }
    }

    //ถ้า ค่าของ input age นั้น เป็น e + - จะไม่ใส่ค่านั้นเพื่อป้องกันข้อผิดพลาด
    else if (keycode === Array01 || keycode === Array02 || keycode === Array03 /*|| keycode === Array04*/) {
        evt.preventDefault();
    }
    
    //ใช้ setTimeout เพื่อให้ JavaScript รอจนกระทั่งค่าของ Input ถูกอัปเดตและตรวจสอบว่าค่านั้นไม่เกิน 150 ถ้าเกิน จะตั้งค่าให้เป็น 150
    setTimeout(() => {
        //ถ้าอายุมากกว่า 150 จะตั้งค่าให้เป็น 150
        if (parseInt(input.value) > maxAge) {
            input.value = maxAge;
        }
        //ถ้าอายุน้อยกว่า 3 จะตั้งค่าให้เป็น 3
        else if (parseInt(input.value) < minAge) {
            input.value = minAge;
        }
    }, 0);
}
