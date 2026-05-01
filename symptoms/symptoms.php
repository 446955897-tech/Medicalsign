<?php
include '../database/db.php'; 
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl"> <head>
    <meta charset="UTF-8">
    <title>استكشف الأعراض الطبية</title>
    <link rel="stylesheet" href="../CSS/style.css"> 
</head>

<body class="symptoms-body">
<div class="logo-top-corner">
    <a href="index.php">
        <img src="../images/logo.png" alt="MedicalSign">
    </a>
</div>

<div class="symp-container" style="margin-top: 50px;"> 

    <div class="header-actions" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; gap: 15px; flex-wrap: wrap;">
        <h2 style="margin:0; font-size: 2.2rem; color: #1a508b;">استكشف الأعراض الطبية</h2>
        
        <a href="index.php" class="symp-btn btn-back" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px; padding: 10px 22px; background: #fff !important; border: 1px solid #ddd !important; color: #333 !important; border-radius: 50px;">
            العودة للرئيسية⬅️ 
        </a>
    </div>

    <input type="search" id="searchbar" onkeyup="searchSymptoms()" placeholder="ابحث عن عرض…" style="margin-bottom: 40px; width: 100%; padding: 15px; border-radius: 12px; border: 1px solid #e0e0e0; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
    <?php
    echo '<div class="symp_grid" id="cards" aria-live="polite">';
    echo '<div class="symp_grid" id="cards" aria-live="polite">';

   
    $res = mysqli_query($conn, "SELECT id, name_ar, description_ar, icon, video_url FROM symptoms ORDER BY created_at DESC, id DESC");

    if (!$res) {
        die('<pre style="direction:ltr;background:#fee;border:1px solid #fbb;padding:10px">SQL ERROR: ' . htmlspecialchars(mysqli_error($conn), ENT_QUOTES, 'UTF-8') . '</pre>');
    }

    if (mysqli_num_rows($res) === 0) {
        echo '<p class="empty">لا توجد أعراض مسجّلة حالياً.</p>';
    } else {
        while ($row = mysqli_fetch_assoc($res)) {
            
            $title = $row['name_ar'];
            $desc  = $row['description_ar'];

           
            $emoji = "🔍"; 
            if (mb_strpos($title, 'صداع') !== false) $emoji = "🤕";
            elseif (mb_strpos($title, 'زكام') !== false) $emoji = "🤧";
            elseif (mb_strpos($title, 'كحة') !== false) $emoji = "😷";
            elseif (mb_strpos($title, 'حرارة') !== false) $emoji = "🤒";
            elseif (mb_strpos($title, 'ألم') !== false) $emoji = "😫";
            elseif (mb_strpos($title, 'غثيان') !== false) $emoji = "🤢";
            elseif (mb_strpos($title, 'قيء') !== false) $emoji = "🤮";

           
            $statusText = "معلومات عامة";
            $statusStyle = ""; 

            if (mb_strpos($desc, 'ألم') !== false || mb_strpos($title, 'ضيق') !== false) {
                $statusText = "يحتاج انتباه";
                $statusStyle = "style='background:#fff5f5; color:#e53e3e;'"; 
            }

            echo '<article class="symp-card" data-title="'. htmlspecialchars($title) .'">';
                echo '<div class="status-tag" '.$statusStyle.'>'.$statusText.'</div>';
                
                echo '<div class="card-img" style="display:flex; align-items:center; justify-content:center; font-size:45px; background:#f0f7ff; margin: 0 auto 15px; width:90px; height:90px; border-radius:50%;">';
                echo $emoji;
                echo '</div>';

                echo '<h3>'. htmlspecialchars($title, ENT_QUOTES, "UTF-8") .'</h3>';
                echo '<p class="desc">'. htmlspecialchars(mb_strimwidth($desc, 0, 100, "...", "UTF-8"), ENT_QUOTES, "UTF-8") .'</p>';
                
                echo '<div style="margin-top:12px">';
                    echo '<a href="symptom-details.php?id='. (int)$row['id'] .'" class="symp-btn">التفاصيل</a>';
                echo '</div>';
            echo '</article>';
        }
    }

    echo '    </div>';
    echo '</div>';
    ?>

 <script src=".../JAVA S/script.js"></script>
<script>
function searchSymptoms() {
    let input = document.getElementById('searchbar').value.toLowerCase().trim();
    let cards = document.getElementsByClassName('symp-card');

    for (let i = 0; i < cards.length; i++) {
        let title = cards[i].getAttribute('data-title') || "";
        if (title.toLowerCase().includes(input)) {
            cards[i].style.setProperty('display', 'flex', 'important');
        } else {
            cards[i].style.setProperty('display', 'none', 'important');
        }
    }
}
</script>
</body>
</html>