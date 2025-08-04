<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>幽喵直播点歌抽卡系统 - 曲风筛选</title>
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
        
        /* 容器样式 */
        .container {
            max-width: 1200px;
            width: 95%;
            margin: 20px auto;
            padding: 25px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
        }
        
        /* 头部样式 */
        header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }
        
        h1 {
            font-size: 2.5rem;
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
        
        /* 绝密选项样式 */
        .secret-option {
            color: var(--secret-color);
            font-style: italic;
            opacity: 0.7;
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
            bottom: 90px;
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
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 50px;
            background: rgba(43, 45, 66, 0.9);
            padding: 10px 0;
            text-align: center;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.7);
            z-index: 99;
            backdrop-filter: blur(5px);
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
                font-size: 2rem;
            }
            
            th, td {
                padding: 12px 8px;
                font-size: 14px;
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
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>幽喵直播点歌抽卡</h1>
            <p class="subtitle">选择曲风，搜索歌曲，或随机抽取一首</p>
        </header>
        
        <!-- 控制区域 -->
        <div class="controls">
            <!-- 曲风筛选下拉框 -->
            <select id="styleFilter" onchange="filterByStyle()">
                <option value="all">全部歌曲</option>
                <option value="古风">古风</option>
                <option value="甜歌">甜歌</option>
                <option value="致郁">致郁</option>
                <option value="治愈">治愈</option>
                <option value="情歌">情歌</option>
                <option value="原创">原创</option>
                <option value="提督">提督</option>
                <option value="绝密">绝密</option>
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
    
    <!-- 页脚 -->
    <footer>
        <p>
            <a href="https://space.bilibili.com/23118401" target="_blank">网站由©苍二君开发所有</a> | 
            <a href="http://beian.miit.gov.cn" target="_blank">辽ICP备2025050731号</a>
        </p>
    </footer>
    
    <script>
        // 歌曲数据
        const songs = [
                {name: "醉清风", artist: "弦子", style: "古风", love: null},
                {name: "轮回之境", artist: "CRITTY", style: "古风", love: null},
                {name: "遇萤", artist: "CRITTY", style: "古风", love: null},
                {name: "我的一个道姑朋友", artist: "LON", style: "古风", love: null},
                {name: "公子对我摇", artist: "pig小优", style: "古风", love: null},
                {name: "两相负", artist: "Tacke竹桑、重小烟", style: "古风", love: null},
                {name: "山鬼", artist: "winky诗", style: "古风", love: null},
                {name: "云与海", artist: "阿YueYue", style: "古风", love: null},
                {name: "沈园外", artist: "阿YueYue、戾格", style: "古风", love: null},
                {name: "千古", artist: "阿兰", style: "古风", love: null},
                {name: "参商", artist: "不才", style: "古风", love: null},
                {name: "涉川", artist: "不才", style: "古风", love: null},
                {name: "寄长月", artist: "不才", style: "古风", love: null},
                {name: "十三月凉", artist: "不才", style: "古风", love: null},
                {name: "一身诗意千寻瀑", artist: "不才", style: "古风", love: null},
                {name: "年少乘快意", artist: "程佳敏", style: "古风", love: null},
                {name: "故梦", artist: "橙翼", style: "古风", love: null},
                {name: "可念不可说", artist: "崔子格", style: "古风", love: null},
                {name: "月", artist: "大柯", style: "古风", love: null},
                {name: "繁花", artist: "董贞", style: "古风", love: null},
                {name: "飞羽", artist: "董贞", style: "古风", love: null},
                {name: "金缕衣", artist: "董贞", style: "古风", love: null},
                {name: "相思引", artist: "董贞", style: "古风", love: null},
                {name: "旧雨", artist: "封茗囧菌", style: "古风", love: true},
                {name: "伞下铭", artist: "封茗囧菌", style: "古风", love: true},
                {name: "皈依", artist: "皈依、小能手", style: "古风", love: null},
                {name: "金陵谣", artist: "国风堂", style: "古风", love: true},
                {name: "狐言", artist: "河图", style: "古风", love: null},
                {name: "浪人琵琶", artist: "胡66", style: "古风", love: null},
                {name: "绾青丝", artist: "花世", style: "古风", love: null},
                {name: "笑纳", artist: "花僮", style: "古风", love: null},
                {name: "出山", artist: "花粥", style: "古风", love: null},
                {name: "盗将行", artist: "花粥", style: "古风", love: true},
                {name: "痒", artist: "黄龄", style: "古风", love: null},
                {name: "九万字", artist: "黄诗扶", style: "古风", love: null},
                {name: "孽海记", artist: "黄诗扶", style: "古风", love: true},
                {name: "东流", artist: "灰老板", style: "古风", love: null},
                {name: "芊芊", artist: "回音哥", style: "古风", love: null},
                {name: "画中仙", artist: "金莎", style: "古风", love: null},
                {name: "梦千年之恋", artist: "金莎", style: "古风", love: null},
                {name: "相思垢", artist: "金莎", style: "古风", love: null},
                {name: "问风", artist: "金渔", style: "古风", love: true},
                {name: "繁花尽", artist: "锦零", style: "古风", love: true},
                {name: "刚烈女子", artist: "锦零", style: "古风", love: null},
                {name: "清秋怨", artist: "锦零", style: "古风", love: true},
                {name: "一尘不染", artist: "锦零", style: "古风", love: true},
                {name: "云归去", artist: "锦零", style: "古风", love: true},
                {name: "落花成泥", artist: "鞠婧祎", style: "古风", love: true},
                {name: "千年泪", artist: "鞠婧祎", style: "古风", love: null},
                {name: "叹云兮", artist: "鞠婧祎", style: "古风", love: null},
                {name: "海棠", artist: "离殇", style: "古风", love: true},
                {name: "醉赤壁", artist: "林俊杰", style: "古风", love: null},
                {name: "半壶纱", artist: "刘珂矣", style: "古风", love: null},
                {name: "风筝误", artist: "刘珂矣", style: "古风", love: null},
                {name: "红颜旧", artist: "刘涛", style: "古风", love: null},
                {name: "兰若词", artist: "刘亦菲", style: "古风", love: null},
                {name: "轮回", artist: "刘增瞳", style: "古风", love: null},
                {name: "从别后", artist: "流浪的蛙蛙", style: "古风", love: null},
                {name: "孙尚香", artist: "柳岩", style: "古风", love: null},
                {name: "杨花落尽子规啼", artist: "卢一帆 ", style: "古风", love: null},
                {name: "如寄", artist: "鲁璐", style: "古风", love: null},
                {name: "山有木兮", artist: "伦桑", style: "古风", love: null},
                {name: "烟雨行舟", artist: "伦桑", style: "古风", love: null},
                {name: "唐朝的雨", artist: "萝莉大大", style: "古风", love: null},
                {name: "情缘十诫", artist: "洛少爷", style: "古风", love: null},
                {name: "下山", artist: "麦小兜", style: "古风", love: null},
                {name: "不染", artist: "毛不易", style: "古风", love: null},
                {name: "古城一侧", artist: "毛儿", style: "古风", love: null},
                {name: "帝都", artist: "萌萌哒天团", style: "古风", love: null},
                {name: "多情应是我", artist: "南风ZIN", style: "古风", love: null},
                {name: "小城谣", artist: "泥鳅Niko、翘课迟到", style: "古风", love: null},
                {name: "镇命歌", artist: "齐栾", style: "古风", love: null},
                {name: "此生不换", artist: "青鸟飞鱼", style: "古风", love: null},
                {name: "眉间雪", artist: "晴愔 ", style: "古风", love: null},
                {name: "野火", artist: "三无", style: "古风", love: null},
                {name: "草木", artist: "山风", style: "古风", love: null},
                {name: "风华燃尽-指间沙", artist: "少司命", style: "古风", love: null},
                {name: "黑白小巷", artist: "少司命", style: "古风", love: null},
                {name: "梅坞寻茶", artist: "少司命", style: "古风", love: null},
                {name: "风缘", artist: "双笙", style: "古风", love: null},
                {name: "马步谣", artist: "双笙", style: "古风", love: null},
                {name: "月出", artist: "双笙", style: "古风", love: null},
                {name: "春三月", artist: "司南", style: "古风", love: null},
                {name: "皎然记", artist: "司夏", style: "古风", love: null},
                {name: "痴愿", artist: "孙羽幽 （白骨哀填词）", style: "古风", love: null},
                {name: "三国杀", artist: "汪苏泷", style: "古风", love: null},
                {name: "无情画", artist: "王呈章", style: "古风", love: null},
                {name: "如愿", artist: "王菲", style: "古风", love: null},
                {name: "吹灭小山河", artist: "忘川", style: "古风", love: null},
                {name: "神武笑春风", artist: "韦萱", style: "古风", love: null},
                {name: "仙剑问情", artist: "萧人凤", style: "古风", love: null},
                {name: "桃花诀", artist: "萧忆情Alex", style: "古风", love: null},
                {name: "蛊梦", artist: "小荣童鞋、馒头妞", style: "古风", love: null},
                {name: "爱殇", artist: "小时姑娘", style: "古风", love: null},
                {name: "月弯弯", artist: "谢金燕", style: "古风", love: null},
                {name: "千年缘", artist: "心然", style: "古风", love: null},
                {name: "清风采", artist: "新乐尘符", style: "古风", love: null},
                {name: "醉流年", artist: "新乐尘符", style: "古风", love: null},
                {name: "半城烟沙", artist: "许嵩", style: "古风", love: null},
                {name: "山水之间", artist: "许嵩", style: "古风", love: null},
                {name: "天龙八部之宿敌", artist: "许嵩", style: "古风", love: null},
                {name: "红颜劫", artist: "姚贝娜", style: "古风", love: null},
                {name: "隔岸", artist: "姚六一", style: "古风", love: null},
                {name: "初见", artist: "叶里", style: "古风", love: null},
                {name: "君不在长江头,我也不在长江尾", artist: "叶里", style: "古风", love: null},
                {name: "无归", artist: "叶里", style: "古风", love: null},
                {name: "嫡仙", artist: "叶里", style: "古风", love: null},
                {name: "一生独一", artist: "叶笙", style: "古风", love: null},
                {name: "九张机", artist: "叶炫清", style: "古风", love: null},
                {name: "纯阳雪", artist: "异域雪影儿", style: "古风", love: null},
                {name: "吹灭小山河", artist: "易燃阿治", style: "古风", love: null},
                {name: "红昭愿", artist: "音阙诗听", style: "古风", love: null},
                {name: "不老梦", artist: "银临", style: "古风", love: null},
                {name: "迟迟", artist: "银临", style: "古风", love: null},
                {name: "腐草为萤", artist: "银临", style: "古风", love: null},
                {name: "金绫谣", artist: "银临", style: "古风", love: null},
                {name: "锦鲤抄", artist: "银临", style: "古风", love: null},
                {name: "流光记", artist: "银临", style: "古风", love: null},
                {name: "落梅笺", artist: "银临", style: "古风", love: null},
                {name: "迷画", artist: "银临", style: "古风", love: null},
                {name: "牵丝戏", artist: "银临", style: "古风", love: null},
                {name: "青玉案", artist: "银临", style: "古风", love: null},
                {name: "如一", artist: "银临", style: "古风", love: null},
                {name: "棠梨煎雪", artist: "银临", style: "古风", love: null},
                {name: "闻妖", artist: "银临", style: "古风", love: null},
                {name: "意难平", artist: "银临 （魔道祖师", style: "古风", love: null},
                {name: "是风动", artist: "银临、河图", style: "古风", love: null},
                {name: "一梦情深", artist: "银临/妖扬", style: "古风", love: null},
                {name: "与你走过的江湖", artist: "瑜小乔", style: "古风", love: null},
                {name: "知否知否", artist: "郁可唯 胡夏", style: "古风", love: null},
                {name: "同归", artist: "云泣", style: "古风", love: null},
                {name: "铃舟", artist: "匀子", style: "古风", love: null},
                {name: "折枝花满衣", artist: "泽典", style: "古风", love: null},
                {name: "决爱", artist: "詹文婷", style: "古风", love: null},
                {name: "凉凉", artist: "张碧晨", style: "古风", love: null},
                {name: "年轮", artist: "张碧晨", style: "古风", love: null},
                {name: "燕归巢", artist: "张杰 张靓颖", style: "古风", love: null},
                {name: "吹梦到西洲", artist: "昭爻tsuki、千世", style: "古风", love: null},
                {name: "倚栏听风", artist: "郑国锋", style: "古风", love: null},
                {name: "发如雪", artist: "周杰伦", style: "古风", love: null},
                {name: "烟花易冷", artist: "周杰伦", style: "古风", love: null},
                {name: "请笃信一个梦", artist: "周深", style: "古风", love: null},
                {name: "人们说这妖孽", artist: "著小生zoki", style: "古风", love: null},
                {name: "山海入梦来", artist: "邹秋实", style: "古风", love: null},
                {name: "迷画", artist: "银临", style: "古风", love: null},
                {name: "拜无忧", artist: "萧忆情Alex", style: "古风", love: null},
                {name: "夜风无意作情歌", artist: "恋恋故人难、不才", style: "古风", love: null},
                {name: "千年泪", artist: "tank", style: "古风", love: null},
                {name: "彼岸", artist: "陈恬", style: "古风", love: null},
                {name: "会开花的云", artist: "王樾安", style: "古风", love: true},
                {name: "青花瓷", artist: "周杰伦", style: "古风", love: null},
                {name: "桃花诺", artist: "邓紫棋", style: "古风", love: null},
                {name: "月光", artist: "胡彦斌", style: "古风", love: null},
                {name: "浮光", artist: "周深", style: "古风", love: true},
                {name: "心念", artist: "黄诗扶", style: "古风", love: null},
                {name: "人间不值得", artist:"黄诗扶" , style: "古风", love: null},
                {name: "浮生忆玲珑", artist:"刘惜君", style: "古风", love: null},
                {name: "良辰夜", artist:"黄诗扶", style: "古风", love: true},
                {name: "梦回花事了", artist:"Lil Yo", style: "古风", love: true},
                {name: "心想", artist: "孟慧圆", style: "甜歌", love: null},
                {name: "如晴天似雨天", artist: " Sasablue", style: "甜歌", love: null},
                {name: "谁怕谁", artist: "4 in love", style: "甜歌", love: null},
                {name: "爱情闯进门", artist: "BY2", style: "甜歌", love: null},
                {name: "爱丫爱丫", artist: "BY2", style: "甜歌", love: null},
                {name: "新少女祈祷", artist: "BY2", style: "甜歌", love: null},
                {name: "我的悲伤是水做的", artist: "ChiliChill、洛天依", style: "甜歌", love: null},
                {name: "你的微笑", artist: "F.I.R.飞儿乐团", style: "甜歌", love: null},
                {name: "想想念念", artist: "FAFA、雪二", style: "甜歌", love: null},
                {name: "虎虎歌", artist: "hanser、三无Marblue、绝对演绎", style: "甜歌", love: null},
                {name: "小一", artist: "Joysaaaa", style: "甜歌", love: null},
                {name: "花吃了那男孩", artist: "kent", style: "甜歌", love: null},
                {name: "花吃了这男孩", artist: "kent", style: "甜歌", love: null},
                {name: "囧囧", artist: "kent", style: "甜歌", love: null},
                {name: "我的女主角是你", artist: "kent", style: "甜歌", love: null},
                {name: "宝贝在干嘛", artist: "KuiKui", style: "甜歌", love: null},
                {name: "靠近一点点", artist: "Lara梁心颐", style: "甜歌", love: null},
                {name: "pretty boy", artist: "M2M", style: "甜歌", love: null},
                {name: "勇敢爱", artist: "Mi2", style: "甜歌", love: null},
                {name: "最后的旅行", artist: "Rainton桐", style: "甜歌", love: null},
                {name: "Remember", artist: "SHE", style: "甜歌", love: null},
                {name: "爱上你", artist: "SHE", style: "甜歌", love: null},
                {name: "安全感", artist: "SHE", style: "甜歌", love: null},
                {name: "半糖主义", artist: "SHE", style: "甜歌", love: null},
                {name: "波斯猫", artist: "SHE", style: "甜歌", love: null},
                {name: "不想长大", artist: "SHE", style: "甜歌", love: null},
                {name: "给我多一点", artist: "SHE", style: "甜歌", love: null},
                {name: "魔力", artist: "SHE", style: "甜歌", love: null},
                {name: "无可取代", artist: "SHE", style: "甜歌", love: null},
                {name: "五月天", artist: "SHE", style: "甜歌", love: null},
                {name: "幽喵喵主义", artist: "SHE", style: "甜歌", love: null},
                {name: "幽喵喵主义", artist: "SHE", style: "甜歌", love: null},
                {name: "怎么办", artist: "SHE", style: "甜歌", love: null},
                {name: "爱的号码牌", artist: "Sweety", style: "甜歌", love: null},
                {name: "爱情就像一张纸", artist: "Sweety", style: "甜歌", love: null},
                {name: "樱花草", artist: "Sweety", style: "甜歌", love: null},
                {name: "会长大的幸福", artist: "tank", style: "甜歌", love: null},
                {name: "星光游乐园", artist: "twins", style: "甜歌", love: null},
                {name: "爱心早餐", artist: "Vk、贺子玲", style: "甜歌", love: null},
                {name: "地铁等待", artist: "VY、爆音BOOM、黑崎子", style: "甜歌", love: null},
                {name: "银河与星斗", artist: "yihuik", style: "甜歌", love: null},
                {name: "麦浪", artist: "yihuik苡慧", style: "甜歌", love: null},
                {name: "依然爱你", artist: "yihuik苡慧", style: "甜歌", love: null},
                {name: "Melody", artist: "ZIV", style: "甜歌", love: null},
                {name: "明天再见", artist: "阿悄", style: "甜歌", love: null},
                {name: "妄想之夜", artist: "阿悄", style: "甜歌", love: null},
                {name: "想我的时候听这歌", artist: "阿悄", style: "甜歌", love: null},
                {name: "热爱105°C的你", artist: "阿肆", style: "甜歌", love: null},
                {name: "世界上的另一个我", artist: "阿肆/郭采洁", style: "甜歌", love: null},
                {name: "晚安喵", artist: "艾索", style: "甜歌", love: null},
                {name: "爱情公寓", artist: "爱情公寓", style: "甜歌", love: null},
                {name: "我不上你的当", artist: "宝宝巴士", style: "甜歌", love: null},
                {name: "情花", artist: "本兮", style: "甜歌", love: null},
                {name: "翻篇", artist: "本兮", style: "甜歌", love: null},
                {name: "我们的回忆", artist: "本兮", style: "甜歌", love: null},
                {name: "怎么办我爱你", artist: "本兮", style: "甜歌", love: null},
                {name: "爆米花的味道", artist: "蔡依林", style: "甜歌", love: null},
                {name: "唇唇欲动", artist: "蔡依林", style: "甜歌", love: null},
                {name: "骑士精神", artist: "蔡依林", style: "甜歌", love: null},
                {name: "乖猫", artist: "蔡依林", style: "甜歌", love: null},
                {name: "就是爱", artist: "蔡依林", style: "甜歌", love: null},
                {name: "看我72变", artist: "蔡依林", style: "甜歌", love: null},
                {name: "日不落", artist: "蔡依林", style: "甜歌", love: null},
                {name: "说爱你", artist: "蔡依林", style: "甜歌", love: null},
                {name: "心型圈", artist: "蔡依林", style: "甜歌", love: null},
                {name: "数到五答应我", artist: "曹格", style: "甜歌", love: null},
                {name: "梁山伯与祝英台", artist: "曹格", style: "甜歌", love: null},
                {name: "两只恋人", artist: "曹格", style: "甜歌", love: null},
                {name: "石头剪刀布", artist: "陈秋含", style: "甜歌", love: null},
                {name: "烟火", artist: "陈翔", style: "甜歌", love: null},
                {name: "静悄悄", artist: "陈泫孝", style: "甜歌", love: null},
                {name: "呓语", artist: "程嘉敏", style: "甜歌", love: true},
                {name: "想起了你", artist: "程响", style: "甜歌", love: null},
                {name: "白月光与朱砂痣", artist: "大籽", style: "甜歌", love: null},
                {name: "我想我不够好", artist: "单色凌", style: "甜歌", love: null},
                {name: "最依赖的温柔", artist: "单色凌", style: "甜歌", love: null},
                {name: "夜猫", artist: "丁当", style: "甜歌", love: null},
                {name: "不开心与没烦恼", artist: "东来东往", style: "甜歌", love: null},
                {name: "恋上了你给的", artist: "恩宠", style: "甜歌", love: null},
                {name: "恋爱百分比", artist: "二嘉", style: "甜歌", love: null},
                {name: "热气球", artist: "二嘉", style: "甜歌", love: null},
                {name: "遇见你的时候星星都落到我头上", artist: "二欧", style: "甜歌", love: null},
                {name: "你的甜蜜", artist: "范晓萱", style: "甜歌", love: null},
                {name: "我爱洗澡", artist: "范晓萱", style: "甜歌", love: null},
                {name: "只对你有感觉", artist: "飞轮海、田馥甄", style: "甜歌", love: null},
                {name: "元气满满", artist: "冯提莫", style: "甜歌", love: null},
                {name: "荷塘月色", artist: "凤凰传奇", style: "甜歌", love: null},
                {name: "属于你", artist: "覆予 - ", style: "甜歌", love: null},
                {name: "环游星空", artist: "葛雨晴", style: "甜歌", love: null},
                {name: "小尾巴", artist: "葛雨晴", style: "甜歌", love: null},
                {name: "咬一口夏天", artist: "葛雨晴", style: "甜歌", love: null},
                {name: "下个礼拜", artist: "葛雨晴、天气晴", style: "甜歌", love: null},
                {name: "静静地", artist: "庚澄庆", style: "甜歌", love: null},
                {name: "Honey", artist: "郭书瑶", style: "甜歌", love: null},
                {name: "爱的抱抱", artist: "郭书瑶", style: "甜歌", love: null},
                {name: "最佳男朋友", artist: "郭书瑶", style: "甜歌", love: null},
                {name: "花开", artist: "郭晓薇", style: "甜歌", love: null},
                {name: "爱啦啦", artist: "海楠", style: "甜歌", love: null},
                {name: "彩虹糖", artist: "何柏诚、一口甜", style: "甜歌", love: null},
                {name: "绵绵冰", artist: "何曼婷", style: "甜歌", love: null},
                {name: "明明说好不哭", artist: "何曼婷", style: "甜歌", love: null},
                {name: "我不", artist: "何曼婷", style: "甜歌", love: null},
                {name: "我要吃肉肉", artist: "何曼婷", style: "甜歌", love: null},
                {name: "123木头人", artist: "黑涩会", style: "甜歌", love: null},
                {name: "跟我在一起", artist: "很美味", style: "甜歌", love: null},
                {name: "睡衣和厨艺", artist: "很美味", style: "甜歌", love: null},
                {name: "地球最可爱", artist: "红格格", style: "甜歌", love: null},
                {name: "单车恋人", artist: "后弦", style: "甜歌", love: null},
                {name: "娃娃脸", artist: "后弦", style: "甜歌", love: null},
                {name: "大叔不要跑", artist: "胡艾彤", style: "甜歌", love: null},
                {name: "黑糖麻花", artist: "花玲", style: "甜歌", love: null},
                {name: "他她它", artist: "花玲", style: "甜歌", love: null},
                {name: "暖色呓语", artist: "花玲、Yuncino", style: "甜歌", love: null},
                {name: "古灵精怪", artist: "花园精灵", style: "甜歌", love: null},
                {name: "暗恋", artist: "浣语", style: "甜歌", love: true },
                {name: "黑猫与牛奶", artist: "黄晓明", style: "甜歌", love: null},
                {name: "蝴蝶泉边", artist: "黄雅莉", style: "甜歌", love: true },
                {name: "绿茶", artist: "灰色", style: "甜歌", love: null},
                {name: "海绵宝宝", artist: "回音哥", style: "甜歌", love: null},
                {name: "僵持", artist: "回音哥", style: "甜歌", love: null},
                {name: "喜欢你", artist: "火鸡", style: "甜歌", love: null},
                {name: "大王叫我来巡山", artist: "贾乃亮", style: "甜歌", love: null},
                {name: "把握你的美", artist: "江映蓉", style: "甜歌", love: null},
                {name: "爱的魔法", artist: "金莎", style: "甜歌", love: null},
                {name: "不可思议", artist: "金莎", style: "甜歌", love: null},
                {name: "大小姐", artist: "金莎", style: "甜歌", love: null},
                {name: "告别爱的夏", artist: "金莎", style: "甜歌", love: null},
                {name: "你的嘴", artist: "金莎", style: "甜歌", love: null},
                {name: "小王子的漂流瓶", artist: "金莎", style: "甜歌", love: null},
                {name: "一个像夏天一个像秋天", artist: "金莎", style: "甜歌", love: null},
                {name: "最后一个夏天", artist: "金莎", style: "甜歌", love: null},
                {name: "我的赖皮女友", artist: "金娃娃", style: "甜歌", love: null},
                {name: "非花", artist: "锦零", style: "甜歌", love: null},
                {name: "空山新雨后", artist: "锦零", style: "甜歌", love: null},
                {name: "恋爱画板", artist: "锦零", style: "甜歌", love: null},
                {name: "遇见你", artist: "锦零", style: "甜歌", love: null},
                {name: "想要你在身边", artist: "锦零/王榇钰", style: "甜歌", love: null},
                {name: "属于你", artist: "绝对演绎、张黎", style: "甜歌", love: null},
                {name: "熬夜上瘾", artist: "可爱就是力量", style: "甜歌", love: null},
                {name: "元气夏天", artist: "辣椒酱", style: "甜歌", love: null},
                {name: "舒伯特玫瑰", artist: "蓝心羽", style: "甜歌", love: null},
                {name: "全世界的人都知道", artist: "乐瞳", style: "甜歌", love: null},
                {name: "情话微甜", artist: "李朝、王圣锋", style: "甜歌", love: null},
                {name: "会有天使替我爱你", artist: "李承铉、王恩琦", style: "甜歌", love: null},
                {name: "流浪的猫写情诗", artist: "李佳思", style: "甜歌", love: null},
                {name: "小爱", artist: "李佳思", style: "甜歌", love: null},
                {name: "夏天", artist: "李玖哲", style: "甜歌", love: null},
                {name: "宠坏", artist: "李俊佑、小潘潘", style: "甜歌", love: null},
                {name: "乌梅子酱", artist: "李荣浩", style: "甜歌", love: null},
                {name: "SoCrazy", artist: "李玟", style: "甜歌", love: null},
                {name: "要定你", artist: "李玟", style: "甜歌", love: null},
                {name: "刚好遇见你", artist: "李玉刚", style: "甜歌", love: null},
                {name: "对不起我爱你", artist: "梁静茹", style: "甜歌", love: null},
                {name: "没有如果", artist: "梁静茹", style: "甜歌", love: null},
                {name: "暖暖", artist: "梁静茹", style: "甜歌", love: null},
                {name: "瘦瘦的", artist: "梁静茹", style: "甜歌", love: null},
                {name: "我喜欢", artist: "梁静茹", style: "甜歌", love: null},
                {name: "小手拉大手", artist: "梁静茹", style: "甜歌", love: null},
                {name: "怎么办我爱你", artist: "梁静茹", style: "甜歌", love: null},
                {name: "最想环游的世界", artist: "梁静茹", style: "甜歌", love: null},
                {name: "爱一直存在", artist: "梁文音", style: "甜歌", love: null},
                {name: "东西", artist: "林俊呈", style: "甜歌", love: null},
                {name: "豆浆油条", artist: "林俊杰", style: "甜歌", love: null},
                {name: "小酒窝", artist: "林俊杰", style: "甜歌", love: null},
                {name: "Rhythm Of Rain Days", artist: "林子琪", style: "甜歌", love: null},
                {name: "带你去旅行", artist: "林子琪", style: "甜歌", love: null},
                {name: "恋习圆舞曲", artist: "林子琪", style: "甜歌", love: null},
                {name: "浅浅的笑", artist: "林子琪", style: "甜歌", love: null},
                {name: "幸福的勇气", artist: "林子琪", style: "甜歌", love: null},
                {name: "勾指起誓", artist: "泠鸢", style: "甜歌", love: null},
                {name: "决斗", artist: "刘丹萌", style: "甜歌", love: null},
                {name: "爱的就是你", artist: "刘佳", style: "甜歌", love: null},
                {name: "爱很美", artist: "刘佳", style: "甜歌", love: null},
                {name: "我们结婚吧", artist: "刘佳、金莎", style: "甜歌", love: null},
                {name: "礼物", artist: "刘力扬", style: "甜歌", love: true},
                {name: "浪漫爱", artist: "刘瑞琦", style: "甜歌", love: null},
                {name: "贝壳风铃", artist: "刘惜君", style: "甜歌", love: null},
                {name: "完美男友", artist: "刘晓晨", style: "甜歌", love: null},
                {name: "I MISS YOU", artist: "罗百吉", style: "甜歌", love: null},
                {name: "东京不太热", artist: "洛天依", style: "甜歌", love: null},
                {name: "正式的告白", artist: "吕口口", style: "甜歌", love: null},
                {name: "OK歌", artist: "麦小兜", style: "甜歌", love: null},
                {name: "比心", artist: "麦小兜", style: "甜歌", love: null},
                {name: "咖喱咖喱", artist: "萌萌哒天团", style: "甜歌", love: null},
                {name: "爱一点", artist: "莫艳琳", style: "甜歌", love: null},
                {name: "第二杯半价", artist: "纳豆", style: "甜歌", love: null},
                {name: "少女作妖日记", artist: "纳豆", style: "甜歌", love: null},
                {name: "What Can I Do", artist: "南拳妈妈", style: "甜歌", love: null},
                {name: "快乐星猫", artist: "牛奶咖啡", style: "甜歌", love: null},
                {name: "我超喜欢你", artist: "欧阳朵", style: "甜歌", love: null},
                {name: "不得不爱", artist: "潘玮柏、弦子", style: "甜歌", love: null},
                {name: "月亮代表我的心", artist: "齐秦", style: "甜歌", love: null},
                {name: "粘人精", artist: "圈9", style: "甜歌", love: null},
                {name: "我要你", artist: "任素汐", style: "甜歌", love: null},
                {name: "花好月圆", artist: "任贤齐", style: "甜歌", love: false},
                {name: "这就是爱吗", artist: "容祖儿", style: "甜歌", love: null},
                {name: "想和你迎着台风去看海", artist: "桑拿猫黑糖/洛天依", style: "甜歌", love: null},
                {name: "失眠飞行", artist: "沈以诚", style: "甜歌", love: null},
                {name: "小冤家", artist: "苏三", style: "甜歌", love: null},
                {name: "勾勾手", artist: "孙羽幽", style: "甜歌", love: null},
                {name: "两只老虎", artist: "孙羽幽", style: "甜歌", love: null},
                {name: "一点点温柔", artist: "孙羽幽", style: "甜歌", love: null},
                {name: "不会分手的恋人", artist: "孙羽幽、阿庆", style: "甜歌", love: null},
                {name: "大猪蹄子", artist: "孙紫涵", style: "甜歌", love: null},
                {name: "门没锁", artist: "唐筱优", style: "甜歌", love: null},
                {name: "深夜地下铁", artist: "陶钰玉", style: "甜歌", love: null},
                {name: "爱很简单", artist: "陶喆", style: "甜歌", love: null},
                {name: "就是爱你", artist: "陶喆", style: "甜歌", love: null},
                {name: "今天你要嫁给我", artist: "陶喆、蔡依林", style: "甜歌", love: null},
                {name: "多莉宝贝", artist: "童可可", style: "甜歌", love: null},
                {name: "怪我咯", artist: "童可可", style: "甜歌", love: null},
                {name: "萌二代", artist: "童可可", style: "甜歌", love: null},
                {name: "萌萌哒", artist: "童可可", style: "甜歌", love: null},
                {name: "不分手的恋爱", artist: "汪苏泷", style: "甜歌", love: null},
                {name: "吵架歌", artist: "汪苏泷", style: "甜歌", love: null},
                {name: "万有引力", artist: "汪苏泷", style: "甜歌", love: null},
                {name: "唯你懂我心", artist: "汪苏泷", style: "甜歌", love: null},
                {name: "小星星", artist: "汪苏泷", style: "甜歌", love: null},
                {name: "一笑倾城", artist: "汪苏泷", style: "甜歌", love: null},
                {name: "有点甜", artist: "汪苏泷", style: "甜歌", love: null},
                {name: "去年夏天", artist: "王大毛", style: "甜歌", love: null},
                {name: "心引力", artist: "王俊凯、蔡依林", style: "甜歌", love: true},
                {name: "我多喜欢你你会知道", artist: "王俊琪", style: "甜歌", love: null},
                {name: "公转自转", artist: "王力宏", style: "甜歌", love: null},
                {name: "唯一", artist: "王力宏", style: "甜歌", love: null},
                {name: "星座", artist: "王力宏", style: "甜歌", love: null},
                {name: "确定一定以及肯定", artist: "王水洋", style: "甜歌", love: null},
                {name: "da da da", artist: "王心凌", style: "甜歌", love: null},
                {name: "I Do", artist: "王心凌", style: "甜歌", love: null},
                {name: "爱你", artist: "王心凌", style: "甜歌", love: null},
                {name: "爱情加油", artist: "王心凌", style: "甜歌", love: null},
                {name: "月光", artist: "王心凌", style: "甜歌", love: null},
                {name: "哥本哈根的童话", artist: "王心如", style: "甜歌", love: null},
                {name: "云淡风轻", artist: "王欣宇", style: "甜歌", love: true},
                {name: "爱情错觉", artist: "王娅", style: "甜歌", love: null},
                {name: "Everything sucks哈喽你好", artist: "王玉萌", style: "甜歌", love: null},
                {name: "苹果与蝴蝶", artist: "王筝", style: "甜歌", love: null},
                {name: "啊77", artist: "网络歌手", style: "甜歌", love: true},
                {name: "大黄老鼠皮卡丘", artist: "网络歌手", style: "甜歌", love: null},
                {name: "广角美女", artist: "温岚", style: "甜歌", love: null},
                {name: "突然好想你", artist: "五月天", style: "甜歌", love: null},
                {name: "私奔到月球", artist: "五月天、陈绮贞", style: "甜歌", love: null},
                {name: "爱你爱到死", artist: "夏宇童", style: "甜歌", love: null},
                {name: "爱的魔法", artist: "夏雨桐", style: "甜歌", love: null},
                {name: "非你不爱", artist: "弦子", style: "甜歌", love: null},
                {name: "看走眼", artist: "弦子", style: "甜歌", love: null},
                {name: "老鼠爱大米", artist: "香香", style: "甜歌", love: null},
                {name: "猪之歌", artist: "香香", style: "甜歌", love: null},
                {name: "爱情通关密语", artist: "萧亚轩", style: "甜歌", love: null},
                {name: "潇洒小姐", artist: "萧亚轩", style: "甜歌", love: null},
                {name: "目极皆是你", artist: "小F4", style: "甜歌", love: null},
                {name: "学猫叫", artist: "小峰峰", style: "甜歌", love: null},
                {name: "专属电影", artist: "小贱", style: "甜歌", love: null},
                {name: "从热恋到永远", artist: "小可乐", style: "甜歌", love: null},
                {name: "想对你说", artist: "小潘潘", style: "甜歌", love: null},
                {name: "眼睛", artist: "小潘潘", style: "甜歌", love: null},
                {name: "死性不改", artist: "小柔小姐", style: "甜歌", love: null},
                {name: "晚安晚安", artist: "小三金", style: "甜歌", love: null},
                {name: "小跳蛙", artist: "小斯", style: "甜歌", love: null},
                {name: "山妖", artist: "小星星", style: "甜歌", love: true},
                {name: "你是我的bsby boy", artist: "小佑", style: "甜歌", love: null},
                {name: "格斗宝贝", artist: "小缘", style: "甜歌", love: null},
                {name: "猪头哥哥", artist: "肖小胖", style: "甜歌", love: null},
                {name: "带你去旅行", artist: "校长", style: "甜歌", love: null},
                {name: "所念皆星河", artist: "欣然", style: "甜歌", love: null},
                {name: "123我爱你", artist: "新乐尘符", style: "甜歌", love: null},
                {name: "草莓圣代", artist: "新乐尘符", style: "甜歌", love: null},
                {name: "大神带带我", artist: "新乐尘符", style: "甜歌", love: null},
                {name: "好像恋爱了", artist: "新乐尘符", style: "甜歌", love: null},
                {name: "每一句都很甜", artist: "新乐尘符", style: "甜歌", love: null},
                {name: "巧克力", artist: "新乐尘符", style: "甜歌", love: null},
                {name: "未来旅行", artist: "新乐尘符", style: "甜歌", love: null},
                {name: "青柠", artist: "徐秉龙、桃十五", style: "甜歌", love: null},
                {name: "I Wanna Be With You", artist: "徐洁儿", style: "甜歌", love: null},
                {name: "飞机场", artist: "徐良", style: "甜歌", love: null},
                {name: "创作者", artist: "徐良/本兮", style: "甜歌", love: null},
                {name: "星座恋人", artist: "徐良/吴昕", style: "甜歌", love: null},
                {name: "小雨天气", artist: "徐梦圆", style: "甜歌", love: null},
                {name: "恒星", artist: "许茹芸", style: "甜歌", love: null},
                {name: "云且留住", artist: "许茹芸", style: "甜歌", love: true},
                {name: "惊鸿一面", artist: "许嵩", style: "甜歌", love: null},
                {name: "你若成风", artist: "许嵩", style: "甜歌", love: null},
                {name: "素颜", artist: "许嵩", style: "甜歌", love: null},
                {name: "温泉", artist: "许嵩", style: "甜歌", love: null},
                {name: "我乐意", artist: "许嵩", style: "甜歌", love: true},
                {name: "祝你爱我到天荒地老", artist: "颜人中", style: "甜歌", love: null},
                {name: "如果我可以把你忘记", artist: "颜小健", style: "甜歌", love: null},
                {name: "芥末巧克力", artist: "杨丞琳", style: "甜歌", love: null},
                {name: "理想情人", artist: "杨丞琳", style: "甜歌", love: null},
                {name: "庆祝", artist: "杨丞琳", style: "甜歌", love: null},
                {name: "缺氧", artist: "杨丞琳", style: "甜歌", love: null},
                {name: "牛奶面包", artist: "杨紫", style: "甜歌", love: null},
                {name: "十九岁的一天", artist: "杨紫怡", style: "甜歌", love: null},
                {name: "好想要牵你的手", artist: "一口甜", style: "甜歌", love: null},
                {name: "麋鹿森林", artist: "一口甜", style: "甜歌", love: null},
                {name: "文字游戏", artist: "一口甜", style: "甜歌", love: null},
                {name: "喜欢你", artist: "一口甜", style: "甜歌", love: null},
                {name: "想和你在一起", artist: "一口甜", style: "甜歌", love: null},
                {name: "宇宙环游日记", artist: "一口甜", style: "甜歌", love: null},
                {name: "36.5℃", artist: "音阙诗听", style: "甜歌", love: null},
                {name: "这一刻，奔赴你", artist: "尹昔眠", style: "甜歌", love: null},
                {name: "刚刚好遇到", artist: "盈妹妹", style: "甜歌", love: null},
                {name: "蠢货", artist: "喻言", style: "甜歌", love: null},
                {name: "爱×无限大", artist: "元若兰", style: "甜歌", love: null},
                {name: "99次我爱他", artist: "元若蓝", style: "甜歌", love: null},
                {name: "心愿便利贴", artist: "元若蓝", style: "甜歌", love: null},
                {name: "下一秒", artist: "张碧晨", style: "甜歌", love: null},
                {name: "最想念的季节", artist: "张含韵", style: "甜歌", love: null},
                {name: "保护色", artist: "张韶涵", style: "甜歌", love: null},
                {name: "淋雨一直走", artist: "张韶涵", style: "甜歌", love: null},
                {name: "欧若拉", artist: "张韶涵", style: "甜歌", love: null},
                {name: "如果的事", artist: "张韶涵", style: "甜歌", love: null},
                {name: "宝贝", artist: "张悬", style: "甜歌", love: null},
                {name: "芒种", artist: "赵方婧", style: "甜歌", love: null},
                {name: "直觉", artist: "赵方婧", style: "甜歌", love: null},
                {name: "甜甜咸咸", artist: "赵芷彤", style: "甜歌", love: null},
                {name: "虫儿飞", artist: "郑伊健", style: "甜歌", love: null},
                {name: "棉花糖", artist: "至上励合", style: "甜歌", love: null},
                {name: "爱降落", artist: "中国娃娃", style: "甜歌", love: null},
                {name: "哥哥妹妹采茶歌", artist: "中国娃娃", style: "甜歌", love: null},
                {name: "我爱你", artist: "中国娃娃", style: "甜歌", love: null},
                {name: "我不想想你", artist: "中国娃娃", style: "甜歌", love: null},
                {name: "告白气球", artist: "周杰伦", style: "甜歌", love: null},
                {name: "简单爱", artist: "周杰伦", style: "甜歌", love: null},
                {name: "可爱女人", artist: "周杰伦", style: "甜歌", love: null},
                {name: "迷迭香", artist: "周杰伦", style: "甜歌", love: null},
                {name: "你听的到", artist: "周杰伦", style: "甜歌", love: null},
                {name: "七里香", artist: "周杰伦", style: "甜歌", love: null},
                {name: "甜甜的", artist: "周杰伦", style: "甜歌", love: null},
                {name: "园游会", artist: "周杰伦", style: "甜歌", love: null},
                {name: "画沙", artist: "周杰伦、袁咏琳", style: "甜歌", love: null},
                {name: "好想你", artist: "朱主爱", style: "甜歌", love: null},
                {name: "亲亲猪猪宝贝", artist: "庄真羚", style: "甜歌", love: null},
                {name: "有的城堡", artist: "卓文萱", style: "甜歌", love: null},
                {name: "童年", artist: "卓依婷", style: "甜歌", love: null},
                {name: "捉泥鳅", artist: "卓依婷", style: "甜歌", love: null},
                {name: "好想拥有无敌超能力", artist: "邹念慈", style: "甜歌", love: null},
                {name: "数到十就奔向你", artist: "锦零", style: "甜歌", love: null},
                {name: "遇", artist:"ai.mini", style: "甜歌", love: null},
                {name: "百万萝莉过大江", artist:"剑三", style: "甜歌", love: null},
                {name: "零几年听的情歌", artist:"AY杨老三", style: "甜歌", love: null},
                {name: "洗澡歌", artist:"圈圈宝贝", style: "甜歌", love: null},
                {name: "即刻晚风", artist:"小蓝背心", style: "甜歌", love: null},
                {name: "公路站台", artist:"绎曲", style: "甜歌", love: null},
                {name: "特别的人台", artist:"方大同", style: "甜歌", love: null},
                {name: "有一种悲伤", artist: "A Lin", style: "致郁", love: null},
                {name: "爱上你" , artist: "BY2", style: "致郁", love: null},
                {name: "不是故意", artist: "BY2", style: "致郁", love: null},
                {name: "曾经的约定", artist: "BY2", style: "致郁", love: null},
                {name: "你并不懂我", artist: "BY2", style: "致郁", love: null},
                {name: "我知道", artist: "BY2", style: "致郁", love: null},
                {name: "嚣张", artist: "en", style: "致郁", love: null},
                {name: "心欲止水", artist: "Ice Paper", style: "致郁", love: null},
                {name: "说散就散", artist: "JC", style: "致郁", love: null},
                {name: "三千发", artist: "kent", style: "致郁", love: null},
                {name: "隐藏", artist: "kent", style: "致郁", love: null},
                {name: "心如止水", artist: "lce paper", style: "致郁", love: null},
                {name: "612星球", artist: "SHE", style: "致郁", love: null},
                {name: "yes i love you", artist: "SHE", style: "致郁", love: null},
                {name: "爱我的资格", artist: "SHE", style: "致郁", love: null},
                {name: "安静了", artist: "SHE", style: "致郁", love: null},
                {name: "斗牛士之歌", artist: "SHE", style: "致郁", love: null},
                {name: "候鸟", artist: "SHE", style: "致郁", love: null},
                {name: "你不会", artist: "SHE", style: "致郁", love: null},
                {name: "你太诚实", artist: "SHE", style: "致郁", love: null},
                {name: "热带雨林", artist: "SHE", style: "致郁", love: null},
                {name: "天灰", artist: "SHE", style: "致郁", love: null},
                {name: "紫藤花", artist: "SHE", style: "致郁", love: null},
                {name: "还是喜欢你", artist: "sweety", style: "致郁", love: null},
                {name: "想你", artist: "try", style: "致郁", love: null},
                {name: "蓝色灰色", artist: "Zkaaai", style: "致郁", love: null},
                {name: "过客", artist: "阿涵", style: "致郁", love: null},
                {name: "爱与忌妒", artist: "阿悄", style: "致郁", love: null},
                {name: "哭笑不得", artist: "阿悄", style: "致郁", love: null},
                {name: "陪我去流浪", artist: "阿悄", style: "致郁", love: null},
                {name: "情歌忘了告诉我", artist: "阿悄", style: "致郁", love: null},
                {name: "时光", artist: "阿悄", style: "致郁", love: null},
                {name: "小背叛", artist: "阿悄", style: "致郁", love: null},
                {name: "笑颜", artist: "阿悄", style: "致郁", love: null},
                {name: "在深秋", artist: "阿悄", style: "致郁", love: null},
                {name: "寂寞在唱歌", artist: "阿桑", style: "致郁", love: null},
                {name: "叶子", artist: "阿桑", style: "致郁", love: null},
                {name: "一直很安静", artist: "阿桑", style: "致郁", love: null},
                {name: "直到你降临", artist: "阿肆", style: "致郁", love: null},
                {name: "错位时空", artist: "艾辰", style: "致郁", love: null},
                {name: "是想你的声音啊", artist: "傲七爷", style: "致郁", love: null},
                {name: "告诉自己忘了他", artist: "本兮", style: "致郁", love: null},
                {name: "过眼飘散", artist: "本兮", style: "致郁", love: null},
                {name: "海誓山盟亦会分开", artist: "本兮", style: "致郁", love: null},
                {name: "你从不知道我的心", artist: "本兮", style: "致郁", love: null},
                {name: "柒末雪", artist: "本兮", style: "致郁", love: null},
                {name: "轻轻", artist: "本兮", style: "致郁", love: null},
                {name: "无语", artist: "本兮", style: "致郁", love: null},
                {name: "下雪的季节", artist: "本兮", style: "致郁", love: null},
                {name: "一首歌倾诉所有", artist: "本兮", style: "致郁", love: null},
                {name: "最后的最后", artist: "本兮", style: "致郁", love: null},
                {name: "一个深爱的女孩", artist: "本兮", style: "致郁", love: null},
                {name: "收敛", artist: "不够", style: "致郁", love: null},
                {name: "依恋", artist: "蔡淳佳", style: "致郁", love: null},
                {name: "我可以", artist: "蔡旻佑", style: "致郁", love: null},
                {name: "倒带", artist: "蔡依林", style: "致郁", love: null},
                {name: "柠檬草的味道", artist: "蔡依林", style: "致郁", love: null},
                {name: "奴隶船", artist: "蔡依林", style: "致郁", love: null},
                {name: "诗人漫步", artist: "蔡依林", style: "致郁", love: null},
                {name: "真的傻", artist: "蔡咏琪", style: "致郁", love: null},
                {name: "一个人想着一个人", artist: "曾沛慈", style: "致郁", love: null},
                {name: "拥挤", artist: "茶二娘", style: "致郁", love: null},
                {name: "离线留言", artist: "陈嘉唯", style: "致郁", love: null},
                {name: "心动", artist: "陈洁仪", style: "致郁", love: null},
                {name: "尘埃", artist: "陈粒", style: "致郁", love: null},
                {name: "华丽的冒险", artist: "陈绮贞", style: "致郁", love: null},
                {name: "旅行的意义", artist: "陈绮贞", style: "致郁", love: null},
                {name: "蓝颜知己", artist: "陈倩倩", style: "致郁", love: null},
                {name: "梦醒时分", artist: "陈淑桦", style: "致郁", love: null},
                {name: "独家记忆", artist: "陈小春", style: "致郁", love: null},
                {name: "绿色", artist: "陈雪凝", style: "致郁", love: null},
                {name: "不哭了", artist: "BY2", style: "致郁", love: null},
                {name: "漠河舞厅", artist: "戴羽彤", style: "致郁", love: null},
                {name: "阵雨天", artist: "是二智呀", style: "致郁", love: null},
                {name: "你的酒馆对我打了烊", artist: "陈雪凝", style: "致郁", love: null},
                {name: "淘汰", artist: "陈奕迅", style: "致郁", love: null},
                {name: "患得患失", artist: "陈尤利", style: "致郁", love: null},
                {name: "千里共婵娟", artist: "程响", style: "致郁", love: null},
                {name: "一花一世界", artist: "程响", style: "致郁", love: null},
                {name: "归雪", artist: "川儿", style: "致郁", love: null},
                {name: "傀心", artist: "崔子格", style: "致郁", love: null},
                {name: "念", artist: "大柯", style: "致郁", love: null},
                {name: "你要的爱", artist: "戴佩妮", style: "致郁", love: null},
                {name: "怎样", artist: "戴佩妮", style: "致郁", love: null},
                {name: "泡沫", artist: "邓紫棋", style: "致郁", love: null},
                {name: "猜不透", artist: "丁当", style: "致郁", love: null},
                {name: "我爱他", artist: "丁当", style: "致郁", love: null},
                {name: "吻安", artist: "丁娜、胜屿", style: "致郁", love: null},
                {name: "雪", artist: "杜雯媞", style: "致郁", love: null},
                {name: "是非题", artist: "范玮琪", style: "致郁", love: null},
                {name: "我要我们在一起", artist: "范晓萱", style: "致郁", love: null},
                {name: "雪人", artist: "范晓萱", style: "致郁", love: null},
                {name: "氧气", artist: "范晓萱", style: "致郁", love: null},
                {name: "三人游", artist: "方大同", style: "致郁", love: null},
                {name: "云烟成雨", artist: "房东的猫", style: "致郁", love: null},
                {name: "我们的爱", artist: "F.I.R.飞儿乐团", style: "致郁", love: null},
                {name: "暗夜谁", artist: "绯雨菲弦", style: "致郁", love: null},
                {name: "影子小姐", artist: "封茗囧菌", style: "致郁", love: null},
                {name: "避风港", artist: "冯曦妤", style: "致郁", love: null},
                {name: "何必呢", artist: "格子兮", style: "致郁", love: null},
                {name: "悬溺", artist: "葛东琪", style: "致郁", love: null},
                {name: "中毒", artist: "光泽", style: "致郁", love: null},
                {name: "下一个天亮", artist: "郭静", style: "致郁", love: null},
                {name: "心墙", artist: "郭静", style: "致郁", love: null},
                {name: "幸福不远", artist: "郭书瑶", style: "致郁", love: null},
                {name: "你一定要幸福", artist: "何洁", style: "致郁", love: null},
                {name: "小永远", artist: "何洁", style: "致郁", love: null},
                {name: "秋天别来", artist: "侯湘婷", style: "致郁", love: null},
                {name: "樱树花", artist: "胡爱彤", style: "致郁", love: null},
                {name: "指纹", artist: "胡歌", style: "致郁", love: null},
                {name: "单飞", artist: "胡灵", style: "致郁", love: null},
                {name: "多情种", artist: "胡杨林", style: "致郁", love: null},
                {name: "往后余生", artist: "花僮", style: "致郁", love: null},
                {name: "归去来兮", artist: "花粥", style: "致郁", love: null},
                {name: "真爱你的云", artist: "黄国俊", style: "致郁", love: null},
                {name: "给我一个理由忘记", artist: "黄丽玲", style: "致郁", love: null},
                {name: "风月", artist: "黄龄", style: "致郁", love: null},
                {name: "热气球", artist: "黄淑惠", style: "致郁", love: null},
                {name: "那女孩对我说", artist: "黄义达", style: "致郁", love: null},
                {name: "趁早", artist: "季彦霖", style: "致郁", love: null},
                {name: "可不可以", artist: "季彦霖", style: "致郁", love: null},
                {name: "选择失忆", artist: "季彦霖", style: "致郁", love: null},
                {name: "亲爱的你怎么不在我身边", artist: "江美琪", style: "致郁", love: null},
                {name: "练习题", artist: "江映蓉", style: "致郁", love: null},
                {name: "我太乖", artist: "江映蓉", style: "致郁", love: null},
                {name: "悲伤的秋千", artist: "金海心", style: "致郁", love: null},
                {name: "那么骄傲", artist: "金海心", style: "致郁", love: null},
                {name: "笨蛋", artist: "金莎", style: "致郁", love: null},
                {name: "亲爱的还幸福吗", artist: "金莎", style: "致郁", love: null},
                {name: "若只如初见", artist: "金莎", style: "致郁", love: null},
                {name: "我懂了", artist: "金莎", style: "致郁", love: null},
                {name: "星月神话", artist: "金莎", style: "致郁", love: null},
                {name: "最近好吗", artist: "金莎", style: "致郁", love: null},
                {name: "他还在", artist: "金娃娃", style: "致郁", love: null},
                {name: "岁月神偷", artist: "金玟岐", style: "致郁", love: null},
                {name: "流着泪说分手", artist: "金志文", style: "致郁", love: null},
                {name: "影子", artist: "锦零", style: "致郁", love: null},
                {name: "撒野", artist: "凯瑟喵", style: "致郁", love: null},
                {name: "阿拉斯加海湾", artist: "蓝心羽", style: "致郁", love: null},
                {name: "茫", artist: "李润祺", style: "致郁", love: null},
                {name: "我们的纪念", artist: "李雅微", style: "致郁", love: null},
                {name: "雨蝴", artist: "李翊君", style: "致郁", love: null},
                {name: "分手快乐", artist: "梁静茹", style: "致郁", love: null},
                {name: "给未来的自己", artist: "梁静茹", style: "致郁", love: null},
                {name: "没有人像你", artist: "梁静茹", style: "致郁", love: null},
                {name: "情歌", artist: "梁静茹", style: "致郁", love: null},
                {name: "如果有一天", artist: "梁静茹", style: "致郁", love: null},
                {name: "问", artist: "梁静茹", style: "致郁", love: null},
                {name: "说爱我", artist: "梁一贞", style: "致郁", love: null},
                {name: "一个人生活", artist: "林凡", style: "致郁", love: null},
                {name: "可惜没如果", artist: "林俊杰", style: "致郁", love: null},
                {name: "那些你很冒险的梦", artist: "林俊杰", style: "致郁", love: null},
                {name: "杀手", artist: "林俊杰", style: "致郁", love: null},
                {name: "企鹅", artist: "林小柯", style: "致郁", love: null},
                {name: "说谎", artist: "林宥嘉", style: "致郁", love: null},
                {name: "自然醒", artist: "林宥嘉", style: "致郁", love: null},
                {name: "我们就到这", artist: "林子开琪", style: "致郁", love: null},
                {name: "第二顺位", artist: "林子琪", style: "致郁", love: null},
                {name: "输给时间", artist: "林子琪/小贱", style: "致郁", love: null},
                {name: "疏远", artist: "刘初寻", style: "致郁", love: null},
                {name: "心动心痛", artist: "刘畊宏、许慧欣", style: "致郁", love: null},
                {name: "我的心好冷", artist: "刘佳", style: "致郁", love: null},
                {name: "一个人走", artist: "刘佳", style: "致郁", love: null},
                {name: "成全", artist: "刘若英", style: "致郁", love: null},
                {name: "后来", artist: "刘若英", style: "致郁", love: null},
                {name: "走在冷风中", artist: "刘思涵", style: "致郁", love: null},
                {name: "如昨", artist: "刘惜君", style: "致郁", love: null},
                {name: "我很快乐", artist: "刘惜君", style: "致郁", love: null},
                {name: "怎么唱情歌", artist: "刘惜君", style: "致郁", love: null},
                {name: "关于你的心事", artist: "刘梓炎", style: "致郁", love: null},
                {name: "是想你的声音啊", artist: "柳湘云", style: "致郁", love: null},
                {name: "刻在我心底的名字", artist: "卢广仲", style: "致郁", love: null},
                {name: "赤道和北极", artist: "卢茜", style: "致郁", love: null},
                {name: "爱转角", artist: "罗志详", style: "致郁", love: null},
                {name: "相思", artist: "毛阿敏", style: "致郁", love: null},
                {name: "不值得", artist: "孟飞船", style: "致郁", love: null},
                {name: "如果没有你", artist: "莫文蔚", style: "致郁", love: null},
                {name: "梦一场", artist: "那英", style: "致郁", love: null},
                {name: "默", artist: "那英", style: "致郁", love: null},
                {name: "下雨天", artist: "南拳妈妈", style: "致郁", love: null},
                {name: "堪培拉的风", artist: "暖乐团", style: "致郁", love: null},
                {name: "夜夜夜夜", artist: "齐秦", style: "致郁", love: null},
                {name: "天亮以前说再见", artist: "曲肖冰", style: "致郁", love: null},
                {name: "飞机", artist: "任然", style: "致郁", love: null},
                {name: "飞鸟与蝉", artist: "任然", style: "致郁", love: null},
                {name: "后继者", artist: "任然", style: "致郁", love: null},
                {name: "空空如也", artist: "任然", style: "致郁", love: null},
                {name: "无人之岛", artist: "任然", style: "致郁", love: null},
                {name: "风筝，飞鸟", artist: "任舒瞳", style: "致郁", love: null},
                {name: "暗香", artist: "沙宝高", style: "致郁", love: null},
                {name: "如果爱能早些说出来", artist: "山野", style: "致郁", love: null},
                {name: "爱河", artist: "神马乐团", style: "致郁", love: null},
                {name: "冬眠", artist: "司南", style: "致郁", love: null},
                {name: "忘却", artist: "苏琛", style: "致郁", love: null},
                {name: "我还能抱你吗", artist: "苏二零", style: "致郁", love: null},
                {name: "离岸", artist: "苏晗", style: "致郁", love: null},
                {name: "爱如空气", artist: "孙俪", style: "致郁", love: null},
                {name: "我不难过", artist: "孙燕姿", style: "致郁", love: null},
                {name: "不同世界", artist: "孙羽幽", style: "致郁", love: null},
                {name: "蝶", artist: "孙羽幽", style: "致郁", love: null},
                {name: "回来好吗", artist: "孙羽幽", style: "致郁", love: null},
                {name: "前任身份", artist: "孙羽幽", style: "致郁", love: null},
                {name: "危险表演", artist: "孙羽幽", style: "致郁", love: null},
                {name: "要有一点点想我", artist: "孙羽幽", style: "致郁", love: null},
                {name: "蛹", artist: "孙羽幽", style: "致郁", love: null},
                {name: "这该死的异地恋", artist: "孙羽幽", style: "致郁", love: null},
                {name: "害怕爱你", artist: "孙羽幽、心大俊", style: "致郁", love: null},
                {name: "你会不会怪我", artist: "孙羽幽、心大俊", style: "致郁", love: null},
                {name: "雪落下的声音", artist: "谭维维", style: "致郁", love: null},
                {name: "无名指的等待", artist: "谭欣懿", style: "致郁", love: null},
                {name: "我不知道", artist: "唐笑", style: "致郁", love: null},
                {name: "寂寞的季节", artist: "陶喆", style: "致郁", love: null},
                {name: "你就不要想起我", artist: "田馥甄", style: "致郁", love: null},
                {name: "一个人也能好好过", artist: "童可可", style: "致郁", love: null},
                {name: "yes周杰伦", artist: "荼靡", style: "致郁", love: null},
                {name: "新不了情", artist: "万芳", style: "致郁", love: null},
                {name: "巴赫旧约", artist: "汪苏泷", style: "致郁", love: null},
                {name: "风度", artist: "汪苏泷", style: "致郁", love: null},
                {name: "他的爱", artist: "汪苏泷", style: "致郁", love: null},
                {name: "像鱼", artist: "王贰浪", style: "致郁", love: null},
                {name: "飞蛾扑火", artist: "王键", style: "致郁", love: null},
                {name: "沦陷", artist: "王靖雯", style: "致郁", love: null},
                {name: "爱我不要丢下我", artist: "王思思", style: "致郁", love: null},
                {name: "我真的受伤了", artist: "王菀之", style: "致郁", love: null},
                {name: "爱的天国", artist: "王心凌", style: "致郁", love: null},
                {name: "花的嫁衣", artist: "王心凌", style: "致郁", love: null},
                {name: "明天见", artist: "王心凌", style: "致郁", love: null},
                {name: "忘了我也不错", artist: "王心凌", style: "致郁", love: null},
                {name: "我会好好的", artist: "王心凌", style: "致郁", love: null},
                {name: "原谅", artist: "王玉华", style: "致郁", love: null},
                {name: "三妻四妾", artist: "王媛渊", style: "致郁", love: null},
                {name: "恋人心", artist: "魏新雨", style: "致郁", love: null},
                {name: "夏天的风", artist: "温岚", style: "致郁", love: null},
                {name: "你不是真正的快乐", artist: "五月天", style: "致郁", love: null},
                {name: "习惯", artist: "夏婉安", style: "致郁", love: null},
                {name: "第三者的第三者", artist: "弦子", style: "致郁", love: null},
                {name: "舍不得", artist: "弦子", style: "致郁", love: null},
                {name: "天真", artist: "弦子", style: "致郁", love: null},
                {name: "命运", artist: "香香", style: "致郁", love: null},
                {name: "对不起我爱你", artist: "萧萧", style: "致郁", love: null},
                {name: "握不住的他", artist: "萧萧", style: "致郁", love: null},
                {name: "怎么办我爱你", artist: "萧萧", style: "致郁", love: null},
                {name: "错的人", artist: "萧亚轩", style: "致郁", love: null},
                {name: "类似爱情", artist: "萧亚轩", style: "致郁", love: null},
                {name: "突然想起你", artist: "萧亚轩", style: "致郁", love: null},
                {name: "从前说", artist: "小阿七", style: "致郁", love: null},
                {name: "烟雨蒙蒙", artist: "小堇色", style: "致郁", love: null},
                {name: "我怕来者不是你", artist: "小蓝背心", style: "致郁", love: null},
                {name: "发呆", artist: "小楠楠", style: "致郁", love: null},
                {name: "让心跳停了", artist: "小暖", style: "致郁", love: null},
                {name: "还想听你的故事", artist: "谢春花、王碧浪", style: "致郁", love: null},
                {name: "第三天", artist: "谢雨欣", style: "致郁", love: null},
                {name: "谁", artist: "谢雨欣", style: "致郁", love: null},
                {name: "纷飞", artist: "徐怀钰", style: "致郁", love: null},
                {name: "失落沙洲", artist: "徐佳莹", style: "致郁", love: null},
                {name: "红妆", artist: "徐良", style: "致郁", love: null},
                {name: "即使说抱歉", artist: "徐良", style: "致郁", love: null},
                {name: "女骑士", artist: "徐良", style: "致郁", love: null},
                {name: "天真", artist: "徐良", style: "致郁", love: null},
                {name: "无颜女", artist: "徐良", style: "致郁", love: null},
                {name: "抽离", artist: "徐良、刘丹萌", style: "致郁", love: null},
                {name: "爱笑的眼睛", artist: "徐若瑄", style: "致郁", love: null},
                {name: "七月七日晴", artist: "许慧欣", style: "致郁", love: null},
                {name: "不爱我放了我", artist: "许茹芸", style: "致郁", love: null},
                {name: "好听", artist: "许茹芸", style: "致郁", love: null},
                {name: "如果云知道", artist: "许茹芸", style: "致郁", love: null},
                {name: "不煽情", artist: "许嵩", style: "致郁", love: null},
                {name: "幻听", artist: "许嵩", style: "致郁", love: null},
                {name: "灰色头像", artist: "许嵩", style: "致郁", love: null},
                {name: "庐州月", artist: "许嵩", style: "致郁", love: null},
                {name: "清明雨上", artist: "许嵩", style: "致郁", love: null},
                {name: "如果当时", artist: "许嵩", style: "致郁", love: null},
                {name: "丑八怪", artist: "薛之谦", style: "致郁", love: null},
                {name: "其实", artist: "薛之谦", style: "致郁", love: null},
                {name: "认真的雪", artist: "薛之谦", style: "致郁", love: null},
                {name: "演员", artist: "薛之谦", style: "致郁", love: null},
                {name: "三寸天堂", artist: "严艺丹", style: "致郁", love: null},
                {name: "傻孩子", artist: "阎韦伶", style: "致郁", love: null},
                {name: "我是个傻瓜", artist: "颜小健", style: "致郁", love: null},
                {name: "暧昧", artist: "杨丞琳", style: "致郁", love: null},
                {name: "带我走", artist: "杨丞琳", style: "致郁", love: null},
                {name: "过敏", artist: "杨丞琳", style: "致郁", love: null},
                {name: "倔强", artist: "杨丞琳", style: "致郁", love: null},
                {name: "可爱", artist: "杨丞琳", style: "致郁", love: null},
                {name: "少年维特的烦恼", artist: "杨丞琳", style: "致郁", love: null},
                {name: "失眠的睡美人", artist: "杨丞琳", style: "致郁", love: null},
                {name: "雨爱", artist: "杨丞琳", style: "致郁", love: null},
                {name: "在你怀里微笑", artist: "杨丞琳", style: "致郁", love: null},
                {name: "找不到", artist: "杨丞琳", style: "致郁", love: null},
                {name: "左边", artist: "杨丞琳", style: "致郁", love: null},
                {name: "值得", artist: "叶倩文", style: "致郁", love: null},
                {name: "相念于心", artist: "叶炫清", style: "致郁", love: null},
                {name: "慢慢等", artist: "一口甜", style: "致郁", love: null},
                {name: "海底", artist: "一支榴莲", style: "致郁", love: null},
                {name: "安静听完这一首", artist: "依稀", style: "致郁", love: null},
                {name: "白夜", artist: "尹妹贻", style: "致郁", love: null},
                {name: "落空", artist: "印子月", style: "致郁", love: null},
                {name: "那又如何", artist: "应嘉俐", style: "致郁", love: null},
                {name: "穷极一生到不了的天堂", artist: "于潼", style: "致郁", love: null},
                {name: "体面", artist: "于文文", style: "致郁", love: null},
                {name: "朋友们都结婚去了", artist: "宇衡", style: "致郁", love: null},
                {name: "时间煮雨", artist: "郁可唯", style: "致郁", love: null},
                {name: "指望", artist: "郁可唯", style: "致郁", love: null},
                {name: "绿袖子", artist: "元若蓝", style: "致郁", love: null},
                {name: "想我了吗", artist: "袁成杰", style: "致郁", love: null},
                {name: "旅行中忘记", artist: "袁娅维", style: "致郁", love: null},
                {name: "心语心愿", artist: "张柏芝", style: "致郁", love: null},
                {name: "拾忆", artist: "张翰", style: "致郁", love: null},
                {name: "honey money", artist: "张惠春", style: "致郁", love: null},
                {name: "记得", artist: "张惠妹", style: "致郁", love: null},
                {name: "如果你也听说", artist: "张惠妹", style: "致郁", love: null},
                {name: "听海", artist: "张惠妹", style: "致郁", love: null},
                {name: "云中的angel", artist: "张杰", style: "致郁", love: null},
                {name: "画心", artist: "张靓颖", style: "致郁", love: null},
                {name: "来不及说爱你", artist: "张靓颖", style: "致郁", love: null},
                {name: "如果爱下去", artist: "张靓颖", style: "致郁", love: null},
                {name: "天下无双", artist: "张靓颖", style: "致郁", love: null},
                {name: "爱的旅程", artist: "张韶涵", style: "致郁", love: null},
                {name: "复活节", artist: "张韶涵", style: "致郁", love: null},
                {name: "偶尔", artist: "张韶涵", style: "致郁", love: null},
                {name: "亲爱的那不是爱情", artist: "张韶涵", style: "致郁", love: null},
                {name: "我的最爱", artist: "张韶涵", style: "致郁", love: null},
                {name: "遗失的美好", artist: "张韶涵", style: "致郁", love: null},
                {name: "过火", artist: "张信哲", style: "致郁", love: null},
                {name: "信仰", artist: "张信哲", style: "致郁", love: null},
                {name: "我是真的受伤了", artist: "张学友", style: "致郁", love: null},
                {name: "只是太爱你", artist: "赵大紫", style: "致郁", love: null},
                {name: "尽头", artist: "赵方婧", style: "致郁", love: null},
                {name: "最初的温柔", artist: "赵乃吉", style: "致郁", love: null},
                {name: "离别的车站", artist: "赵薇", style: "致郁", love: null},
                {name: "分手假期", artist: "钟洁", style: "致郁", love: null},
                {name: "season", artist: "周笔畅", style: "致郁", love: null},
                {name: "冬天的私密", artist: "周传雄", style: "致郁", love: null},
                {name: "风铃", artist: "周惠", style: "致郁", love: null},
                {name: "预言", artist: "周惠", style: "致郁", love: null},
                {name: "爱情悬崖", artist: "周杰伦", style: "致郁", love: null},
                {name: "安静", artist: "周杰伦", style: "致郁", love: null},
                {name: "暗号", artist: "周杰伦", style: "致郁", love: null},
                {name: "白色风车", artist: "周杰伦", style: "致郁", love: null},
                {name: "半岛铁盒", artist: "周杰伦", style: "致郁", love: null},
                {name: "不能说的秘密", artist: "周杰伦", style: "致郁", love: null},
                {name: "彩虹", artist: "周杰伦", style: "致郁", love: null},
                {name: "稻香", artist: "周杰伦", style: "致郁", love: null},
                {name: "等你下课", artist: "周杰伦", style: "致郁", love: null},
                {name: "断了的弦", artist: "周杰伦", style: "致郁", love: null},
                {name: "反方向的钟", artist: "周杰伦", style: "致郁", love: null},
                {name: "枫", artist: "周杰伦", style: "致郁", love: null},
                {name: "搁浅", artist: "周杰伦", style: "致郁", love: null},
                {name: "给我一首歌的时间", artist: "周杰伦", style: "致郁", love: null},
                {name: "轨迹", artist: "周杰伦", style: "致郁", love: null},
                {name: "黑色毛衣", artist: "周杰伦", style: "致郁", love: null},
                {name: "黑色幽默", artist: "周杰伦", style: "致郁", love: null},
                {name: "花海", artist: "周杰伦", style: "致郁", love: null},
                {name: "回到过去", artist: "周杰伦", style: "致郁", love: null},
                {name: "开不了口", artist: "周杰伦", style: "致郁", love: null},
                {name: "龙卷风", artist: "周杰伦", style: "致郁", love: null},
                {name: "明明就", artist: "周杰伦", style: "致郁", love: null},
                {name: "蒲公英的约定", artist: "周杰伦", style: "致郁", love: null},
                {name: "晴天", artist: "周杰伦", style: "致郁", love: null},
                {name: "珊瑚海", artist: "周杰伦", style: "致郁", love: null},
                {name: "世界末日", artist: "周杰伦", style: "致郁", love: null},
                {name: "手写的从前", artist: "周杰伦", style: "致郁", love: null},
                {name: "说好的幸福呢", artist: "周杰伦", style: "致郁", love: null},
                {name: "退后", artist: "周杰伦", style: "致郁", love: null},
                {name: "我不配", artist: "周杰伦", style: "致郁", love: null},
                {name: "心雨", artist: "周杰伦", style: "致郁", love: null},
                {name: "最伟大的作品", artist: "周杰伦", style: "致郁", love: null},
                {name: "最长的电影", artist: "周杰伦", style: "致郁", love: null},
                {name: "大鱼", artist: "周深", style: "致郁", love: null},
                {name: "化身孤岛的鲸", artist: "周深", style: "致郁", love: null},
                {name: "愿", artist: "周深", style: "致郁", love: null},
                {name: "不想", artist: "周思涵", style: "致郁", love: null},
                {name: "爱在身边", artist: "周兴哲", style: "致郁", love: null},
                {name: "我爱过你", artist: "周兴哲", style: "致郁", love: null},
                {name: "怎么了", artist: "周兴哲", style: "致郁", love: null},
                {name: "飘摇", artist: "周迅", style: "致郁", love: null},
                {name: "好可惜", artist: "庄心妍", style: "致郁", love: null},
                {name: "洛丽塔", artist: "卓亚君", style: "致郁", love: null},
                {name: "终不换", artist: "于文文", style: "致郁", love: null},
                {name: "虚拟", artist: "陈粒", style: "致郁", love: null},
                {name: "想念拟人化", artist: "孟慧圆", style: "致郁", love: null},
                {name: "当我唱起这首歌", artist: "小贱/星弟", style: "致郁", love: null},
                {name: "水星记", artist: "郭顶", style: "致郁", love: null},
                {name: "那时以为", artist: "苏星婕", style: "致郁", love: null},
                {name: "滴滴滴", artist: "许哲佩", style: "致郁", love: null},
                {name: "那时以为", artist: "苏星婕", style: "致郁", love: null},
                {name: "如果我变成回忆", artist: "tank", style: "致郁", love: null},
                {name: "贝多芬的悲伤", artist: "Zey(郑毅) ", style: "致郁", love: null},
                {name: "不了了之", artist: "冰淇", style: "致郁", love: null},
                {name: "耿", artist: "汪苏泷", style: "致郁", love: null},
                {name: "最天使", artist: "曾轶可", style: "致郁", love: null},
                {name: "我喜欢上你时的内心活动", artist: "陈绮贞", style: "致郁", love: null},
                {name: "天后", artist: "陈势安", style: "致郁", love: null},
                {name: "天使的翅膀", artist: "陈依梦", style: "致郁", love: null},
                {name: "追", artist: "陈壹千", style: "致郁", love: null},
                {name: "红玫瑰", artist: "陈奕迅", style: "致郁", love: null},
                {name: "想念拟人化", artist: "孟慧圆", style: "致郁", love: null},
                {name: "当我唱起这首歌", artist: "小贱/星弟", style: "致郁", love: null},
                {name: "慢冷", artist: "梁静茹", style: "致郁", love: null},
                {name: "两清", artist: "烟（许佳豪）", style: "致郁", love: null},
                {name: "一个深受的女孩", artist: "本兮", style: "致郁", love: null},
                {name: "爱存在", artist: "王诗安", style: "致郁", love: null},
                {name: "父亲", artist: "筷子兄弟", style: "致郁", love: null},
                {name: "时间长了受不了", artist: "庄心妍", style: "治愈", love: null},
                {name: "月牙湾", artist: "A Lin", style: "治愈", love: null},
                {name: "愿你", artist: "昼夜", style: "治愈", love: null},
                {name: "永不失联的爱", artist: "周兴哲", style: "治愈", love: null},
                {name: "星晴", artist: "周杰伦", style: "治愈", love: null},
                {name: "约定", artist: "周惠", style: "治愈", love: null},
                {name: "笔记", artist: "周笔畅", style: "治愈", love: null},
                {name: "真心不假", artist: "赵薇", style: "治愈", love: null},
                {name: "爱我别走", artist: "张震岳", style: "治愈", love: null},
                {name: "小宇", artist: "张震岳", style: "治愈", love: null},
                {name: "偏爱", artist: "张云京", style: "治愈", love: null},
                {name: "一个人", artist: "张艺兴", style: "治愈", love: null},
                {name: "crystal plane", artist: "张瑶", style: "治愈", love: null},
                {name: "爱就一个字", artist: "张信哲", style: "治愈", love: null},
                {name: "萱草花", artist: "张小斐", style: "治愈", love: null},
                {name: "看的最远的地方", artist: "张韶涵", style: "治愈", love: null},
                {name: "梦里花", artist: "张韶涵", style: "治愈", love: null},
                {name: "呐喊", artist: "张韶涵", style: "治愈", love: null},
                {name: "隐形的翅膀", artist: "张靓颖", style: "治愈", love: null},
                {name: "着魔", artist: "张杰", style: "治愈", love: null},
                {name: "当你孤单你会想起谁", artist: "张栋梁", style: "治愈", love: null},
                {name: "小乌龟", artist: "张栋梁", style: "治愈", love: null},
                {name: "等你到冬天", artist: "张德伊玲", style: "治愈", love: null},
                {name: "暖心", artist: "郁可唯", style: "治愈", love: null},
                {name: "侧脸", artist: "于果", style: "治愈", love: null},
                {name: "不下雨就出太阳吧", artist: "游鸿明", style: "治愈", love: null},
                {name: "昨日青空", artist: "尤长靖", style: "治愈", love: null},
                {name: "浮木", artist: "悠然然", style: "治愈", love: null},
                {name: "奔赴星空", artist: "尹昔眠", style: "治愈", love: null},
                {name: "落在生命里的光", artist: "尹昔眠", style: "治愈", love: null},
                {name: "爱不单行", artist: "叶炫清", style: "治愈", love: null},
                {name: "脆弱星球", artist: "杨胖雨", style: "治愈", love: null},
                {name: "爱的供养", artist: "杨幂", style: "治愈", love: null},
                {name: "只想爱你", artist: "杨丞琳", style: "治愈", love: null},
                {name: "重新认识我", artist: "杨丞琳", style: "治愈", love: null},
                {name: "绿洲", artist: "颜小健、任然", style: "治愈", love: null},
                {name: "解药", artist: "颜小健", style: "治愈", love: null},
                {name: "全球变冷", artist: "许嵩", style: "治愈", love: null},
                {name: "我依然爱你", artist: "许茹芸", style: "治愈", love: null},
                {name: "城里的月光", artist: "许美静", style: "治愈", love: null},
                {name: "寻水的鱼", artist: "许飞", style: "治愈", love: null},
                {name: "光阴独白", artist: "徐佳莹", style: "治愈", love: null},
                {name: "红黑", artist: "小星星", style: "治愈", love: null},
                {name: "向云端", artist: "小霞、海洋bo", style: "治愈", love: null},
                {name: "一个人", artist: "夏婉安", style: "治愈", love: null},
                {name: "巷子和树", artist: "西二", style: "治愈", love: null},
                {name: "拥抱", artist: "五月天", style: "治愈", love: null},
                {name: "后来的我们", artist: "五月天", style: "治愈", love: null},
                {name: "年轮说", artist: "吴奕妤", style: "治愈", love: null},
                {name: "一路生花", artist: "温奕心", style: "治愈", love: null},
                {name: "同手同脚", artist: "温岚", style: "治愈", love: null},
                {name: "爱存在", artist: "魏奇奇", style: "治愈", love: null},
                {name: "流星雨又来临", artist: "魏晨", style: "治愈", love: null},
                {name: "我们都是好孩子", artist: "王筝", style: "治愈", love: null},
                {name: "还是好朋友", artist: "王心凌", style: "治愈", love: null},
                {name: "第一次爱的人", artist: "王心凌", style: "治愈", love: null},
                {name: "黄昏晓", artist: "王心凌", style: "治愈", love: null},
                {name: "小星星", artist: "王心凌", style: "治愈", love: null},
                {name: "羽毛", artist: "王心凌", style: "治愈", love: null},
                {name: "这就是爱", artist: "王心凌", style: "治愈", love: null},
                {name: "是不是爱情", artist: "王若琳", style: "治愈", love: null},
                {name: "有你的快乐", artist: "王若琳", style: "治愈", love: null},
                {name: "爸爸妈妈", artist: "王蓉", style: "治愈", love: null},
                {name: "揉碎夜的光", artist: "王靖雯", style: "治愈", love: null},
                {name: "红豆", artist: "王菲", style: "治愈", love: null},
                {name: "旋木", artist: "王菲", style: "治愈", love: null},
                {name: "这条小鱼在乎", artist: "王OK", style: "治愈", love: null},
                {name: "还是", artist: "兔子ST", style: "治愈", love: null},
                {name: "小幸运", artist: "田馥甄", style: "治愈", love: null},
                {name: "普通朋友", artist: "陶喆", style: "治愈", love: null},
                {name: "如果有来生", artist: "谭维维", style: "治愈", love: null},
                {name: "时光手扎", artist: "孙羽幽", style: "治愈", love: null},
                {name: "开始懂了", artist: "孙燕姿", style: "治愈", love: null},
                {name: "我想你的时候", artist: "苏二零", style: "治愈", love: null},
                {name: "小情歌", artist: "苏打绿", style: "治愈", love: null},
                {name: "欢", artist: "苏琛", style: "治愈", love: null},
                {name: "星河万里", artist: "苏贝贝", style: "治愈", love: null},
                {name: "一生有你", artist: "水木年华", style: "治愈", love: null},
                {name: "单向箭头", artist: "双笙", style: "治愈", love: null},
                {name: "漫长的告白", artist: "双笙", style: "治愈", love: null},
                {name: "胆小鬼", artist: "容祖儿", style: "治愈", love: null},
                {name: "有可能的夜晚", artist: "任然", style: "治愈", love: null},
                {name: "我的歌声里", artist: "曲婉婷", style: "治愈", love: null},
                {name: "霞光", artist: "曲锦楠", style: "治愈", love: null},
                {name: "太阳", artist: "邱振哲", style: "治愈", love: null},
                {name: "大天蓬", artist: "清er", style: "治愈", love: null},
                {name: "喜欢两个人", artist: "彭佳慧", style: "治愈", love: null},
                {name: "明天 你好", artist: "牛奶咖啡", style: "治愈", love: null},
                {name: "越长大越孤单", artist: "牛奶咖啡", style: "治愈", love: null},
                {name: "慢一点", artist: "你的九儿", style: "治愈", love: null},
                {name: "慢慢喜欢你", artist: "莫文蔚", style: "治愈", love: null},
                {name: "勇气", artist: "棉子", style: "治愈", love: null},
                {name: "爱斯基摩", artist: "蜜雪薇琪", style: "治愈", love: null},
                {name: "火", artist: "曼陀罗乐队", style: "治愈", love: null},
                {name: "9420", artist: "麦小兜", style: "治愈", love: null},
                {name: "爱转角", artist: "罗志祥", style: "治愈", love: null},
                {name: "靠近", artist: "罗震环", style: "治愈", love: null},
                {name: "恋爱的距离", artist: "刘梓炎", style: "治愈", love: null},
                {name: "多想留在你身边", artist: "刘增瞳", style: "治愈", love: null},
                {name: "那年春天下着雪", artist: "刘心", style: "治愈", love: null},
                {name: "恋风恋歌", artist: "刘惜君", style: "治愈", love: null},
                {name: "房间", artist: "刘瑞琦", style: "治愈", love: null},
                {name: "感官先生", artist: "刘凤瑶", style: "治愈", love: null},
                {name: "朝汐", artist: "泠鸢yousa和双笙", style: "治愈", love: null},
                {name: "想自由", artist: "林宥嘉", style: "治愈", love: null},
                {name: "至少还有你", artist: "林依莲", style: "治愈", love: null},
                {name: "非你莫属", artist: "林依晨", style: "治愈", love: null},
                {name: "Always online", artist: "林俊杰", style: "治愈", love: null},
                {name: "她说", artist: "林俊杰", style: "治愈", love: null},
                {name: "爱久见人心", artist: "梁静茹", style: "治愈", love: null},
                {name: "崇拜", artist: "梁静茹", style: "治愈", love: null},
                {name: "孤单北半球", artist: "梁静茹", style: "治愈", love: null},
                {name: "可乐戒指", artist: "梁静茹", style: "治愈", love: null},
                {name: "无条件为你", artist: "梁静茹", style: "治愈", love: null},
                {name: "勇气", artist: "梁静茹", style: "治愈", love: null},
                {name: "宁夏", artist: "梁静茹", style: "治愈", love: null},
                {name: "你那边还好吗", artist: "李子阳", style: "治愈", love: null},
                {name: "下个路口再见吧", artist: "李宇春", style: "治愈", love: null},
                {name: "雨蝶", artist: "李翊君", style: "治愈", love: null},
                {name: "贝加尔湖畔", artist: "李健", style: "治愈", love: null},
                {name: "悬崖的花", artist: "冷漠", style: "治愈", love: null},
                {name: "老男孩", artist: "筷子兄弟", style: "治愈", love: null},
                {name: "这一生关于你的风景", artist: "枯木逢春", style: "治愈", love: null},
                {name: "被风吹过的夏天", artist: "金莎、林俊杰", style: "治愈", love: null},
                {name: "午夜唱情歌", artist: "姜玉阳", style: "治愈", love: null},
                {name: "星辰大海", artist: "黄霄雲", style: "治愈", love: null},
                {name: "纸短情长", artist: "花粥", style: "治愈", love: null},
                {name: "浮白", artist: "花粥", style: "治愈", love: null},
                {name: "六月的雨", artist: "胡歌", style: "治愈", love: null},
                {name: "逍遥叹", artist: "胡歌", style: "治愈", love: null},
                {name: "请先说你好", artist: "贺一航", style: "治愈", love: null},
                {name: "水星记", artist: "郭顶", style: "治愈", love: null},
                {name: "第一次", artist: "光良", style: "治愈", love: null},
                {name: "a little love", artist: "冯曦妤", style: "治愈", love: null},
                {name: "荒", artist: "封茗囧菌", style: "治愈", love: null},
                {name: "写给我第一个喜欢的女孩的歌", artist: "封茗囧菌", style: "治愈", love: null},
                {name: "孤单摩天轮", artist: "飞轮海", style: "治愈", love: null},
                {name: "遇到", artist: "方雅贤", style: "治愈", love: null},
                {name: "春风吹", artist: "方大同", style: "治愈", love: null},
                {name: "关于爱的定义", artist: "方大同", style: "治愈", love: null},
                {name: "陪我长大", artist: "段奥娟", style: "治愈", love: null},
                {name: "爱要坦荡荡", artist: "丁丁", style: "治愈", love: null},
                {name: "白月光与朱砂痣", artist: "大籽", style: "治愈", love: null},
                {name: "四季予你", artist: "程响", style: "治愈", love: null},
                {name: "听风的鲸", artist: "程嘉敏", style: "治愈", love: null},
                {name: "我的世界", artist: "陈姿彤", style: "治愈", love: null},
                {name: "爱的回归线", artist: "陈韵若、陈每文", style: "治愈", love: null},
                {name: "阴天快乐", artist: "陈奕迅", style: "治愈", love: null},
                {name: "孤勇者", artist: "陈奕迅", style: "治愈", love: null},
                {name: "还是会寂寞", artist: "陈绮贞", style: "治愈", love: null},
                {name: "小半", artist: "陈粒", style: "治愈", love: null},
                {name: "夜车", artist: "曾轶可", style: "治愈", love: null},
                {name: "讲真的", artist: "曾惜", style: "治愈", love: null},
                {name: "追光者", artist: "岑宁儿", style: "治愈", love: null},
                {name: "爱上了一条街", artist: "蔡依林", style: "治愈", love: null},
                {name: "越来越不懂", artist: "蔡健雅", style: "治愈", love: null},
                {name: "红色高跟鞋", artist: "蔡健雅", style: "治愈", love: null},
                {name: "陪我看日出", artist: "蔡淳佳", style: "治愈", love: null},
                {name: "枕边童话", artist: "傲七爷", style: "治愈", love: null},
                {name: "童话末", artist: "夏喘喘，沙朵", style: "治愈",love: null},
                {name: "童话镇", artist: "暗杠", style: "治愈", love: null},
                {name: "有你陪着我", artist: "安又琪", style: "治愈", love: null},
                {name: "愿", artist: "艾辰", style: "治愈", love: null},
                {name: "起风了", artist: "阿泱", style: "治愈", love: null},
                {name: "爱与妒忌", artist: "阿悄", style: "治愈", love: null},
                {name: "海海海", artist: "阿悄", style: "治愈", love: null},
                {name: "任性爱", artist: "阿悄", style: "治愈", love: null},
                {name: "舍子花", artist: "阿悄", style: "治愈", love: null},
                {name: "莫斯科没有眼泪", artist: "Twins", style: "治愈", love: null},
                {name: "给我你的爱", artist: "tank", style: "治愈", love: null},
                {name: "专属天使", artist: "tank", style: "治愈", love: null},
                {name: "Always On My Mind", artist: "SHE", style: "治愈", love: null},
                {name: "belief", artist: "SHE", style: "治愈", love: null},
                {name: "nothing ever changes", artist: "SHE", style: "治愈", love: null},
                {name: "白色恋歌", artist: "SHE", style: "治愈", love: null},
                {name: "河滨公园", artist: "SHE", style: "治愈", love: null},
                {name: "花都开好了", artist: "SHE", style: "治愈", love: null},
                {name: "恋人未满", artist: "SHE", style: "治愈", love: null},
                {name: "一眼万年", artist: "SHE", style: "治愈", love: null},
                {name: "爱我的每个人", artist: "Selina", style: "治愈", love: null},
                {name: "杀破狼", artist: "JS", style: "治愈", love: null},
                {name: "光年之外", artist: "G.E.M.邓紫棋", style: "治愈", love: null},
                {name: "雨樱花", artist: "F.I.R.飞儿乐团", style: "治愈", love: null},
                {name: "勇敢", artist: "BY2", style: "治愈", love: null},
                {name: "月牙湾", artist: "A Lin", style: "治愈", love: null},
                {name: "一千零一个愿望", artist: "4 in love", style: "治愈", love: null},
                {name: "再见中国海", artist: "4 in love", style: "治愈", love: null},
                {name: "能遇见你就已经够了", artist: " 杪夏sumika", style: "治愈", love: true},
                {name: "续写", artist: "单依纯", style: "情歌", love: null},
                {name: "180度", artist: "孙燕姿", style: "情歌", love: null},
                {name: "写满爱", artist: "孙羽幽、心大俊", style: "原创", love: null},
                {name: "对不起有用吗", artist: "孙羽幽、心大俊", style: "原创", love: null},
                {name: "确认过眼神", artist: "孙羽幽", style: "原创", love: null},
                {name: "你看我可不可爱", artist: "孙羽幽", style: "原创", love: null},
                {name: "小哥哥一起吗", artist: "孙羽幽", style: "原创", love: null},
                {name: "不分手的恋人", artist: "孙羽幽", style: "原创", love: null},
                {name: "曾经的你", artist: "孙羽幽", style: "原创", love: null},
                {name: "耳听爱情", artist: "孙羽幽", style: "原创", love: null},
                {name: "服输", artist: "孙羽幽", style: "原创", love: null},
                {name: "归兮词", artist: "孙羽幽", style: "原创", love: null},
                {name: "黑色的伞", artist: "孙羽幽", style: "原创", love: null},
                {name: "黄昏的海", artist:"孙羽幽", style: "原创", love: null},
                {name: "今天", artist: "孙羽幽", style: "原创", love: null},
                {name: "爱河插电(总能有的)", artist: "蒋雪儿", style: "绝密", love: null},
                {name: "好汉歌(唱过有切片)", artist: "刘欢", style: "绝密", love: null },
                {name: "让风告诉你(学了两年)", artist: "花玲、喵☆酱 、宴宁 、kinsen", style: "绝密", love: null},
                {name: "moon halo(直播是跟乐唱过)", artist: "茶理理、TetraCalyx、Hanser", style: "绝密", love: null},
                {name: "默画", artist: "孙羽幽", style: "原创", love: null},
                {name: "奇了怪", artist: "孙羽幽", style: "原创", love: null},
                {name: "三行情书", artist: "孙羽幽", style: "原创", love: null},
                {name: "深海", artist: "孙羽幽", style: "原创", love: null},
                {name: "叹", artist: "孙羽幽", style: "原创", love: null},
                {name: "幸福长大", artist: "孙羽幽", style: "原创", love: null},
                {name: "压箱底", artist: "孙羽幽", style: "原创", love: null},
                {name: "一秒", artist: "孙羽幽", style: "原创", love: null},
                {name: "易年", artist: "孙羽幽", style: "原创", love: null},
                {name: "因为你不喜欢我", artist: "孙羽幽", style: "原创", love: null},
                {name: "羽音幽幽", artist: "孙羽幽", style: "原创", love: null},
                {name: "醉红缘", artist: "孙羽幽", style: "原创", love: null},
                {name: "几段感情", artist: "孙羽幽", style: "原创", love: null},
                {name: "爱了", artist: "孙羽幽", style: "原创", love: null},
                {name: "时光不散", artist: "孙羽幽", style: "原创", love: null},
                {name: "还记得他", artist: "孙羽幽", style: "原创", love: null},
                {name: "青巷", artist: "孙羽幽", style: "原创", love: null},
                {name: "杀阡陌", artist: "孙羽幽", style: "原创", love: null},
                {name: "十月的离别", artist: "孙羽幽", style: "原创", love: null},
                {name: "朱丽叶的秋天", artist: "孙羽幽", style: "原创", love: null},
                {name: "专属约定", artist: "孙羽幽", style: "原创", love: null},
                {name: "种豆南山下", artist: "孙羽幽", style: "原创", love: null},
                {name: "笑如花", artist: "孙羽幽", style: "原创", love: null},
                {name: "5267", artist: "孙羽幽", style: "原创", love: null},
                {name: "花不语", artist: "孙羽幽", style: "原创", love: null},
                {name: "你是我留不住的风景", artist: "单小源,孙羽幽", style: "原创 ", love: null},
                {name: "如果当初没有开口", artist: "孙羽幽", style: "原创", love: null},
                {name: "三个人的旅行", artist: "孙羽幽", style: "原创", love: null},
                {name: "温暖牌", artist: "孙羽幽", style: "原创", love: null},
                {name: "爱是", artist: "孙羽幽", style: "原创", love: null},
                {name: "你的心跳", artist: "孙羽幽", style: "原创", love: null},
                {name: "谢谢你守护的爱", artist: "孙羽幽", style: "原创", love: null},
                {name: "千方百计", artist: "MJ-7 _ 毛一鹏 _ 孙羽幽", style: "原创", love: null},
                {name: "被困疑心岛", artist: "孙羽幽", style: "原创", love:true },
                {name: "局部有雨", artist: "孙羽幽", style: "原创", love: true },
                {name: "雪停下来的时候", artist: "孙羽幽", style: "原创", love: true },
                {name: "遇见晴天", artist: "孙羽幽", style: "原创", love: null},
                {name: "无法言喻", artist: "孙羽幽", style: "原创 ", love: null},
                {name: "错过晚风", artist: "孙羽幽", style: "原创 ", love: null},
                {name: "七秒钟的记忆", artist: "孙羽幽", style: "提督", love: null},
                {name: "虐心", artist: "孙羽幽", style: "提督", love: null},
                {name: "情话", artist: "孙羽幽", style: "提督", love: null},
                {name: "确认过眼神", artist: "孙羽幽", style: "提督", love: null},
                {name: "天下无双", artist: "张靓颖", style: "提督", love: null},
                {name: "爱殇", artist: "小时姑娘", style: "提督", love: null},
                {name: "百万个吻", artist: "陈明真", style: "提督", love: null},
                {name: "死性不改", artist: "小柔小姐", style: "提督", love: null},
                {name: "我不上你的当", artist: "宝宝巴士", style: "提督", love: null},
                {name: "人间不值得", artist: "大柯", style: "提督", love: null},
                {name: "爱情错觉", artist: "王娅", style: "提督", love: null},
                {name: "心念", artist: "黄诗扶", style: "提督", love: null},
                {name: "美丽的神话", artist: "孙楠/韩红", style: "提督", love: null},
                {name: "浮木", artist: "KANATA雪,缪木弯弯", style: "提督", love: null},
                {name: "亲亲猪猪宝贝", artist: "庄真羚", style: "提督", love: null},
                {name: "忐忑", artist: "龚琳娜", style: "提督", love: null},
                {name: "勇气大爆发", artist: "土豆王国乐队", style: "提督", love: null},
            ];

        let searchTimer = null;
        let isDrawing = false;
        let currentStyle = 'all'; // 当前选中的曲风

        // 初始化页面
        document.addEventListener('DOMContentLoaded', function() {
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
            });
        });

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
                'all': '全部',
                '古风': '古风',
                '甜歌': '甜歌',
                '致郁': '致郁',
                '治愈': '治愈',
                '情歌': '情歌',
                '原创': '原创',
                '提督': '提督',
                '绝密': '绝密'
            }[currentStyle];
            
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
    </script>
</body>
</html>