<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>লগআউট হচ্ছে...</title>
</head>
<body style="font-family:sans-serif; background:#f8fafc; display:flex; align-items:center; justify-content:center; height:100vh; margin:0;">
    <div style="text-align:center;">
        <p style="color:#64748b; font-size:14px;">লগআউট হচ্ছে... অনুগ্রহ করে অপেক্ষা করুন।</p>
    </div>
    <script>
        localStorage.removeItem('store_token');
        localStorage.removeItem('store_tenant');
        window.location.href = 'login.php';
    </script>
</body>
</html>
