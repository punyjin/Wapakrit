// เพิ่มการจัดการเหตุการณ์ 'submit' สำหรับฟอร์มที่มี id เป็น 'bmiForm'
document.getElementById('bmiForm').addEventListener('submit', function(event) {
    // ยกเลิกการส่งฟอร์มตามปกติเพื่อป้องกันการรีเฟรชหน้า
    event.preventDefault();
    
    // รับค่า 'weight' จาก input field และแปลงเป็นตัวเลขจริง
    const weight = parseFloat(document.getElementById('weight').value);
    // รับค่า 'height' จาก input field, แปลงเป็นตัวเลขจริง และแปลงจากเซนติเมตรเป็นเมตรโดยการหารด้วย 100
    const height = parseFloat(document.getElementById('height').value) / 100;
    
    // ตรวจสอบว่าค่าที่ป้อนมาเป็นตัวเลขที่ถูกต้องและส่วนสูงไม่เป็นศูนย์หรือต่ำกว่า 0
    if (isNaN(weight) || isNaN(height) || height <= 0) {
        // แจ้งเตือนผู้ใช้ให้ป้อนข้อมูลที่ถูกต้อง
        alert('โปรดป้อนตัวเลขที่ถูกต้องสำหรับน้ำหนักและส่วนสูง');
        return; // ออกจากฟังก์ชันหากข้อมูลไม่ถูกต้อง
    }
    
    // คำนวณค่า BMI โดยใช้สูตร: น้ำหนัก / (ส่วนสูง * ส่วนสูง)
    const bmi = weight / (height * height);
    // เข้าถึงองค์ประกอบ HTML ที่แสดงค่า BMI
    const bmiValue = document.getElementById('bmiValue');
    // เข้าถึงองค์ประกอบ HTML ที่แสดงหมวดหมู่ BMI
    const bmiCategory = document.getElementById('bmiCategory');
    
    // แสดงค่า BMI ที่คำนวณได้โดยการจัดรูปแบบให้เป็นทศนิยม 2 ตำแหน่ง
    bmiValue.textContent = bmi.toFixed(2);
    
    // ตรวจสอบช่วงค่าของ BMI และแสดงข้อความหมวดหมู่ที่เหมาะสม
    if (bmi < 18.5) {
        // BMI ต่ำกว่าค่าที่กำหนด แสดงข้อความเตือนให้เพิ่มน้ำหนัก
        bmiCategory.textContent = 'คุณผอมเกินไป ควรเพิ่มน้ำหนัก';
        // เปลี่ยนสีข้อความให้เหมาะสม
        bmiCategory.style.color = '#ff6347';
    } else if (bmi >= 18.5 && bmi < 24.9) {
        // BMI อยู่ในเกณฑ์ปกติ แสดงข้อความว่าปกติ
        bmiCategory.textContent = 'คุณอยู่ในเกณฑ์ปกติ';
        // เปลี่ยนสีข้อความให้เหมาะสม
        bmiCategory.style.color = '#28a745';
    } else if (bmi >= 25 && bmi < 29.9) {
        // BMI อยู่ในช่วงเริ่มอ้วน แสดงข้อความเตือนให้ออกกำลังกาย
        bmiCategory.textContent = 'คุณเริ่มอ้วน ควรออกกำลังกาย';
        // เปลี่ยนสีข้อความให้เหมาะสม
        bmiCategory.style.color = '#ffcc00';
    } else if (bmi >= 30 && bmi < 34.9) {
        // BMI อยู่ในช่วงอ้วนมาก แสดงข้อความเตือนให้ลดน้ำหนัก
        bmiCategory.textContent = 'คุณอ้วนมาก ควรลดน้ำหนัก';
        // เปลี่ยนสีข้อความให้เหมาะสม
        bmiCategory.style.color = '#dc3545';
    } else {
        // BMI สูงกว่าช่วงที่กำหนด แสดงข้อความเตือนให้ลดน้ำหนักมาก
        bmiCategory.textContent = 'คุณอ้วนขั้นสูงสุด !!!';
        // เปลี่ยนสีข้อความให้เหมาะสม
        bmiCategory.style.color = '#dc3545';
    }
});
