document.getElementById('bmiForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const weight = parseFloat(document.getElementById('weight').value);
    const height = parseFloat(document.getElementById('height').value) / 100;
    
    
    const bmi = weight / (height * height);
    const bmiValue = document.getElementById('bmiValue');
    const bmiCategory = document.getElementById('bmiCategory');

    bmiValue.textContent = bmi.toFixed(2);
    
    if (bmi < 18.5) {
        bmiCategory.textContent = 'คุณผอมเกินไป ควรเพิ่มน้ำหนัก';
        bmiCategory.style.color = '#ff6347';
    } else if (bmi >= 18.5 && bmi < 24.9) {
        bmiCategory.textContent = 'คุณอยู่ในเกณฑ์ปกติ';
        bmiCategory.style.color = '#28a745';
    } else if (bmi >= 25 && bmi < 29.9) {
        bmiCategory.textContent = 'คุณเริ่มอ้วน ควรออกกำลังกาย';
        bmiCategory.style.color = '#ffcc00';
    } else if (bmi >= 30 && bmi < 34.9) {
        bmiCategory.textContent = 'คุณอ้วนมาก ควรลดน้ำหนัก';
        bmiCategory.style.color = '#dc3545';
    } else {
        bmiCategory.textContent = 'คุณอ้วนขั้นสูงสุด !!!';
        bmiCategory.style.color = '#dc3545';
    }
});
