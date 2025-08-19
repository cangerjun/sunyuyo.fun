<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>幽喵直播点歌抽卡系统</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* 全局样式 */
        :root {
            --primary: #ff6b6b;
            --secondary: #4ecdc4;
            --accent: #ffd166;
            --dark: #2b2d42;
            --light: #f8f9fa;
            --highlight-pink: #ffb6c1;
            --highlight-gray: #e9ecef;
            --secret-color: #a0a0a0;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --gradient: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            --nav-bg: rgba(43, 45, 66, 0.95);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--gradient);
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
            padding: 20px;
            position: relative;
            background-attachment: fixed;
        }
        
        /* 智能隐藏导航样式 */
        .smart-nav {
            position: fixed;
            top: 0;
            right: 0;
            background: var(--nav-bg);
            backdrop-filter: blur(5px);
            border-radius: 0 0 0 15px;
            padding: 8px 20px;
            box-shadow: var(--shadow);
            z-index: 1000;
            display: flex;
            gap: 20px;
            transition: transform 0.3s ease;
            transform: translateY(0);
        }
        
        .smart-nav.hidden {
            transform: translateY(-100%);
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.3s ease;
            padding: 4px 8px;
            border-radius: 8px;
            white-space: nowrap;
        }
        
        .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }
        
        /* 容器样式 */
        .container {
            max-width: 1200px;
            width: 95%;
            margin: 0 auto 40px;
            padding: 25px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
            margin-top: 20px;
        }
        
        /* 头部样式 */
        header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }
        
        h1 {
            font-size: 2.3rem;
            color: var(--primary);
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            display: inline-block;
        }
        
        h1:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--accent);
            border-radius: 2px;
        }
        
        .subtitle {
            color: var(--dark);
            font-size: 1.1rem;
            opacity: 0.8;
            margin-top: 15px;
        }
        
        /* 控制区域样式 */
        .controls {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 30px;
            padding: 20px;
            background: var(--light);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        .controls > * {
            flex: 1;
            min-width: 200px;
        }
        
        .controls select, .controls input {
            height: 50px;
            padding: 0 15px;
            font-size: 16px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            background: white;
            transition: all 0.3s ease;
        }
        
        .controls select:focus, .controls input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.2);
            outline: none;
        }
        
        .controls input {
            padding-left: 45px;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23999999" width="24" height="24"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>');
            background-repeat: no-repeat;
            background-position: 15px center;
            background-size: 20px;
        }
        
        .buttons {
            display: flex;
            gap: 15px;
        }
        
        button {
            height: 50px;
            padding: 0 25px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        
        button:active {
            transform: translateY(0);
        }
        
        #searchBtn {
            background: var(--secondary);
            color: white;
            flex: 2;
        }
        
        #drawBtn {
            background: var(--primary);
            color: white;
            flex: 1;
        }
        
        /* 直播间样式 */
        .live-container {
            margin: 30px 0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        
        .live-container::before {
            content: "LIVE";
            position: absolute;
            top: 10px;
            left: 10px;
            background: #ff0000;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
            z-index: 10;
        }
        
        iframe {
            width: 100%;
            height: 400px;
            border: none;
            display: block;
        }
        
        /* 表格样式 */
        .table-container {
            max-height: 950px;
            overflow-y: auto;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
            position: relative;
        }
        
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: white;
        }
        
        thead {
            position: sticky;
            top: 0;
            z-index: 10;
        }
        
        th {
            background: var(--dark);
            color: white;
            padding: 16px 12px;
            text-align: left;
            font-weight: 600;
            position: sticky;
            top: 0;
        }
        
        th:first-child {
            border-top-left-radius: 12px;
        }
        
        th:last-child {
            border-top-right-radius: 12px;
        }
        
        tbody tr {
            transition: all 0.2s ease;
        }
        
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        tbody tr:hover {
            background-color: #f1f1f1;
            transform: translateX(5px);
        }
        
        td {
            padding: 14px 12px;
            border-bottom: 1px solid #eee;
        }
        
        /* 高亮样式 */
        .highlight-true {
            background-color: var(--highlight-pink) !important;
            font-weight: 600;
        }
        
        .highlight-false {
            background-color: var(--highlight-gray) !important;
        }
        
        /* 抽取动画效果 */
        .drawing-animation {
            animation: drawPulse 1s infinite;
        }
        
        @keyframes drawPulse {
            0% { box-shadow: 0 0 0 0 rgba(255, 107, 107, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(255, 107, 107, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 107, 107, 0); }
        }
        
        /* 结果卡片样式 */
        .result-card {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            max-width: 90%;
            width: 400px;
            text-align: center;
            transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .result-card.show {
            transform: translate(-50%, -50%) scale(1);
        }
        
        .result-card h2 {
            color: var(--primary);
            margin-bottom: 20px;
            font-size: 1.8rem;
        }
        
        .result-card p {
            margin: 10px 0;
            font-size: 1.2rem;
        }
        
        .result-card .close-btn {
            margin-top: 20px;
            background: var(--secondary);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .result-card .close-btn:hover {
            background: var(--primary);
        }
        
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 999;
            display: none;
        }
        
        .overlay.show {
            display: block;
        }
        
        /* 回到顶部按钮 */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            display: none;
            width: 50px;
            height: 50px;
            background: var(--primary);
            color: white;
            text-align: center;
            line-height: 50px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 100;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        
        .back-to-top:hover {
            background: var(--secondary);
            transform: translateY(-3px);
        }
        
        /* 页脚样式 */
        footer {
            width: 100%;
            height: auto;
            background: rgba(43, 45, 66, 0.9);
            padding: 15px 0;
            text-align: center;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            margin-top: 20px;
        }
        
        footer a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            margin: 0 10px;
            transition: color 0.3s;
        }
        
        footer a:hover {
            color: var(--accent);
            text-decoration: underline;
        }
        
        /* 响应式设计 */
        @media (max-width: 768px) {
            .controls {
                flex-direction: column;
            }
            
            .buttons {
                width: 100%;
            }
            
            button {
                flex: 1;
            }
            
            iframe {
                height: 300px;
            }
            
            .table-container {
                max-height: 400px;
            }
            
            h1 {
                font-size: 1.8rem;
            }
            
            th, td {
                padding: 12px 8px;
                font-size: 14px;
            }
            
            .smart-nav {
                gap: 10px;
                padding: 6px 15px;
            }
            
            .nav-link {
                font-size: 0.75rem;
                padding: 3px 6px;
            }
        }
        
        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }
            
            iframe {
                height: 250px;
            }
            
            .table-container {
                max-height: 350px;
            }
            
            button {
                padding: 0 15px;
                font-size: 14px;
            }
            
            .result-card {
                width: 90%;
                padding: 20px;
            }
            
            .smart-nav {
                gap: 8px;
                padding: 5px 10px;
            }
            
            .nav-link {
                font-size: 0.7rem;
            }
        }
        
        .stats-bar {
            background-color: var(--secondary);
            color: white;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        
        .stat-item {
            padding: 5px 10px;
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.2);
            margin: 5px;
        }
        
        /* 主题切换按钮 */
        .theme-toggle {
            position: fixed;
            bottom: 90px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: var(--dark);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 100;
            transition: all 0.3s ease;
        }
        
        .theme-toggle:hover {
            transform: rotate(30deg) scale(1.1);
        }
    </style>
