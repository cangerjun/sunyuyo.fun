<?php
// 日志记录功能
$ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$logEntry = "[$date] IP: $ip | Agent: $userAgent\n";
file_put_contents('access_log.txt', $logEntry, FILE_APPEND);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>企业安全登录系统</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #1a2980, #26d0ce);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            overflow: hidden;
        }
        
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 450px;
            overflow: hidden;
            position: relative;
            z-index: 10;
            transform: translateY(0);
            transition: transform 0.5s ease;
        }
        
        .container.login-success {
            transform: translateY(-50px);
        }
        
        .header {
            background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
            color: white;
            padding: 35px 20px;
            text-align: center;
            position: relative;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }
        
        .header h1 {
            font-size: 32px;
            margin-bottom: 8px;
            letter-spacing: 1px;
            font-weight: 600;
        }
        
        .header p {
            opacity: 0.85;
            font-size: 16px;
            max-width: 300px;
            margin: 0 auto;
        }
        
        .logo {
            width: 90px;
            height: 90px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 25px;
            border: 2px solid rgba(255,255,255,0.2);
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }
        
        .logo i {
            font-size: 45px;
            color: white;
        }
        
        .form-container {
            padding: 35px 40px;
        }
        
        .input-group {
            position: relative;
            margin-bottom: 30px;
        }
        
        .input-group i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #5a67d8;
            font-size: 20px;
        }
        
        .input-group input {
            width: 100%;
            padding: 17px 20px 17px 60px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 17px;
            transition: all 0.3s;
            outline: none;
            background: #f8fafc;
            color: #1a202c;
        }
        
        .input-group input:focus {
            border-color: #5a67d8;
            box-shadow: 0 0 0 4px rgba(90, 103, 216, 0.2);
        }
        
        .btn-login {
            background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
            color: white;
            border: none;
            width: 100%;
            padding: 18px;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
            position: relative;
            overflow: hidden;
            letter-spacing: 1px;
        }
        
        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .btn-login .spinner {
            display: none;
            animation: spin 1s linear infinite;
        }
        
        .btn-login.loading .text {
            display: none;
        }
        
        .btn-login.loading .spinner {
            display: inline-block;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .footer {
            text-align: center;
            padding: 25px;
            font-size: 14px;
            color: #718096;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
        }
        
        .footer a {
            color: #5a67d8;
            text-decoration: none;
            margin: 0 5px;
            font-weight: 500;
        }
        
        .success-message {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.95);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            z-index: 100;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.6s ease;
        }
        
        .success-message.active {
            opacity: 1;
            pointer-events: all;
        }
        
        .success-icon {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(to right, #00b09b, #96c93d);
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
            position: relative;
            animation: scaleIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }
        
        .success-icon i {
            font-size: 60px;
            color: white;
        }
        
        @keyframes scaleIn {
            0% { transform: scale(0); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        
        .success-message h2 {
            font-size: 36px;
            margin-bottom: 20px;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
        }
        
        .success-message p {
            font-size: 18px;
            margin-bottom: 30px;
            max-width: 500px;
            text-align: center;
            line-height: 1.6;
            color: #ddd;
        }
        
        .redirect-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }
        
        .redirect-link {
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 5px 15px rgba(255, 75, 43, 0.3);
        }
        
        .redirect-link.alt {
            background: linear-gradient(to right, #00b09b, #96c93d);
            box-shadow: 0 5px 15px rgba(0, 176, 155, 0.3);
        }
        
        .redirect-link:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        
        .security-info {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            font-size: 14px;
        }
        
        .security-info div {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #28a745;
        }
        
        .loading-circle {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(255, 255, 255, 0.2);
            border-top: 5px solid #4facfe;
            border-radius: 50%;
            margin: 20px auto;
            animation: spin 1s linear infinite;
        }
        
        .log-info {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.7);
            color: #aaa;
            font-size: 10px;
            padding: 4px 8px;
            border-radius: 4px;
            font-family: monospace;
        }
    </style>
</head>
<body>
    <div class="container" id="loginContainer">
        <div class="header">
            <div class="logo">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h1>企业安全登录系统</h1>
            <p>安全访问企业资源</p>
        </div>
        
        <div class="form-container">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" id="username" placeholder="请输入用户名" autocomplete="off">
            </div>
            
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" placeholder="请输入密码">
            </div>
            
            <button class="btn-login" id="loginBtn">
                <span class="text"><i class="fas fa-sign-in-alt"></i> 登录系统</span>
                <span class="spinner"><i class="fas fa-spinner"></i></span>
            </button>
            
            <div class="security-info">
                <div>
                    <i class="fas fa-shield-check"></i>
                    <span>SSL安全连接</span>
                </div>
                <div>
                    <i class="fas fa-fingerprint"></i>
                    <span>双因素认证可用</span>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <p>&copy; 2023 企业安全系统 | <a href="#">隐私政策</a> | <a href="#">使用条款</a> | <a href="#">帮助中心</a></p>
        </div>
    </div>
    
    <div class="success-message" id="successMessage">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        <h2>身份验证成功！</h2>
        <p>您的账户已通过安全验证，正在进入系统...</p>
        
        <div class="loading-circle"></div>
        
        <div class="redirect-container">
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank" class="redirect-link">
                <i class="fab fa-youtube"></i> 访问原视频
            </a>
            <a href="https://www.bilibili.com/video/BV1GJ411x7h7" target="_blank" class="redirect-link alt">
                <i class="fab fa-bilibili"></i> B站替代链接
            </a>
        </div>
    </div>
    
    <div class="log-info">LOG: <?php echo $ip; ?> | <?php echo $date; ?></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginBtn = document.getElementById('loginBtn');
            const successMessage = document.getElementById('successMessage');
            const loginContainer = document.getElementById('loginContainer');
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');
            
            loginBtn.addEventListener('click', function() {
                // 获取输入值
                const username = usernameInput.value.trim();
                const password = passwordInput.value.trim();
                
                // 添加输入动画效果
                if(username === '') {
                    usernameInput.style.borderColor = '#ff4757';
                    setTimeout(() => {
                        usernameInput.style.borderColor = '#e1e1e1';
                        usernameInput.focus();
                    }, 1000);
                    return;
                }
                
                if(password === '') {
                    passwordInput.style.borderColor = '#ff4757';
                    setTimeout(() => {
                        passwordInput.style.borderColor = '#e1e1e1';
                        passwordInput.focus();
                    }, 1000);
                    return;
                }
                
                // 添加按钮加载动画
                loginBtn.classList.add('loading');
                
                // 模拟登录验证过程
                setTimeout(() => {
                    // 添加成功动画
                    loginContainer.classList.add('login-success');
                    
                    // 显示成功消息
                    setTimeout(() => {
                        successMessage.classList.add('active');
                        
                        // 3秒后自动跳转
                        setTimeout(() => {
                            window.location.href = "https://www.bilibili.com/video/BV1GJ411x7h7";
                        }, 3000);
                    }, 500);
                }, 1500);
            });
            
            // 支持按Enter键登录
            passwordInput.addEventListener('keypress', function(e) {
                if(e.key === 'Enter') {
                    loginBtn.click();
                }
            });
        });
    </script>
</body>
</html>