</head>
<body>
    <!-- 智能隐藏导航 -->
    <div class="smart-nav" id="smartNav">
        <a href="https://sunyuyo.fun/" class="nav-link">回家的路</a>
        <a href="https://live.bilibili.com/25816719" class="nav-link">直播间</a>
    </div>
    
    <div class="container">
        <header>
            <h1>幽喵直播点歌抽卡</h1>
            <p class="subtitle">选择曲风，搜索歌曲，或随机抽取一首</p>
        </header>
        
        <!-- 控制区域 -->
        <div class="controls">
            <!-- 曲风筛选下拉框 -->
            <select id="styleFilter" onchange="filterByStyle()">
                <option value="all">所有曲风</option>
            </select>
            
            <input type="text" id="searchInput" placeholder="输入歌名或歌手搜索" oninput="handleSearchInput()">
            
            <div class="buttons">
                <button id="searchBtn" onclick="searchSongs()">
                    <i class="fas fa-search"></i>
                    搜索
                </button>
                <button id="drawBtn" onclick="drawSong()">
                    <i class="fas fa-random"></i>
                    抽取
                </button>
            </div>
        </div>
        
        <!-- 统计信息 -->
        <div class="stats-bar">
            <div class="stat-item">总歌曲: <span id="totalSongs">0</span></div>
            <div class="stat-item">当前显示: <span id="currentSongs">0</span></div>
            <div class="stat-item">当前曲风: <span id="currentStyle">全部</span></div>
        </div>
        
        <!-- 直播间 -->
        <div class="live-container">
            <iframe src="https://www.bilibili.com/blackboard/live/live-activity-player.html?cid=22621571&quality=0" 
                    frameborder="0" 
                    allow="autoplay; encrypted-media" 
                    allowfullscreen="true">
            </iframe>
        </div>
        
        <!-- 表格 -->
        <div class="table-container">
            <table id="songTable">
                <thead>
                    <tr>
                        <th width="5%">序号</th>
                        <th width="37.5%">歌名</th>
                        <th width="37.5%">歌手</th>
                        <th width="20%">曲风</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- 歌曲数据将通过 JavaScript 动态生成 -->
                </tbody>
            </table>
        </div>
        
        <!-- 页脚 -->
        <footer>
            <p>
                <a href="https://space.bilibili.com/23118401" target="_blank">网站由©苍二君开发所有</a> | 
                <a href="http://beian.miit.gov.cn" target="_blank">辽ICP备2025050731号</a>
            </p>
        </footer>
    </div>
    
    <!-- 抽取结果卡片 -->
    <div class="overlay" id="overlay"></div>
    <div class="result-card" id="resultCard">
        <h2><i class="fas fa-music"></i> 抽取结果 <i class="fas fa-music"></i></h2>
        <p><strong>歌名：</strong><span id="resultSongName">歌曲名称</span></p>
        <p><strong>歌手：</strong><span id="resultArtist">歌手</span></p>
        <p><strong>曲风：</strong><span id="resultStyle">曲风</span></p>
        <button class="close-btn" onclick="closeResultCard()">关闭</button>
    </div>
    
    <!-- 回到顶部按钮 -->
    <div class="back-to-top" onclick="scrollToTop()"><i class="fas fa-arrow-up"></i></div>
    
    <!-- 主题切换按钮 -->
    <div class="theme-toggle" onclick="toggleTheme()">
        <i class="fas fa-moon"></i>
    </div>
    
    <script>
        // 歌曲数据
        const songs = [
            {name: "爱河·插电(总能有的)", artist: "蒋雪儿", style: "绝密", love: null},
            {name: "好汉歌(只有切片)", artist: "刘欢", style: "绝密", love: null },
            {name: "让风告诉你(学了3年)", artist: "花玲、喵☆酱 、宴宁 、kinsen", style: "绝密", love: null},
            {name: "Moon Halo(直播时跟着哼唱过)", artist: "茶理理、TetraCalyx、Hanser", style: "绝密", love: null},
        ];

        let searchTimer = null;
        let isDrawing = false;
        let currentStyle = 'all'; // 当前选中的曲风
        let lastScrollTop = 0;

        // 初始化页面
        document.addEventListener('DOMContentLoaded', function() {
            populateStyleFilter();
            updateTable();
            updateStats();
            
            // 设置滚动事件监听器
            window.addEventListener('scroll', function() {
                const backToTopButton = document.querySelector('.back-to-top');
                if (window.scrollY > 300) {
                    backToTopButton.style.display = "block";
                } else {
                    backToTopButton.style.display = "none";
                }
                
                // 导航栏智能隐藏
                const nav = document.getElementById('smartNav');
                const currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                if (currentScrollTop > lastScrollTop && currentScrollTop > 100) {
                    // 向下滚动并且超过100px时隐藏
                    nav.classList.add('hidden');
                } else {
                    // 向上滚动时显示
                    nav.classList.remove('hidden');
                }
                
                lastScrollTop = currentScrollTop <= 0 ? 0 : currentScrollTop;
            });
        });

        // 填充曲风筛选选项
        function populateStyleFilter() {
            const styleFilter = document.getElementById('styleFilter');
            
            // 获取所有曲风
            const styles = [...new Set(songs.map(song => song.style))];
            
            // 添加曲风选项
            styles.forEach(style => {
                const option = document.createElement('option');
                option.value = style;
                option.textContent = style;
                styleFilter.appendChild(option);
            });
        }

        // 更新表格
        function updateTable(filteredSongs = songs) {
            const tableBody = document.querySelector('#songTable tbody');
            const fragment = document.createDocumentFragment();
            
            filteredSongs.forEach((song, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${song.name}</td>
                    <td>${song.artist}</td>
                    <td>${song.style}</td>
                `;
                
                // 添加高亮类
                if (song.love === true) {
                    row.classList.add('highlight-true');
                } else if (song.love === false) {
                    row.classList.add('highlight-false');
                }
                
                fragment.appendChild(row);
            });
            
            // 一次性更新表格
            tableBody.innerHTML = '';
            tableBody.appendChild(fragment);
            
            // 更新统计信息
            updateStats(filteredSongs);
        }
        
        // 更新统计信息
        function updateStats(filteredSongs = songs) {
            document.getElementById('totalSongs').textContent = songs.length;
            document.getElementById('currentSongs').textContent = filteredSongs.length;
            
            const styleName = {
                'all': '全部'
            }[currentStyle] || currentStyle;
            
            document.getElementById('currentStyle').textContent = styleName;
        }

        // 曲风筛选功能
        function filterByStyle() {
            const styleSelect = document.getElementById('styleFilter');
            currentStyle = styleSelect.value;
            
            if (currentStyle === 'all') {
                updateTable(songs);
            } else {
                const filteredSongs = songs.filter(song => song.style === currentStyle);
                updateTable(filteredSongs);
            }
            
            // 滚动到表格顶部
            document.querySelector('.table-container').scrollTop = 0;
        }

        // 搜索歌曲
        function searchSongs() {
            const query = document.getElementById('searchInput').value.trim().toLowerCase();
            
            if (!query) {
                // 如果没有搜索词，根据当前曲风显示
                if (currentStyle === 'all') {
                    updateTable(songs);
                } else {
                    const filteredSongs = songs.filter(song => song.style === currentStyle);
                    updateTable(filteredSongs);
                }
                return;
            }
            
            // 先根据曲风筛选，再在结果中搜索
            let filteredSongs = songs;
            if (currentStyle !== 'all') {
                filteredSongs = songs.filter(song => song.style === currentStyle);
            }
            
            filteredSongs = filteredSongs.filter(song => 
                song.name.toLowerCase().includes(query) || 
                song.artist.toLowerCase().includes(query)
            );
            
            updateTable(filteredSongs);
        }

        // 输入处理（带防抖）
        function handleSearchInput() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(searchSongs, 300);
        }

        // 抽取歌曲
        function drawSong() {
            if (isDrawing) return;
            
            // 获取当前显示的歌曲列表
            let currentSongs = songs;
            if (currentStyle !== 'all') {
                currentSongs = songs.filter(song => song.style === currentStyle);
            }
            
            if (currentSongs.length === 0) {
                alert('当前曲风筛选下没有歌曲');
                return;
            }
            
            isDrawing = true;
            const drawBtn = document.getElementById('drawBtn');
            drawBtn.classList.add('drawing-animation');
            drawBtn.disabled = true;
            
            // 模拟抽取过程
            let counter = 0;
            const maxIterations = 20;
            const interval = setInterval(() => {
                const randomIndex = Math.floor(Math.random() * currentSongs.length);
                highlightSong(randomIndex, currentSongs);
                
                counter++;
                if (counter >= maxIterations) {
                    clearInterval(interval);
                    const finalIndex = Math.floor(Math.random() * currentSongs.length);
                    const selectedSong = currentSongs[finalIndex];
                    
                    setTimeout(() => {
                        highlightSong(finalIndex, currentSongs);
                        showResultCard(selectedSong);
                        drawBtn.classList.remove('drawing-animation');
                        drawBtn.disabled = false;
                        isDrawing = false;
                    }, 500);
                }
            }, 100);
        }
        
        // 高亮显示歌曲
        function highlightSong(index, currentSongs) {
            const tableBody = document.querySelector('#songTable tbody');
            const rows = tableBody.querySelectorAll('tr');
            
            // 移除之前的高亮
            rows.forEach(row => {
                row.classList.remove('highlight-true', 'highlight-false');
                const songIndex = Array.from(rows).indexOf(row);
                if (currentSongs[songIndex]?.love === true) {
                    row.classList.add('highlight-true');
                } else if (currentSongs[songIndex]?.love === false) {
                    row.classList.add('highlight-false');
                }
            });
            
            // 添加当前高亮
            if (rows[index]) {
                rows[index].classList.add('highlight-true');
                
                // 滚动到高亮行
                rows[index].scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
        
        // 显示结果卡片
        function showResultCard(song) {
            document.getElementById('resultSongName').textContent = song.name;
            document.getElementById('resultArtist').textContent = song.artist;
            document.getElementById('resultStyle').textContent = song.style;
            
            const resultCard = document.getElementById('resultCard');
            const overlay = document.getElementById('overlay');
            
            overlay.classList.add('show');
            resultCard.classList.add('show');
        }
        
        // 关闭结果卡片
        function closeResultCard() {
            const resultCard = document.getElementById('resultCard');
            const overlay = document.getElementById('overlay');
            
            resultCard.classList.remove('show');
            overlay.classList.remove('show');
        }

        // 回到顶部
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
        
        // 主题切换功能
        function toggleTheme() {
            const body = document.body;
            const isDark = body.classList.toggle('dark-theme');
            
            // 更新按钮图标
            const themeIcon = document.querySelector('.theme-toggle i');
            themeIcon.className = isDark ? 'fas fa-sun' : 'fas fa-moon';
            
            // 保存主题偏好
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }
        
        // 检查保存的主题
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.body.classList.add('dark-theme');
            document.querySelector('.theme-toggle i').className = 'fas fa-sun';
        }
    </script>
</body>
</html>
